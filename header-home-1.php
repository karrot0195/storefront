<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <script>
        const home_url = "<?= home_url() ?>";
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>
<?php
$class = [];
$action = 'storefront_header_full_home_1';
if (is_page_template('templates/template-home1.php')) {
    $class[] = 'one-page';
    $action = 'storefront_header_home_1';
}
?>
<div id="page" class="hfeed site home-page-1 <?= implode(' ', $class) ?>">
    <header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
        <div class="container">
            <div class="col-full">
                <?php
                do_action( $action );
                ?>
            </div>
        </div>
    </header><!-- #masthead -->
    <?php
    /**
     * Functions hooked in to storefront_before_content
     *
     * @hooked storefront_header_widget_region - 10
     * @hooked woocommerce_breadcrumb - 10
     */
    ?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="block-content">

<?php
//do_action( 'storefront_content_top' );
