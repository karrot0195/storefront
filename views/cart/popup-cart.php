<?php
$cart = WC()->cart->get_cart();
$total = get_all_quantity_item();
$sub_price = 0;
?>
<div class="block-cart-side">
    <div class="block-info">
        <div class="info">
            <div class="total"><?= $total ?></div>
            <div class="desc">
                <?= esc_html__('Added to my cart!', 'storefront') ?>&nbsp;&nbsp;<b><?= $total ?> <?= esc_html__('items', 'storefront') ?></b>
            </div>
        </div>
        <div class="close">
            <i class="icon ion-md-close"></i>
        </div>
    </div>

    <div class="block-main">
        <?php
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product = $item['data'];
                $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $item['product_id'] ));
                $sub_price += $item['line_total'];
                ?>
                <div class="block-item">
                    <div class="thumbnail-item">
                        <img src="<?= esc_url($thumbnail_url) ?>">
                    </div>
                    <div class="info-item">
                        <div class="item-name">
                            <?= $product->get_title() ?>
                        </div>
                        <div class="item-qty">
                            <?= esc_html__('Qty:', 'storefront') ?> <b><?= $item['quantity'] ?></b>
                        </div>
                    </div>

                    <div class="price-item">
                        <?= wc_price($item['line_total']) ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <div class="block-action">
        <div class="block-subinfo">
            <div class="block-subinfo--content"><?= esc_html__('Subtotal:', 'storefront') ?></div>
            <div class="block-subinfo--price"><?= wc_price($sub_price) ?></div>
        </div>

        <div class="block-checkoutbutton">
            <a href="<?= home_url('checkout') ?>" class="btn btn-checkout"><span class="checkout"><?= esc_html__('Checkout', 'storefront') ?></span><i class="ion ion-ios-arrow-forward"></i></a>
        </div>
    </div>
</div>
<div class="background"></div>
