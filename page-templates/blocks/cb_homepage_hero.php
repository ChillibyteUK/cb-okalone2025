<?php
$bg = null;
$small_h1 = get_field('small_h1');
?>
<!-- homepage_hero -->
<section class="homepage_hero d-flex">
    <div class="container-xl my-auto">
        <div class="row">
            <div class="col-lg-8 homepage_hero__content d-flex justify-content-center flex-column order-2 order-lg-1">
                <div class="inner">
                    <?php
                    if (get_field('pre_title') ?? null) {
                        if( $small_h1 && in_array('yes', $small_h1) ) {
                    ?>
                        <h1 class="text--yellow-400 fs-600 fw-bold"><?= get_field('pre_title') ?></h1>
                    <?php
                        } else {
                    ?>
                        <div class="text--yellow-400 fs-600 fw-bold"><?= get_field('pre_title') ?></div>
                    <?php
                        }
                    }

                    if( $small_h1 && in_array('yes', $small_h1) ) {
                    ?>
                    <h2>
                        <div class="text-dark h1">
                            <?= get_field('title') ?>
                        </div>
                    </h2>  
                    <?php
                    } else {
                    ?>
                    <h1>
                        <div class="text-dark">
                            <?= get_field('title') ?>
                        </div>
                    </h1>  
                    <?php
                    }
                    ?>
                    <div class="hero__content mb-4"><?= get_field('content') ?></div>
                    <a class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto" href="/pricing/"><span>Get a Quote</span></a>
                    <button type="button" class="button button-outline mb-2 me-2 text-center w-100 w-md-auto d-inline" data-bs-toggle="modal" data-bs-target="#demoModal"><span>Book a Demo</span></button>
                    <?php
                    if (get_field('cta2')) {
                        $cta2 = get_field('cta2');
                    ?>
                        <a class="button button-outline mb-2 me-2 text-center w-100 w-md-auto" href="<?= $cta2['url'] ?>" target="<?= $cta2['target'] ?>"><?= $cta2['title'] ?></a>
                    <?php
                    }
                    if (get_field('modal_cta') != '') {
                        $id = get_field('modal_cta');
                    ?>
                        <button type="button" class="button button-yellow mb-2 text-center w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#<?= $id ?>"><span>Watch Video</span></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="heroAnim">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/circle.png" alt="" class="circle">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/dots.png" alt="" class="dots">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/gradient.png" alt="" class="gradient">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/figure.png" alt="" class="shakira">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/laptop.png" alt="" class="laptop">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/phone.png" alt="" class="phone">
                    <!--
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/phone2.png" alt="" class="phone2">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/heroAnim/phone3.png" alt="" class="phone3">
                -->
                </div>
            </div>
        </div>
    </div>
</section>