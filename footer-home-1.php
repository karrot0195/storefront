<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col-full">

				<?php
				/**
				 * Functions hooked in to storefront_footer action
				 *
				 * @hooked storefront_footer_widgets - 10
				 * @hooked storefront_credit         - 20
				 */
				do_action( 'storefront_footer_home_1' );
				?>

			</div><!-- .col-full -->
		</div>
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>
<!--    <div class="wrap-modal">-->
<!--        <div class="modal-content">-->
<!--            <span class="close">&times;</span>-->
<!--            <p>Some text in the Modal..</p>-->
<!--        </div>-->
<!--    </div>-->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
