<?php
/**
 * Custom page walker for this theme.
 *
 * @package Consultancy Firm
 */

if (!class_exists('Consultancy_Firm_Walker_Page')) {
    /**
     * CUSTOM PAGE WALKER
     * A custom walker for pages.
     */
    class Consultancy_Firm_Walker_Page extends Walker_Page
    {

        /**
         * Outputs the beginning of the current element in the tree.
         *
         * @param string $consultancy_firm_output Used to append additional content. Passed by reference.
         * @param WP_Post $page Page data object.
         * @param int $consultancy_firm_depth Optional. Depth of page. Used for padding. Default 0.
         * @param array $consultancy_firm_args Optional. Array of arguments. Default empty array.
         * @param int $current_page Optional. Page ID. Default 0.
         * @since 2.1.0
         *
         * @see Walker::start_el()
         */

        public function start_lvl( &$consultancy_firm_output, $consultancy_firm_depth = 0, $consultancy_firm_args = array() ) {
            $consultancy_firm_indent  = str_repeat( "\t", $consultancy_firm_depth );
            $consultancy_firm_output .= "$consultancy_firm_indent<ul class='sub-menu'>\n";
        }

        public function start_el(&$consultancy_firm_output, $page, $consultancy_firm_depth = 0, $consultancy_firm_args = array(), $current_page = 0)
        {

            if (isset($consultancy_firm_args['item_spacing']) && 'preserve' === $consultancy_firm_args['item_spacing']) {
                $t = "\t";
                $n = "\n";
            } else {
                $t = '';
                $n = '';
            }
            if ($consultancy_firm_depth) {
                $consultancy_firm_indent = str_repeat($t, $consultancy_firm_depth);
            } else {
                $consultancy_firm_indent = '';
            }

            $consultancy_firm_css_class = array('page_item', 'page-item-' . $page->ID);

            if (isset($consultancy_firm_args['pages_with_children'][$page->ID])) {
                $consultancy_firm_css_class[] = 'page_item_has_children';
            }

            if (!empty($current_page)) {
                $_current_page = get_post($current_page);
                if ($_current_page && in_array($page->ID, $_current_page->ancestors, true)) {
                    $consultancy_firm_css_class[] = 'current_page_ancestor';
                }
                if ($page->ID === $current_page) {
                    $consultancy_firm_css_class[] = 'current_page_item';
                } elseif ($_current_page && $page->ID === $_current_page->post_parent) {
                    $consultancy_firm_css_class[] = 'current_page_parent';
                }
            } elseif (get_option('page_for_posts') === $page->ID) {
                $consultancy_firm_css_class[] = 'current_page_parent';
            }

            /** This filter is documented in wp-includes/class-walker-page.php */
            $consultancy_firm_css_classes = implode(' ', apply_filters('page_css_class', $consultancy_firm_css_class, $page, $consultancy_firm_depth, $consultancy_firm_args, $current_page));
            $consultancy_firm_css_classes = $consultancy_firm_css_classes ? ' class="' . esc_attr($consultancy_firm_css_classes) . '"' : '';

            if ('' === $page->post_title) {
                /* translators: %d: ID of a post. */
                $page->post_title = sprintf(__('#%d (no title)', 'consultancy-firm'), $page->ID);
            }

            $consultancy_firm_args['link_before'] = empty($consultancy_firm_args['link_before']) ? '' : $consultancy_firm_args['link_before'];
            $consultancy_firm_args['link_after'] = empty($consultancy_firm_args['link_after']) ? '' : $consultancy_firm_args['link_after'];

            $consultancy_firm_atts = array();
            $consultancy_firm_atts['href'] = get_permalink($page->ID);
            $consultancy_firm_atts['aria-current'] = ($page->ID === $current_page) ? 'page' : '';

            /** This filter is documented in wp-includes/class-walker-page.php */
            $consultancy_firm_atts = apply_filters('page_menu_link_attributes', $consultancy_firm_atts, $page, $consultancy_firm_depth, $consultancy_firm_args, $current_page);

            $consultancy_firm_attributes = '';
            foreach ($consultancy_firm_atts as $attr => $consultancy_firm_value) {
                if (!empty($consultancy_firm_value)) {
                    $consultancy_firm_value = ('href' === $attr) ? esc_url($consultancy_firm_value) : esc_attr($consultancy_firm_value);
                    $consultancy_firm_attributes .= ' ' . $attr . '="' . $consultancy_firm_value . '"';
                }
            }

            $consultancy_firm_args['list_item_before'] = '';
            $consultancy_firm_args['list_item_after'] = '';
            $consultancy_firm_args['icon_rennder'] = '';
            // Wrap the link in a div and append a sub menu toggle.
            if (isset($consultancy_firm_args['show_toggles']) && true === $consultancy_firm_args['show_toggles']) {
                // Wrap the menu item link contents in a div, used for positioning.
                $consultancy_firm_args['list_item_after'] = '';
            }


            // Add icons to menu items with children.
            if (isset($consultancy_firm_args['show_sub_menu_icons']) && true === $consultancy_firm_args['show_sub_menu_icons']) {
                if (isset($consultancy_firm_args['pages_with_children'][$page->ID])) {
                    $consultancy_firm_args['icon_rennder'] = '';
                }
            }

            // Add icons to menu items with children.
            if (isset($consultancy_firm_args['show_toggles']) && true === $consultancy_firm_args['show_toggles']) {
                if (isset($consultancy_firm_args['pages_with_children'][$page->ID])) {

                    $toggle_target_string = '.page_item.page-item-' . $page->ID . ' > .sub-menu';

                    $consultancy_firm_args['list_item_after'] = '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'consultancy-firm' ) . '</span>' . consultancy_firm_get_theme_svg( 'chevron-down' ) . '</span></button>';
                }
            }

            if (isset($consultancy_firm_args['show_toggles']) && true === $consultancy_firm_args['show_toggles']) {

                $consultancy_firm_output .= $consultancy_firm_indent . sprintf(
                        '<li%s>%s%s<a%s>%s%s%s</a>%s%s',
                        $consultancy_firm_css_classes,
                        '<div class="submenu-wrapper">',
                        $consultancy_firm_args['list_item_before'],
                        $consultancy_firm_attributes,
                        $consultancy_firm_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $consultancy_firm_args['link_after'],
                        $consultancy_firm_args['list_item_after'],
                        '</div>'
                    );

            }else{

                $consultancy_firm_output .= $consultancy_firm_indent . sprintf(
                        '<li%s>%s<a%s>%s%s%s%s</a>%s',
                        $consultancy_firm_css_classes,
                        $consultancy_firm_args['list_item_before'],
                        $consultancy_firm_attributes,
                        $consultancy_firm_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $consultancy_firm_args['icon_rennder'],
                        $consultancy_firm_args['link_after'],
                        $consultancy_firm_args['list_item_after']
                    );

            }

            if (!empty($consultancy_firm_args['show_date'])) {
                if ('modified' === $consultancy_firm_args['show_date']) {
                    $consultancy_firm_time = $page->post_modified;
                } else {
                    $consultancy_firm_time = $page->post_date;
                }

                $consultancy_firm_date_format = empty($consultancy_firm_args['date_format']) ? '' : $consultancy_firm_args['date_format'];
                $consultancy_firm_output .= ' ' . mysql2date($consultancy_firm_date_format, $consultancy_firm_time);
            }
        }
    }
}