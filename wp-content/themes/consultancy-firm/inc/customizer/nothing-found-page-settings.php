<?php
/**
* Noting Found Page Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

$wp_customize->add_section( 'consultancy_firm_noting_found_page_settings',
    array(
        'title'      => esc_html__( 'Noting Found Page Settings', 'consultancy-firm' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'consultancy_firm_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'consultancy_firm_noting_found_main_title',
    array(
        'default'           => 'Nothing Found',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_noting_found_main_title',
    array(
        'label'    => esc_html__( 'Main Title', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_noting_found_para',
    array(
        'default'           => 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_noting_found_para',
    array(
        'label'    => esc_html__( 'Para Text', 'consultancy-firm' ),
        'section'  => 'consultancy_firm_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting('consultancy_firm_noting_found_saerch',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_noting_found_saerch',
    array(
        'label' => esc_html__('Enable/Disable Search', 'consultancy-firm'),
        'section' => 'consultancy_firm_noting_found_page_settings',
        'type' => 'checkbox',
    )
);