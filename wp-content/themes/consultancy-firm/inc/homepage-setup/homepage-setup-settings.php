<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
require trailingslashit( WHIZZIE_DIR ) . 'homepage-setup-contents.php';
$consultancy_firmcurrent_theme = wp_get_theme();
$consultancy_firmtheme_title = $consultancy_firmcurrent_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['consultancy_firmpage_slug'] 	= 'consultancy-firm';
$config['consultancy_firmpage_title']	= 'Homepage Setup';

$config['steps'] = array(
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Install and Activate Essential Plugins', 'consultancy-firm' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'consultancy-firm' ),
		'can_skip'		=> true
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Setup Home Page', 'consultancy-firm' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Start Home Page Setup', 'consultancy-firm' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'Customize Your Site', 'consultancy-firm' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Consultancy_Firm_Whizzie' ) ) {
	$Consultancy_Firm_Whizzie = new Consultancy_Firm_Whizzie( $config );
}