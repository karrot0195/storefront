<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<table class="woocommerce-product-attributes shop_attributes">
	<?php 
	if (isset($product_attributes['attribute_ingredient'])) {
		$arr = explode(',', $product_attributes['attribute_ingredient']['value']);
		for ($i=0; $i<count($arr); $i++) {
			?>
<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item">
	<td class="woocommerce-product-attributes-item__value">
   			<i class="icon ion-md-checkmark-circle-outline" style="display: inline"></i>
    		<?= $arr[$i] ?>
	</td>
</tr>
			<?php
		}
	}
	?>
</table>
