<?php
/**
* Header Banner Options.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();
$consultancy_firm_post_category_list = consultancy_firm_post_category_list();

$wp_customize->add_section( 'header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Settings', 'consultancy-firm' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'consultancy_firm_theme_home_pannel',
    )
);

// Show/Hide Site Logo
$wp_customize->add_setting('consultancy_firm_display_logo', array(
    'default'           => false,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
));
$wp_customize->add_control('consultancy_firm_display_logo', array(
    'label'    => esc_html__('Enable / Disable Site Logo', 'consultancy-firm'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Title
$wp_customize->add_setting('consultancy_firm_display_title', array(
    'default'           => true,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
));
$wp_customize->add_control('consultancy_firm_display_title', array(
    'label'    => esc_html__('Enable / Disable Site Title', 'consultancy-firm'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Tagline
$wp_customize->add_setting('consultancy_firm_display_header_text',
    array(
        'default'           => false,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_header_text',
    array(
        'label' => esc_html__('Enable / Disable Site Tagline', 'consultancy-firm'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_header_slider',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_header_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_header_slider',
    array(
        'label' => esc_html__('Enable Slider', 'consultancy-firm'),
        'section' => 'header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('consultancy_firm_banner_background_image',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_banner_background_image'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'consultancy_firm_banner_background_image',
        array(
            'label' => __('Slider Background Image','consultancy-firm'),
            'section' => 'header_banner_setting',
            'settings' => 'consultancy_firm_banner_background_image',
        )
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_banner_cat',
    array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_select',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Left Category', 'consultancy-firm' ),
    'section'     => 'header_banner_setting',
    'type'        => 'select',
    'choices'     => $consultancy_firm_post_category_list,
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_phone_number',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_phone_number'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_phone_number',
    array(
    'label'    => esc_html__( 'Phone Number', 'consultancy-firm' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_email_id',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_email_id'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_email_id',
    array(
    'label'    => esc_html__( 'Email Id', 'consultancy-firm' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_header_location',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_header_location'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_header_location',
    array(
    'label'    => esc_html__( 'Address', 'consultancy-firm' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);


// Our Team Section

$wp_customize->add_section( 'consultancy_firm_header_category_setting',
    array(
    'title'      => esc_html__( 'Our Team Section', 'consultancy-firm' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'consultancy_firm_theme_home_pannel',
    )
);

$wp_customize->add_setting('consultancy_firm_header_case_studies',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_header_case_studies'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_header_case_studies',
    array(
        'label' => esc_html__('Enable Our Team', 'consultancy-firm'),
        'section' => 'consultancy_firm_header_category_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'consultancy_firm_team_section_subtitle',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_team_section_subtitle'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_team_section_subtitle',
    array(
    'label'    => esc_html__( 'Sub Title ', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_header_category_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_team_section_title',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_team_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_team_section_title',
    array(
    'label'    => esc_html__( 'Title ', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_header_category_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'consultancy_firm_locations_post_cat',
    array(
    'default'           => 'Second',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_select',
    )
);
$wp_customize->add_control( 'consultancy_firm_locations_post_cat',
    array(
    'label'       => esc_html__( 'Team Post Category', 'consultancy-firm' ),
    'section'     => 'consultancy_firm_header_category_setting',
    'type'        => 'select',
    'choices'     => $consultancy_firm_post_category_list,
    )
);

for ($i=1; $i <=6 ; $i++) {

    $wp_customize->add_setting( 'consultancy_firm_team_section_designation'.$i,
        array(
        'default'           => 'Lead Strategy Consultant',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_team_section_designation'.$i,
        array(
        'label'    => esc_html__( 'Designation ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'text',
        )
    );
    $wp_customize->add_setting( 'consultancy_firm_our_team_facebook_link'.$i,
        array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_our_team_facebook_link'.$i,
        array(
        'label'    => esc_html__( 'Facebook Link ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'url',
        )
    );

    $wp_customize->add_setting( 'consultancy_firm_our_team_twitter_link'.$i,
        array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_our_team_twitter_link'.$i,
        array(
        'label'    => esc_html__( 'Twitter Link ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'url',
        )
    );

    $wp_customize->add_setting( 'consultancy_firm_our_team_pintrest_link'.$i,
        array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_our_team_pintrest_link'.$i,
        array(
        'label'    => esc_html__( 'Instagram Link ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'url',
        )
    );

    $wp_customize->add_setting( 'consultancy_firm_our_team_instagram_link'.$i,
        array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_our_team_instagram_link'.$i,
        array(
        'label'    => esc_html__( 'Linkedin Link ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'url',
        )
    );

    $wp_customize->add_setting( 'consultancy_firm_our_team_youtube_link'.$i,
        array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_our_team_youtube_link'.$i,
        array(
        'label'    => esc_html__( 'Watsapp Link ', 'consultancy-firm' ) .$i,
        'section'  => 'consultancy_firm_header_category_setting',
        'type'     => 'url',
        )
    );
}