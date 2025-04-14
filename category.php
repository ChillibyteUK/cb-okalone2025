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
            <div class="col-md-6 col-lg-3">
                <a href="<?=get_the_permalink()?>" class="latest_blogs__card">
                    <?=get_the_post_thumbnail($q->ID,'large',['class' => 'latest_blogs__image'])?>
                    <div class="latest_blogs__inner">
                        <h3><?=get_the_title()?></h3>
                        <div class="latest_blogs__excerpt <?=$mb?>"><?=wp_trim_words(get_the_content(null,false,$q->ID),12)?></div>
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
