<?php
/**
 * Template name: Template Term & Conditions
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main privacy-policy" role="main">
            <div class="container">
                <?php get_breadcrumb() ?>
                <div class="privacy-policy-wrapper">
                    <div class="sidebar">
                    <?php echo get_field('privacy_policy_sidebar') ?>
                    </div>    
                    <div class="content">
                        <?php 
                            $content=get_field('privacy_policy_content');
                            if($content) :
                                foreach($content as $content_item) :
                        ?>
                           <div class="block__content">
                                <div class="title">
                                    <?php echo $content_item['privacy_policy_category'] ?>
                                </div>
                                <div class="sub-title">
                                    <?php echo $content_item['answer'] ?>
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
