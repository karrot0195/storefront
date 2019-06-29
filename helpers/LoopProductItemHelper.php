<?php

class LoopProductItemHelper {
    static function renderHtmlAddToCart($product) {
        $textButton = esc_html__('Add to cart', 'storefront');
        $productId = get_the_ID();
        $total = get_item_quantity($productId);
        return <<< HTML
    <div class="wrap-cart">
        <a href="javascript:void(0)" class="button product_type_simple">
            $textButton
        </a>
         <form class="increse-decrease fm-sl-cart" data-product_id="$productId">
          <div class="value-button js-cart-btn" data-val="-1" id="decrease" value="Decrease Value">-</div>
          <input type="number" id="number" name="number" value="$total" />
          <div class="value-button js-cart-btn" data-val="1" value="Increase Value">+</div>
        </form>
</div>
HTML;

    }
}