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
$attachmentId = get_field('background_image');
$attachmentUrl = wp_get_attachment_url($attachmentId);
$title = get_field('title');
get_header('home-1'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <img class="bg-img" src="<?= esc_url($attachmentUrl) ?>" alt="">
            <div class="title">
                <?= $title ?>
            </div>

            <div class="primary-menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary',
                        'container_class' => 'primary-navigation',
                    )
                );
                ?>
            </div>
		</main><!-- #main -->

        <div class="block-notify">
            <div class="block-notify--element block-notify--text">
                this website use cookies. <a href="#">Learn more</a>
            </div>
            <div class="block-notify--element block-notify--action">
                <i class="fas fa-times"></i>
            </div>
        </div>
	</div><!-- #primary -->
<?php
get_footer('home-1');
