<?php
$orderText = get_field('order') == 'Text Image' ? 'order-2 order-md-1' : 'order-2 order-md-2';
$orderImage = get_field('order') == 'Text Image' ? 'order-1 order-md-2' : 'order-1 order-md-1';

$text_fade = (get_field('order') == 'Text Image') ? 'fade-right' : 'fade-left';
$image_fade = (get_field('order') == 'Text Image') ? 'fade-left' : 'fade-right';

$l = get_field('cta') ?? null;
?>
<section class="text_image py-5">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6 <?= $orderText ?>  d-grid align-content-center" style="justify-items:start;"
                data-aos="<?= $text_fade ?>">
                <?php
                if (get_field('pre_title') ?? null) {
                ?>
                    <div class="fs-300 fw-900 text-blue mb-3"><?= get_field('pre_title') ?></div>
                <?php
                }
                ?>
                <h2><?= get_field('title') ?></h2>
                <p><?= get_field('content') ?></p>
                <?php
                $demo = get_field('book_demo') ?? null;
                if (!empty($demo)) {
                    ?>
                    <button type="button" class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto d-inline" data-bs-toggle="modal" data-bs-target="#demoModal"><span>Book a Demo</span></button>
                    <?php
                }
                if (!empty($l)) {
                ?>
                    <a href="<?= $l['url'] ?>" target="<?= $l['target'] ?>" class="button button-yellow text-center w-100 w-md-auto"><span><?= $l['title'] ?></span></a>
                <?php
                }
                ?>
            </div>
            <div class="col-md-6 <?= $orderImage ?> text-center"
                data-aos="<?= $image_fade ?>">
                <?php
                if (get_field('image') ?? null) {
                    echo wp_get_attachment_image(get_field('image'), 'full', false);
                } elseif (get_field('video_id') ?? null) {
                    $type = get_field('video_provider') == 'YouTube' ? 'youtube-embed' : 'vimeo-embed';
                ?>
                    <div class="<?= $type ?> ratio ratio-16x9" id="<?= get_field('video_id') ?>" title="VIDEO">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
document.querySelectorAll('.vimeo-embed, .youtube-embed').forEach(v => {
	const isVimeo = v.classList.contains('vimeo-embed');

	if (isVimeo) {
		// Handle vimeo ID and optional hash
		const [id, hash] = v.id.split('/');
		const poster = `vumbnail.com/${id}${hash ? '/' + hash : ''}.jpg`;
		const src = `player.vimeo.com/video/${id}${hash ? '?h=' + hash : ''}`;

		v.innerHTML = `<img loading="lazy" src="https://${poster}" alt="${v.title}" aria-label="Play"><div class="ltv-playbtn"></div>`;

		v.children[0].addEventListener('click', () => {
			v.innerHTML = `<iframe allow="autoplay" src="https://${src}&autoplay=1" allowfullscreen></iframe>`;
			v.classList.add('video-loaded');
		});
	} else {
		const poster = `i.ytimg.com/vi/${v.id}/hqdefault.jpg`;
		const src = `www.youtube.com/embed/${v.id}`;

		v.innerHTML = `<img loading="lazy" src="https://${poster}" alt="${v.title}" aria-label="Play"><div class="ltv-playbtn"></div>`;

		v.children[0].addEventListener('click', () => {
			v.innerHTML = `<iframe allow="autoplay" src="https://${src}?autoplay=1" allowfullscreen></iframe>`;
			v.classList.add('video-loaded');
		});
	}
});
    </script>
<?php
});