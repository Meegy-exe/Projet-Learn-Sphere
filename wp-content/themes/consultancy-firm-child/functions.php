<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// fonction dappel des scripts et des css
function theme_enqueue_styles()
{
    // theme parent    
    wp_enqueue_style('parent-styles', get_template_directory_uri() . '/style.css');
    //theme enfant
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-styles'));
    // header
    wp_enqueue_style('ns-header-style', get_stylesheet_directory_uri() . '/assets/css/header.css');
    // footer
    wp_enqueue_style('ns-footer-style', get_stylesheet_directory_uri() . '/assets/css/footer.css');
    // affiche si sur page d accueil
    if (is_front_page()) {
        wp_enqueue_style('ns-home-style', get_stylesheet_directory_uri() . '/assets/css/home.css');
    }
    // affiche si sur page quiz ou cours
    if (is_post_type_archive('cours') || is_post_type_archive('quiz_learnsphere')) {
        wp_enqueue_style(
            'ns-quiz-cours-style',
            get_stylesheet_directory_uri() . '/assets/css/quiz-cours.css',
            // css bien chargé 
            array('child-style'),
            '1.0'
        );
    }
}


function consultancy_firm_main_slider()
{
    $output = '';
    $consultancy_firm_defaults = consultancy_firm_get_default_theme_options();
    $consultancy_firm_header_slider = get_theme_mod('consultancy_firm_header_slider', $consultancy_firm_defaults['consultancy_firm_header_slider']);

    if (!$consultancy_firm_header_slider) {
        error_log('Header slider is not enabled or has a falsy value.');
        return '';
    }

    $consultancy_firm_banner_background_image = get_theme_mod('consultancy_firm_banner_background_image', $consultancy_firm_defaults['consultancy_firm_banner_background_image']);
    $consultancy_firm_header_banner_cat = get_theme_mod('consultancy_firm_header_banner_cat');

    $consultancy_firm_header_phone_number = esc_html(get_theme_mod(
        'consultancy_firm_header_phone_number',
        $consultancy_firm_defaults['consultancy_firm_header_phone_number']
    ));

    $consultancy_firm_header_email_id = esc_html(get_theme_mod(
        'consultancy_firm_header_email_id',
        $consultancy_firm_defaults['consultancy_firm_header_email_id']
    ));

    $consultancy_firm_header_location = esc_html(get_theme_mod(
        'consultancy_firm_header_location',
        $consultancy_firm_defaults['consultancy_firm_header_location']
    ));

    // modification : cours plutot quarticle
    $banner_query = new WP_Query(array(
        'post_type' => 'cours',
        'posts_per_page' => 4,
        'post__not_in' => get_option('sticky_posts'),
        // 'category_name' => esc_html($consultancy_firm_header_banner_cat),
        // MISE EN AVANT DES COURS
        'category_name' => 'slider'
    ));

    if (!$banner_query->have_posts()) {
        error_log('Aucun cours trouvé pour le slider.');
        return '';
    }

    ob_start();
    ?>
    <div id="site-content" class="main-banner">
        <div class="slider-box" style="background: url(<?php echo esc_url($consultancy_firm_banner_background_image); ?>);">
            <div class="main-slider">
                <div class="swiper-container theme-main-carousel">
                    <div class="swiper-wrapper">
                        <?php while ($banner_query->have_posts()):
                            $banner_query->the_post();
                            $consultancy_firm_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0] ?? get_template_directory_uri() . '/assets/images/slider-img1.png';
                            ?>
                            <div class="swiper-slide main-carousel-item">
                                <div class="slider-main">
                                    <div class="left-box">
                                        <div class="slide-heading-main">
                                            <div class="main-carousel-caption">
                                                <div class="post-content">
                                                    <header class="entry-header">
                                                        <h2 class="slider-heading">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><span>
                                                                    <?php echo esc_html(get_the_title()); ?>
                                                                </span></a>
                                                        </h2>
                                                    </header>

                                                    <!-- fix probleme que wordpress affiche tout meme la descrip de limg -->
                                                    <!-- a refaire au propre pour le moment tout est supprimé -->
                                                    <div class="entry-content">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-box">
                                        <div class="image-main-box">
                                            <div class="data-bg banner-img"
                                                data-background="<?php echo esc_url($consultancy_firm_featured_image); ?>">
                                                <a href="<?php the_permalink(); ?>" class="theme-image-responsive"></a>
                                            </div>
                                            <?php consultancy_firm_post_format_icon(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

    </div>
    <?php

    wp_reset_postdata();
    $output = ob_get_clean();
    return $output;
}

function consultancy_firm_product_section()
{

    $consultancy_firm_default = consultancy_firm_get_default_theme_options();
    $consultancy_firm_locations_post_cat = get_theme_mod('consultancy_firm_locations_post_cat');

    // modification des titres
    $consultancy_firm_team_section_subtitle = "Bienvenue Sur North Star";
    $consultancy_firm_team_section_title = "La plateforme pédagogique pour bien préparer son cursus chez Epitech.";

    ?>
    <div class="theme-product-block">
        <div class="wrapper">
            <div class="section-heading">
                <?php if ($consultancy_firm_team_section_subtitle) { ?>
                    <h6>
                        <?php echo esc_html($consultancy_firm_team_section_subtitle); ?>
                        <span>
                            <?php echo esc_html($consultancy_firm_team_section_subtitle); ?>
                        </span>
                    </h6>
                <?php } ?>
                <?php if ($consultancy_firm_team_section_title) { ?>
                    <h4>
                        <?php echo esc_html($consultancy_firm_team_section_title); ?>
                    </h4>
                <?php } ?>
                <!-- btn vers les cours -->
                <div class="ls-header-btn-box">
                    <a href="<?php echo get_post_type_archive_link('cours'); ?>" class="btn-fancy btn-fancy-primary">
                        Voir tous les cours
                    </a>
                </div>
            </div>
            <div class="team-mian-box">
                <?php
                $consultancy_firm_locations_query =
                    new WP_Query(array(
                        'post_type' => 'cours',
                        'posts_per_page' => 4,
                        'post__not_in' => get_option("sticky_posts"),
                        // 'category_name' => esc_html($consultancy_firm_locations_post_cat)
                    ));
                if ($consultancy_firm_locations_query->have_posts()): ?>
                    <div class="ns-courses-grid">
                        <?php
                        while ($consultancy_firm_locations_query->have_posts()):
                            $consultancy_firm_locations_query->the_post();
                            $consultancy_firm_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            $consultancy_firm_featured_image = isset($consultancy_firm_featured_image[0]) ? $consultancy_firm_featured_image[0] : '';
                            ?>
                            <div class="theme-article-post team-box">
                                <div class="entry-thumbnail">
                                    <div class="data-bg featured-img"
                                        data-background="<?php echo esc_url($consultancy_firm_featured_image ? $consultancy_firm_featured_image : get_template_directory_uri() . '/assets/images/team1.png'); ?>">
                                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                    </div>
                                    <?php consultancy_firm_post_format_icon(); ?>
                                </div>
                                <div class="main-owl-caption">
                                    <div class="post-content-location">
                                        <header class="entry-header">
                                            <h2 class="entry-title entry-title-big">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><span>
                                                        <?php the_title(); ?>
                                                    </span></a>
                                            </h2>
                                        </header>

                                        <!-- <p style="ls-coming-soon">Plus d'informations à venir...</p> -->
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
    <?php
}

// function pour ajouter les 4 quizz sur la page daccueil (comme function cours)
function consultancy_firm_quiz_section()
{
    ?>
    <div class="theme-quiz-block ls-section-padding">
        <div class="wrapper">

            <!-- structure identique aux cours et au theme parent-->
            <div class="section-heading">
                <h6>Évaluez vos connaissances <span>Quiz interactifs</span></h6>
                <h4>Nos derniers quiz</h4>
                <!-- permet dacceder au data de tous les quiz  -->
                <!-- btn vers les quiz -->
                <div class="ls-header-btn-box">
                    <a href="<?php echo get_post_type_archive_link('quiz_learnsphere'); ?>"
                        class="btn-fancy btn-fancy-primary">
                        Voir tous les quiz
                    </a>
                </div>
            </div>

            <div class="team-mian-box">
                <?php
                // wp_query: permet de faire une requete qui recupere les datas de la bdd
                $quiz_query = new WP_Query(array(
                    // cpt du quiz
                    'post_type' => 'quiz_learnsphere',
                    // affiche 4
                    'posts_per_page' => 4,
                    // par ordre chrono
                    'orderby' => 'date',
                    // plus recent dabord
                    'order' => 'DESC'
                ));

                // securite: affiche la structure que SI il y a des quizz publiés 
                if ($quiz_query->have_posts()): ?>
                    <div class="ns-courses-grid">
                        <?php

                        // boucle while : parcourt chaque quiz
                        while ($quiz_query->have_posts()):
                            $quiz_query->the_post();

                            // recupere limg mise en avant via api wordpress
                            $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            ?>

                            <div class="theme-article-post team-box">
                                <div class="entry-thumbnail">

                                    <!-- affiche une img par defaut si pas dimg -->
                                    <div class="data-bg featured-img"
                                        data-background="<?php echo esc_url($featured_img ? $featured_img : get_template_directory_uri() . '/assets/images/quiz-default.png'); ?>">
                                        <a href="<?php the_permalink(); ?>" class="theme-image-responsive"></a>
                                    </div>
                                </div>

                                <div class="main-owl-caption">
                                    <div class="post-content-location">
                                        <header class="entry-header">
                                            <h2 class="entry-title">
                                                <!-- the title: affiche le titre -->
                                                <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
                                            </h2>
                                        </header>
                                        <!-- <p class="ls-coming-soon">Plus d'informations à venir...</p> -->

                                        <!-- recupere la valeur du champ acf difficulte -->
                                        <p>Difficulté : <?php echo esc_html(get_field('difficulte') ?: '2'); ?></p>
                                        <!-- btn lancer quizz -->
                                        <p><a href="<?php the_permalink(); ?>" class="ls-quiz-link">Lancer le quiz →</a></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;

                        // wp reset postdata : reinitialise la var globale $post (evite de melanger les datas des quiz)
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

// filtre de recherche par theme
// modification du theme parent
function ns_filter_and_sort_courses($query)
{
    if (!is_admin() && $query->is_main_query() && (is_post_type_archive('cours') || is_post_type_archive('quiz_learnsphere'))) {

        // FILTRE gestion des niveaux de diffulté QUIZ
        if (isset($_GET['difficulty_level']) && !empty($_GET['difficulty_level'])) {
            $level = sanitize_text_field($_GET['difficulty_level']);

            if (is_post_type_archive('quiz_learnsphere')) {
                // slug dans quiz genre
                $query->set('tax_query', array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'ls_quiz_niveau',
                        'field' => 'slug',
                        'terms' => $level,
                    )
                ));
            } else {
                // FILTRE gestion des niveaux de diffulté COURS
                $query->set('meta_query', array(
                    array(
                        'key' => 'difficulte',
                        'value' => $level,
                        'compare' => '='
                    )
                ));
            }
        }

        // FILTRE ordre chrono
        if (isset($_GET['sort_order'])) {
            $query->set('orderby', 'date');
            $query->set('order', ($_GET['sort_order'] === 'asc') ? 'ASC' : 'DESC');
        }

        // case à cocher avec les thèmes QUIZ
        if (isset($_GET['custom_cat']) && is_array($_GET['custom_cat'])) {
            $cat_ids = array_map('intval', $_GET['custom_cat']);
            $tax_name = is_post_type_archive('quiz_learnsphere') ? 'ls_quiz_genre' : 'category';

            // tax_query specifique
            $tax_query = $query->get('tax_query') ?: array('relation' => 'AND');
            $tax_query[] = array(
                'taxonomy' => $tax_name,
                'field' => 'term_id',
                'terms' => $cat_ids,
            );
            $query->set('tax_query', $tax_query);
        }
    }
}
// lie la fonction
add_action('pre_get_posts', 'ns_filter_and_sort_courses');
// MENU BURGER
function ns_enqueue_custom_scripts()
{
    // chargement du script du menu bg
    wp_enqueue_script(
        'ns-mobile-menu',
        // path du script
        get_stylesheet_directory_uri() . '/assets/js/menu-burger.js',
        array(),
        '1.0',
        // charge le script dans le footer (perf)
        true
    );
}
add_action('wp_enqueue_scripts', 'ns_enqueue_custom_scripts');