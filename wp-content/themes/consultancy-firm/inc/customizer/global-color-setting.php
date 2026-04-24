<?php
/**
* Global Color Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'consultancy_firm_global_color_setting',
	array(
	'title'      => esc_html__( 'Global Color Settings', 'consultancy-firm' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

$wp_customize->add_setting( 'consultancy_firm_global_color',
    array(
    'default'           => '#F75C4E',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'consultancy_firm_global_color',
    array(
        'label'      => esc_html__( 'Global Color', 'consultancy-firm' ),
        'section'    => 'consultancy_firm_global_color_setting',
        'settings'   => 'consultancy_firm_global_color',
    ) ) 
);