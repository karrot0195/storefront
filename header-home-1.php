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
                <div class="menu-desktop">
                    <?php
                        do_action( $action );
                    ?>
                </div>
                <div class="hamburger-menu">
                    <div class="bar"></div>
                </div>
                <div class="menu-mobile">
                    <?php
                        do_action( $action );
                    ?>
                </div>
            </div>
        </div>
    </header><!-- #masthead -->

    <!--    Product search-->

    <div class="wrap-search-product <?= isset($_GET['action']) && $_GET['action'] == 'search' ? 'show' : '' ?>">
        <span class="close"><i class="icon ion-md-close"></i></span>
        <div class="block-search">
            <input type="text" class="js-input-search" name="search" autocomplete="false">
        </div>

        <div class="block-content">
            <div class="block-content--main">
                <?php
                $products = getProductByText();
                if (!empty($products)):
                foreach ($products as $product): ?>
                    <div class="wrap-item">
                        <div class="block-thumbnail">
                            <a href="<?= esc_url($product['permalink']) ?>">
                                <img width="100%" src="<?= esc_url($product['thumbnail_url']) ?>" alt="<?= esc_attr($product['title']) ?>">
                            </a>
                        </div>
                        <div class="block-title">
                            <a href="<?= esc_url($product['permalink']) ?>"><?= esc_html($product['title']) ?></a>
                        </div>
                    </div>
                <?php
                endforeach;
                endif;
                ?>
            </div>
            <div class="block-content--action">
                <a href="#" class="js-btn-search"><?= esc_html('View all products', 'storefront') ?></a>
            </div>
        </div>
    </div>
    <!--  end  -->

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
