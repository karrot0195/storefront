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

    static function renderTabs() {
        $page = get_page_by_title('shop');

        $tabs = get_field('tab_group', $page->ID ? $page->ID : '');
        if (!empty($tabs)):
        ?>
        <section class="tab-content">
            <div class="tabs">
                <ul class="tabs-nav">
                    <?php
                        foreach ($tabs as $idx => $tab) {
                            $tabTitle = $tab['title'];
                            $tabHref = "#tab-".($idx+1);
                            echo <<< HTML
                    <li><a href="$tabHref">$tabTitle</a></li>
HTML;

                        }
                    ?>
                </ul>
                <div class="tabs-stage">
                    <?php foreach ($tabs as $idx => $tab): ?>
                    <section id="tab-<?= ($idx+1) ?>">
                        <div class="sub-title">
                            <?= $tab['description'] ?>
                        </div>
                        <?php
                        if (!empty($tab['gallery'])) {
                          ?>
                            <div class="slider-tab-<?= ($idx+1) ?>" data-slick='{"slidesToShow": 5, "slidesToScroll": 1}'>
                                <?php
                                foreach ($tab['gallery'] as $attachment) {
                                    $attachmentUrl = $attachment['url'];
                                    echo <<< HTML
                                <div><img src="$attachmentUrl"/></div>
HTML;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </section>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<?php endif;
    }


    static function renderVideo() {
        $page = get_page_by_title('shop');
        $video = get_field('video', $page->ID ? $page->ID : '');
        ?>
        <section class="video">
            <div class="video_wrapper video_wrapper_full js-videoWrapper">
                <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true" allowfullscreen data-src="https://www.youtube.com/embed/<?= $video ?>" width="100%" height="500px"></iframe>
                <button class="videoPoster js-videoPoster">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </section>

        <?php
    }
}