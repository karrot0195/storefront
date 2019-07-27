<?php 

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

add_action('wp_ajax_action_book_mark', 'action_book_mark');
add_action('wp_ajax_nopriv_action_book_mark', 'action_book_mark');

function action_book_mark() {
    $bookmark = get_user_bookmark();
    $post_id = $_GET['post_id'];
    $type = 0;

   if (is_user_logged_in()) {
        if (in_array($post_id, $bookmark)) {
            $type = -1;
            $bookmark = array_filter($bookmark, function ($i) use ($post_id) {
                if ($i != $post_id) {
                    return true;
                }

                return false;
            });

        } else {
            $type = 1;
            $bookmark[] = $post_id;
        }
        update_user_meta(get_current_user_id(), 'bookmark', $bookmark);
   }
    echo $type;
    die;
}



function ajax_set_item_from_cart() {
    $cart = WC()->instance()->cart;
    $result = [
        'success' => false
    ];
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    $prod_unique_id = $cart->generate_cart_id( $product_id );
    if (empty($quantity)) {
        $r = $cart->remove_cart_item($prod_unique_id);
    } else {
        unset( $cart->cart_contents[$prod_unique_id] );
        $r = $cart->add_to_cart( $product_id, $quantity );
    }

    if (!empty($r)) {
        $result['success'] = true;
    }

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

add_action('wp_ajax_get_html_popup_cart', 'get_html_popup_cart');
add_action('wp_ajax_nopriv_get_html_popup_cart', 'get_html_popup_cart');

function get_html_popup_cart($is_html=false) {
    if ($is_html) {
        return render_php('views/cart/popup-cart.php');
    }

    echo render_php('views/cart/popup-cart.php');
    exit();
}


add_action('wp_ajax_action_create_account', 'action_create_account');
add_action('wp_ajax_nopriv_action_create_account', 'action_create_account');

function action_create_account() {
    $result = [
        'error' => true,
        'message' => ''
    ];
    $username = $email = $_POST['email'];
    $password = $_POST['password'];
    $user = wp_create_user( $username, $password, $email);
    if( is_wp_error( $user ) ) {
        $result['message'] = $user->get_error_message()
;    } else {
        login($user);
        $result['error'] = false;
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}

add_action('wp_ajax_action_forgot_password', 'action_forgot_password');
add_action('wp_ajax_nopriv_action_forgot_password', 'action_forgot_password');

function action_forgot_password() {
    $result = [
        'error' => true,
        'message' => ''
    ];
    $email = $_POST['email'];
    $user = get_user_by_email($email);
    if ($user) {
        $pass = generateRandomString();
        $to = $email;
        $subject = 'DERMA SYSTEM';
        $body = 'Password current: '. $pass;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );
        wp_set_password($pass, $user->ID);
        $result['error'] = false;
    } else {
        $result['message'] = 'User is not exists';
    }
    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}
// end ajax
