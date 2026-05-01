<?php

function consultancy_firm_enqueue_fonts() {
    $consultancy_firm_default_font_content = 'plusjakartasans';
    $consultancy_firm_default_font_heading = 'plusjakartasans';

    $consultancy_firm_font_content = esc_attr(get_theme_mod('consultancy_firm_content_typography_font', $consultancy_firm_default_font_content));
    $consultancy_firm_font_heading = esc_attr(get_theme_mod('consultancy_firm_heading_typography_font', $consultancy_firm_default_font_heading));

    $consultancy_firm_css = '';

    // Always enqueue main font
    $consultancy_firm_css .= '
    :root {
        --font-main: "' . $consultancy_firm_font_content . '", sans-serif !important;
    }';
    wp_enqueue_style('consultancy-firm-style-font-general', get_template_directory_uri() . '/fonts/' . $consultancy_firm_font_content . '/font.css');

    // Always enqueue header font
    $consultancy_firm_css .= '
    :root {
        --font-head: "' . $consultancy_firm_font_heading . '", sans-serif !important;
    }';
    wp_enqueue_style('consultancy-firm-style-font-h', get_template_directory_uri() . '/fonts/' . $consultancy_firm_font_heading . '/font.css');

    // Add inline style
    wp_add_inline_style('consultancy-firm-style-font-general', $consultancy_firm_css);
}
add_action('wp_enqueue_scripts', 'consultancy_firm_enqueue_fonts', 50);