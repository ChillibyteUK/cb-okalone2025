<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

$term = get_queried_object();
$term_slug = $term->slug;

$section_class = 'row';

if ($term_slug == 'video') {
    $section_class = 'row videos pb-5 g-4';
} elseif ($term_slug == 'how-to') { // fixed comparison
    $section_class = 'row how_to pb-5 g-4';
}

get_header();

// Set up custom query that disables Post Types Order
$args = [
    'post_type' => 'post',
    'tax_query' => [
        [
            'taxonomy' => 'article-type',
            'field'    => 'slug',
            'terms'    => $term_slug,
        ],
    ],
    'orderby' => 'date',
    'order'   => 'DESC',
    'ignore_custom_sort' => true,
    'paged' => get_query_var('paged') ?: 1,
];

$custom_query = new WP_Query($args);
?>
<main id="main" class="resources">
    <div class="container-xl pt-5">
        <h1><?php single_term_title(); ?></h1>

        <div class="taxonomy-description"><?php echo term_description(); ?></div>

        <?php
        if ($custom_query->have_posts()) {
            ?>
            <div class="<?=$section_class?>">
            <?php

            while ($custom_query->have_posts()) {
                $custom_query->the_post();

                if ($term_slug == 'video') {
                    ?>
            <div class="col-md-4">
                <a href="<?=get_the_permalink()?>" class="videos__card">
                    <div class="videos__image_box">
                        <?=get_the_post_thumbnail(get_the_ID(),'large',['class' => 'videos__image'])?>
                        <img src="<?=get_stylesheet_directory_uri()?>/img/icons/play-button.png" class="play" width="59" height="59">
                    </div>
                    <div class="videos__inner">
                        <h3><?=get_the_title()?></h3>
                        <div class="videos__excerpt"><?=wp_trim_words(get_the_content(null,false,get_the_ID()),12)?></div>
                    </div>
                </a>
            </div>
                    <?php
                }
                elseif ($term_slug == 'how-to') {
                    ?>
            <div class="col-md-6">
                <a href="<?=get_the_permalink()?>" class="how_to__card">
                    <?=get_the_post_thumbnail(get_the_ID(),'custom-thumb-275x184',['class' => 'how_to__image'])?>
                    <div class="how_to__inner">
                        <h3><?=get_the_title()?></h3>
                        <div class="how_to__excerpt"><?=wp_trim_words(get_the_content(null,false,get_the_ID()),12)?></div>
                    </div>
                </a>
            </div>
                    <?php
                }
                else {
                    ?>
            <article>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
            </article>
                    <?php
                }
            }

            // Display the pagination component.
            understrap_pagination(['total' => $custom_query->max_num_pages]);
        } else {
            ?>
            <p>No posts found.</p>
            <?php
        }

        wp_reset_postdata();
        ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
