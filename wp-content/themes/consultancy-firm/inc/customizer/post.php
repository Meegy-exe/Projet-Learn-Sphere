<?php
/**
* Posts Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'consultancy_firm_single_posts_settings',
    array(
    'title'      => esc_html__( 'Single Meta Information Settings', 'consultancy-firm' ),
    'priority'   => 35,
    'capability' => 'edit_theme_options',
    'panel'      => 'consultancy_firm_theme_option_panel',
    )
);

$wp_customize->add_setting('consultancy_firm_display_single_post_image',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_single_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_single_post_image',
    array(
        'label' => esc_html__('Enable Single Posts Image', 'consultancy-firm'),
        'section' => 'consultancy_firm_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_post_author',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'consultancy-firm'),
        'section' => 'consultancy_firm_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_post_date',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'consultancy-firm'),
        'section' => 'consultancy_firm_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_post_category',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'consultancy-firm'),
        'section' => 'consultancy_firm_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_post_tags',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'consultancy-firm'),
        'section' => 'consultancy_firm_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'consultancy_firm_single_page_content_alignment',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_single_page_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'consultancy_firm_single_page_content_alignment',
    array(
    'label'       => esc_html__( 'Single Page Content Alignment', 'consultancy-firm' ),
    'section'     => 'consultancy_firm_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'consultancy-firm' ),
        'center'  => esc_html__( 'Center', 'consultancy-firm' ),
        'right'    => esc_html__( 'Right', 'consultancy-firm' ),
        ),
    )
);

$wp_customize->add_setting( 'consultancy_firm_single_post_content_alignment',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_single_post_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'consultancy_firm_single_post_content_alignment',
    array(
    'label'       => esc_html__( 'Single Post Content Alignment', 'consultancy-firm' ),
    'section'     => 'consultancy_firm_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'consultancy-firm' ),
        'center'  => esc_html__( 'Center', 'consultancy-firm' ),
        'right'    => esc_html__( 'Right', 'consultancy-firm' ),
        ),
    )
);

// Archive Post Section.
$wp_customize->add_section( 'consultancy_firm_posts_settings',
    array(
    'title'      => esc_html__( 'Archive Meta Information Settings', 'consultancy-firm' ),
    'priority'   => 36,
    'capability' => 'edit_theme_options',
    'panel'      => 'consultancy_firm_theme_option_panel',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_format_icon',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_format_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_format_icon',
    array(
        'label' => esc_html__('Enable Posts Format Icon', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_image',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_image',
    array(
        'label' => esc_html__('Enable Posts Image', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_category',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_title',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_title',
    array(
        'label' => esc_html__('Enable Posts Title', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_content',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_content'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_content',
    array(
        'label' => esc_html__('Enable Posts Content', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_display_archive_post_button',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_archive_post_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_archive_post_button',
    array(
        'label' => esc_html__('Enable Posts Button', 'consultancy-firm'),
        'section' => 'consultancy_firm_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_excerpt_limit',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_excerpt_limit'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
    )
);
$wp_customize->add_control('consultancy_firm_excerpt_limit',
    array(
        'label'       => esc_html__('Blog Posts Excerpt limit', 'consultancy-firm'),
        'section'     => 'consultancy_firm_posts_settings',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 100,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'consultancy_firm_archive_image_size',
	array(
	'default'           => 'medium',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'consultancy_firm_sanitize_select',
	)
);
$wp_customize->add_control( 'consultancy_firm_archive_image_size',
	array(
	'label'       => esc_html__( 'Blog Posts Image Size', 'consultancy-firm' ),
	'section'     => 'consultancy_firm_posts_settings',
	'type'        => 'select',
	'choices'               => array(
		'full' => esc_html__( 'Large Size Image', 'consultancy-firm' ),
		'large' => esc_html__( 'Big Size Image', 'consultancy-firm' ),
		'medium' => esc_html__( 'Medium Size Image', 'consultancy-firm' ),
		'small' => esc_html__( 'Small Size Image', 'consultancy-firm' ),
		'xsmall' => esc_html__( 'Extra Small Size Image', 'consultancy-firm' ),
		'thumbnail' => esc_html__( 'Thumbnail Size Image', 'consultancy-firm' ),
	    ),
	)
);

$wp_customize->add_setting('consultancy_firm_posts_per_columns',
    array(
    'default'           => '3',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
    )
);
$wp_customize->add_control('consultancy_firm_posts_per_columns',
    array(
    'label'       => esc_html__('Blog Posts Per Column', 'consultancy-firm'),
    'section'     => 'consultancy_firm_posts_settings',
    'type'        => 'number',
    'input_attrs' => array(
    'min'   => 1,
    'max'   => 5,
    'step'   => 1,
    ),
    )
);