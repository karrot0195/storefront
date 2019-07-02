<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'home-1' );
?>
    <?php ArchiveShopHelper::renderBanner() ?>
	<section class="info-page">
		<div class="container">
			<div class="wrapper-page">
				<div class="info-page-child">
					<div class="info-page-left">
						<a href="#"><?= esc_html__('View Products', 'storefront') ?></a>
						<ul class="list-filter">
							<li><a href="#">ALL</a></li>
							<li><a href="#">8</a></li>
							<li><a href="#">16</a></li>
							<li><a href="#">24</a></li>
						</ul>
					</div>
					<div class="info-page-right">
						<button class="btn-filter"><?= esc_html__('FILTER', 'storefront') ?></button>
					</div>
				</div>
				<div class="modal-filter">
					<div class="modal-heading">
						<span href="#" class="logo"></span>
						<span class="button-close">
							<i class="ion ion-ios-close"></i>
						</span>
					</div>
					<div class="modal-content">
						<div class="block-content">
							<div class="content content-1">
								<h5 class="title">Skin Type</h5>
								<ul>
									<li class="is-selected"><button>All Types</button></li>
									<li><button>Dry</button></li>
									<li><button>Normal</button></li>
									<li><button>Combination</button></li>
									<li><button>Oily</button></li>
								</ul>
							</div>
							<div class="content content-2">
								<h5 class="title">Skin Concern</h5>
								<ul>
									<li class="is-selected"><button>All Concerns</button></li>
									<li><button>Dehydrated</button></li>
									<li><button>Mature</button></li>
									<li><button>Blemished</button></li>
								</ul>
							</div>
							<div class="content content-3">
								<h5 class="title">Sub Category</h5>
								<ul>
									<li class="is-selected"><button>All Products</button></li>
									<li><button>Gift Kits</button></li>
									<li><button>Hand & Body</button></li>
									<li><button>Men’s</button></li>
									<li><button>Skin </button></li>
									<li><button>Travel </button></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php 

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
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
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
?>
    <?php ArchiveShopHelper::renderTabs() ?>
    <?php ArchiveShopHelper::renderVideo() ?>
<?php

get_footer( 'home-1' );
