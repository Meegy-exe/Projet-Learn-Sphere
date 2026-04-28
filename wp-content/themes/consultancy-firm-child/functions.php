<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    wp_enqueue_style('parent-styles', get_template_directory_uri() . '/style.css');
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
        <div class=" header-wrapper sldier-contact-box">
            <?php if ($consultancy_firm_header_phone_number) { ?>
                <div class="theme-header-areas header-areas-right header-button">
                    <div class="phone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true">
                            <path
                                d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z" />
                        </svg>
                    </div>
                    <div class="phone-text">
                        <p class="default-text">
                            <?php echo esc_html('Des questions?', 'consultancy-firm'); ?>
                        </p>
                        <p><a href="tel:<?php echo esc_html($consultancy_firm_header_phone_number); ?>">
                                <?php echo esc_html($consultancy_firm_header_phone_number); ?>
                            </a></p>
                    </div>
                </div>
            <?php } ?>

            <?php if ($consultancy_firm_header_email_id) { ?>
                <div class="theme-header-areas header-areas-right header-button">
                    <div class="phone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true">
                            <path
                                d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7 .3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2 .4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z" />
                        </svg>
                    </div>
                    <div class="phone-text">
                        <p class="default-text">
                            <?php echo esc_html('Contactez nous', 'consultancy-firm'); ?>
                        </p>
                        <p><a href="mailto:<?php echo esc_html($consultancy_firm_header_email_id); ?>">
                                <?php echo esc_html($consultancy_firm_header_email_id); ?>
                            </a></p>
                    </div>
                </div>
            <?php } ?>

            <?php if ($consultancy_firm_header_location) { ?>
                <div class="theme-header-areas header-areas-right header-button">
                    <div class="phone-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512" aria-hidden="true">
                            <path
                                d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z" />
                        </svg>
                    </div>
                    <div class="phone-text">
                        <p class="default-text">
                            <?php echo esc_html('Adresse', 'consultancy-firm'); ?>
                        </p>
                        <p>
                            <?php echo esc_html($consultancy_firm_header_location); ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
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
                $consultancy_firm_locations_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($consultancy_firm_locations_post_cat)));
                if ($consultancy_firm_locations_query->have_posts()): ?>
                    <div class="owl-carousel" role="listbox">
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

                                        <p style="font-size: 14px; font-style: italic;">Plus d'informations à venir...</p>

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