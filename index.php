<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');
$bg = get_the_post_thumbnail_url($page_for_posts, 'full');

get_header();
?>
<main id="main">
    <div class="container-xl py-5">
        <h1 data-aos="fade-right">OK Alone Lone Worker Blog</h1>
        <div class="fw-bold">The latest news and stories from the lone worker sector.</div>
    </div>

    <div class="container-xl py-5">
        <?php
        if (get_the_content(null, false, $page_for_posts)) {
            echo '<div class="mb-5">' . get_the_content(null, false, $page_for_posts) . '</div>';
        }

        /*
        $cats = get_categories(array('exclude' => array(32)));
        ?>
        <div class="filters mb-4">
            <?php
        echo '<button class="btn btn-outline-primary active me-2 mb-2" data-filter="*">All</button>';
        foreach ($cats as $cat) {
            echo '<button class="btn btn-outline-primary me-2 mb-2" data-filter=".' . cbslugify($cat->name) . '">' . $cat->cat_name . '</button>';
        }
        ?>
        </div>
        <?php
        */
        ?>
        <div class="row w-100" id="newsGrid">
            <?php
            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                }
                $cats = get_the_category();
                $category = wp_list_pluck($cats, 'name');
                $flashcat = cbslugify($category[0]);
                $catClass = implode(' ', array_map('cbslugify', $category));
                $category = implode(', ', $category);

                if (has_category('event')) {
                    $the_date = get_field('start_date', get_the_ID());
                } else {
                    $the_date = get_the_date('jS F, Y');
                }

            ?>
                <div
                    class="grid_item col-lg-4 col-md-6 px-1 <?= $catClass ?>">
                    <a href="<?= get_the_permalink() ?>"
                        class="news_grid__item mb-2 mx-1"
                        style="background-image:url(<?= $img ?>)"
                        data-aos="fade">
                        <div class="overlay <?= $catClass ?>"></div>
                        <!-- div class="catflash <?= $catClass ?>">
                    <?= $flashcat ?>
            </div -->
                        <h3><?= get_the_title() ?></h3>
                        <div class="news_meta">
                            <div class="news_meta__date">
                                <?= get_the_date('j F Y') ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <!--        <div class="mt-5">
        <?php
        // numeric_posts_nav();
        ?>
    </div>
    -->
    </div>
</main>
<?php

get_footer();
?>