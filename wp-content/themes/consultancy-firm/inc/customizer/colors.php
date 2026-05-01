<?php
/**
* Color Settings.
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

$wp_customize->add_setting( 'consultancy_firm_default_text_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'consultancy_firm_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'consultancy-firm' ),
        'section'    => 'colors',
        'settings'   => 'consultancy_firm_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'consultancy_firm_border_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'consultancy_firm_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'consultancy-firm' ),
        'section'    => 'colors',
        'settings'   => 'consultancy_firm_border_color',
    ) ) 
);