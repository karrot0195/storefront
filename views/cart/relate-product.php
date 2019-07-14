<?php
if (!isset($title)) {
    $title = '';
}

if (!isset($description)) {
    $description = '';
}
if (!isset($relate_product)) {
    $relate_product = [];
}

$term_ids = [];
if (!empty($relate_product)) {
    for ($i=0; $i<count($relate_product); $i++) {
        $terms = wp_get_post_terms($relate_product[$i], 'product_cat', ['field' => ['term_id']]);
        $ids = array_column($terms, 'slug');
        $term_ids = array_merge($term_ids, $ids);
    }
}

$query = new WC_Product_Query( [
    'category' => $term_ids,
    'exclude' => $relate_product
] );

$products = $query->get_products();
?>
<div class="related">
    <div class="container">
        <div class="related-wrapper">
            <div class="content-related">
                <div class="title"><?= $title ?></div>
                <div class="description">
                    <?= $description ?>
                </div>
            </div>
            <div class="image-related">
                <ul class="products columns-4">
                    <div class="loop-main-product related-slider">
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                $thumbnail_url = get_the_post_thumbnail_url($product->get_id());

                                ?>
                                <li class="wrap-product-item product type-product">
                                    <a href="<?= $product->get_permalink() ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <img src="<?= esc_url($thumbnail_url) ?>" alt="#">
                                        <h2 class="woocommerce-loop-product__title"><?= $product->get_title() ?></h2>
                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">SGD</span>45</span></span>
                                    </a>
                                    <div class="wrap-cart">
                                        <form class="increse-decrease fm-sl-cart proccessing" data-product_id="<?= $product->get_id() ?>">
                                            <div class="wrap-block wrap-init">
                                                <div class="lb-btn js-cart-btn" data-val="1" id="increase" value="Increase Value"><?= esc_html__('Add to cart', 'storefront') ?></div>

                                            </div>
                                            <div class="wrap-block wrap-proccess">
                                                <div class="value-button js-cart-btn" data-val="-1" id="decrease" value="Decrease Value">
                                                    <i class="icon ion-md-remove"></i>
                                                </div>
                                                <div class="block-number">
                                                    <div id="number"><div class="val">1</div></div>
                                                </div>
                                                <div class="value-button js-cart-btn" data-val="1" id="increase" value="Increase Value">
                                                    <i class="icon ion-md-add"></i>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
}
