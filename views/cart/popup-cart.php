<?php
$cart = WC()->cart->get_cart();

$total = get_all_quantity_item();
?>
<div class="block-cart-side">
    <div class="block-info">
        <div class="info">
            <div class="total"><?= $total ?></div>
            <div class="desc">
                Added to my cart!&nbsp;&nbsp;<b><?= $total ?> <?= esc_html__('items', 'storefront') ?></b>
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
                $thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $item['product_id'] ))
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
</div>