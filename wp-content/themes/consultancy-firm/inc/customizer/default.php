<?php
/**
 * Default Values.
 *
 * @package Consultancy Firm
 */

if ( ! function_exists( 'consultancy_firm_get_default_theme_options' ) ) :
	function consultancy_firm_get_default_theme_options() {

		$consultancy_firm_defaults = array();
		
        // Options.
        $consultancy_firm_defaults['consultancy_firm_logo_width_range']                                                      = 200;
	$consultancy_firm_defaults['consultancy_firm_global_sidebar_layout']	                  = 'right-sidebar';
        $consultancy_firm_defaults['consultancy_firm_header_search']                                  = 0;
        $consultancy_firm_defaults['consultancy_firm_display_header_toggle']                          = 0;
        $consultancy_firm_defaults['consultancy_firm_theme_pagination_options_alignment']             = 'Center';
        $consultancy_firm_defaults['consultancy_firm_theme_breadcrumb_options_alignment']             = 'Left';
        $consultancy_firm_defaults['consultancy_firm_pagination_layout']                              = 'numeric';
        $consultancy_firm_defaults['consultancy_firm_menu_text_transform']                            = 'uppercase';
        $consultancy_firm_defaults['consultancy_firm_single_page_content_alignment']                  = 'left';
        $consultancy_firm_defaults['consultancy_firm_footer_column_layout'] 		            = 3;
        $consultancy_firm_defaults['consultancy_firm_menu_font_size']                                 = 14;
        $consultancy_firm_defaults['consultancy_firm_copyright_font_size']                            = 16;
        $consultancy_firm_defaults['consultancy_firm_breadcrumb_font_size']                           = 16;
        $consultancy_firm_defaults['consultancy_firm_excerpt_limit']                                  = 20;
        $consultancy_firm_defaults['consultancy_firm_per_columns']                                    = 3;
        $consultancy_firm_defaults['consultancy_firm_product_per_page']                               = 9;
        $consultancy_firm_defaults['consultancy_firm_custom_related_products_number'] = 6;
        $consultancy_firm_defaults['consultancy_firm_custom_related_products_number_per_row'] = 3;
        $consultancy_firm_defaults['consultancy_firm_footer_copyright_text'] 		          = esc_html__( 'All rights reserved.', 'consultancy-firm' );
        $consultancy_firm_defaults['twp_navigation_type']              			                  = 'theme-normal-navigation';
        $consultancy_firm_defaults['consultancy_firm_post_author']                	                  = 1;
        $consultancy_firm_defaults['consultancy_firm_post_date']                		          = 1;
        $consultancy_firm_defaults['consultancy_firm_post_category']                	          = 1;
        $consultancy_firm_defaults['consultancy_firm_post_tags']                		          = 1;
        $consultancy_firm_defaults['consultancy_firm_floating_next_previous_nav']                     = 1;
        $consultancy_firm_defaults['consultancy_firm_category_section']                               = 0;
        $consultancy_firm_defaults['consultancy_firm_courses_category_section']                       = 0;
        $consultancy_firm_defaults['consultancy_firm_theme_loader']                  = 0;
        $consultancy_firm_defaults['consultancy_firm_sticky']                                         = 0;
        $consultancy_firm_defaults['consultancy_firm_background_color']                               = '#fff';
        $consultancy_firm_defaults['consultancy_firm_theme_breadcrumb_enable']                 = 1;
        $consultancy_firm_defaults['consultancy_firm_single_post_content_alignment']                 = 'left';

        // Social Icon
        $consultancy_firm_defaults['consultancy_firm_header_layout_facebook_link']              = esc_url( '#', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_layout_twitter_link']               = esc_url( '#', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_layout_pintrest_link']              = esc_url( '#', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_layout_instagram_link']             = esc_url( '#', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_layout_youtube_link']               = esc_url( '#', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_footer_widget_title_alignment']                 = 'left'; 

        //slider
        $consultancy_firm_defaults['consultancy_firm_header_slider']                                  = 1;
        $consultancy_firm_defaults['consultancy_firm_header_phone_number']                            = esc_html__( '+91123456789', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_email_id']                                = esc_html__( 'consulting@example.com', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_header_location']                                = esc_html__( '775 Rolling Green Rd.', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_banner_background_image']                        = esc_url(get_template_directory_uri() . '/assets/images/slide-bg.png');

        // Courses Section
        $consultancy_firm_defaults['consultancy_firm_header_case_studies']                                        = 1;
        $consultancy_firm_defaults['consultancy_firm_team_section_subtitle']                          = esc_html__( 'Your Consulting Partners', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_team_section_title']                             = esc_html__( 'Experienced consultants committed to driving your business forward.', 'consultancy-firm' );

        $consultancy_firm_defaults['consultancy_firm_global_color']                                   = '#F75C4E';
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_category']          = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_sticky_post']       = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_title']             = 1;
        $consultancy_firm_defaults['consultancy_firm_show_hide_related_product']                      = 1;
        $consultancy_firm_defaults['consultancy_firm_display_footer']                                 = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_content']           = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_image']            = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_button']            = 1;
        $consultancy_firm_defaults['consultancy_firm_enable_to_the_top']                      = 1;
        $consultancy_firm_defaults['consultancy_firm_to_the_top_text']                      = esc_html__( 'To The Top', 'consultancy-firm' );
        
        $consultancy_firm_defaults['consultancy_firm_display_single_post_image']            = 1;
        $consultancy_firm_defaults['consultancy_firm_display_archive_post_format_icon']       = 1;
        
        // 404 Page Defaults
        $consultancy_firm_defaults['consultancy_firm_404_main_title'] = esc_html__( 'Oops! That page can’t be found.', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_404_subtitle_one'] = esc_html__( 'Maybe it’s out there, somewhere...', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_404_para_one'] = esc_html__( 'You can always find insightful stories on our', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_404_subtitle_two'] = esc_html__( 'Still feeling lost? You’re not alone.', 'consultancy-firm' );
        $consultancy_firm_defaults['consultancy_firm_404_para_two'] = esc_html__( 'Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'consultancy-firm' );
        
	// Pass through filter.
	$consultancy_firm_defaults = apply_filters( 'consultancy_firm_filter_default_theme_options', $consultancy_firm_defaults );

		return $consultancy_firm_defaults;
	}
endif;
