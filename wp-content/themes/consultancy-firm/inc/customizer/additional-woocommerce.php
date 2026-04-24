<?php
/**
* Additional Woocommerce Settings.
*
* @package Consultancy Firm
*/

$consultancy_firm_default = consultancy_firm_get_default_theme_options();

// Additional Woocommerce Section.
$wp_customize->add_section( 'consultancy_firm_additional_woocommerce_options',
	array(
	'title'      => esc_html__( 'Additional Woocommerce Options', 'consultancy-firm' ),
	'priority'   => 210,
	'capability' => 'edit_theme_options',
	'panel'      => 'consultancy_firm_theme_option_panel',
	)
);

	$wp_customize->add_setting('consultancy_firm_per_columns',
		array(
		'default'           => $consultancy_firm_default['consultancy_firm_per_columns'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
		)
	);
	$wp_customize->add_control('consultancy_firm_per_columns',
		array(
		'label'       => esc_html__('Products Per Column', 'consultancy-firm'),
		'section'     => 'consultancy_firm_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 6,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('consultancy_firm_product_per_page',
		array(
		'default'           => $consultancy_firm_default['consultancy_firm_product_per_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
		)
	);
	$wp_customize->add_control('consultancy_firm_product_per_page',
		array(
		'label'       => esc_html__('Products Per Page', 'consultancy-firm'),
		'section'     => 'consultancy_firm_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 100,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('consultancy_firm_show_hide_related_product',
    array(
        'default' => $consultancy_firm_default['consultancy_firm_show_hide_related_product'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'consultancy_firm_sanitize_checkbox',
    )
	);
	$wp_customize->add_control('consultancy_firm_show_hide_related_product',
	    array(
	        'label' => esc_html__('Enable Related Products', 'consultancy-firm'),
	        'section' => 'consultancy_firm_additional_woocommerce_options',
	        'type' => 'checkbox',
	    )
	);

	$wp_customize->add_setting('consultancy_firm_custom_related_products_number',
		array(
		'default'           => $consultancy_firm_default['consultancy_firm_custom_related_products_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
		)
	);
	$wp_customize->add_control('consultancy_firm_custom_related_products_number',
		array(
		'label'       => esc_html__('Related Products Per Page', 'consultancy-firm'),
		'section'     => 'consultancy_firm_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 10,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('consultancy_firm_custom_related_products_number_per_row',
		array(
		'default'           => $consultancy_firm_default['consultancy_firm_custom_related_products_number_per_row'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'consultancy_firm_sanitize_number_range',
		)
	);
	$wp_customize->add_control('consultancy_firm_custom_related_products_number_per_row',
		array(
		'label'       => esc_html__('Related Products Per Row', 'consultancy-firm'),
		'section'     => 'consultancy_firm_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 5,
		'step'   => 1,
		),
		)
	);