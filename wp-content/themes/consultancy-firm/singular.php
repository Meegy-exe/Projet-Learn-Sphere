<?php
/**
 * The template for displaying single posts and pages.
 * @package Consultancy Firm
 * @since 1.0.0
 */

get_header();

$consultancy_firm_default = consultancy_firm_get_default_theme_options();
$consultancy_firm_global_layout = get_theme_mod('consultancy_firm_global_sidebar_layout', $consultancy_firm_default['consultancy_firm_global_sidebar_layout']);
$consultancy_firm_page_layout = get_theme_mod('consultancy_firm_page_sidebar_layout', $consultancy_firm_global_layout);
$consultancy_firm_post_layout = get_theme_mod('consultancy_firm_post_sidebar_layout', $consultancy_firm_global_layout);
$consultancy_firm_post_meta = get_post_meta(get_the_ID(), 'consultancy_firm_post_sidebar_option', true);

$consultancy_firm_final_layout = $consultancy_firm_global_layout;
if (!empty($consultancy_firm_post_meta) && $consultancy_firm_post_meta !== 'default') {
    $consultancy_firm_final_layout = $consultancy_firm_post_meta;
} elseif (is_page() || (function_exists('is_shop') && is_shop())) {
    $consultancy_firm_final_layout = $consultancy_firm_page_layout;
} elseif (is_single()) {
    $consultancy_firm_final_layout = $consultancy_firm_post_layout;
}

// Set content column order based on sidebar layout
$consultancy_firm_sidebar_column_class = 'column-order-1';
if ($consultancy_firm_final_layout === 'left-sidebar') {
    $consultancy_firm_sidebar_column_class = 'column-order-2';
}

?>

<div id="single-page" class="singular-main-block">
    <div class="wrapper">
        <div class="column-row <?php echo esc_attr($consultancy_firm_final_layout === 'no-sidebar' ? 'no-sidebar-layout' : ''); ?>">

            <?php if ($consultancy_firm_final_layout === 'left-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <div id="primary" class="content-area <?php echo esc_attr($consultancy_firm_final_layout === 'no-sidebar' ? 'full-width-content' : $consultancy_firm_sidebar_column_class); ?>">
                <main id="site-content" role="main">

                    <?php
                    consultancy_firm_breadcrumb(); // Display breadcrumb

                    if (have_posts()) : ?>

                        <div class="article-wraper">
                            <?php while (have_posts()) : the_post(); ?>

                                <?php get_template_part('template-parts/content', 'single'); ?>

                                <?php if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) : ?>
                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>

                        <?php get_template_part('template-parts/content', 'none'); ?>

                    <?php endif;

                    do_action('consultancy_firm_navigation_action');
                    ?>

                </main>
            </div>

            <?php if ($consultancy_firm_final_layout === 'right-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>