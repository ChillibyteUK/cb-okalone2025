<?php
/* Template Name: Guides Index */
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>
<main id="main" class="resources">
    <div class="container-xl pt-5">
        <h1><?= single_cat_title(); ?></h1>
        <div class="row g-4 mb-4">
            <?php
        while (have_posts()) {
            the_post();
            ?>
            <div class="col-lg-3">
                <a class="blog_card" href="<?=get_the_permalink()?>">
                    <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'large')?>" alt="" class="blog_card__image">
                    <div class="blog_card__content">
                        <h3 class="blog_card__title"><?=get_the_title()?></h3>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>
        </div>
        <?= understrap_pagination() ?>
    </div>
</main>
<?php

get_footer();
