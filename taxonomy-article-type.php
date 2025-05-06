<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

$term = get_queried_object();
$term_slug = $term->slug;

$section_class = 'row';

if ($term_slug == 'video') {
    $section_class = 'row videos pb-5 g-4';
} elseif ($term_slug == 'how-to') {
    $section_class = 'row how_to pb-5 g-4';
}

get_header();

// Build a custom query that disables Post Types Order and forces ordering by date
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

        <?php if ($custom_query->have_posts()) : ?>
            <div class="<?php echo esc_attr($section_class); ?>">
                <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

                    <?php if ($term_slug == 'video') : ?>
                        <div class="col-md-4">
                            <a href="<?php the_permalink(); ?>" class="videos__card">
                                <div class="videos__image_box">
                                    <?php the_post_thumbnail('large', ['class' => 'videos__image']); ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/play-button.png" class="play" width="59" height="59">
                                </div>
                                <div class="videos__inner">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="videos__excerpt"><?php echo wp_trim_words(get_the_content(), 12); ?></div>
                                </div>
                            </a>
                        </div>

                    <?php elseif ($term_slug == 'how-to') : ?>
                        <div class="col-md-6">
                            <a href="<?php the_permalink(); ?>" class="how_to__card">
                                <?php the_post_thumbnail('custom-thumb-275x184', ['class' => 'how_to__image']); ?>
                                <div class="how_to__inner">
                                    <h3><?php the_title(); ?></h3>
                                    <div class="how_to__excerpt"><?php echo wp_trim_words(get_the_content(), 12); ?></div>
                                </div>
                            </a>
                        </div>

                    <?php else : ?>
                        <article>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php the_excerpt(); ?></p>
                        </article>
                    <?php endif; ?>

                <?php endwhile; ?>

                <?php
                // Custom pagination function
                understrap_pagination([
                    'total' => $custom_query->max_num_pages,
                ]);
                ?>

            </div>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>

    </div>
</main>

<?php
// Reset global post data
wp_reset_postdata();

get_footer();
