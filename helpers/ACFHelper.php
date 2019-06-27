<?php
class ACFHelper {
    static function getSliderHeaderConfig() {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'templates/template-header-config.php'
        ));
        $slider = get_field('slider', count($pages) ? $pages[0]->ID: '');
        return $slider;
    }

    static function renderHtmlSlider1() {
        $slider = ACFHelper::getSliderHeaderConfig();
        $title = [];
        if (!empty($slider)) {
            foreach ($slider as $item) {
                $title[] = $item['title'];
            }
        }
        ?>
        <div class="slider">
            <?php if (!empty($slider)):
                foreach ($slider as $idx => $item):
                    $attachmentUrl = wp_get_attachment_url($item['background']);
                    $description = $item['description'];
                    ?>
                    <div class="slider--item" <?= $idx == 0 ? "style='display: block;'" : '' ?>>
                        <div class="block-img">
                            <img class="bg-img" src="<?= esc_url($attachmentUrl) ?>" alt="">
                        </div>
                        <div class="block-desc">
                            <?= $description ?>
                        </div>
                        <div class="list-title">
                            <ul>
                                <?php
                                foreach ($title as $idxTitle => $t) {
                                    $class = "";
                                    if ($idxTitle == $idx) {
                                        $class = 'active';
                                    }
                                    echo "<li><a href='javascript:void(0)' class='js-btn-slider ".$class."' data-id='$idxTitle'>$t</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; endif;?>
        </div>
        <?php
    }
}