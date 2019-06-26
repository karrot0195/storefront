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
	<section class="banner-main">
		<div class="banner-title">Precision Skincare from Lab to Skin</div>

	</section>
	<section class="info-page">
		<div class="info-page-left">
			<a href="#">View All Products</a>
			<ul class="list-filter">
				<li><a href="#">8</a></li>
				<li><a href="#">16</a></li>
				<li><a href="#">24</a></li>
			</ul>
		</div>
		<div class="info-page-right">
			<button class="btn-filter">FILTER</button>
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
<section class="tab-content">
	<div class="tabs">
		<ul class="tabs-nav">
			<li><a href="#tab-1">About</a></li>
			<li><a href="#tab-2">Our Belief</a></li>
			<li><a href="#tab-2">The Science Behind</a></li>
		</ul>
		<div class="tabs-stage">
			<section id="tab-1">
				<div class="sub-title">
					Come and experience our multi-award winning redefinition of your everyday skincare routine. From cleansers to moisturisers, we have you covered every step of the way.
				</div>
				<div class="slider-tab-1" data-slick='{"slidesToShow": 5, "slidesToScroll": 1}'>
					<div><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-5.jpg"/></div>
					<div><h3><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-2.jpg"/></h3></div>
					<div><h3><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-3.jpg"/></h3></div>
					<div><h3><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-4.jpg"/></h3></div>
					<div><h3><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-5.jpg"/></h3></div>
					<div><h3><img src="<?php bloginfo('template_url'); ?>/assets/images/common/about/about-4.jpg"/></h3></div>
				</div>
			</section>
			<section id="tab-2">
				<p>Phasellus pharetra aliquet viverra. Donec scelerisque tincidunt diam, eu fringilla urna auctor at.</p>
			</section>
			<section id="tab-3">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec neque nisi, dictum aliquet lectus.</p>
			</section>
		</div>
	</div>
</section>
<section class="video">
		<!-- <a href="https://codepen.io/himalayasingh/full/ZdWvMj" target="_blank" id="full_view">Full view</a> -->
		<div id="player_cover">
			<div id="player">
				<input type="checkbox" id="start_video_checkbox">
				<input type="checkbox" id="play_pause_video_checkbox">
				<input type="radio" name="video_quality" id="video_quality_144p">
				<input type="radio" name="video_quality" id="video_quality_240p">
				<input type="radio" name="video_quality" id="video_quality_360p">
				<input type="radio" name="video_quality" id="video_quality_720p">
				<input type="radio" name="video_quality" id="video_quality_1080p" checked>
				<div id="play_video">
					<label for="start_video_checkbox" id="start_video_label">
						<i class="fas fa-play"></i>
					</label>
				</div>

				<div id="video">
					<div id="intro_video">
						<div id="intro_video_text">
							<div id="publisher_name">WebSlake</div>
							<div id="ytd_url">www.youtube.com/c/WebSlake</div>
						</div>
						<div id="video_theme">
							<div id="theme_cover">
								<div id="theme">Funny whatsapp chats</div>
								<img id="th_img_1" src="https://abs.twimg.com/emoji/v2/72x72/1f49e.png" alt="Emoji">
								<img id="th_img_2" src="https://abs.twimg.com/emoji/v2/72x72/1f308.png" alt="Emoji">
								<img id="th_img_3" src="https://abs.twimg.com/emoji/v2/72x72/1f382.png" alt="Emoji">
								<img id="th_img_4" src="https://abs.twimg.com/emoji/v2/72x72/1f973.png" alt="Emoji">
								<img id="th_img_5" src="https://abs.twimg.com/emoji/v2/72x72/1f44a.png" alt="Emoji">
								<img id="th_img_6" src="https://abs.twimg.com/emoji/v2/72x72/1f355.png" alt="Emoji">
								<img id="th_img_7" src="https://abs.twimg.com/emoji/v2/72x72/1f431.png" alt="Emoji">
								<img id="th_img_8" src="https://abs.twimg.com/emoji/v2/72x72/1f923.png" alt="Emoji">
							</div>
						</div>
					</div>
					<div id="main_video">
						<div id="wh_header">
							<div id="r_arrow" class="wh_float_l wh_font"><i class="fas fa-arrow-left"></i></div>
							<div id="user_ppic" class="wh_float_l"></div>
							<div id="user_name" class="wh_float_l"></div>
							<div id="wh_hdr_icons" class="wh_font">
								<i class="fas fa-video"></i>
								<i class="fas fa-phone"></i>
								<i class="fas fa-ellipsis-v"></i>
							</div>
						</div>

						<div id="chats">
							<div id="chat_box_1" class="chat_box">
								<div class="chat_number"></div>
								<div class="chat_lines">
									<div class="chat_line l" id="ch_1_1"><span class="chat_text">Helen, I've just heard on the radio that some weirdo is driving the wrong way along the highway.<span></span></span>
									</div>
									<div class="chat_line l ch_up" id="ch_1_2"><span class="chat_text">Take care!</span></div>
									<div class="chat_line r" id="ch_1_3"><span class="chat_text">Just one weirdo?<span></span></span>
									</div>
									<div class="chat_line r ch_up" id="ch_1_4"><span class="chat_text">There are thousands of them heading straight for me!</span></div>
								</div>
							</div>

							<div id="chat_box_2" class="chat_box">
								<div class="chat_number"></div>
								<div class="chat_lines">
									<div class="chat_line l" id="ch_2_1"><span class="chat_text">Hello! Recognize me?<span></span></span>
									</div>
									<div class="chat_line r" id="ch_2_2"><span class="chat_text">Yeah. You've got unmistakable handwriting.<span></span></span>
									</div>
								</div>
							</div>

							<div id="chat_box_3" class="chat_box">
								<div class="chat_number"></div>
								<div class="chat_lines">
									<div class="chat_line l" id="ch_3_1"><span class="chat_text">Even when I'm asleep, I'm still thinking about you.<span></span></span>
									</div>
									<div class="chat_line r" id="ch_3_2"><span class="chat_text">I'll return that damn money to you soon, ok?.<span></span></span>
									</div>
								</div>
							</div>

							<div id="chat_box_4" class="chat_box">
								<div class="chat_number"></div>
								<div class="chat_lines">
									<div class="chat_line r" id="ch_4_1"><span class="chat_text">Hello<span></span></span>
									</div>
									<div class="chat_line l" id="ch_4_2"><span class="chat_text">Uh, I'm sorry, but who are you? It's just that someone has renamed all the contacts in my phone.<span></span></span>
									</div>
									<div class="chat_line r" id="ch_4_3"><span class="chat_text">Oh, I see. And what name am I listed under now?<span></span></span>
									</div>
									<div class="chat_line l" id="ch_4_4"><span class="chat_text">Batman<span></span></span>
									</div>
								</div>
							</div>

							<div id="chat_box_5" class="chat_box">
								<div class="chat_number"></div>
								<div class="chat_lines">
									<div class="chat_line l" id="ch_5_1"><span class="chat_text">Hello!<span></span></span>
									</div>
									<div class="chat_line r" id="ch_5_2"><span class="chat_text">Hello. Who are you?<span></span></span>
									</div>
									<div class="chat_line l" id="ch_5_3"><span class="chat_text">Andrew<span></span></span>
									</div>
									<div class="chat_line r" id="ch_5_4"><span class="chat_text">And?<span></span></span>
									</div>
									<div class="chat_line l" id="ch_5_5"><span class="chat_text">...rew.<span></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="end_screen">
						<h2>Thanks for watching</h2>
					</div>
				</div>

				<div id="video_controls_cover" class="clearfix">
					<div id="seekbar"></div>
					<div id="video_controls_left" class="controls_cover">
						<label for="play_pause_video_checkbox" class="video_control">
							<i class="fas fa-pause" id="pause_icon"></i>
							<i class="fas fa-play" id="play_icon"></i>
						</label>
					</div>
					<div id="video_controls_right" class="controls_cover clearfix">
						<div class="video_control" id="video_quality_control">
							<i class="fas fa-cog"></i>
							<span id="hd_quality">HD</span>
							<div id="video_quality_options">
								<label for="video_quality_144p">144p</label>
								<label for="video_quality_240p">240p</label>
								<label for="video_quality_360p">360p</label>
								<label for="video_quality_720p">720p</label>
								<label for="video_quality_1080p">1080p</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php

get_footer( 'home-1' );
