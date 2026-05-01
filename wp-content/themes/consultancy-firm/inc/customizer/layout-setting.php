<?php
/**
* Layouts Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'consultancy_firm_layout_setting',
	array(
	'title'      => esc_html__( 'Sidebar Settings', 'consultancy-firm' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

$wp_customize->add_setting( 'consultancy_firm_global_sidebar_layout',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'consultancy_firm_global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'consultancy-firm' ),
    'section'     => 'consultancy_firm_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'consultancy-firm' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'consultancy-firm' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'consultancy-firm' ),
        ),
    )
);

$wp_customize->add_setting('consultancy_firm_page_sidebar_layout', array(
    'default'           => $consultancy_firm_default['consultancy_firm_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_sidebar_option',
));

$wp_customize->add_control('consultancy_firm_page_sidebar_layout', array(
    'label'       => esc_html__('Single Page Sidebar Layout', 'consultancy-firm'),
    'section'     => 'consultancy_firm_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'consultancy-firm'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'consultancy-firm'),
        'no-sidebar'    => esc_html__('No Sidebar', 'consultancy-firm'),
    ),
));

$wp_customize->add_setting('consultancy_firm_post_sidebar_layout', array(
    'default'           => $consultancy_firm_default['consultancy_firm_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_sidebar_option',
));

$wp_customize->add_control('consultancy_firm_post_sidebar_layout', array(
    'label'       => esc_html__('Single Post Sidebar Layout', 'consultancy-firm'),
    'section'     => 'consultancy_firm_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'consultancy-firm'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'consultancy-firm'),
        'no-sidebar'    => esc_html__('No Sidebar', 'consultancy-firm'),
    ),
));

$wp_customize->add_setting('consultancy_firm_sticky_sidebar',
    array(
        'default'           => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_sticky_sidebar',
    array(
        'label' => esc_html__('Enable/Disable Sticky Sidebar', 'consultancy-firm'),
        'section' => 'consultancy_firm_layout_setting',
        'type' => 'checkbox',
    )
);