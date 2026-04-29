<?php
/**
 * Plugin Name: LearnSphere Quiz Pro
 * Description: Plugin complet avec CPT et ACF
 * Version: osef
 * Author: Meegy & Magda
 */

if (!defined('ABSPATH')) exit;

// 1. ENREGISTREMENT DU CPT (L'interface d'administration)
function ls_register_quiz_cpt() {
    $args = array(
        'public' => true,
        'label'  => 'Quiz LearnSphere',
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title'),
        'has_archive' => true,
    );
    register_post_type('quiz_learnsphere', $args);
}
add_action('init', 'ls_register_quiz_cpt');

// 2. SHORTCODE D'AFFICHAGE
function ls_display_quiz_shortcode($atts) {
    $atts = shortcode_atts(array('id' => null), $atts);
    $quiz_id = $atts['id'] ? absint($atts['id']) : get_the_ID();

    if (!function_exists('get_field')) return "Veuillez activer ACF.";

    ob_start();
    if (have_rows('liste_questions', $quiz_id)) : ?>
        
        <div class="ls-quiz-wrapper mb-5" id="quiz-<?php echo $quiz_id; ?>">
            <h2 class="quiz-title"><?php echo esc_html(get_the_title($quiz_id)); ?></h2>
            
            <form id="ls-quiz-form-<?php echo $quiz_id; ?>">
                <?php $q_idx = 1; while (have_rows('liste_questions', $quiz_id)) : the_row(); ?>
                    
                    <div class="quiz-question-container mb-4">
                        <h5 class="question-text fw-bold">
                            <?php echo $q_idx; ?>. <?php the_sub_field('titre_question'); ?>
                        </h5>

                        <?php if (have_rows('choix')) : while (have_rows('choix')) : the_row(); ?>
                            <div class="form-check quiz-answer-option">
                                <input class="form-check-input" type="radio" 
                                       name="q<?php echo $q_idx; ?>" 
                                       value="<?php echo get_sub_field('est_correct') ? '1' : '0'; ?>" 
                                       required>
                                <label class="form-check-label">
                                    <?php the_sub_field('texte_reponse'); ?>
                                </label>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>

                <?php $q_idx++; endwhile; ?>

                <button type="button" onclick="lsValidateQuiz(<?php echo $quiz_id; ?>)" class="btn btn-primary">
                    Vérifier mes réponses
                </button>
            </form>

            <div id="ls-results-<?php echo $quiz_id; ?>" class="mt-4 alert d-none text-center h4"></div>
        </div>

        <script>
        function lsValidateQuiz(id) {
            const form = document.getElementById('ls-quiz-form-' + id);
            const total = form.querySelectorAll('.quiz-question-container').length;
            const checked = form.querySelectorAll('input[type="radio"]:checked');

            if (checked.length < total) { 
                alert("Veuillez répondre à toutes les questions !"); 
                return; 
            }

            let score = 0;
            checked.forEach(i => { if(i.value === "1") score++; });

            const res = document.getElementById('ls-results-' + id);
            res.classList.remove('d-none', 'alert-success', 'alert-info');
            res.classList.add(score === total ? 'alert-success' : 'alert-info');
            res.innerHTML = "Votre score : " + score + " / " + total;
        }
        </script>

    <?php endif;
    return ob_get_clean();
}
add_shortcode('quiz_learnsphere', 'ls_display_quiz_shortcode');