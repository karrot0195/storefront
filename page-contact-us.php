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

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main contact-us" role="main">
            <div class="container">
                <div class="contact-us-wrapper">
                    <div class="sidebar">
                        <?php echo get_field('sidebar') ?>
                    </div>
                    <div class="content">
                        <div class="ad-p-wrapper">
                            <div class="address">
                                <p class="title">Address</p>
                                <div class="desc"><?php echo get_field('address') ?></div>
                            </div>
                            <div class="phone">
                                <p class="title">Phone</p>
                                <div class="desc"><?php echo get_field('phone') ?></div>
                            </div>
                        </div>
                        <div class="contact-form">
                            <div class="title">Please Send Your Inquiry</div>
                             <?php echo do_shortcode( '[contact-form-7 id="244" title="Contact form 1"]' ); ?>
                        </div>
                    </div>
                
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
