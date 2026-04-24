<?php

	require get_template_directory() . '/inc/homepage-setup/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function consultancy_firmregister_recommended_plugins() {
	$plugins = array(
		
		array(
			'name'             => __( 'Classic Widgets', 'consultancy-firm' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'consultancy_firmregister_recommended_plugins' );