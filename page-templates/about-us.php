<?php
/**
 * Template name: Template About Us
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main about-us" role="main">
            <?php get_breadcrumb() ?>
            <div class="slider">
                <?php
                    $slider = get_field('slider_about_us');
                    if($slider) :
                        foreach($slider as $slider_item ):
                            $bg_image= wp_get_attachment_url($slider_item['background_image']);
                        ?>
                        <div class="slider__item">
                            <div class="slider__item__img">
                                <img class="bg_img" alt="" src="<?= esc_url($bg_image) ?>">
                            </div>
                            <div class="slider__item__content">
                                <div class="title">
                                    <?php echo $slider_item['title'] ?>
                                </div>
                                <div class="sub-title">
                                    <?php echo $slider_item['sub_title'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif ?>
            </div>
            <div class="container">
                 <div class="content">
                    <?php 
                        $content_ab = get_field('content_ab');
                        if($content_ab) :
                    ?>
                    <div class="title">
                        <?php echo $content_ab[0]['title'] ?>
                    </div>
                    <div class="sub_title">
                        <?php echo $content_ab[0]['sub_title'] ?>
                    </div>
                    <?php
                        $box = $content_ab[0]['box'];
                        if($box) : 
                    ?>
                 
                    <div class="box">
                        <div class="left">
                            <?php echo $box[0]['left'] ?>
                        </div>
                        <div class="right">
                            <?php echo $box[0]['right'] ?>
                        </div>
                    </div>
                    <?php endif ?>
                    <div class="desc">
                        <?php echo $content_ab[0]['description'] ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
