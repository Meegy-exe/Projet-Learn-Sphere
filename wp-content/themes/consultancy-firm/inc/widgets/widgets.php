<?php
/**
* Widget Functions.
*
* @package Consultancy Firm
*/

function consultancy_firm_widgets_init(){

	register_sidebar(array(
	    'name' => esc_html__('Main Sidebar', 'consultancy-firm'),
	    'id' => 'sidebar-1',
	    'description' => esc_html__('Add widgets here.', 'consultancy-firm'),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>',
	));

    $consultancy_firm_default = consultancy_firm_get_default_theme_options();
    $consultancy_firm_footer_column_layout = absint( get_theme_mod( 'consultancy_firm_footer_column_layout',$consultancy_firm_default['consultancy_firm_footer_column_layout'] ) );

    for( $i = 0; $i < $consultancy_firm_footer_column_layout; $i++ ){
    	
    	if( $i == 0 ){ $count = esc_html__('One','consultancy-firm'); }
    	if( $i == 1 ){ $count = esc_html__('Two','consultancy-firm'); }
    	if( $i == 2 ){ $count = esc_html__('Three','consultancy-firm'); }

	    register_sidebar( array(
	        'name' => esc_html__('Footer Widget ', 'consultancy-firm').$count,
	        'id' => 'consultancy-firm-footer-widget-'.$i,
	        'description' => esc_html__('Add widgets here.', 'consultancy-firm'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<h2 class="widget-title">',
	        'after_title' => '</h2>',
	    ));
	}

}

add_action('widgets_init', 'consultancy_firm_widgets_init');