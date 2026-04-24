<?php

$consultancy_firm_custom_css = "";

	$consultancy_firm_theme_pagination_options_alignment = get_theme_mod('consultancy_firm_theme_pagination_options_alignment', 'Center');
	if ($consultancy_firm_theme_pagination_options_alignment == 'Center') {
		$consultancy_firm_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$consultancy_firm_custom_css .= 'justify-content: center;margin: 0 auto;';
		$consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_theme_pagination_options_alignment == 'Right') {
		$consultancy_firm_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$consultancy_firm_custom_css .= 'justify-content: right;margin: 0 0 0 auto;';
		$consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_theme_pagination_options_alignment == 'Left') {
		$consultancy_firm_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$consultancy_firm_custom_css .= 'justify-content: left;margin: 0 auto 0 0;';
		$consultancy_firm_custom_css .= '}';
	}

	$consultancy_firm_theme_breadcrumb_enable = get_theme_mod('consultancy_firm_theme_breadcrumb_enable',true);
    if($consultancy_firm_theme_breadcrumb_enable != true){
        $consultancy_firm_custom_css .='nav.breadcrumb-trail.breadcrumbs,nav.woocommerce-breadcrumb{';
            $consultancy_firm_custom_css .='display: none;';
        $consultancy_firm_custom_css .='}';
    }

	$consultancy_firm_theme_breadcrumb_options_alignment = get_theme_mod('consultancy_firm_theme_breadcrumb_options_alignment', 'Left');
	if ($consultancy_firm_theme_breadcrumb_options_alignment == 'Center') {
	    $consultancy_firm_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $consultancy_firm_custom_css .= 'text-align: center !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_theme_breadcrumb_options_alignment == 'Right') {
	    $consultancy_firm_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $consultancy_firm_custom_css .= 'text-align: Right !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_theme_breadcrumb_options_alignment == 'Left') {
	    $consultancy_firm_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $consultancy_firm_custom_css .= 'text-align: Left !important;';
	    $consultancy_firm_custom_css .= '}';
	}

	$consultancy_firm_single_page_content_alignment = get_theme_mod('consultancy_firm_single_page_content_alignment', 'left');
	if ($consultancy_firm_single_page_content_alignment == 'left') {
	    $consultancy_firm_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $consultancy_firm_custom_css .= 'text-align: left !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_single_page_content_alignment == 'center') {
	    $consultancy_firm_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $consultancy_firm_custom_css .= 'text-align: center !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_single_page_content_alignment == 'right') {
	    $consultancy_firm_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $consultancy_firm_custom_css .= 'text-align: right !important;';
	    $consultancy_firm_custom_css .= '}';
	}

	$consultancy_firm_single_post_content_alignment = get_theme_mod('consultancy_firm_single_post_content_alignment', 'left');
	if ($consultancy_firm_single_post_content_alignment == 'left') {
	    $consultancy_firm_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $consultancy_firm_custom_css .= 'text-align: left !important;justify-content: left;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_single_post_content_alignment == 'center') {
	    $consultancy_firm_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $consultancy_firm_custom_css .= 'text-align: center !important;justify-content: center;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_single_post_content_alignment == 'right') {
	    $consultancy_firm_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $consultancy_firm_custom_css .= 'text-align: right !important;justify-content: right;';
	    $consultancy_firm_custom_css .= '}';
	}

	$consultancy_firm_footer_widget_title_alignment = get_theme_mod('consultancy_firm_footer_widget_title_alignment', 'left');
	if ($consultancy_firm_footer_widget_title_alignment == 'left') {
	    $consultancy_firm_custom_css .= 'h2.widget-title{';
	    $consultancy_firm_custom_css .= 'text-align: left !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_footer_widget_title_alignment == 'center') {
	    $consultancy_firm_custom_css .= 'h2.widget-title{';
	    $consultancy_firm_custom_css .= 'text-align: center !important;';
	    $consultancy_firm_custom_css .= '}';
	} else if ($consultancy_firm_footer_widget_title_alignment == 'right') {
	    $consultancy_firm_custom_css .= 'h2.widget-title{';
	    $consultancy_firm_custom_css .= 'text-align: right !important;';
	    $consultancy_firm_custom_css .= '}';
	}

	$consultancy_firm_menu_text_transform = get_theme_mod('consultancy_firm_menu_text_transform', 'uppercase'); 
	if ($consultancy_firm_menu_text_transform == 'capitalize') {
	$consultancy_firm_custom_css .= '.site-navigation .primary-menu > li a{';
	$consultancy_firm_custom_css .= 'text-transform: capitalize !important;';
	$consultancy_firm_custom_css .= '}'; 
	} 
	else if ($consultancy_firm_menu_text_transform == 'uppercase') {
	$consultancy_firm_custom_css .= '.site-navigation .primary-menu > li a{';
	$consultancy_firm_custom_css .= 'text-transform: uppercase !important;';
	$consultancy_firm_custom_css .= '}'; 
	} 
	else if ($consultancy_firm_menu_text_transform == 'lowercase') {
	$consultancy_firm_custom_css .= '.site-navigation .primary-menu > li a{';
	$consultancy_firm_custom_css .= 'text-transform: lowercase !important;';
	$consultancy_firm_custom_css .= '}'; 
	}

	$consultancy_firm_show_hide_related_product = get_theme_mod('consultancy_firm_show_hide_related_product',true);
    if($consultancy_firm_show_hide_related_product != true){
        $consultancy_firm_custom_css .='.related.products{';
            $consultancy_firm_custom_css .='display: none;';
        $consultancy_firm_custom_css .='}';
    }

	/*-------------------- Global First Color -------------------*/

	$consultancy_firm_global_color = get_theme_mod('consultancy_firm_global_color', '#F75C4E'); // Add a fallback if the color isn't set

	if ($consultancy_firm_global_color) {
		$consultancy_firm_custom_css .= ':root {';
		$consultancy_firm_custom_css .= '--global-color: ' . esc_attr($consultancy_firm_global_color) . ';';
		$consultancy_firm_custom_css .= '}';
	}	

	/*-------------------- Content Font -------------------*/

	$consultancy_firm_content_typography_font = get_theme_mod('consultancy_firm_content_typography_font', 'plusjakartasans'); // Add a fallback if the color isn't set

	if ($consultancy_firm_content_typography_font) {
		$consultancy_firm_custom_css .= ':root {';
		$consultancy_firm_custom_css .= '--font-main: ' . esc_attr($consultancy_firm_content_typography_font) . ';';
		$consultancy_firm_custom_css .= '}';
	}

	/*-------------------- Heading Font -------------------*/

	$consultancy_firm_heading_typography_font = get_theme_mod('consultancy_firm_heading_typography_font', 'plusjakartasans'); // Add a fallback if the color isn't set

	if ($consultancy_firm_heading_typography_font) {
		$consultancy_firm_custom_css .= ':root {';
		$consultancy_firm_custom_css .= '--font-head: ' . esc_attr($consultancy_firm_heading_typography_font) . ';';
		$consultancy_firm_custom_css .= '}';
	}
								
	$consultancy_firm_columns = get_theme_mod('consultancy_firm_posts_per_columns', 3);
	$consultancy_firm_columns = absint($consultancy_firm_columns);
	if ( $consultancy_firm_columns < 1 || $consultancy_firm_columns > 6 ) {
		$consultancy_firm_columns = 3;
	}
	$consultancy_firm_custom_css .= "
		.site-content .article-wraper-archive {
			grid-template-columns: repeat({$consultancy_firm_columns}, 1fr);
		}
	";

	// FOOTER

	$consultancy_firm_footer_widget_background_color = get_theme_mod('consultancy_firm_footer_widget_background_color');
	if ($consultancy_firm_footer_widget_background_color) {

		$consultancy_firm_custom_css .= "
			.footer-widgetarea {
				background-color: ". esc_attr($consultancy_firm_footer_widget_background_color) .";
			}
		";
	}

	$consultancy_firm_footer_widget_background_image = get_theme_mod('consultancy_firm_footer_widget_background_image');
	if ($consultancy_firm_footer_widget_background_image) {
		$consultancy_firm_custom_css .= "
			.footer-widgetarea {
				background-image: url(" . esc_url($consultancy_firm_footer_widget_background_image) . ");
			}
		";
	}

	$consultancy_firm_copyright_font_size = get_theme_mod('consultancy_firm_copyright_font_size');
	if ($consultancy_firm_copyright_font_size) {

		$consultancy_firm_custom_css .= "
			.footer-copyright {
				font-size: ". esc_attr($consultancy_firm_copyright_font_size) ."px;
			}
		";
	}

	$consultancy_firm_copyright_alignment = get_theme_mod( 'consultancy_firm_copyright_alignment', 'Default' );
	if ( $consultancy_firm_copyright_alignment === 'Reverse' ) {
		$consultancy_firm_custom_css .= '.site-info .column-row { flex-direction: row-reverse; }';
		$consultancy_firm_custom_css .= '.footer-credits { justify-content: flex-end; }';
		$consultancy_firm_custom_css .= '.footer-copyright { text-align: right; }';
		$consultancy_firm_custom_css .= '.site-info .column.column-3 { text-align: left; }';
	} elseif ( $consultancy_firm_copyright_alignment === 'Center' ) {
		$consultancy_firm_custom_css .= '.site-info .column-row { flex-direction: column; align-items: center; gap: 15px; }';
		$consultancy_firm_custom_css .= '.footer-credits { justify-content: center; }';
		$consultancy_firm_custom_css .= '.footer-copyright { text-align: center; }';
		$consultancy_firm_custom_css .= '.site-info .column.column-3 { text-align: center; }';
	}

	/*-------------------- Menu Color CSS -------------------*/

	$consultancy_firm_header_menus_color = get_theme_mod('consultancy_firm_header_menus_color');
	if($consultancy_firm_header_menus_color != false){
		$consultancy_firm_custom_css .='.site-navigation .primary-menu a{';
			$consultancy_firm_custom_css .='color: '.esc_attr($consultancy_firm_header_menus_color).'!important;';
		$consultancy_firm_custom_css .='}';
	}

	$consultancy_firm_header_menus_hover_color = get_theme_mod('consultancy_firm_header_menus_hover_color');
	if($consultancy_firm_header_menus_hover_color != false){
		$consultancy_firm_custom_css .='.site-navigation .primary-menu a:hover{';
			$consultancy_firm_custom_css .='color: '.esc_attr($consultancy_firm_header_menus_hover_color).'!important;';
		$consultancy_firm_custom_css .='}';
	}

	$consultancy_firm_header_submenus_color = get_theme_mod('consultancy_firm_header_submenus_color');
	if($consultancy_firm_header_submenus_color != false){
		$consultancy_firm_custom_css .='.site-navigation .primary-menu li ul li a{';
			$consultancy_firm_custom_css .='color: '.esc_attr($consultancy_firm_header_submenus_color).'!important;';
		$consultancy_firm_custom_css .='}';
	}

	$consultancy_firm_header_submenus_hover_color = get_theme_mod('consultancy_firm_header_submenus_hover_color');
	if($consultancy_firm_header_submenus_hover_color != false){
		$consultancy_firm_custom_css .='.site-navigation .primary-menu li ul li a:hover{';
			$consultancy_firm_custom_css .='color: '.esc_attr($consultancy_firm_header_submenus_hover_color).'!important;';
		$consultancy_firm_custom_css .='}';
	}