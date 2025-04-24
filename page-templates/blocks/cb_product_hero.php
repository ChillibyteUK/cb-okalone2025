<?php
$small_h1 = get_field('small_h1');
?>
<section class="product_hero d-flex align-items-center">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-7 my-auto py-5 order-2 order-md-1">
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
                    <div class="d-flex flex-wrap g-4">
                        <?php
                        if (get_field('quote_link') ?? null) {
                            $l = get_field('quote_link');
                            ?>
                        <a class="button button-outline mb-2 me-2 text-center w-100 w-md-auto d-inline" href="<?=$l['url']?>" target="<?=$l['target']?>"><span><?=$l['title']?></span></a>
                            <?php
                        }
                        if (get_field('show_demo_cta') ?? null) {
                            ?>
                        <button type="button" class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto d-inline" data-bs-toggle="modal" data-bs-target="#demoModal"><span>Book a Demo</span></button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 order-1 order-md-2">
                <?= wp_get_attachment_image(get_field('image'),'large') ?>
            </div>
        </div>
    </div>
</section>