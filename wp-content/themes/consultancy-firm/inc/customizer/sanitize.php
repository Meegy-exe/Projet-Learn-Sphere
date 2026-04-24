<?php
/**
* Custom Functions.
*
* @package Consultancy Firm
*/

if( !function_exists( 'consultancy_firm_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function consultancy_firm_sanitize_sidebar_option( $consultancy_firm_input ){

        $consultancy_firm_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $consultancy_firm_input,$consultancy_firm_metabox_options ) ){

            return $consultancy_firm_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'consultancy_firm_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function consultancy_firm_sanitize_checkbox( $consultancy_firm_checked ) {

		return ( ( isset( $consultancy_firm_checked ) && true === $consultancy_firm_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'consultancy_firm_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function consultancy_firm_sanitize_select( $consultancy_firm_input, $consultancy_firm_setting ) {
        $consultancy_firm_input = sanitize_text_field( $consultancy_firm_input );
        $choices = $consultancy_firm_setting->manager->get_control( $consultancy_firm_setting->id )->choices;
        return ( array_key_exists( $consultancy_firm_input, $choices ) ? $consultancy_firm_input : $consultancy_firm_setting->default );
    }

endif;