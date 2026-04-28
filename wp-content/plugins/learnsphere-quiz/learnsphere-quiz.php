<?php
/**
 * Plugin Name: LearnSphere Quiz
 * Description: Quiz dynamique utilisant CPT et ACF.
 * Version: 1.1
 * Author: Meegy & Magda
 */

if (!defined('ABSPATH'))
    exit;

// création du custom post type
// (menu quiz coté WordPress)
function ls_register_quiz_cpt()
{
    $labels = array(
        'name' => 'Quiz',
        'singular_name' => 'Quiz',
        'menu_name' => 'Quiz LearnSphere',
        'add_new' => 'Ajouter un Quiz',
        'add_new_item' => 'Ajouter un nouveau Quiz',
        'edit_item' => 'Modifier le Quiz',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title'),
        'rewrite' => array('slug' => 'quizz'),
    );

    register_post_type('quiz_learnsphere', $args);
}
add_action('init', 'ls_register_quiz_cpt');

// affichage du quiz en raccourcis
function display_learnsphere_quiz($atts)
{
    $atts = shortcode_atts(array(
        'id' => null,
    ), $atts);

    $quiz_id = $atts['id'] ? $atts['id'] : get_the_ID();

    // vérifie si ACF est activé
    if (!function_exists('get_field')) {
        return "Erreur : ACF doit être installé pour ce quiz.";
    }

    $output = '<div class="ls-quiz-wrapper shadow-sm p-4 mb-5 bg-white rounded border">';
    $output .= '<h2 class="mb-4 text-primary">' . get_the_title($quiz_id) . '</h2>';

    // atten que le champ ACF type repeater nommé liste_questions
    if (have_rows('liste_questions', $quiz_id)) {
        $output .= '<form id="quiz-form-' . $quiz_id . '">';

        $q_index = 1;
        while (have_rows('liste_questions', $quiz_id)) {
            the_row();
            $question_text = get_sub_field('intitule_question');

            $output .= '<div class="question-block mb-4">';
            $output .= '<h5>' . $q_index . '. ' . esc_html($question_text) . '</h5>';

            if (have_rows('choix_possibles')) {
                while (have_rows('choix_possibles')) {
                    the_row();
                    $reponse = get_sub_field('texte_reponse');
                    $is_correct = get_sub_field('est_correct');

                    $output .= '<div class="form-check">';
                    $output .= '<input class="form-check-input" type="radio" name="q' . $q_index . '" value="' . ($is_correct ? '1' : '0') . '">';
                    $output .= '<label class="form-check-label">' . esc_html($reponse) . '</label>';
                    $output .= '</div>';
                }
            }
            $output .= '</div>';
            $q_index++;
        }

        $output .= '<button type="button" onclick="checkQuiz(' . $quiz_id . ')" class="btn btn-success mt-3">Vérifier mes réponses</button>';
        $output .= '<div id="quiz-result-' . $quiz_id . '" class="mt-3 fw-bold"></div>';
        $output .= '</form>';
    } else {
        $output .= '<p>Aucune question trouvée pour ce quiz.</p>';
    }

    $output .= '</div>';

    // script pour la logique de test
    $output .= '
    <script>
    function checkQuiz(id) {
        let score = 0;
        let total = document.querySelectorAll("#quiz-form-" + id + " .question-block").length;
        let answers = document.querySelectorAll("#quiz-form-" + id + " input[type=\'radio\']:checked");
        
        answers.forEach(input => {
            if(input.value === "1") score++;
        });

        document.getElementById("quiz-result-" + id).innerHTML = "Score : " + score + " / " + total;
    }
    </script>';

    return $output;
}




add_shortcode('quiz_learnsphere', 'display_learnsphere_quiz');
