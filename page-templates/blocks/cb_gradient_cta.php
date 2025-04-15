<?php
$grad = get_query_var('grad', get_field('theme'));
$cta = get_query_var('cta', get_field('cta') ?? null);
$title = get_query_var('title', get_field('title') ?? 'NO TITLE');
$content = get_query_var('content', get_field('content'));
$modal_trigger = get_query_var('modal_trigger', get_field('modal_trigger'));
if ( $title == '' ) {
    $title = get_field('title');
}
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--<?= $grad ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-5" data-aos="fade-left">
                <h2><?= $title ?></h2>
                <div class="mb-4"><?= $content ?></div>
                <?php
                $modal_trigger = $modal_trigger;
                if (is_array($modal_trigger) && isset($modal_trigger[0]) && $modal_trigger[0] == 'Yes') {
                ?>
                    <button type="button" class="button button-outline" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>
                <?php
                }
                if ($cta) {
                ?>
                    <a href="<?= $cta['url'] ?>" target="<?= $cta['target'] ?>" class="button button-outline--white text-white"><?= $cta['title'] ?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>