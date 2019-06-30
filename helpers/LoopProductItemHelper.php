<?php

class LoopProductItemHelper {
    static function renderHtmlAddToCart($product) {
        $textButton = esc_html__('Add to cart', 'storefront');
        $productId = get_the_ID();
        $total = get_item_quantity($productId);
        $class = $total > 0 ? 'proccessing' : '';
        return <<< HTML
    <div class="wrap-cart">
         <form class="increse-decrease fm-sl-cart $class" data-product_id="$productId">
            <div class="wrap-block wrap-init">
              <div class="lb-btn">Add to cart</div>
              <div class="value-button js-cart-btn" data-val="1" id="increase" value="Increase Value">
                    <i class="icon ion-md-add"></i>  
                </div>
            </div>
            <div class="wrap-block wrap-proccess">
                 <div class="value-button js-cart-btn" data-val="-1" id="decrease" value="Decrease Value">
                     <i class="icon ion-md-remove"></i> 
                </div>
                <div class="block-number">
                    <div id="number"><div class="val">$total</div></div>
                </div>
                <div class="value-button js-cart-btn" data-val="1" id="increase" value="Increase Value">
                    <i class="icon ion-md-add"></i>  
                </div>
            </div>
        </form>
</div>
HTML;

    }

    static function renderHtmlAddToCartDetail($product) {
        $textButton = esc_html__('Add to cart', 'storefront');
        $productId = get_the_ID();
        $total = get_item_quantity($productId);
        $class = $total > 0 ? 'proccessing' : '';
        return <<< HTML
    <div class="wrap-cart">
         <form class="increse-decrease fm-detail-cart $class" data-product_id="$productId">
            <div class="wrap-block wrap-proccess">
                 <div class="value-button js-detail-cart-btn" data-val="-1" id="decrease" value="Decrease Value">
                     <i class="icon ion-md-remove"></i> 
                </div>
                <div class="block-number">
                    <div id="number"><div class="val">$total</div></div>
                </div>
                <div class="value-button js-detail-cart-btn" data-val="1" id="increase" value="Increase Value">
                    <i class="icon ion-md-add"></i>  
                </div>
              <a class="btn-add-to-cart js-btn-add-to-cart">Add to cart</a>
            </div>
        </form>
</div>
HTML;

    }
}