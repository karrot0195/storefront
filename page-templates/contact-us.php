<?php
/**
 * Template name: Template Contact Us
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
                                <div class="desc"><a href="#"><?php echo get_field('phone') ?></a></div>
                            </div>
                        </div>
                        <div class="contact-form">
                            <div class="title">Please Send Your Inquiry</div>
                           <?php 
                            $form = get_field('form_contact');
                            gravity_form($form['id']);
                            ?>
                        </div>
                    </div>
                
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
