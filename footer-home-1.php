<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

$footer_menu_item = get_field('footer_menu_item', 'option');
$introduce_site = get_field('introduce_site', 'option', '');
$facebook_link = get_field('facebook_link', 'option', '#');
$instagram_link = get_field('instagram_link', 'option', '#');

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col-full">
			    <div class="footer-widgets row-1 col-4 fix">
			        <div class="block footer-widget-1">
			            <div id="custom_html-2" class="widget_text widget widget_custom_html">
			                <div class="textwidget custom-html-widget">
			                	<span class="text-info-footer"><?= $introduce_site ?></span>
			                    <style>
			                        .text-info-footer {
			                            width: 336px;
			                            height: 11px;
			                            font-family: Barlow;
			                            font-size: 15px;
			                            font-weight: normal;
			                            font-style: normal;
			                            font-stretch: normal;
			                            line-height: 2.2;
			                            letter-spacing: 0.3px;
			                            text-align: left;
			                            color: #707070;
			                        }
			                    </style>
			                </div>
			            </div>
			        </div>
			        <div class="block footer-widget-2">
			            <?php if (!empty($footer_menu_item)):?>
			            <div id="page_widget-2" class="widget page-widget">
			                <div class="block-widget-page">
			                    <div class="menu-info"> Info <span><i class="fa fa-chevron-up"></i></span> </div>
			                    <ul>
									<?php foreach($footer_menu_item as $item):  ?>
			                        <li>
			                        	<a href="<?= esc_url($item['link']) ?>"><?= $item['title'] ?></a>
		                            </li>
	                               <?php  endforeach; ?>
			                    </ul>
			                </div>
			            </div>
			        	<?php endif; ?>
			        </div>
			        <div class="block footer-widget-3">
			            <div id="custom_html-3" class="widget_text widget widget_custom_html">
			                <div class="textwidget custom-html-widget">
			                    <div class="block-social-footer">
			                        <ul>
			                            <li>
			                                <a href="<?= esc_url($facebook_link) ?>">
			                                    <i class="fab fa-facebook-f"></i>
			                                </a>
			                            </li>
			                            <li><a href="<?= esc_url($instagram_link) ?>"><i class="fab fa-instagram"></i></a></li>
			                        </ul>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <div class="block footer-widget-4">
			            <div id="custom_html-5" class="widget_text widget widget_custom_html">
			                <div class="textwidget custom-html-widget">
			                    <div class="block-contact-form">
			                        <img width="20px" src="http://stg1.techvsi.com/wp-content/themes/storefront/assets/images/icon/mail.png">
			                        <input placeholder="Sign up for newsletter">
			                        <a href="#" class="js-btn-submit"><i class="ion ion-ios-arrow-round-forward"></i></a>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			    <!-- .footer-widgets.row-1 -->

			</div>
		</div>
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>
    <div class="wrap-modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-title"></div>
            <div class="modal-content--main">
                <p>Some text in the Modal..</p>
            </div>
        </div>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
