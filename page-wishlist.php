<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */
$products = get_products_by_bookmark();
get_header('home-1'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main page-wishlist" role="main">
            <div class="container">
            <ul class="products columns-4">
                <div class="loop-main-product">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            $thumbnail_url = get_the_post_thumbnail_url($product->get_id());
                        ?>
                            <li class="wrap-product-item product type-product">
                                <i class="ion ion-md-close-circle icon-close"></i>
                                <a href="<?= esc_url($product->get_permalink()) ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                    <img src="<?= esc_url($thumbnail_url) ?>" alt="#">
                                    <h2 class="woocommerce-loop-product__title">
                                        <?= $product->get_title() ?>
                                    </h2>
                                    <span class="price">
                                        <?= wc_price($product->get_price()) ?>

                                    </span>
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
                                <div class="stock">
                                    <div class="wrapper">
                                        <span><i class="ion ion-ios-information-circle"></i></span>
                                        <span class="text"><?= esc_html__('Low in stock', 'storefornt') ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                    }
                    ?>

                </div>
            </ul>
            <?php

            echo render_php('views/cart/relate-product.php', [
                'title' => get_field('title'),
                'description' => get_field('description'),
                'relate_product' => get_user_bookmark()
            ]);
            ?>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
