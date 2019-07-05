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
		<main id="main" class="site-main" role="main">
            <div class="slider">
                <?php
                    $slider = get_field('slider_about_us');
                   
                    if($slider) :
                 ?>
                <div class="slider__item">
                    <?php
                         $bg_image = $slider[0]['background_image'];
                         echo '<pre>';
                            print_r($bg_image);
                         echo '</pre>';
                         if($bg_image) :
                         $attachmentUrl = isset($bg_image[0]['image']) ? wp_get_attachment_url($bg_image[0]['image']) : ''; 
                         echo '<pre>';
                            print_r($attachmentUrl);
                         echo '</pre>';

                    ?>

                    <div class="slider__item__img">
                        <img class="bg_img" alt="" src="<?= esc_url($attachmentUrl) ?>">
                    </div>
                    <div class="slider__item__content">
                        <div class="title">

                        </div>
                        <div class="sub-title">
                        </div>
                    </div>
                    <?php endif ?>
                </div>
                    <?php endif ?>
            <div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
