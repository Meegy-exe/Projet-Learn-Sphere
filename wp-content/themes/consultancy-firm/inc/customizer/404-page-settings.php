<?php
/**
* 404 Page Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

$wp_customize->add_section( 'consultancy_firm_404_page_settings',
    array(
        'title'      => esc_html__( '404 Page Settings', 'consultancy-firm' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'consultancy_firm_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'consultancy_firm_404_main_title',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_404_main_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_404_main_title',
    array(
        'label'    => esc_html__( '404 Main Title', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_404_subtitle_one',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_404_subtitle_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_404_subtitle_one',
    array(
        'label'    => esc_html__( '404 Sub Title One', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_404_para_one',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_404_para_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_404_para_one',
    array(
        'label'    => esc_html__( '404 Para Text One', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_404_subtitle_two',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_404_subtitle_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_404_subtitle_two',
    array(
        'label'    => esc_html__( '404 Sub Title Two', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_404_para_two',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_404_para_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_404_para_two',
    array(
        'label'    => esc_html__( '404 Para Text Two', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_404_page_settings',
        'type'     => 'text',
    )
);