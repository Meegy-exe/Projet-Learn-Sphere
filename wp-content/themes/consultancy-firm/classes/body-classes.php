<?php
/**
 * Body Classes.
 * @package Consultancy Firm
 */

if (!function_exists('consultancy_firm_body_classes')) :

    function consultancy_firm_body_classes($consultancy_firm_classes)
    {
        $consultancy_firm_defaults = consultancy_firm_get_default_theme_options();
        $consultancy_firm_layout = consultancy_firm_get_final_sidebar_layout();

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $consultancy_firm_classes[] = 'hfeed';
        }

        // Sidebar layout logic
        $consultancy_firm_classes[] = $consultancy_firm_layout;

        // Copyright alignment
        $copyright_alignment = get_theme_mod('consultancy_firm_copyright_alignment', 'Default');
        $consultancy_firm_classes[] = 'copyright-' . strtolower($copyright_alignment);

        return $consultancy_firm_classes;
    }

endif;

add_filter('body_class', 'consultancy_firm_body_classes');