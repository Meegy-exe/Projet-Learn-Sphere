<?php
/**
* Typography Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'consultancy_firm_typography_setting',
	array(
	'title'      => esc_html__( 'Typography Settings', 'consultancy-firm' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

// -----------------  Font array
$consultancy_firm_fonts = array(
    'Select'           => __('Default Font', 'consultancy-firm'),
    'bad-script' => 'Bad Script',
    'bitter'     => 'Bitter',
    'cuprum'     => 'Cuprum',
    'exo-2'      => 'Exo 2',
    'jost'       => 'Jost',
    'open-sans'  => 'Open Sans',
    'oswald'     => 'Oswald',
    'play'       => 'Play',
    'roboto'     => 'Roboto',
    'ubuntu'     => 'Ubuntu',
    'plusjakartasans'     => 'Plus Jakarta Sans',
);

 // -----------------  General text font
 $wp_customize->add_setting( 'consultancy_firm_content_typography_font', array(
    'default'           => 'plusjakartasans',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_radio_sanitize',
) );
$wp_customize->add_control( 'consultancy_firm_content_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Content Font', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_typography_setting',
    'settings' => 'consultancy_firm_content_typography_font',
    'choices'  => $consultancy_firm_fonts,
) );

 // -----------------  General Heading Font
$wp_customize->add_setting( 'consultancy_firm_heading_typography_font', array(
    'default'           => 'plusjakartasans',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_radio_sanitize',
) );
$wp_customize->add_control( 'consultancy_firm_heading_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Heading Font', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_typography_setting',
    'settings' => 'consultancy_firm_heading_typography_font',
    'choices'  => $consultancy_firm_fonts,
) );