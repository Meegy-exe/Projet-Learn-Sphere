<?php
/**
* Header Options.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'consultancy_firm_button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'consultancy-firm' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

$wp_customize->add_setting('consultancy_firm_menu_font_size',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_menu_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
    )
);
$wp_customize->add_control('consultancy_firm_menu_font_size',
    array(
        'label'       => esc_html__('Menu Font Size', 'consultancy-firm'),
        'section'     => 'consultancy_firm_button_header_setting',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 30,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'consultancy_firm_menu_text_transform',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_menu_text_transform'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_menu_transform',
    )
);
$wp_customize->add_control( 'consultancy_firm_menu_text_transform',
    array(
    'label'       => esc_html__( 'Menu Text Transform', 'consultancy-firm' ),
    'section'     => 'consultancy_firm_button_header_setting',
    'type'        => 'select',
    'choices'     => array(
        'capitalize' => esc_html__( 'Capitalize', 'consultancy-firm' ),
        'uppercase'  => esc_html__( 'Uppercase', 'consultancy-firm' ),
        'lowercase'    => esc_html__( 'Lowercase', 'consultancy-firm' ),
        ),
    )
);

$wp_customize->add_setting('consultancy_firm_sticky',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_sticky'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_sticky',
    array(
        'label' => esc_html__('Enable Sticky Header', 'consultancy-firm'),
        'section' => 'consultancy_firm_button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_header_menus_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'consultancy_firm_header_menus_color', array(
    'label'    => __('Main Menu Color', 'consultancy-firm'),
    'section'  => 'consultancy_firm_button_header_setting',
)));

$wp_customize->add_setting('consultancy_firm_header_menus_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'consultancy_firm_header_menus_hover_color', array(
    'label'    => __('Main Menu Hover Color', 'consultancy-firm'),
    'section'  => 'consultancy_firm_button_header_setting',
)));

$wp_customize->add_setting('consultancy_firm_header_submenus_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'consultancy_firm_header_submenus_color', array(
    'label'    => __('Submenu Color', 'consultancy-firm'),
    'section'  => 'consultancy_firm_button_header_setting',
)));

$wp_customize->add_setting('consultancy_firm_header_submenus_hover_color', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'consultancy_firm_header_submenus_hover_color', array(
    'label'    => __('Submenu Hover Color', 'consultancy-firm'),
    'section'  => 'consultancy_firm_button_header_setting',
)));