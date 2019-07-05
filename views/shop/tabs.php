<section data-wow-delay="0.5s" class="tab-content wow fadeIn">
    <div class="container">
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
    </div>
</section>
