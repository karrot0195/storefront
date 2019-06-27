<?php
class ArchiveShopHelper {
    static function renderBanner() {
        $page = get_page_by_title('shop');
        if ($page) {
            $title = get_field('banner_title', $page->ID);
            $image = get_field('banner_image',$page->ID);
            $imageUrl = wp_get_attachment_url($image);
            ?>
            <section class="banner-main" <?= !empty($imageUrl) ? 'style="background: url('.esc_url($imageUrl).')' : '' ?>">
                <div class="banner-title"><?= $title ?></div>
            </section>
            <?php
        }
    }
}