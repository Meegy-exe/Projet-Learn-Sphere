<?php
/**
 *
 * Pagination Functions
 *
 * @package Consultancy Firm
 */

/**
 * Pagination for archive.
 */
function consultancy_firm_render_posts_pagination() {
    // Get the setting to check if pagination is enabled
    $consultancy_firm_is_pagination_enabled = get_theme_mod( 'consultancy_firm_enable_pagination', true );

    // Check if pagination is enabled
    if ( $consultancy_firm_is_pagination_enabled ) {
        // Get the selected pagination type from the Customizer
        $consultancy_firm_pagination_type = get_theme_mod( 'consultancy_firm_theme_pagination_type', 'numeric' );

        // Check if the pagination type is "newer_older" (Previous/Next) or "numeric"
        if ( 'newer_older' === $consultancy_firm_pagination_type ) :
            // Display "Newer/Older" pagination (Previous/Next navigation)
            the_posts_navigation(
                array(
                    'prev_text' => __( '&laquo; Newer', 'consultancy-firm' ),  // Change the label for "previous"
                    'next_text' => __( 'Older &raquo;', 'consultancy-firm' ),  // Change the label for "next"
                    'screen_reader_text' => __( 'Posts navigation', 'consultancy-firm' ),
                )
            );
        else :
            // Display numeric pagination (Page numbers)
            the_posts_pagination(
                array(
                    'prev_text' => __( '&laquo; Previous', 'consultancy-firm' ),
                    'next_text' => __( 'Next &raquo;', 'consultancy-firm' ),
                    'type'      => 'list', // Display as <ul> <li> tags
                    'screen_reader_text' => __( 'Posts navigation', 'consultancy-firm' ),
                )
            );
        endif;
    }
}
add_action( 'consultancy_firm_posts_pagination', 'consultancy_firm_render_posts_pagination', 10 );