<section class="info-page">
    <div class="container">
        <div class="wrapper-page">
            <div class="info-page-child">
                <div class="info-page-left">
                    <a href="#"><?= esc_html__('View Products', 'storefront') ?></a>
                    <ul class="list-filter js-list-filter">
                        <li class="is-selected"><a href="javascript:void(0)" data-limit="-1">ALL</a></li>
                        <li><a href="javascript:void(0)" data-limit="8">8</a></li>
                        <li><a href="javascript:void(0)" data-limit="16">16</a></li>
                        <li><a href="javascript:void(0)" data-limit="24">24</a></li>
                    </ul>
                </div>
                <div class="info-page-right">
                    <button class="btn-filter pc"><?= esc_html__('FILTER', 'storefront') ?><i class="ion ion-ios-arrow-down"></i></button>
                    <button class="btn-filter sp"><?= esc_html__('FILTER', 'storefront') ?><i class="ion ion-ios-arrow-down"></i></button>

                </div>
                <div class="modal-heading">
                    <span href="#" class="logo"></span>
                    <span class="button-close">
							<i class="ion ion-ios-close"></i>
						</span>
                </div>
            </div>
            <div class="modal-filter">
                <div class="modal-title-sp">Filter</div>
                <div class="btn-done-sp">
                    <button>
                        Done
                    </button>
                </div>
                <span class="button-close-sp">
						<i class="ion ion-ios-close"></i>
					</span>
                <div class="modal-content">
                    <div class="block-content">
                        <?php
                        foreach ($product_cats as $idx => $cat) {
                            ?>
                            <div class="cat-content content content-<?= $idx+1 ?>" data-cat="<?= $cat['term_id'] ?>">
                                <h5 class="title"><?= $cat['name'] ?></h5>
                                <ul>
                                    <li class="is-selected" data-sub_cat="">
                                        <button class="js-filter-product"><?= esc_html__('All Types', 'storefront') ?></button>
                                    </li>
                                    <?php
                                    if (isset($cat['sub_cats']) && count($cat['sub_cats'])) {
                                        foreach ($cat['sub_cats'] as $sub_cat) {
                                            echo '<li data-sub_cat="'.$sub_cat['term_id'].'"><button class="js-filter-product">'.$sub_cat['name'].'</button></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>