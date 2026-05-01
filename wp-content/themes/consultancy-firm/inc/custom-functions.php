<?php
/**
 * Custom Functions.
 *
 * @package Consultancy Firm
 */

if( !function_exists( 'consultancy_firm_fonts_url' ) ) :

    //Google Fonts URL
    function consultancy_firm_fonts_url(){

        $font_families = array(
            'Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800', //    font-family: "Plus Jakarta Sans", sans-serif;
        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);

    }

endif;

if ( ! function_exists( 'consultancy_firm_sub_menu_toggle_button' ) ) :

    function consultancy_firm_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'consultancy-firm-primary-menu' && isset( $args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'consultancy-firm' ) . '</span>' . consultancy_firm_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $args->theme_location == 'consultancy-firm-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $item->classes ) ) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = consultancy_firm_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $args->before = '';
                $args->after  = '';

            }

        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'consultancy_firm_sub_menu_toggle_button', 10, 3 );

if ( ! function_exists( 'consultancy_firm_the_theme_svg' ) ):
    
    function consultancy_firm_the_theme_svg( $consultancy_firm_svg_name, $return = false ) {

        if( $return ){

            return consultancy_firm_get_theme_svg( $consultancy_firm_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in consultancy_firm_get_theme_svg();.

        }else{

            echo consultancy_firm_get_theme_svg( $consultancy_firm_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in consultancy_firm_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'consultancy_firm_get_theme_svg' ) ):

    function consultancy_firm_get_theme_svg( $consultancy_firm_svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $consultancy_firm_svg = wp_kses(
            Consultancy_Firm_SVG_Icons::get_svg( $consultancy_firm_svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $consultancy_firm_svg ) {
            return false;
        }
        return $consultancy_firm_svg;

    }

endif;

if( !function_exists( 'consultancy_firm_post_category_list' ) ) :

    // Post Category List.
    function consultancy_firm_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','consultancy-firm' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('consultancy_firm_single_post_navigation') ):

    function consultancy_firm_single_post_navigation(){

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $consultancy_firm_default['twp_navigation_type']);
        }

        if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . consultancy_firm_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'consultancy-firm') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . consultancy_firm_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'consultancy-firm') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'consultancy_firm_navigation_action','consultancy_firm_single_post_navigation',30 );

if( !function_exists('consultancy_firm_content_offcanvas') ):

    // Offcanvas Contents
    function consultancy_firm_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'consultancy-firm'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'consultancy-firm'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('consultancy-firm-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'consultancy-firm-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Consultancy_Firm_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'consultancy_firm_before_footer_content_action','consultancy_firm_content_offcanvas',30 );

if( !function_exists('consultancy_firm_footer_content_widget') ):

    function consultancy_firm_footer_content_widget(){
        
        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        
        $consultancy_firm_footer_column_layout = absint(get_theme_mod('consultancy_firm_footer_column_layout', $consultancy_firm_default['consultancy_firm_footer_column_layout']));
        $consultancy_firm_footer_sidebar_class = 12;
        
        if($consultancy_firm_footer_column_layout == 2) {
            $consultancy_firm_footer_sidebar_class = 6;
        }
        
        if($consultancy_firm_footer_column_layout == 3) {
            $consultancy_firm_footer_sidebar_class = 4;
        }
        ?>
        
        <?php if ( get_theme_mod('consultancy_firm_display_footer', true) == true ) : ?>
            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                    
                        <?php for ($i = 0; $i < $consultancy_firm_footer_column_layout; $i++) : ?>
                            
                            <div class="column <?php echo 'column-' . absint($consultancy_firm_footer_sidebar_class); ?> column-sm-12">
                                
                                <?php 
                                // If no widgets are assigned, display default widgets
                                if ( ! is_active_sidebar( 'consultancy-firm-footer-widget-' . $i ) ) : 

                                    if ($i === 0) : ?>
                                        <div id="media_image-3" class="widget widget_media_image">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" alt="<?php echo esc_attr__( 'Footer Image', 'consultancy-firm' ); ?>" style="max-width: 100%; height: auto;">
                                        </div>
                                        <div id="text-3" class="widget widget_text">
                                            <div class="textwidget">
                                                <p class="widget_text">
                                                    <?php esc_html_e('The Consultancy Firm Theme is a powerful and professional solution designed for modern consulting businesses. Whether you\'re in business consultancy, strategy consulting, or HR consulting, this theme offers everything you need to build a credible online presence. Ideal for firms specializing in management consulting, financial consulting, IT consulting, legal consulting, or tax consulting, it features a sleek layout, intuitive navigation, and full customization options tailored to your branding needs.', 'consultancy-firm'); ?>
                                                </p>
                                            </div>
                                        </div>

                                    <?php elseif ($i === 1) : ?>
                                        <div id="pages-2" class="widget widget_pages">
                                            <h2 class="widget-title"><?php esc_html_e('Calendar', 'consultancy-firm'); ?></h2>
                                            <?php get_calendar(); ?>
                                        </div>

                                    <?php elseif ($i === 2) : ?>
                                        <div id="search-2" class="widget widget_search">
                                            <h2 class="widget-title"><?php esc_html_e('Enter Keywords Here', 'consultancy-firm'); ?></h2>
                                            <?php get_search_form(); ?>
                                        </div>
                                    <?php endif; 
                                    
                                else :
                                    // Display dynamic sidebar widget if assigned
                                    dynamic_sidebar('consultancy-firm-footer-widget-' . $i);
                                endif;
                                ?>
                                
                            </div>
                            
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?> 

    <?php
    }

endif;

add_action( 'consultancy_firm_footer_content_action', 'consultancy_firm_footer_content_widget', 10 );

if( !function_exists('consultancy_firm_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function consultancy_firm_footer_content_info(){

        $consultancy_firm_default = consultancy_firm_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                    $consultancy_firm_footer_copyright_text = wp_kses_post( get_theme_mod( 'consultancy_firm_footer_copyright_text', $consultancy_firm_default['consultancy_firm_footer_copyright_text'] ) );
                                        echo esc_html( $consultancy_firm_footer_copyright_text );
                                        echo '<br>';
                                        echo esc_html__('Theme: ', 'consultancy-firm') . '<a href="' . esc_url('https://www.omegathemes.com/products/consultancy-firm') . '" title="' . esc_attr__('Electrician Company ', 'consultancy-firm') . '" target="_blank"><span>' . esc_html__('Consultancy Firm ', 'consultancy-firm') . '</span></a>' . esc_html__(' By ', 'consultancy-firm') . '  <span>' . esc_html__('OMEGA ', 'consultancy-firm') . '</span>';
                                        echo esc_html__('Powered by ', 'consultancy-firm') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'consultancy-firm') . '" target="_blank"><span>' . esc_html__('WordPress.', 'consultancy-firm') . '</span></a>';
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php if ( get_theme_mod('consultancy_firm_enable_to_the_top', true) == true ) : ?>
                                    <?php
                                    $consultancy_firm_to_the_top_text = get_theme_mod( 'consultancy_firm_to_the_top_text', __( 'To the Top', 'consultancy-firm' ) );
                                    printf( 
                                        wp_kses( 
                                            /* translators: %s is the arrow icon markup */
                                            '%s %s', 
                                            array( 'span' => array( 'class' => array(), 'aria-hidden' => array() ) ) 
                                        ), 
                                        esc_html( $consultancy_firm_to_the_top_text ),
                                        '<span class="arrow" aria-hidden="true">&uarr;</span>' 
                                    );
                                    ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'consultancy_firm_footer_content_action','consultancy_firm_footer_content_info',20 );


if ( ! function_exists( 'consultancy_firm_main_slider' ) ) :

    function consultancy_firm_main_slider() {
        $output = '';
        $consultancy_firm_defaults = consultancy_firm_get_default_theme_options();
        $consultancy_firm_header_slider = get_theme_mod( 'consultancy_firm_header_slider', $consultancy_firm_defaults['consultancy_firm_header_slider'] );

        // Debugging header slider status
        if ( ! $consultancy_firm_header_slider ) {
            error_log('Header slider is not enabled or has a falsy value.');
            return '';  // Exit early if no slider
        }

        $consultancy_firm_banner_background_image = get_theme_mod( 'consultancy_firm_banner_background_image', $consultancy_firm_defaults['consultancy_firm_banner_background_image'] );
        $consultancy_firm_header_banner_cat = get_theme_mod( 'consultancy_firm_header_banner_cat');

        $consultancy_firm_header_phone_number = esc_html( get_theme_mod( 'consultancy_firm_header_phone_number',
        $consultancy_firm_defaults['consultancy_firm_header_phone_number'] ) );

        $consultancy_firm_header_email_id = esc_html( get_theme_mod( 'consultancy_firm_header_email_id',
        $consultancy_firm_defaults['consultancy_firm_header_email_id'] ) );

        $consultancy_firm_header_location = esc_html( get_theme_mod( 'consultancy_firm_header_location',
        $consultancy_firm_defaults['consultancy_firm_header_location'] ) );

        $banner_query = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post__not_in' => get_option( 'sticky_posts' ),
            'category_name' => esc_html( $consultancy_firm_header_banner_cat ),
        ) );

        // Check if the query has posts
        if ( ! $banner_query->have_posts() ) {
            error_log('No posts found for the banner query.');
            return '';  // Exit early if no posts
        }

        ob_start();  // Start output buffering
        ?>
        <div id="site-content" class="main-banner">
            <div class="slider-box" style="background: url(<?php echo esc_url( $consultancy_firm_banner_background_image ); ?>);">
                <div class="main-slider">
                    <div class="swiper-container theme-main-carousel">
                        <div class="swiper-wrapper">
                            <?php while ( $banner_query->have_posts() ) : $banner_query->the_post();
                                $consultancy_firm_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0] ?? get_template_directory_uri() . '/assets/images/slider-img1.png';
                                ?>
                                <div class="swiper-slide main-carousel-item">
                                    <div class="slider-main">
                                        <div class="left-box">
                                            <div class="slide-heading-main">
                                                <div class="main-carousel-caption">
                                                    <div class="post-content">
                                                        <header class="entry-header">
                                                            <h2 class="slider-heading">
                                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php echo esc_html( get_the_title() ); ?></span></a>
                                                            </h2>
                                                        </header>
                                                        <div class="entry-content">
                                                            <?php
                                                            if ( has_excerpt() ) {
                                                                echo esc_html( get_the_excerpt() );
                                                            } else {
                                                                echo esc_html( wp_trim_words( get_the_content(), 25, '...' ) );
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="slide-btn">
                                                            <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary">
                                                                <?php echo esc_html__( 'Get Started Now', 'consultancy-firm' ); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-box">
                                            <div class="image-main-box">
                                                <div class="data-bg banner-img" data-background="<?php echo esc_url( $consultancy_firm_featured_image ); ?>">
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
                <?php if( $consultancy_firm_header_phone_number ){ ?>
                    <div class="theme-header-areas header-areas-right header-button">
                        <div class="phone-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true">
                                <path d="M497.4 361.8l-112-48a24 24 0 0 0 -28 6.9l-49.6 60.6A370.7 370.7 0 0 1 130.6 204.1l60.6-49.6a23.9 23.9 0 0 0 6.9-28l-48-112A24.2 24.2 0 0 0 122.6 .6l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.3 24.3 0 0 0 -14-27.6z"/>
                            </svg>
                        </div>
                        <div class="phone-text">
                            <p class="default-text"><?php echo esc_html( 'Got Questions?', 'consultancy-firm'); ?></p>
                            <p><a href="tel:<?php echo esc_html( $consultancy_firm_header_phone_number ); ?>"><?php echo esc_html( $consultancy_firm_header_phone_number ); ?></a></p>
                        </div>
                    </div>
                <?php } ?>
                    
                <?php if( $consultancy_firm_header_email_id ){ ?>
                    <div class="theme-header-areas header-areas-right header-button">
                        <div class="phone-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" aria-hidden="true">
                                <path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7 .3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2 .4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"/>
                            </svg>
                        </div>
                        <div class="phone-text">
                            <p class="default-text"><?php echo esc_html( 'Email Us', 'consultancy-firm'); ?></p>
                            <p><a href="mailto:<?php echo esc_html( $consultancy_firm_header_email_id ); ?>"><?php echo esc_html( $consultancy_firm_header_email_id ); ?></a></p>
                        </div>
                    </div>
                <?php } ?>

                <?php if( $consultancy_firm_header_location ){ ?>
                    <div class="theme-header-areas header-areas-right header-button">
                        <div class="phone-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512" aria-hidden="true">
                                <path d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/>
                            </svg>
                        </div>
                        <div class="phone-text">
                            <p class="default-text"><?php echo esc_html( 'Address', 'consultancy-firm'); ?></p>
                            <p><?php echo esc_html( $consultancy_firm_header_location ); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        $output = ob_get_clean(); // Get buffered output and clean buffer
        return $output; // Return the output instead of echoing
    }

endif;



if( !function_exists( 'consultancy_firm_product_section' ) ) :

    function consultancy_firm_product_section(){ 

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();

        $consultancy_firm_header_case_studies = get_theme_mod( 'consultancy_firm_header_case_studies', $consultancy_firm_default['consultancy_firm_header_case_studies'] );
        $consultancy_firm_locations_post_cat = get_theme_mod( 'consultancy_firm_locations_post_cat' );

        $consultancy_firm_team_section_subtitle = esc_html( get_theme_mod( 'consultancy_firm_team_section_subtitle',
        $consultancy_firm_default['consultancy_firm_team_section_subtitle'] ) );

        $consultancy_firm_team_section_title = esc_html( get_theme_mod( 'consultancy_firm_team_section_title',
        $consultancy_firm_default['consultancy_firm_team_section_title'] ) );
            ?>
                <div class="theme-product-block">
                    <div class="wrapper">
                        <div class="section-heading">
                            <?php if( $consultancy_firm_team_section_subtitle ){ ?>
                                <h6><?php echo esc_html( $consultancy_firm_team_section_subtitle ); ?> <span><?php echo esc_html( $consultancy_firm_team_section_subtitle ); ?></span></h6>
                            <?php } ?>
                            <?php if( $consultancy_firm_team_section_title ){ ?>
                                <h4><?php echo esc_html( $consultancy_firm_team_section_title ); ?></h4>
                            <?php } ?>
                        </div>
                        <div class="team-mian-box">
                        <?php 
                        $consultancy_firm_locations_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $consultancy_firm_locations_post_cat ) ) );
                        if( $consultancy_firm_locations_query->have_posts() ): ?>
                            <div class="owl-carousel" role="listbox">
                                    <?php
                                        $s=1;
                                        while( $consultancy_firm_locations_query->have_posts() ):
                                        $consultancy_firm_locations_query->the_post();
                                        $consultancy_firm_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        $consultancy_firm_featured_image = isset( $consultancy_firm_featured_image[0] ) ? $consultancy_firm_featured_image[0] : ''; 

                                        $consultancy_firm_team_section_designation = esc_html( get_theme_mod( 'consultancy_firm_team_section_designation'.$s,'Lead Strategy Consultant' ) );

                                        $consultancy_firm_our_team_facebook_link = esc_html( get_theme_mod( 'consultancy_firm_our_team_facebook_link'.$s,'#' ) );

                                        $consultancy_firm_our_team_twitter_link = esc_html( get_theme_mod( 'consultancy_firm_our_team_twitter_link'.$s,'#' ) );

                                        $consultancy_firm_our_team_pintrest_link = esc_html( get_theme_mod( 'consultancy_firm_our_team_pintrest_link'.$s,'#' ) );

                                        $consultancy_firm_our_team_instagram_link = esc_html( get_theme_mod( 'consultancy_firm_our_team_instagram_link'.$s,'#' ) );

                                        $consultancy_firm_our_team_youtube_link = esc_html( get_theme_mod( 'consultancy_firm_our_team_youtube_link'.$s,'#' ) );

                                        ?>                                
                                        <div class="theme-article-post team-box">
                                            <div class="entry-thumbnail">
                                                <div class="data-bg featured-img" data-background="<?php echo esc_url($consultancy_firm_featured_image ? $consultancy_firm_featured_image : get_template_directory_uri() . '/assets/images/team1.png'); ?>">
                                                    <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                                </div>
                                                <?php consultancy_firm_post_format_icon(); ?>
                                            </div>
                                            <div class="main-owl-caption">
                                                <div class="post-content-location">
                                                    <header class="entry-header">
                                                        <h2 class="entry-title entry-title-big">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                                        </h2>
                                                    </header>
                                                    <?php if( $consultancy_firm_team_section_designation ){ ?>
                                                        <p><?php echo esc_html( $consultancy_firm_team_section_designation ); ?></p>
                                                    <?php } ?>
                                                    <div class="social-area">
                                                        <?php if( $consultancy_firm_our_team_facebook_link || $consultancy_firm_our_team_twitter_link || $consultancy_firm_our_team_pintrest_link || $consultancy_firm_our_team_instagram_link || $consultancy_firm_our_team_youtube_link ){ ?>
                                                            <?php if( $consultancy_firm_our_team_facebook_link ){ ?>
                                                               <a class="social-1" href="<?php echo esc_url( $consultancy_firm_our_team_facebook_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a>
                                                            <?php } ?>
                                                            <?php if( $consultancy_firm_our_team_twitter_link ){ ?>
                                                               <a class="social-2" href="<?php echo esc_url( $consultancy_firm_our_team_twitter_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg></a>
                                                            <?php } ?>
                                                            <?php if( $consultancy_firm_our_team_pintrest_link ){ ?>
                                                               <a class="social-3" href="<?php echo esc_url( $consultancy_firm_our_team_pintrest_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></a>
                                                            <?php } ?>
                                                            <?php if( $consultancy_firm_our_team_instagram_link ){ ?>
                                                               <a class="social-4" href="<?php echo esc_url( $consultancy_firm_our_team_instagram_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a>
                                                            <?php } ?>
                                                            <?php if( $consultancy_firm_our_team_youtube_link ){ ?>
                                                               <a class="social-5" href="<?php echo esc_url( $consultancy_firm_our_team_youtube_link ); ?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $s++; endwhile; ?>
                                </div>
                            <?php
                            wp_reset_postdata();
                            endif;
                          ?>
                        </div>
                    </div>
                </div>
    <?php }

endif;

if (!function_exists('consultancy_firm_post_format_icon')):

    // Post Format Icon.
    function consultancy_firm_post_format_icon() {

        $consultancy_firm_format = get_post_format(get_the_ID()) ?: 'standard';
        $consultancy_firm_icon = '';
        $consultancy_firm_title = '';
        if( $consultancy_firm_format == 'video' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'video' );
            $consultancy_firm_title = esc_html__('Video','consultancy-firm');
        }elseif( $consultancy_firm_format == 'audio' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'audio' );
            $consultancy_firm_title = esc_html__('Audio','consultancy-firm');
        }elseif( $consultancy_firm_format == 'gallery' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'gallery' );
            $consultancy_firm_title = esc_html__('Gallery','consultancy-firm');
        }elseif( $consultancy_firm_format == 'quote' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'quote' );
            $consultancy_firm_title = esc_html__('Quote','consultancy-firm');
        }elseif( $consultancy_firm_format == 'image' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'image' );
            $consultancy_firm_title = esc_html__('Image','consultancy-firm');
        } elseif( $consultancy_firm_format == 'link' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'link' );
            $consultancy_firm_title = esc_html__('Link','consultancy-firm');
        } elseif( $consultancy_firm_format == 'status' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'status' );
            $consultancy_firm_title = esc_html__('Status','consultancy-firm');
        } elseif( $consultancy_firm_format == 'aside' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'aside' );
            $consultancy_firm_title = esc_html__('Aside','consultancy-firm');
        } elseif( $consultancy_firm_format == 'chat' ){
            $consultancy_firm_icon = consultancy_firm_get_theme_svg( 'chat' );
            $consultancy_firm_title = esc_html__('Chat','consultancy-firm');
        }
        
        if (!empty($consultancy_firm_icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo consultancy_firm_svg_escape($consultancy_firm_icon); ?></span>
                <?php if( $consultancy_firm_title ){ echo '<span class="post-format-label">'.esc_html( $consultancy_firm_title ).'</span>'; } ?>
            </div>
        <?php }
    }

endif;

if ( ! function_exists( 'consultancy_firm_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $consultancy_firm_svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function consultancy_firm_svg_escape( $consultancy_firm_input ) {

        // Make sure that only our allowed tags and attributes are included.
        $consultancy_firm_svg = wp_kses(
            $consultancy_firm_input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $consultancy_firm_svg ) {
            return false;
        }

        return $consultancy_firm_svg;

    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_sidebar_option_meta( $consultancy_firm_input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $consultancy_firm_input,$metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_pagination_meta' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_pagination_meta( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'Center','Right','Left');
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_pagination_type' ) ) :

    /**
     * Sanitize the pagination type setting.
     *
     * @param string $consultancy_firm_input The input value from the Customizer.
     * @return string The sanitized value.
     */
    function consultancy_firm_sanitize_pagination_type( $consultancy_firm_input ) {
        // Define valid options for the pagination type.
        $consultancy_firm_valid_options = array( 'numeric', 'newer_older' ); // Update valid options to include 'newer_older'

        // If the input is one of the valid options, return it. Otherwise, return the default option ('numeric').
        if ( in_array( $consultancy_firm_input, $consultancy_firm_valid_options, true ) ) {
            return $consultancy_firm_input;
        } else {
            // Return 'numeric' as the fallback if the input is invalid.
            return 'numeric';
        }
    }

endif;

// Sanitize the enable/disable setting for pagination
if( !function_exists('consultancy_firm_sanitize_enable_pagination') ) :
    function consultancy_firm_sanitize_enable_pagination( $consultancy_firm_input ) {
        return (bool) $consultancy_firm_input;
    }
endif;

if( !function_exists( 'consultancy_firm_sanitize_menu_transform' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_menu_transform( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'capitalize','uppercase','lowercase');
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_page_content_alignment' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_page_content_alignment( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'left','center','right');
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_footer_widget_title_alignment' ) ) :

    // Footer Option Sanitize.
    function consultancy_firm_sanitize_footer_widget_title_alignment( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'left','center','right');
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'consultancy_firm_sanitize_copyright_alignment_meta' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_copyright_alignment_meta( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'Default','Reverse','Center');
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }else{

            return '';

        }
    }

endif;

/**
 * Sidebar Layout Function
 */
function consultancy_firm_get_final_sidebar_layout() {
	$consultancy_firm_defaults       = consultancy_firm_get_default_theme_options();
	$consultancy_firm_global_layout  = get_theme_mod('consultancy_firm_global_sidebar_layout', $consultancy_firm_defaults['consultancy_firm_global_sidebar_layout']);
	$consultancy_firm_page_layout    = get_theme_mod('consultancy_firm_page_sidebar_layout', $consultancy_firm_global_layout);
	$consultancy_firm_post_layout    = get_theme_mod('consultancy_firm_post_sidebar_layout', $consultancy_firm_global_layout);
	$consultancy_firm_meta_layout    = get_post_meta(get_the_ID(), 'consultancy_firm_post_sidebar_option', true);

	if (!empty($consultancy_firm_meta_layout) && $consultancy_firm_meta_layout !== 'default') {
		return $consultancy_firm_meta_layout;
	}
	if (is_page() || (function_exists('is_shop') && is_shop())) {
		return $consultancy_firm_page_layout;
	}
	if (is_single()) {
		return $consultancy_firm_post_layout;
	}
	return $consultancy_firm_global_layout;
}