<?php
/**
 * The template for displaying the footer
 * @package Consultancy Firm
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked consultancy_firm_content_offcanvas - 30
*/

do_action('consultancy_firm_before_footer_content_action'); ?>

</div>

<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked consultancy_firm_footer_content_widget - 10
     * @hooked consultancy_firm_footer_content_info - 20
    */

    do_action('consultancy_firm_footer_content_action'); ?>

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>