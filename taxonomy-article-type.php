<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

$term = get_queried_object();
$term_slug = $term->slug;

$section_class = 'row';

if ($term_slug == 'video') {
    $section_class = 'row videos pb-5 g-4';
} elseif ($term_slug == 'how-to' || $term_slug == 'blog') {
    $section_class = 'row how_to pb-5 g-4';
}

get_header();

// Force correct order and disable Post Types Order interference
global $wp_query;
$search_term = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

query_posts(array_merge($wp_query->query, array(
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_custom_sort' => true,
    's' => $search_term,
)));
?>
 <main id="main" class="resources">
    <div class="container-xl pt-5">
        <h1><?php single_term_title(); ?></h1>

        <div class="taxonomy-description"><?php echo term_description(); ?></div>

            <form class="d-flex mb-4" role="search" method="get" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search articles..." aria-label="Search" value="<?php echo esc_attr(get_query_var('search')); ?>">
                <button class="button button-yellow" type="submit">Search</button>
            </form>

<?php
if ($term_slug == 'how-to') {
?>
            <div class="<?=$section_class?>">
                <div class="col-md-6">
                    <a href="/resources/lone-worker-risk-assessment-guide/" class="button button-yellow w-100">Free Lone Working Policy Template</a>
                </div>
                <div class="col-md-6">
                    <a href="/ok-alone-risk-assesment-guide/" class="button button-yellow w-100">Free Risk Assessment Guide</a>
                </div>
            </div>
<?php
}
?>
        
            <?php 

            if (have_posts()) {
                ?>
                <div class="<?=$section_class?>">
                <?php

                while (have_posts()) {
                    the_post();

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
                    elseif ($term_slug == 'how-to' || $term_slug == 'blog') {
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
                understrap_pagination();
            } else {
                ?>
                <p>No posts found.</p>
                <?php
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
