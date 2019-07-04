<section data-wow-delay="0.5s" class="video wow fadeIn <?= $has_bg ? 'has-bg' : '' ?>">
    <div class="video_wrapper video_wrapper_full js-videoWrapper">
        <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowTransparency="true" allowfullscreen data-src="https://www.youtube.com/embed/<?= $video ?>" width="100%" height="500px"></iframe>
        <button class="videoPoster js-videoPoster" <?= $has_bg ? 'style="background: url('.$bg.')"' : '' ?>>
            <i class="fas fa-play"></i>
        </button>
    </div>
</section>