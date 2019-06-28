<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Template Home 1
 *
 * @package storefront
 */
get_header('home-1'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="slider">
                <?php
                $gallery = get_field('gallery');
                $description = get_field('title');
                $attachmentUrl = wp_get_attachment_url($gallery[0]['background']);
                ?>
                <div class="slider--item" style="display: block;">
                    <div class="block-img">
                        <img class="bg-img" src="<?= esc_url($attachmentUrl) ?>" alt="" height="900px">
                    </div>
                    <div class="block-description">
                        <div class="container">
                            <div class="block-desc">
                                <?= $description ?>
                            </div>
                            <div class="list-title">
                                <ul>
                                    <?php
                                    $class = 'active';
                                    foreach ($gallery as $attachment) {
                                        $title = $attachment['title'];
                                        $attachmentUrl = wp_get_attachment_url($attachment['background']);
                                        echo "<li><a href='javascript:void(0)' class='js-btn-slider ".$class."' data-src='".esc_url($attachmentUrl)."'>$title</a></li>";
                                        $class = '';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		</main><!-- #main -->
        <div class="container">
            <div class="block-notify">
                <div class="block-notify--element block-notify--text">
                    this website use cookies. <a href="#">Learn more</a>
                </div>
                <div class="block-notify--element block-notify--action">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
	</div><!-- #primary -->
<?php
get_footer('home-1');
