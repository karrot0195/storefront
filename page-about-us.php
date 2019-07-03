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
            <div class="sider">
                <?php
                    $slider = get_field('slider');
                    var_dump($slider);
                    $acttachmentUrl = isset($slider())
                 ?>
                <div class="slider__item">
                    <div class="slider__item__img">
                        <img class="bg-img">
                    </div>
                    <div class="slider__item__content">
                        <div class="title">

                        </div>
                        <div class="sub-title">
                        </div>
                    </div>
                </div>
            <div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
