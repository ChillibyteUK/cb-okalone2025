<?php
/*
 * Template Name: Resources Index
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
?>
 <main id="main" class="resources">
    <div class="container-xl">
        <h1>OK Alone Knowledge Hub</h1>
        <p>The latest news and stories from the lone worker sector.</p>
        <h2>Latest Stories</h2>
        <div class="latest_stories pb-5">
            <?php
            $q = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 4
            ));
            $first = true;
            while ($q->have_posts()) {
                $q->the_post();
                $words = $first ? 20 : 12;
                $mb = $first ? 'mb-4' : '';
                ?>
            <a href="<?=get_the_permalink()?>" class="latest_stories__card">
                <?=get_the_post_thumbnail($q->ID,'large',['class' => 'latest_stories__image'])?>
                <div class="latest_stories__inner">
                    <h3><?=get_the_title()?></h3>
                    <div class="latest_stories__excerpt <?=$mb?>"><?=wp_trim_words(get_the_content(null,false,$q->ID),$words)?></div>
                    <div class="button button-outline">Read More</div>
                </div>
            </a>
                <?php
                $first = false;
            }
            ?>
        </div>
        <?php
        ?>
    </div>
 </main>
<?php

get_footer();