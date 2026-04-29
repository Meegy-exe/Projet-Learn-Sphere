<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// fonction dappel des scripts et des css
function theme_enqueue_styles()
{
    // theme parent    
    wp_enqueue_style('parent-styles', get_template_directory_uri() . '/style.css');

    // header
    wp_enqueue_style('ns-header-style', get_stylesheet_directory_uri() . '/assets/css/header.css');
    // footer
    wp_enqueue_style('ns-footer-style', get_stylesheet_directory_uri() . '/assets/css/footer.css');
    // affiche si sur page d accueil
    if (is_front_page()) {
        wp_enqueue_style('ns-home-style', get_stylesheet_directory_uri() . '/assets/css/home.css');
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

    $banner_query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'post__not_in' => get_option('sticky_posts'),
        'category_name' => esc_html($consultancy_firm_header_banner_cat),
    ));

    if (!$banner_query->have_posts()) {
        error_log('No posts found for the banner query.');
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
                                                    <div class="entry-content">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            echo esc_html(get_the_excerpt());
                                                        } else {
                                                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="slide-btn">
                                                        <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary">
                                                            <!-- modification du bouton -->
                                                            <?php echo esc_html__('Voir le contenu pédagogique', 'consultancy-firm'); ?>
                                                        </a>
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
                    <h6><?php echo esc_html($consultancy_firm_team_section_subtitle); ?>
                        <span><?php echo esc_html($consultancy_firm_team_section_subtitle); ?></span>
                    </h6>
                <?php } ?>
                <?php if ($consultancy_firm_team_section_title) { ?>
                    <h4><?php echo esc_html($consultancy_firm_team_section_title); ?></h4>
                <?php } ?>
            </div>
            <div class="team-mian-box">
               <?php
                $consultancy_firm_locations_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($consultancy_firm_locations_post_cat)));
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
                                                <a href="<?php the_permalink(); ?>"
                                                    rel="bookmark"><span><?php the_title(); ?></span></a>
                                            </h2>
                                        </header>

                                        <p style="ls-coming-soon">Plus d'informations à venir...</p>

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