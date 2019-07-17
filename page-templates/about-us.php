<?php
/**
 * Template name: Template About Us
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main about-us" role="main">
            <div class="slider">
                <?php
                    $slider = get_field('slider_about_us');
                   
                    if($slider) :
                 ?>
                <div class="slider__item">
                    <?php
                         $description = $slider[0]['description'];
                    ?>
                    <div class="slider__item__img">
                        <?php
                         $bg_image = $slider[0]['background_image'];
                         if($bg_image) :
                                foreach($bg_image as $bg_img ):
                                $slider_image = wp_get_attachment_url($bg_img['image']); 
                                ?>
                                 <img class="bg_img" alt="" src="<?= esc_url($slider_image) ?>">
                            <?php endforeach; ?>
                       
                    </div>
                    <div class="slider__item__content">
                        <div class="title">
                            <?php echo $description[0]['title']  ?>
                        </div>
                        <div class="sub-title">
                            <?php echo $description[0]['sub_title']  ?>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
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
