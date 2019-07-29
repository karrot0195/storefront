<?php
class ArchiveShopHelper {
    static function renderBanner() {
        $page = get_page_by_title('shop');
        if ($page) {
            $title = get_field('banner_title', $page->ID);
            $image = get_field('banner_image',$page->ID);
            $imageUrl = wp_get_attachment_url($image);
            ?>
            <section class="banner-main" <?= !empty($imageUrl) ? 'style="background-image: url('.esc_url($imageUrl).')' : '' ?>">
                <div class="banner-title"><?= $title ?></div>
            </section>
            <?php
        }
    }

    static function renderTabs() {
        $page = get_page_by_title('shop');
        $tabs = get_field('tab_group', $page->ID ? $page->ID : '');
        if (!empty($tabs)) {
            echo render_php('views/shop/tabs.php', [
                    'tabs' => $tabs
            ]);
        }
    }


    static function renderVideo() {
        $page = get_page_by_title('shop');
        $video = get_field('video', $page->ID ? $page->ID : '');
        $bg = get_field('video_bg', $page->ID ? $page->ID : '');
        $has_bg = true;
        if ($bg) {
            $bg = wp_get_attachment_url($bg);$has_bg=true;
        } else {
            $bg = "http://i3.ytimg.com/vi/".$video."/maxresdefault.jpg";
        }
        echo render_php('views/shop/video.php', [
            'bg' => $bg,
            'has_bg' => $has_bg,
            'video' => $video,
        ]);
    }

    static function renderFilter() {
        $orderby = 'name';
        $order = 'desc';
        $hide_empty = false ;
        $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty
        );

        $product_cats = get_terms( 'product_cat', array_merge($cat_args, [
            'parent' => 0,
            'orderby' => 'meta_value_num',
            'meta_query' => [[
                'key' => 'priority',
                'type' => 'NUMERIC',
            ]]
        ]) );

        if (!empty($product_cats)) {
            for ($i=0; $i < count($product_cats); $i++) {
                $product_cats[$i] = (array) $product_cats[$i];
                $product_cats[$i]['sub_cats'] = (array) array_map(function($r) {
                    return (array)$r;
                }, get_terms('product_cat',
                    array_merge($cat_args, ['parent' => $product_cats[$i]['term_id']])));
            }
        }

        echo render_php('views/shop/product-filter.php', [
                'product_cats' => $product_cats
        ]);
    }
}
