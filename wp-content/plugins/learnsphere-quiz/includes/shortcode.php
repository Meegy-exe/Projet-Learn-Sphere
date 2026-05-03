<?php

// shortcode: outil qui gère laffichage, fonction wordpress

// SECURITE:
// abspath constante définie par wordpress
// arrete le script si quelqu'un tente dacceder au fichier via un autre path

// esc_html: securité (injection de code)
// le score nest pas stocké dans la bdd donc pas possible dinjection sql

// administration protégé via acf (gere le nettoyage des datas avant de mettre dans la bdd)

// asbsint(): absolute integer natif de wordpress force la data a etre un nombre entier positif

// esc_url: verifie que ladresse img est bien url valide et propre

if (!defined('ABSPATH')) {
    exit;
}


// affichage du quiz en raccourcis
// fonction qui sera appelée pour le shortcode
// genere le html du quiz
function display_learnsphere_quiz($atts)
{
    // recupere les para du shortcode
    // 2 facon soit via le shortcode, soit lid de la page
    $atts = shortcode_atts(array('id' => null), $atts);

    // definit lid du quiz a afficher par defaut
    // asbsint(): absolute integer natif de wordpress force la data a etre un nombre entier positif
    $quiz_id = $atts['id'] ? absint($atts['id']) : get_the_ID();

    // vérifie si ACF est activé
    // evite les erreurs si le plugin nest pas installé
    if (!function_exists('get_field')) {
        return "Erreur : ACF doit être installé pour ce quiz.";
    }

    // var qui stocker le html
    $output = '<div class="ls-quiz-container">';

    // fix affichage image
    // cherche à 2 endroits
    // 1er img mise en avant
    if (has_post_thumbnail($quiz_id)) {
        $output .= '<div class="ls-quiz-header-image">';
        $output .= '<img src="' . esc_url(get_the_post_thumbnail_url($quiz_id, 'large')) . '" alt="Illustration du quiz">';
        $output .= '</div>';
    } else {
        // sinon champ acf
        $img = get_field('image_d_illustration', $quiz_id);
        if ($img) {
            $output .= '<div class="ls-quiz-header-image">';
            $output .= '<img src="' . esc_url($img['url']) . '" alt="Illustration du quiz">';
            $output .= '</div>';
        }
    }

    // affiche le titre
    $output .= '<h2 class="ls-quiz-main-title">' . get_the_title($quiz_id) . '</h2>';

    // requete qui va cibler les questions lié au quiz
    $questions_query = new WP_Query(array(
        // nom question
        'post_type' => 'quiz_learnsphere',
        // toutes les questions
        'posts_per_page' => -1,
        'meta_query' => array(
            // met dans un tab
            array(
                'key' => 'quiz_parent',
                'value' => $quiz_id,
                'compare' => 'LIKE'
            )
        )
    ));

    // SI il y a des questions alors
    if ($questions_query->have_posts()) {
        $output .= '<form id="quiz-form-' . $quiz_id . '" class="ls-quiz-form">';
        $q_index = 1;

        // boucle a chaque question
        while ($questions_query->have_posts()) {
            $questions_query->the_post();
            $q_id = get_the_ID();

            // recupere les infos de la question via ACF
            $question_text = get_field('question', $q_id);
            $correct_answer = get_field('reponse_correcte', $q_id);

            $output .= '<div class="ls-question-card" data-solution="' . esc_attr($correct_answer) . '">';
            // esc_html: securité (injection de code)
            $output .= '<h4 class="ls-question-text">' . $q_index . '. ' . esc_html($question_text) . '</h4>';

            // fix affichage choix
            // boucle sur 3 champs doptions (les reponses)
            for ($i = 1; $i <= 3; $i++) {
                // cible le champ reponse acf
                $reponse_texte = get_field('reponse_' . $i, $q_id);

                // SI reponse est vide alors recupere option de reponse
                if (!$reponse_texte) {
                    $reponse_texte = get_field('option_de_reponse_' . $i, $q_id);
                }

                // SI loption nest pas vide (sauf la 3) alors
                if ($reponse_texte) {
                    // value passe en true, ou false selon la reponse
                    // si reponse correspond au choix alors
                    // strtolower: ignre majustucule et trim les espaces
                    $est_correct = (strtolower(trim($reponse_texte)) === strtolower(trim($correct_answer))) ? '1' : '0';

                    $output .= '<div class="ls-answer-option">';
                    $output .= '<input type="radio" name="q' . $q_index . '" value="' . $est_correct . '" id="q' . $q_index . '_opt' . $i . '">';
                    $output .= '<label for="q' . $q_index . '_opt' . $i . '">' . esc_html($reponse_texte) . '</label>';
                    $output .= '</div>';
                }
            }
            $output .= '</div>';
            // passe a la question suivante
            // increment
            $q_index++;
        }

        // reboot la memoire a apres chaque boucle
        wp_reset_postdata();


        // btn qui lance la function js du calcul du score
        $output .= '<div class="ls-quiz-footer">';
        $output .= '<button type="button" onclick="calculateQuizScore(' . $quiz_id . ')" class="ls-btn-validate">Vérifier mes réponses</button>';
        // champs vide ou il y aura le score
        $output .= '<div id="ls-results-' . $quiz_id . '" class="ls-score-display"></div>';
        $output .= '</div>';

        $output .= '</form>';
    } else {
        // SINON si aucune question nest lié au quiz alors
        $output .= '<p class="ls-no-questions">Aucune question n' . "'" . 'a été liée à ce quiz pour le moment.</p>';
    }

    $output .= '</div>';
    return $output;
}

// stocke le shortcoe pour lutiliser en racourcis
add_shortcode('quiz_learnsphere', 'display_learnsphere_quiz');

// affichage des quizz
// function en gros comme un injecteur, injecte le contenu du quiz
add_filter('the_content', 'ls_auto_display_quiz');
function ls_auto_display_quiz($content)
{
    // SI la page affiché est une page unique et que la page appartient au cpt alors
    if (is_singular('quiz_learnsphere')) {
        // colle le shortcode au contenu
        $content .= do_shortcode('[quiz_learnsphere]');
    }
    return $content;
}