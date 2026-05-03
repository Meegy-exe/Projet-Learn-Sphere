<?php
/**
 * Header file for the Consultancy Firm WordPress theme.
 * @package Consultancy Firm
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<?php if( get_theme_mod('consultancy_firm_theme_loader',false) == 1 ) { ?>
    <div class="preloader">
      <div class="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  <?php }?>
<head>  
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
}
$consultancy_firm_default = consultancy_firm_get_default_theme_options(); ?>

<div id="consultancy-firm-page" class="consultancy-firm-hfeed consultancy-firm-site">
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e('Skip to the content', 'consultancy-firm'); ?></a>

<?php
    get_template_part( 'template-parts/header/header', 'layout' );
?>

<div id="content" class="site-content">