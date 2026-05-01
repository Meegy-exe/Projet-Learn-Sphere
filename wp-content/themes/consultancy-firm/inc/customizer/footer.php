<?php
/**
* Footer Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

$wp_customize->add_section( 'consultancy_firm_footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'consultancy-firm' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

$wp_customize->add_setting('consultancy_firm_display_footer',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_display_footer'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_display_footer',
    array(
        'label' => esc_html__('Enable Footer', 'consultancy-firm'),
        'section' => 'consultancy_firm_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'consultancy_firm_footer_column_layout',
	array(
	'default'           => $consultancy_firm_default['consultancy_firm_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'consultancy_firm_sanitize_select',
	)
);
$wp_customize->add_control( 'consultancy_firm_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'consultancy-firm' ),
	'section'     => 'consultancy_firm_footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'consultancy-firm' ),
		'2' => esc_html__( 'Two Column', 'consultancy-firm' ),
		'3' => esc_html__( 'Three Column', 'consultancy-firm' ),
	    ),
	)
);

$wp_customize->add_setting( 'consultancy_firm_footer_copyright_text',
	array(
	'default'           => $consultancy_firm_default['consultancy_firm_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'consultancy_firm_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'consultancy-firm' ),
	'section'  => 'consultancy_firm_footer_widget_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('consultancy_firm_copyright_font_size',
    array(
        'default'           => $consultancy_firm_default['consultancy_firm_copyright_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
    )
);
$wp_customize->add_control('consultancy_firm_copyright_font_size',
    array(
        'label'       => esc_html__('Copyright Font Size', 'consultancy-firm'),
        'section'     => 'consultancy_firm_footer_widget_area',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 5,
           'max'   => 30,
           'step'   => 1,
    	),
    )
);

$wp_customize->add_setting( 'consultancy_firm_copyright_alignment', array(
    'default'           => 'Default',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'consultancy_firm_sanitize_copyright_alignment_meta',
) );

$wp_customize->add_control( 'consultancy_firm_copyright_alignment', array(
    'label'    => esc_html__( 'Copyright Section Alignment', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_footer_widget_area',
    'type'     => 'select',
    'choices'  => array(
        'Default' => esc_html__( 'Default View', 'consultancy-firm' ),
        'Reverse' => esc_html__( 'Reverse View', 'consultancy-firm' ),
        'Center'  => esc_html__( 'Centered Content', 'consultancy-firm' ),
    ),
) );

$wp_customize->add_setting( 'consultancy_firm_footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'consultancy_firm_footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'consultancy-firm'),
    'description' => __('It will change the complete footer widget background color.', 'consultancy-firm'),
    'section' => 'consultancy_firm_footer_widget_area',
    'settings' => 'consultancy_firm_footer_widget_background_color',
)));

$wp_customize->add_setting('consultancy_firm_footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'consultancy_firm_footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','consultancy-firm'),
    'section' => 'consultancy_firm_footer_widget_area'
)));

$wp_customize->add_setting( 'consultancy_firm_footer_widget_title_alignment',
        array(
        'default'           => $consultancy_firm_default['consultancy_firm_footer_widget_title_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_footer_widget_title_alignment',
        )
    );
    $wp_customize->add_control( 'consultancy_firm_footer_widget_title_alignment',
        array(
        'label'       => esc_html__( 'Footer Widget Title Alignment', 'consultancy-firm' ),
        'section'     => 'consultancy_firm_footer_widget_area',
        'type'        => 'select',
        'choices'     => array(
            'left' => esc_html__( 'Left', 'consultancy-firm' ),
            'center'  => esc_html__( 'Center', 'consultancy-firm' ),
            'right'    => esc_html__( 'Right', 'consultancy-firm' ),
            ),
        )
    );

$wp_customize->add_setting('consultancy_firm_enable_to_the_top',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_enable_to_the_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
);
$wp_customize->add_control('consultancy_firm_enable_to_the_top',
    array(
        'label' => esc_html__('Enable To The Top', 'consultancy-firm'),
        'section' => 'consultancy_firm_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'consultancy_firm_to_the_top_text',
    array(
    'default'           => $consultancy_firm_default['consultancy_firm_to_the_top_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'consultancy_firm_to_the_top_text',
    array(
    'label'    => esc_html__( 'Edit Text Here', 'consultancy-firm' ),
    'section'  => 'consultancy_firm_footer_widget_area',
    'type'     => 'text',
    )
);