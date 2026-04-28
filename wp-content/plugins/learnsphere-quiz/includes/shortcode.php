<?php

// sécurité : abspath constante définie par wordpress
// arrete le script si quelqu'un tente dacceder au fichier

if (!defined('ABSPATH')) {
    exit;
}


// affichage du quiz en raccourcis
// fonction qui sera appelée pour le shortcode
function display_learnsphere_quiz($atts)
{
    // recupere les para du shortcode
    $atts = shortcode_atts(array(
        'id' => null,
    ), $atts);

    // definit lid du quiz a afficher par defaut
    // (celui du para ou lid de la page)
    $quiz_id = $atts['id'] ? $atts['id'] : get_the_ID();

    // vérifie si ACF est activé
    // evite les erreurs si le plugin nest pas installé
    if (!function_exists('get_field')) {
        return "Erreur : ACF doit être installé pour ce quiz.";
    }

    // var qui stocker le html
    $output = '<div class="ls-quiz-wrapper">';
    $output .= '<h2 class="ls-quiz-title">' . get_the_title($quiz_id) . '</h2>';

    // attend que le champ ACF type repeater nommé liste_questions ait des données
    if (have_rows('liste_questions', $quiz_id)) {
        // ouvre la balise form avec id unique
        $output .= '<form id="quiz-form-' . $quiz_id . '">';

        $q_index = 1;
        // boucle a chaque question
        while (have_rows('liste_questions', $quiz_id)) {
            the_row();
            $question_text = get_sub_field('intitule_question');

            $output .= '<div class="ls-question-block">';
            // esc_html: securité (injection de code)
            $output .= '<h5>' . $q_index . '. ' . esc_html($question_text) . '</h5>';

            // boucle sur les choix possibles
            if (have_rows('choix_possibles')) {
                while (have_rows('choix_possibles')) {
                    the_row();
                    $reponse = get_sub_field('texte_reponse');
                    $is_correct = get_sub_field('est_correct');

                    $output .= '<div class="ls-form-check">';
                    $output .= '<input class="ls-form-check-input" type="radio" name="q' . $q_index . '" value="' . ($is_correct ? '1' : '0') . '">';
                    $output .= '<label class="ls-form-check-label">' . esc_html($reponse) . '</label>';
                    $output .= '</div>';
                }
            }
            $output .= '</div>';
            // passe a la question suivante
            $q_index++;
        }

        // btn qui lance la function js du calcul du score
        $output .= '<button type="button" onclick="checkQuiz(' . $quiz_id . ')" class="ls-btn-submit">Vérifier mes réponses</button>';
        // champs vide ou il y aura le score
        $output .= '<div id="quiz-result-' . $quiz_id . '" class="ls-quiz-result"></div>';
        $output .= '</form>';
    } else {
        // sinon si le repeteur est vide echo :
        $output .= '<p>Aucune question trouvée pour ce quiz.</p>';
    }

    $output .= '</div>';


    return $output;
}




add_shortcode('quiz_learnsphere', 'display_learnsphere_quiz');
