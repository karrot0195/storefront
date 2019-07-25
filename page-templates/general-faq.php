<?php
/**
 * Template name: Template Generate Faq
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main faq" role="main">
            <div class="container">
                <?php get_breadcrumb() ?>
                <div class="faq-wrapper">
                    <div class="sidebar">
                        <?php echo get_field('faq_sidebar') ?>
                    </div>    
                    <div class="content">
                        <?php 
                            $content= get_field('faq_content');
                            if($content) :
                                foreach($content as $content_item) :
                                   
                        ?>
                                    <div class="block__content">
                                        <div class="title">
                                            <?php echo $content_item['faq_category'] ?>
                                        </div>
                                        <div class="sub-title">
                                        <?php echo $content_item['questions'] ?>
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
