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

// Force correct order and disable Post Types Order
query_posts(array_merge($wp_query->query, array(
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_custom_sort' => true
)));
?>
<main id="main" class="resources">
    <div class="container-xl pt-5">
        <h1><?php single_term_title(); ?></h1>

        <div class="taxonomy-description"><?php echo term_description(); ?></div>

        <?php 
        if (have_posts()) {
            ?>
            <div class="<?php echo $section_class; ?>">
            <?php

            while (have_posts()) {
                the_post();

                if ($term_slug == 'video') {
                    ?>
                <div class="col-md-4">
                    <a href="<?php echo get_the_permalink(); ?>" class="videos__card">
                        <div class="videos__image_box">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'videos__image')); ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/play-button.png" class="play" width="59" height="59">
                        </div>
                        <div class="videos__inner">
                            <h3><?php echo get_the_title(); ?></h3>
                            <div class="videos__excerpt"><?php echo wp_trim_words(get_the_content(null, false, get_the_ID()), 12); ?></div>
                        </div>
                    </a>
                </div>
                    <?php
                } elseif ($term_slug == 'how-to') {
                    ?>
                <div class="col-md-6">
                    <a href="<?php echo get_the_permalink(); ?>" class="how_to__card">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'custom-thumb-275x184', array('class' => 'how_to__image')); ?>
                        <div class="how_to__inner">
                            <h3><?php echo get_the_title(); ?></h3>
                            <div class="how_to__excerpt"><?php echo wp_trim_words(get_the_content(null, false, get_the_ID()), 12); ?></div>
                        </div>
                    </a>
                </div>
                    <?php
                } else {
                    ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </article>
                    <?php
                }
            }

            // Display the pagination component.
            understrap_pagination();
        } else {
            ?>
            <p>No posts found.</p>
            <?php
        }

        wp_reset_query();
        ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
