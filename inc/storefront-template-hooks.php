<?php
/**
 * Storefront hooks
 *
 * @package storefront
 */

/**
 * General
 *
 * @see  storefront_header_widget_region()
 * @see  storefront_get_sidebar()
 */
add_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
add_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );

/**
 * Header
 *
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */
add_action( 'storefront_header', 'storefront_header_container', 0 );
add_action( 'storefront_header', 'storefront_skip_links', 5 );
add_action( 'storefront_header', 'storefront_site_branding', 20 );
add_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
add_action( 'storefront_header', 'storefront_header_container_close', 41 );
add_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
add_action( 'storefront_header', 'storefront_primary_navigation', 50 );
add_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );


/**
 * hook header home 1
 */
add_action( 'storefront_header_full_home_1', 'storefront_site_branding', 20 );
add_action( 'storefront_header_full_home_1', 'storefront_slider_header', 30 );
add_action( 'storefront_header_full_home_1', 'storefront_site_action', 40 );

add_action( 'storefront_header_home_1', 'storefront_site_branding', 20 );
add_action( 'storefront_header_home_1', 'storefront_site_action', 40 );

/**
 * Footer
 *
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */
add_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
add_action( 'storefront_footer', 'storefront_credit', 20 );


/**
 * Footer home 1
 */

add_action( 'storefront_footer_home_1', 'storefront_footer_widgets', 10 );

/**
 * Homepage
 *
 * @see  storefront_homepage_content()
 */
add_action( 'homepage', 'storefront_homepage_content', 10 );

/**
 * Posts
 *
 * @see  storefront_post_header()
 * @see  storefront_post_meta()
 * @see  storefront_post_content()
 * @see  storefront_paging_nav()
 * @see  storefront_single_post_header()
 * @see  storefront_post_nav()
 * @see  storefront_display_comments()
 */
add_action( 'storefront_loop_post', 'storefront_post_header', 10 );
add_action( 'storefront_loop_post', 'storefront_post_content', 30 );
add_action( 'storefront_loop_post', 'storefront_post_taxonomy', 40 );
add_action( 'storefront_loop_after', 'storefront_paging_nav', 10 );
add_action( 'storefront_single_post', 'storefront_post_header', 10 );
add_action( 'storefront_single_post', 'storefront_post_content', 30 );
add_action( 'storefront_single_post_bottom', 'storefront_edit_post_link', 5 );
add_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
add_action( 'storefront_single_post_bottom', 'storefront_post_nav', 10 );
add_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20 );
add_action( 'storefront_post_header_before', 'storefront_post_meta', 10 );
add_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10 );

/**
 * Pages
 *
 * @see  storefront_page_header()
 * @see  storefront_page_content()
 * @see  storefront_display_comments()
 */
add_action( 'storefront_page', 'storefront_page_header', 10 );
add_action( 'storefront_page', 'storefront_page_content', 20 );
add_action( 'storefront_page', 'storefront_edit_post_link', 30 );
add_action( 'storefront_page_after', 'storefront_display_comments', 10 );

/**
 * Homepage Page Template
 *
 * @see  storefront_homepage_header()
 * @see  storefront_page_content()
 */
add_action( 'storefront_homepage', 'storefront_homepage_header', 10 );
add_action( 'storefront_homepage', 'storefront_page_content', 20 );


// Custom
add_action( 'widgets_init', function(){
    register_widget( 'PageWidget' );
});

/**
 *
 */
add_filter('body_class', function($classes) {
    if (is_post_type_archive('product')) {
        $classes[] = 'storefront-archive-product';
    }

    if (is_home()) {
        $classes[] = 'storefront-home';
    }

    if (is_product()) {
        $classes[] = 'storefront-product-detail';
    }
    return $classes;
});

add_action('upload_mimes', function($mimes = array()) {
    $mimes['svg'] = "text/svg";
    return $mimes;
});

add_filter( 'woocommerce_currency_symbol', 'woocommerce_currency_symbol_sgd', 1001, 2 );
function woocommerce_currency_symbol_sgd( $currency_symbol, $currency ) {
    if ($currency == 'SGD') {
        $currency_symbol = 'SGD';
    }
    return $currency_symbol;
}

function get_item_quantity($targeted_id) {
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        if($cart_item['product_id'] == $targeted_id ){
            return $cart_item['quantity'];
        }
    }
    return 0;
}

function get_all_quantity_item() {
    $total = 0;
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        if (!empty($cart_item['quantity'])) {
            $total += intval($cart_item['quantity']);
        }
    }
    return $total;
}

add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_ans')) {
	function loop_columns() {
	    $default = 4;
		return $default; // 3 products per row
	}
}

add_action('init', function() {
    if (preg_match('/\/login\//', $_SERVER['REQUEST_URI']) && is_user_logged_in()) {
        wp_safe_redirect(home_url('my-account'));
        exit();
    }

    if (preg_match('/\/my-account\//', $_SERVER['REQUEST_URI']) && !is_user_logged_in()) {
        wp_safe_redirect(home_url());
        exit();
    }
});


// add size to product detail
add_action('woocommerce_single_product_summary', function () {
    global $product;
    if ($product->is_type('variable')) {
        echo render_php('views/product-detail/attr-size.php');
    }
}, 15);



// custom action checkout page
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_shipping', 'woocommerce_checkout_payment', 20 );


// theme setting
if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}