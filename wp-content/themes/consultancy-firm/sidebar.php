<?php
$consultancy_firm_layout = consultancy_firm_get_final_sidebar_layout();
$consultancy_firm_sidebar_class = 'column-order-1';

if ( $consultancy_firm_layout === 'left-sidebar' ) {
    $consultancy_firm_sidebar_class = 'column-order-1';
} elseif ( $consultancy_firm_layout === 'right-sidebar' ) {
    $consultancy_firm_sidebar_class = 'column-order-2';
}

if ( $consultancy_firm_layout !== 'no-sidebar' ) : ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $consultancy_firm_sidebar_class ); ?>">
        <div class="widget-area-wrapper">
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php else : ?>
                <!-- Default widgets -->
                <div class="widget widget_block widget_search">
                    <h3 class="widget-title"><?php esc_html_e('Search', 'consultancy-firm'); ?></h3>
                    <?php get_search_form(); ?>
                </div>

                <div class="widget widget_pages">
                    <h3 class="widget-title"><?php esc_html_e('Pages', 'consultancy-firm'); ?></h3>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>
                
                <div class="widget widget_archive">
                    <h3 class="widget-title"><?php esc_html_e('Archives', 'consultancy-firm'); ?></h3>
                    <ul>
                        <?php wp_get_archives(['type' => 'monthly', 'show_post_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_categories">
                    <h3 class="widget-title"><?php esc_html_e('Categories', 'consultancy-firm'); ?></h3>
                    <ul class="wp-block-categories-list wp-block-categories">
                        <?php wp_list_categories(['orderby' => 'name', 'title_li' => '', 'show_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_tag_cloud">
                    <h3 class="widget-title"><?php esc_html_e('Tags', 'consultancy-firm'); ?></h3>
                    <?php
                    $consultancy_firm_tags = get_tags();
                    if ( $consultancy_firm_tags ) {
                        echo '<div class="tagcloud">';
                        foreach ( $consultancy_firm_tags as $consultancy_firm_tag ) {
                            $consultancy_firm_link = get_tag_link($consultancy_firm_tag->term_id);
                            echo '<a href="' . esc_url($consultancy_firm_link) . '" class="tag-cloud-link">' . esc_html($consultancy_firm_tag->name) . '</a> ';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>' . esc_html__('No tags found.', 'consultancy-firm') . '</p>';
                    }
                    ?>
                </div>

            <?php endif; ?>
        </div>
    </aside>
<?php endif; ?>
