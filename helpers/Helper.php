<?php
function render_php($path,$args=[]){
    extract($args);
    ob_start();
    include(PATH_THEME . '/' . $path);
    $var=ob_get_contents();
    ob_end_clean();
    return $var;
}


function login($user_id) {
	wp_clear_auth_cookie();
    wp_set_current_user ( $user_id );
    wp_set_auth_cookie( $user_id );
}

function get_user_bookmark() {
	$bookmark = [];
	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$bookmark = get_user_meta($user_id, 'bookmark', true);
	    if (empty($bookmark)) {
	    	$bookmark = [];
	    }
	}
    return $bookmark;
}

function get_products_by_bookmark() {
    $bookmark_ids = get_user_bookmark();
    if (empty($bookmark_ids)) {
        return [];
    }
    $query = new WC_Product_Query( [
        'include' => $bookmark_ids
    ] );
    $products = $query->get_products();
    return $products;
}

function get_class_the_bookmark() {
	$post_id = get_the_ID();
	$bookmark = get_user_bookmark();
	if (in_array($post_id, $bookmark)) {
		return 'bookmark';
	}

	return '';
}

function get_method($a) {
	dd(get_class_methods($a), false);
}

function get_quality_product_cart($product_id) {
	$quality = 0;
	if (!empty($product_id)) {
		$cart = WC()->instance()->cart;

		if (!empty($cart)) {
			foreach ($cart->cart_contents as $item) {
				if ($item['product_id'] == $product_id) {
					return $item['quantity'];
				}
			}
		}
	}
	return $quality;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}