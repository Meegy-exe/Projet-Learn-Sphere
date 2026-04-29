<?php
/**
 * Custom Functions
 * @package Consultancy Firm
 * @since 1.0.0
 */

if( !function_exists('consultancy_firm_site_logo') ):

    /**
     * Logo & Description
     */
    /**
     * Displays the site logo, either text or image.
     *
     * @param array $consultancy_firm_args Arguments for displaying the site logo either as an image or text.
     * @param boolean $consultancy_firm_echo Echo or return the HTML.
     *
     * @return string $consultancy_firm_html Compiled HTML based on our arguments.
     */
    function consultancy_firm_site_logo( $consultancy_firm_args = array(), $consultancy_firm_echo = true ){
        $consultancy_firm_logo = get_custom_logo();
        $consultancy_firm_site_title = get_bloginfo('name');
        $consultancy_firm_contents = '';
        $consultancy_firm_classname = '';
        $consultancy_firm_defaults = array(
            'logo' => '%1$s<span class="screen-reader-text">%2$s</span>',
            'logo_class' => 'site-logo site-branding',
            'title' => '<a href="%1$s" class="custom-logo-name">%2$s</a>',
            'title_class' => 'site-title',
            'home_wrap' => '<h1 class="%1$s">%2$s</h1>',
            'single_wrap' => '<div class="%1$s">%2$s</div>',
            'condition' => (is_front_page() || is_home()) && !is_page(),
        );
        $consultancy_firm_args = wp_parse_args($consultancy_firm_args, $consultancy_firm_defaults);
        /**
         * Filters the arguments for `consultancy_firm_site_logo()`.
         *
         * @param array $consultancy_firm_args Parsed arguments.
         * @param array $consultancy_firm_defaults Function's default arguments.
         */
        $consultancy_firm_args = apply_filters('consultancy_firm_site_logo_args', $consultancy_firm_args, $consultancy_firm_defaults);
        
        $consultancy_firm_show_logo  = get_theme_mod('consultancy_firm_display_logo', false);
        $consultancy_firm_show_title = get_theme_mod('consultancy_firm_display_title', true);

        if ( has_custom_logo() && $consultancy_firm_show_logo ) {
            $consultancy_firm_contents .= sprintf($consultancy_firm_args['logo'], $consultancy_firm_logo, esc_html($consultancy_firm_site_title));
            $consultancy_firm_classname = $consultancy_firm_args['logo_class'];
        }

        if ( $consultancy_firm_show_title ) {
            $consultancy_firm_contents .= sprintf($consultancy_firm_args['title'], esc_url(get_home_url(null, '/')), esc_html($consultancy_firm_site_title));
            // If logo isn't shown, fallback to title class for wrapper.
            if ( !$consultancy_firm_show_logo ) {
                $consultancy_firm_classname = $consultancy_firm_args['title_class'];
            }
        }

        // If nothing is shown (logo or title both disabled), exit early
        if ( empty($consultancy_firm_contents) ) {
            return;
        }

        $consultancy_firm_wrap = $consultancy_firm_args['condition'] ? 'home_wrap' : 'single_wrap';
        // $consultancy_firm_wrap = 'home_wrap';
        $consultancy_firm_html = sprintf($consultancy_firm_args[$consultancy_firm_wrap], $consultancy_firm_classname, $consultancy_firm_contents);
        /**
         * Filters the arguments for `consultancy_firm_site_logo()`.
         *
         * @param string $consultancy_firm_html Compiled html based on our arguments.
         * @param array $consultancy_firm_args Parsed arguments.
         * @param string $consultancy_firm_classname Class name based on current view, home or single.
         * @param string $consultancy_firm_contents HTML for site title or logo.
         */
        $consultancy_firm_html = apply_filters('consultancy_firm_site_logo', $consultancy_firm_html, $consultancy_firm_args, $consultancy_firm_classname, $consultancy_firm_contents);
        if (!$consultancy_firm_echo) {
            return $consultancy_firm_html;
        }
        echo $consultancy_firm_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('consultancy_firm_site_description') ):

    /**
     * Displays the site description.
     *
     * @param boolean $consultancy_firm_echo Echo or return the html.
     *
     * @return string $consultancy_firm_html The HTML to display.
     */
    function consultancy_firm_site_description($consultancy_firm_echo = true){

        if ( get_theme_mod('consultancy_firm_display_header_text', false) == true ) :
        $consultancy_firm_description = get_bloginfo('description');
        if (!$consultancy_firm_description) {
            return;
        }
        $consultancy_firm_wrapper = '<div class="site-description"><span>%s</span></div><!-- .site-description -->';
        $consultancy_firm_html = sprintf($consultancy_firm_wrapper, esc_html($consultancy_firm_description));
        /**
         * Filters the html for the site description.
         *
         * @param string $consultancy_firm_html The HTML to display.
         * @param string $consultancy_firm_description Site description via `bloginfo()`.
         * @param string $consultancy_firm_wrapper The format used in case you want to reuse it in a `sprintf()`.
         * @since 1.0.0
         *
         */
        $consultancy_firm_html = apply_filters('consultancy_firm_site_description', $consultancy_firm_html, $consultancy_firm_description, $consultancy_firm_wrapper);
        if (!$consultancy_firm_echo) {
            return $consultancy_firm_html;
        }
        echo $consultancy_firm_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        endif;
    }

endif;

if( !function_exists('consultancy_firm_posted_on') ):

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function consultancy_firm_posted_on( $consultancy_firm_icon = true, $consultancy_firm_animation_class = '' ){

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        $consultancy_firm_post_date = absint( get_theme_mod( 'consultancy_firm_post_date',$consultancy_firm_default['consultancy_firm_post_date'] ) );

        if( $consultancy_firm_post_date ){

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf($time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $year = get_the_date('Y');
            $month = get_the_date('m');
            $day = get_the_date('d');
            $link = get_day_link($year, $month, $day);

            $posted_on = '<a href="' . esc_url($link) . '" rel="bookmark">' . $time_string . '</a>';

            echo '<div class="entry-meta-item entry-meta-date">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $consultancy_firm_animation_class ).'">';

            if( $consultancy_firm_icon ){

                echo '<span class="entry-meta-icon calendar-icon"> ';
                consultancy_firm_the_theme_svg('calendar');
                echo '</span>';

            }

            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;

if( !function_exists('consultancy_firm_posted_by') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function consultancy_firm_posted_by( $consultancy_firm_icon = true, $consultancy_firm_animation_class = '' ){   

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        $consultancy_firm_post_author = absint( get_theme_mod( 'consultancy_firm_post_author',$consultancy_firm_default['consultancy_firm_post_author'] ) );

        if( $consultancy_firm_post_author ){

            echo '<div class="entry-meta-item entry-meta-author">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $consultancy_firm_animation_class ).'">';

            if( $consultancy_firm_icon ){
            
                echo '<span class="entry-meta-icon author-icon"> ';
                consultancy_firm_the_theme_svg('user');
                echo '</span>';
                
            }

            $consultancy_firm_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';
            echo '<span class="byline"> ' . $consultancy_firm_byline . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;


if( !function_exists('consultancy_firm_posted_by_avatar') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function consultancy_firm_posted_by_avatar( $consultancy_firm_date = false ){

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        $consultancy_firm_post_author = absint( get_theme_mod( 'consultancy_firm_post_author',$consultancy_firm_default['consultancy_firm_post_author'] ) );

        if( $consultancy_firm_post_author ){



            echo '<div class="entry-meta-left">';
            echo '<div class="entry-meta-item entry-meta-avatar">';
            echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ) ) );
            echo '</div>';
            echo '</div>';

            echo '<div class="entry-meta-right">';

            $consultancy_firm_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';

            echo '<div class="entry-meta-item entry-meta-byline"> ' . $consultancy_firm_byline . '</div>';

            if( $consultancy_firm_date ){
                consultancy_firm_posted_on($consultancy_firm_icon = false);
            }
            echo '</div>';

        }

    }

endif;

if( !function_exists('consultancy_firm_entry_footer') ):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function consultancy_firm_entry_footer( $consultancy_firm_cats = true, $consultancy_firm_tags = true, $consultancy_firm_edits = true){   

        $consultancy_firm_default = consultancy_firm_get_default_theme_options();
        $consultancy_firm_post_category = absint( get_theme_mod( 'consultancy_firm_post_category',$consultancy_firm_default['consultancy_firm_post_category'] ) );
        $consultancy_firm_post_tags = absint( get_theme_mod( 'consultancy_firm_post_tags',$consultancy_firm_default['consultancy_firm_post_tags'] ) );

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            if( $consultancy_firm_cats && $consultancy_firm_post_category ){

                /* translators: used between list items, there is a space after the comma */
                $consultancy_firm_categories = get_the_category();
                if ($consultancy_firm_categories) {
                    echo '<div class="entry-meta-item entry-meta-categories">';
                    echo '<div class="entry-meta-wrapper">';
                
                    /* translators: 1: list of categories. */
                    echo '<span class="cat-links">';
                    foreach( $consultancy_firm_categories as $consultancy_firm_category ){

                        $consultancy_firm_cat_name = $consultancy_firm_category->name;
                        $consultancy_firm_cat_slug = $consultancy_firm_category->slug;
                        $consultancy_firm_cat_url = get_category_link( $consultancy_firm_category->term_id );
                        ?>

                        <a class="twp_cat_<?php echo esc_attr( $consultancy_firm_cat_slug ); ?>" href="<?php echo esc_url( $consultancy_firm_cat_url ); ?>" rel="category tag"><?php echo esc_html( $consultancy_firm_cat_name ); ?></a>

                    <?php }
                    echo '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';
                }

            }

            if( $consultancy_firm_tags && $consultancy_firm_post_tags ){
                /* translators: used between list items, there is a space after the comma */
                $consultancy_firm_tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'consultancy-firm'));
                if( $consultancy_firm_tags_list ){

                    echo '<div class="entry-meta-item entry-meta-tags">';
                    echo '<div class="entry-meta-wrapper">';

                    /* translators: 1: list of tags. */
                    echo '<span class="tags-links">';
                    echo wp_kses_post($consultancy_firm_tags_list) . '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';

                }

            }

            if( $consultancy_firm_edits ){

                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'consultancy-firm'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }

        }
    }

endif;


if ( ! function_exists( 'consultancy_firm_post_thumbnail' ) ) :

    /**
     * Displays an optional post thumbnail.
     *
     * Shows background style image with height class on archive/search/front,
     * and a normal inline image on single post/page views.
     */
    function consultancy_firm_post_thumbnail( $consultancy_firm_image_size = 'full' ) {

        if ( post_password_required() || is_attachment() ) {
            return;
        }

        // Fallback image path
        $consultancy_firm_default_image = get_template_directory_uri() . '/assets/images/slider-img1.png';

        // Image size → height class map
        $consultancy_firm_size_class_map = array(
            'full'      => 'data-bg-large',
            'large'     => 'data-bg-big',
            'medium'    => 'data-bg-medium',
            'small'     => 'data-bg-small',
            'xsmall'    => 'data-bg-xsmall',
            'thumbnail' => 'data-bg-thumbnail',
        );

        $consultancy_firm_class = isset( $consultancy_firm_size_class_map[ $consultancy_firm_image_size ] )
            ? $consultancy_firm_size_class_map[ $consultancy_firm_image_size ]
            : 'data-bg-medium';

        if ( is_singular() ) {
            the_post_thumbnail();
        } else {
            // 🔵 On archives → use background image style
            $consultancy_firm_image = has_post_thumbnail()
                ? wp_get_attachment_image_src( get_post_thumbnail_id(), $consultancy_firm_image_size )
                : array( $consultancy_firm_default_image );

            $consultancy_firm_bg_image = isset( $consultancy_firm_image[0] ) ? $consultancy_firm_image[0] : $consultancy_firm_default_image;
            ?>
            <div class="post-thumbnail data-bg <?php echo esc_attr( $consultancy_firm_class ); ?>"
                 data-background="<?php echo esc_url( $consultancy_firm_bg_image ); ?>">
                <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
            </div>
            <?php
        }
    }

endif;


if( !function_exists('consultancy_firm_is_comment_by_post_author') ):

    /**
     * Comments
     */
    /**
     * Check if the specified comment is written by the author of the post commented on.
     *
     * @param object $comment Comment data.
     *
     * @return bool
     */
    function consultancy_firm_is_comment_by_post_author($comment = null){

        if (is_object($comment) && $comment->user_id > 0) {
            $user = get_userdata($comment->user_id);
            $post = get_post($comment->comment_post_ID);
            if (!empty($user) && !empty($post)) {
                return $comment->user_id === $post->post_author;
            }
        }
        return false;
    }

endif;

if( !function_exists('consultancy_firm_breadcrumb') ) :

    /**
     * Consultancy Firm Breadcrumb
     */
    function consultancy_firm_breadcrumb($comment = null){

        echo '<div class="entry-breadcrumb">';
        consultancy_firm_breadcrumb_trail();
        echo '</div>';

    }

endif;
