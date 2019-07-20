<?php
/**
 * Template name: Template Shipping
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main shipping" role="main">
            <div class="container">
                <div class="shipping-wrapper">
                    <div class="sidebar">
                        <?php echo get_field('shipping_sidebar') ?>
                    </div>    
                    <div class="content">
                        <div class="desc">
                            <?php echo get_field('description'); ?>
                        </div>
                        <?php 
                            $content= get_field('shipping_content');
                            if($content) :
                                foreach($content as $content_item) :
                        ?>
                                <div class="block__content">
                                    <div class="title">
                                        <?php echo $content_item['shipping_category'] ?>
                                    </div>
                                    <div class="sub-title">
                                        <?php echo $content_item['question'] ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
