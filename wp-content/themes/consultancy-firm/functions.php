<?php
/**
 * Consultancy Firm functions and definitions
 * @package Consultancy Firm
 */

if ( ! function_exists( 'consultancy_firm_after_theme_support' ) ) :

	function consultancy_firm_after_theme_support() {
		
		add_theme_support( 'automatic-feed-links' );

		add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		$GLOBALS['content_width'] = apply_filters( 'consultancy_firm_content_width', 1140 );
		
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 270,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		
		add_theme_support( 'title-tag' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'gallery',
			'quote',
			'image',
			'link',
			'status',
			'aside',
			'chat',
		) );
		
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );

		require get_template_directory() . '/inc/metabox.php';

		require get_template_directory() . '/inc/homepage-setup/homepage-setup-settings.php';

		if (! defined( 'CONSULTANCY_FIRM_DOCS_PRO' ) ){
			define('CONSULTANCY_FIRM_DOCS_PRO',__('https://layout.omegathemes.com/steps/consultancy-firm-pro/','consultancy-firm'));
		}
		if (! defined( 'CONSULTANCY_FIRM_BUY_NOW' ) ){
			define('CONSULTANCY_FIRM_BUY_NOW',__('https://www.omegathemes.com/products/consultancy-wordpress-theme','consultancy-firm'));
		}
		if (! defined( 'CONSULTANCY_FIRM_SUPPORT_FREE' ) ){
			define('CONSULTANCY_FIRM_SUPPORT_FREE',__('https://wordpress.org/support/theme/consultancy-firm/','consultancy-firm'));
		}
		if (! defined( 'CONSULTANCY_FIRM_REVIEW_FREE' ) ){
			define('CONSULTANCY_FIRM_REVIEW_FREE',__('https://wordpress.org/support/theme/consultancy-firm/reviews/#new-post/','consultancy-firm'));
		}
		if (! defined( 'CONSULTANCY_FIRM_DEMO_PRO' ) ){
			define('CONSULTANCY_FIRM_DEMO_PRO',__('https://layout.omegathemes.com/consultancy-firm/','consultancy-firm'));
		}
		if (! defined('CONSULTANCY_FIRM_LITE_DOCS_PRO') ){
			define('CONSULTANCY_FIRM_LITE_DOCS_PRO',__('https://layout.omegathemes.com/steps/consultancy-firm-free/','consultancy-firm'));
		}
		if (! defined('CONSULTANCY_FIRM_BUNDLE_BUTTON') ){
			define('CONSULTANCY_FIRM_BUNDLE_BUTTON',__('https://www.omegathemes.com/products/wp-theme-bundle','consultancy-firm'));
		}

	}

endif;

add_action( 'after_setup_theme', 'consultancy_firm_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function consultancy_firm_register_styles() {

	wp_enqueue_style( 'dashicons' );

    $theme_version = wp_get_theme()->get( 'Version' );
	$fonts_url = consultancy_firm_fonts_url();
    if( $fonts_url ){
    	require_once get_theme_file_path( 'lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'consultancy-firm-google-fonts',
			consultancy_firm_wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/lib/swiper/css/swiper-bundle.min.css');
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/lib/custom/css/owl.carousel.min.css');
	wp_enqueue_style( 'consultancy-firm-style', get_stylesheet_uri(), array(), $theme_version );

	wp_enqueue_style( 'consultancy-firm-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom_css.php' );
	wp_add_inline_style( 'consultancy-firm-style',$consultancy_firm_custom_css );

	$consultancy_firm_css = '';

	if ( get_header_image() ) :

		$consultancy_firm_css .=  '
			.wrapper.header-wrapper.header-box{
				background-image: url('.esc_url(get_header_image()).');
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
			}';

	endif;

	wp_add_inline_style( 'consultancy-firm-style', $consultancy_firm_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'consultancy-firm-custom', get_template_directory_uri() . '/lib/custom/js/theme-custom-script.js', array('jquery'), '', 1);
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/lib/custom/js/owl.carousel.js', array('jquery'), '', 1);

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $c_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $consultancy_firm_default = consultancy_firm_get_default_theme_options();
    $consultancy_firm_pagination_layout = get_theme_mod( 'consultancy_firm_pagination_layout',$consultancy_firm_default['consultancy_firm_pagination_layout'] );
}

add_action( 'wp_enqueue_scripts', 'consultancy_firm_register_styles',200 );

function consultancy_firm_admin_enqueue_scripts_callback() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
    }
    wp_enqueue_script('consultancy-firm-uploaderjs', get_stylesheet_directory_uri() . '/lib/custom/js/uploader.js', array(), "1.0", true);
}
add_action( 'admin_enqueue_scripts', 'consultancy_firm_admin_enqueue_scripts_callback' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function consultancy_firm_menus() {

	$consultancy_firm_locations = array(
		'consultancy-firm-primary-menu'  => esc_html__( 'Primary Menu', 'consultancy-firm' ),
	);

	register_nav_menus( $consultancy_firm_locations );
}

add_action( 'init', 'consultancy_firm_menus' );

add_filter('loop_shop_columns', 'consultancy_firm_loop_columns');
if (!function_exists('consultancy_firm_loop_columns')) {
	function consultancy_firm_loop_columns() {
		$consultancy_firm_columns = get_theme_mod( 'consultancy_firm_per_columns', 3 );
		return $consultancy_firm_columns;
	}
}

add_filter( 'loop_shop_per_page', 'consultancy_firm_per_page', 20 );
function consultancy_firm_per_page( $consultancy_firm_cols ) {
  	$consultancy_firm_cols = get_theme_mod( 'consultancy_firm_product_per_page', 9 );
	return $consultancy_firm_cols;
}

add_filter( 'woocommerce_output_related_products_args', 'consultancy_firm_products_args' );

function consultancy_firm_products_args( $consultancy_firm_args ) {

    $consultancy_firm_args['posts_per_page'] = get_theme_mod( 'consultancy_firm_custom_related_products_number', 6 );

    $consultancy_firm_args['columns'] = get_theme_mod( 'consultancy_firm_custom_related_products_number_per_row', 3 );

    return $consultancy_firm_args;
}

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/lib/custom/css/dynamic-style.php';


function consultancy_firm_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'consultancy_firm_remove_customize_register', 11 );


function consultancy_firm_radio_sanitize(  $consultancy_firm_input, $consultancy_firm_setting  ) {
	$consultancy_firm_input = sanitize_key( $consultancy_firm_input );
	$consultancy_firm_choices = $consultancy_firm_setting->manager->get_control( $consultancy_firm_setting->id )->choices;
	return ( array_key_exists( $consultancy_firm_input, $consultancy_firm_choices ) ? $consultancy_firm_input : $consultancy_firm_setting->default );
}
require get_template_directory() . '/inc/general.php';

function consultancy_firm_sticky_sidebar_enabled() {
	$consultancy_firm_sticky_sidebar = get_theme_mod('consultancy_firm_sticky_sidebar', true);
	if($consultancy_firm_sticky_sidebar == false) {
		echo '<style>.widget-area-wrapper {position: relative !important;}</style>';
	}
}

add_action('wp_head', 'consultancy_firm_sticky_sidebar_enabled');

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

// NOTICE FUNCTION

function consultancy_firmadmin_notice() { 
    global $pagenow;
    $theme_args = wp_get_theme();
    $meta = get_option( 'consultancy_firmadmin_notice' );
    $name = $theme_args->get( 'Name' );
    $current_screen = get_current_screen();

    if ( ! $meta ) {
        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( $current_screen->base != 'appearance_page_consultancyfirm-wizard' ) {
            ?>
            <div class="notice notice-success notice-content">
                <h2><?php esc_html_e('Welcome! Thank you for choosing Consultancy Firm. Let’s Set Up Your Website!', 'consultancy-firm') ?> </h2>
                <p><?php esc_html_e('Before you dive into customization, let’s go through a quick setup process to ensure everything runs smoothly. Click below to start setting up your website in minutes!', 'consultancy-firm') ?> </p>
                <div class="info-link">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=consultancyfirm-wizard' ) ); ?>"><?php esc_html_e('Get Started with Consultancy Firm', 'consultancy-firm'); ?></a>
					<a href="#" class="notice-bundle" id="bundleTrigger"><?php esc_html_e('Get All WP Themes', 'consultancy-firm'); ?></a>
					<div class="bundle-overlay" id="bundlePopup">
						<div class="bundle-modal">
							<span class="close-popup">&times;</span>
							<div class="sale-badge"><?php esc_html_e('🔥 MEGA SALE', 'consultancy-firm'); ?></div>
							<h2><?php esc_html_e('Unlock All Premium WP Themes', 'consultancy-firm'); ?></h2>
							<p> <?php esc_html_e('Unlock the Full Potential of Your Website with Our 50+ WordPress Themes Bundle', 'consultancy-firm'); ?></p>
							<ul>
								<li><?php esc_html_e('✔ Expert Support', 'consultancy-firm'); ?></li>
								<li><?php esc_html_e('✔ Premium Theme ZIP File', 'consultancy-firm'); ?></li>
								<li><?php esc_html_e('✔ Ready-to-Use Website Templates', 'consultancy-firm'); ?></li>
								<li><?php esc_html_e('✔ Demo Content (Included in the file)', 'consultancy-firm'); ?></li>
								<li><?php esc_html_e('✔ Access to the Premium Support Forum', 'consultancy-firm'); ?></li>
							</ul>
							<a href="<?php echo esc_url( CONSULTANCY_FIRM_BUNDLE_BUTTON ); ?>" target="_blank" class="bundle-cta"><?php esc_html_e('Get the Bundle Now →', 'consultancy-firm'); ?></a>
						</div>
					</div>
                </div>
                <p class="dismiss-link"><strong><a href="?consultancy_firmadmin_notice=1"><?php esc_html_e( 'Dismiss', 'consultancy-firm' ); ?></a></strong></p>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'consultancy_firmadmin_notice' );

if ( ! function_exists( 'consultancy_firmupdate_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
 */
function consultancy_firmupdate_admin_notice() {
    if ( isset( $_GET['consultancy_firmadmin_notice'] ) && $_GET['consultancy_firmadmin_notice'] == '1' ) {
        update_option( 'consultancy_firmadmin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'consultancy_firmupdate_admin_notice' );

// After Switch theme function
add_action( 'after_switch_theme', 'consultancy_firmgetstart_setup_options' );
function consultancy_firmgetstart_setup_options() {
    update_option( 'consultancy_firmadmin_notice', false );
}