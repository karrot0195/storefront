<?php 

global $product;
$attributes = $product->get_variation_attributes();
$available_variations = $product->get_available_variations();
$selected = $product->get_default_attributes();

$collect_price = [];
if (!empty($available_variations)) {
	foreach ($available_variations as $item) {
		if (isset($item['attributes']['attribute_pa_size'])) {
			$collect_price[$item['attributes']['attribute_pa_size']] = $item['display_price'];
		}
	}
}

$attr_size_selected = isset($selected['pa_size']) ? $selected['pa_size'] : '';

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

$size_attribute_data = wc_get_product_terms(get_the_ID(), 'pa_size');
if (!empty($size_attribute_data)) {
	echo '<div class="wrap-attribute-size">';
	echo '<div class="block-label">'.esc_html__('Size', 'storefront').'</div>';
	echo '<ul class="block-main">';
	foreach ($size_attribute_data as $size_item) {
		$data = [
			'price' => isset($collect_price[$size_item->slug]) ? $collect_price[$size_item->slug] : ''
		];
		$is_checked = $attr_size_selected == $size_item->slug ? 'checked="checked"' : '';
		echo '<li>';		
			echo '<input name="attr_size" id="'.$size_item->slug.'" type="radio" ' .$is_checked. '/>';
			echo '<label class="js-select-size" for="'.$size_item->slug.'" data-json=\''.json_encode($data).'\'>'
					.$size_item->name 
				. '</label>';
		echo '</li>';		
	}
	echo '</ul>';
	echo '</div>';
}

?>

<style type="text/css">

	.wrap-attribute-size {
		display: flex;
	}
	
	.wrap-attribute-size .block-label {
		font-weight: 600;
	}


	.wrap-attribute-size .block-main input {
		display: none;
	}
	

	.wrap-attribute-size .block-main {
		list-style: none;
		margin: 0;
		padding: 0 10px;
	}

	.wrap-attribute-size .block-main li {
		display: inline;
		margin-right: 5px;
	}

	.wrap-attribute-size .block-main input + label {
		border: 2px solid #e8e8e8;
	    min-width: 60px;
	    padding: 5px 10px;
	    font-size: 13px;
	    color: #2a2a2a;
	}

	.wrap-attribute-size .block-main input:checked + label {
		border-color: #333333;
	}

</style>

<script type="text/javascript">
	(function($){
		$('.js-select-size').on('click', function () {
			const json = $(this).data('json');
			const pre_html = $('.woocommerce-Price-amount .woocommerce-Price-currencySymbol').html();

			$('.woocommerce-Price-amount').html(`<span class="woocommerce-Price-currencySymbol">${pre_html}</<span></span>`);
			$('.woocommerce-Price-amount').append(json.price);

		});
	})(jQuery);
</script>