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

// AJAX
function my_enqueue() {
    wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/assets/js/ajax-gobal.js', array('jquery') );
    wp_localize_script( 'ajax-script', 'my_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'my_enqueue' );

// ajax wc set cart
add_action('wp_ajax_set_item_from_cart', 'ajax_set_item_from_cart');
add_action('wp_ajax_nopriv_set_item_from_cart', 'ajax_set_item_from_cart');

// ajax get product by text
add_action('wp_ajax_search_product', 'ajax_search_product');
add_action('wp_ajax_nopriv_search_product', 'ajax_search_product');

// ajax storefront_filter_product
add_action('wp_ajax_storefront_filter_product', 'storefront_filter_product');
add_action('wp_ajax_nopriv_storefront_filter_product', 'storefront_filter_product');

function ajax_set_item_from_cart() {
    $cart = WC()->instance()->cart;
    $result = [
        'success' => false
    ];
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);


    $prod_unique_id = $cart->generate_cart_id( $product_id );

    if (empty($quantity)) {
        $cart->remove_cart_item($prod_unique_id);
    } else {
        unset( $cart->cart_contents[$prod_unique_id] );
        $cart->add_to_cart( $product_id, $quantity );
    }

    $result['success'] = true;
    $result['total'] = get_all_quantity_item();

    header('Content-Type: application/json');
    echo json_encode($result);
    die;
}

function ajax_search_product() {
    try {
        $result = [
            'success' => false,
            'data' => [],
            'html' => ''
        ];

        $text = isset($_POST['text']) ? $_POST['text'] : '';
        $result['data'] = getProductByText($text);
        if (!empty($result['data'])) {
            foreach ($result['data'] as $item) {
                $thumbnail_url = esc_url($item['thumbnail_url']);
                $permalink = esc_url($item['permalink']);
                $title = esc_html($item['title']);
                $result['html'] .= <<<HTML
  <div class="wrap-item">
                        <div class="block-thumbnail">
                            <a href="$permalink">
                                <img width="100%" src="$thumbnail_url" alt="$title">
                            </a>
                        </div>
                        <div class="block-title">
                            <a href="$permalink">$title</a>
                        </div>
                    </div>
HTML;

            }
        }
        $result['success'] = true;
    } catch (Exception $e) {}
    header('Content-Type: application/json');
    echo json_encode($result);
    die;
}

function getProductByText($text='', $number=4) {
    $arr = [];
    $posts = get_posts([
        'post_type' => 'product',
        'numberposts' =>  -1
    ]);
    $idx = 0;
    while($idx < count($posts) && count($arr) < $number) {
        $row = [];
        $isCheck = false;

        if (!empty($text)) {
            $t1 = convert_text_2_key($text);
            $title = convert_text_2_key($posts[$idx]->post_title);
            preg_match('/'.$t1.'/', $title, $matches);
            if (!empty($matches)) {
                $isCheck = true;
            }
        } else {
            $isCheck = true;
        }
        if ($isCheck) {
            $row['ID'] = $posts[$idx]->ID;
            $row['title'] = $posts[$idx]->post_title;
            $row['permalink'] = get_permalink($posts[$idx]->ID);
            $row['thumbnail_url'] = get_the_post_thumbnail_url($posts[$idx]->ID);
            $arr[] = $row;
        }

        $idx ++;
    }

    return $arr;
}

function storefront_filter_product() {
    global $wp_query;
    $cats = $_GET['cat'];
    $limit = isset($_GET['limit']) && !empty($_GET['limit']) ? intval($_GET['limit']) : -1;

    $query_tax = [];
    if (!empty($cats)) {
        foreach ($cats as $cat_id => $cat_sub) {
            $term_ids = [];
            if (!empty($cat_sub)) {
                $term_ids = [$cat_sub];
            } else {
                $terms = get_terms('product_cat', [
                    'hide_empty' => false,
                    'parent' => $cat_id
                ]);

                if (!empty($terms)) {
                    foreach ($terms as $term) {
                        $term_ids[] = $term->term_id;
                    }
                }

            }
            $query_tax [] = [
                'taxonomy' => 'product_cat',
                'terms' => $term_ids,
                'operator' => 'IN'
            ];
        }
    }

    $wp_query = new WP_Query([
        'post_type' => 'product',
        'tax_query' => array_merge(['relation' => 'OR'], $query_tax),
        'posts_per_page' => $limit
    ]);

    while ( have_posts() ) {
        the_post();

        /**
         * Hook: woocommerce_shop_loop.
         *
         * @hooked WC_Structured_Data::generate_product_data() - 10
         */
        do_action( 'woocommerce_shop_loop' );
        wc_get_template_part( 'content', 'product' );
    }
    die;
}
// end ajax