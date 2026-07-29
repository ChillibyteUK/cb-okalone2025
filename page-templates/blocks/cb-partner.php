<?php
$grad = get_query_var('grad', get_field('theme'));
$title = get_query_var('title', get_field('title') ?? 'NO TITLE');
$content = get_query_var('content', get_field('content'));
$modal_trigger = get_query_var('modal_trigger', get_field('modal_trigger'));
if ( $title == '' ) {
    $title = get_field('title');
}
$img = wp_get_attachment_image_url(get_field('image'),'full');
if ( $img == '' ) {
    $img = '/wp-content/uploads/2025/04/woman-on-ok-alone-laptop.png';
}
?>
<!-- gradient_cta -->
<section class="gradient_cta py-5 bg_grad--<?= $grad ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12 text-center text-white mx-auto">
                <h2 class="h1"><?= $title ?></h2>
                <div class="mb-4"><?= $content ?></div>
                <button data-bs-toggle="modal" data-bs-target="#newSectionsModal" class="button button-white">Partner with Us</button>
            </div>
        </div>
    </div>
</section>