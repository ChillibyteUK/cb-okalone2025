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

        <h2>Blog</h2>
        <div class="latest_blogs pb-5 row g-4">
            <?php
            $q = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'article-type',
                        'field'    => 'slug', // You can also use 'term_id' if you prefer
                        'terms'    => 'blog', // The slug of the term
                    ),
                ),
            ));
            while ($q->have_posts()) {
                $q->the_post();
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
                $first = false;
            }
            ?>
        </div>

        <h2>How To</h2>
        <div class="how_to pb-5 row g-4">
            <?php
            $q = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'article-type',
                        'field'    => 'slug', // You can also use 'term_id' if you prefer
                        'terms'    => 'how-to', // The slug of the term
                    ),
                ),
            ));
            while ($q->have_posts()) {
                $q->the_post();
                ?>
                <div class="col-md-6">
                    <a href="<?=get_the_permalink()?>" class="how_to__card">
                        <?=get_the_post_thumbnail($q->ID,'large',['class' => 'how_to__image'])?>
                        <div class="how_to__inner">
                            <h3><?=get_the_title()?></h3>
                            <div class="how_to__excerpt <?=$mb?>"><?=wp_trim_words(get_the_content(null,false,$q->ID),12)?></div>
                        </div>
                    </a>
                </div>
                <?php
                $first = false;
            }
            ?>
        </div>
        <?php
        // there are no guides
        ?>
        <h2>Videos</h2>
        <div class="videos pb-5 row g-4">
            <?php
            $q = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'article-type',
                        'field'    => 'slug', // You can also use 'term_id' if you prefer
                        'terms'    => 'video', // The slug of the term
                    ),
                ),
            ));
            while ($q->have_posts()) {
                $q->the_post();
                ?>
                <div class="col-md-4">
                    <a href="<?=get_the_permalink()?>" class="videos__card">
                        <div class="videos__image_box">
                            <?=get_the_post_thumbnail($q->ID,'large',['class' => 'videos__image'])?>
                            <img src="<?=get_stylesheet_directory_uri()?>/img/icons/play-button.png" class="play" width="59" height="59">
                        </div>
                        <div class="videos__inner">
                            <h3><?=get_the_title()?></h3>
                            <div class="videos__excerpt <?=$mb?>"><?=wp_trim_words(get_the_content(null,false,$q->ID),12)?></div>
                        </div>
                    </a>
                </div>
                <?php
                $first = false;
            }
            ?>
        </div>
    </div>
    <?php
    set_query_var('grad', 'orange'); // Example value for 'theme'
    set_query_var('cta', array(
        'url' => '#',
        'target' => 'self',
        'title' => 'Get a Free Trial'
    ));
    set_query_var('title', 'Book a Demo Today');
    set_query_var('content', '<p>Protect your people with our dedicated personal safety service for at-risk and lone workers. Combining leading technology with a professional 24/7 Safety Monitoring Center, you can ensure your people get immediate emergency help when they need it most.
</p><h3>Alternatively, get a free trial of the app</h3><p>Want to try OK Alone? Click the button below and enter your details. It\'s free and no credit card is required.</p>');
    set_query_var('modal_trigger', array('Yes'));
    
    get_template_part('page-templates/blocks/cb_gradient_cta');
    ?>
 </main>
<?php

get_footer();