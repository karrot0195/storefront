<?php
/**
 * Template name: Template Return Policy
 */

get_header('home-1'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main return-policy privacy-policy" role="main">
            <div class="container">
                <div class="privacy-policy-wrapper return-policy-wrapper">
                    <?php 
                        $return_policy = get_field('return_policy') ;
                        if($return_policy) :
                            $side_bar = $return_policy[0]['sidebar'];
                    ?>
                    <div class="sidebar">
                       <p> <?php echo $side_bar ?></p>
                    </div>    
                    <div class="content">
                        <?php 
                            $content=$return_policy[0]['content'];
                           
                        ?>
                        <div class="desc">
                            <?php echo get_field('description') ?>
                        </div>
                        <?php 
                            $content=$return_policy[0]['content'];
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
                                <div class="extra-title">
                                    <?php echo $block_content[0]['extra_title'] ?>
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
