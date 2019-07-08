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
		<main id="main" class="site-main faq" role="main">
            <div class="container">
                <div class="faq-wrapper">
                    <?php 
                        $faq = get_field('faq') ;
                        if($faq) :
                            $side_bar = $faq[0]['side_bar'];

                    ?>
                    <div class="sidebar">
                        <?php echo $side_bar ?>
                    </div>    
                    <div class="content">
                        <?php 
                            $content=$faq[0]['content'];
                            if($content) :
                                foreach($content as $idx_block_content) :
                                   
                        ?>
                            <div class="block__content">
                                <?php  $block_content = $idx_block_content['block_content']; ?>
                                <div class="title">
                                    <?php echo $block_content[0]['title'] ?>
                                </div>
                                <div class="sub-title">
                                <?php echo $block_content[0]['sub_title'] ?>
                                </div>
                            </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <?php endif ?>
                </div>        
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('home-1');
