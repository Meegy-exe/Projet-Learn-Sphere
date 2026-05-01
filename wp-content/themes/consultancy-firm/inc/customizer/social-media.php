<?php
/**
* Header Options.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'consultancy_firm_social_media_setting',
	array(
	'title'      => esc_html__( 'Social Media Settings', 'consultancy-firm' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

$wp_customize->add_setting( 'consultancy_firm_header_layout_facebook_link',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_layout_facebook_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_layout_facebook_link',
    array(
    'label'    => esc_html__( 'Facebook Link', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_layout_twitter_link',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_layout_twitter_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_layout_twitter_link',
    array(
    'label'    => esc_html__( 'Twitter Link', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_layout_pintrest_link',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_layout_pintrest_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_layout_pintrest_link',
    array(
    'label'    => esc_html__( 'Pintrest Link', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_layout_instagram_link',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_layout_instagram_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_layout_instagram_link',
    array(
    'label'    => esc_html__( 'Instagram Link', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_social_media_setting',
    'type'     => 'url',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_layout_youtube_link',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_layout_youtube_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_layout_youtube_link',
    array(
    'label'    => esc_html__( 'Youtube Link', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_social_media_setting',
    'type'     => 'url',
    )
);