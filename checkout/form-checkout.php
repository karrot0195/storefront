<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<div class="container">
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
		
		<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		<div class="payment-wrapper">
			<div class="payment-with">
				<div class="title">
					Payment with Debit / Credit Card
				</div>
				<div class="items">
					<div class="item">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Capa-1.png">
					</div>
					<div class="item">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Layer-3.png">
					</div>
					<div class="item">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Layer-4.png">
					</div>
				</div>	
			</div>
				<p class="form-row">
					<label>Card Number</label>
					<input type="text" class="form-number-card" placeholder="XXXX-XXXX-XXXX-XXXX">
				</p>
				<p class="form-row">
					<label>Name</label>
					<input type="text" class="form-name">
				</p>
				<div class="expiry-date">
					<p class="form-row">
						<label>Expiry Date</label>
						<div class="m-y-wrapper">
							<input type="text" class="form-month" placeholder="MM">
							<input type="text" class="form-year"  placeholder="YYYY">
						</div>
					</p>
				</div>
					<p class="form-row">
						<label>CVV</label>
						<input type="text" class="form-cvv">
					</p>
				<div class="save-card">
					<input type="checkbox" class="form-save"> Save card details for next time <br>
					<button class="use-card">Use This Card</div>
				</div>
		</div>
	</form>
	<!--  -->
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
