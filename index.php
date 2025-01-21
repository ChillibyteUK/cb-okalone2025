<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');
$bg = get_the_post_thumbnail_url($page_for_posts, 'full');

get_header();
?>
<main id="main">
    <div class="container-xl py-5 mt-5">
        <h1 data-aos="fade-right">OK Alone Lone Worker Blog</h1>
        <div class="fw-bold">The latest news and stories from the lone worker sector.</div>
    </div>

    <div class="container-xl pb-5">
        <div class="blog_grid mb-4">
        <?php
$post_count = 0;

while (have_posts()) {
    the_post();
    $post_count++;
    $first_post_class = (!is_paged() && $post_count === 1) ? 'first-post' : '';

    $img = get_the_post_thumbnail(get_the_ID(), 'large') ?? null;
    $cats = get_the_category();
    $category = wp_list_pluck($cats, 'name');
    $flashcat = cbslugify($category[0]);
    $catClass = implode(' ', array_map('cbslugify', $category));
    $category = implode(', ', $category);
?>
    <a href="<?= get_the_permalink() ?>" class="blog_card mb-2 mx-1 <?=$first_post_class?>">
        <div class="blog_card__image">
            <?= $img ?>
        </div>
        <div class="blog_card__flash">Blog</div>
        <div class="blog_card__meta">
            <?= get_the_date('F j, Y') ?>
        </div>
        <h2 class="blog_card__title"><?= get_the_title() ?></h2>
        <div class="blog_card__excerpt">
            <?=wp_trim_words(get_the_content(), 20)?>
            <div class="blog_card__button">Read More</div>
        </div>
    </a>
<?php
}
?>
        </div>
        <?= understrap_pagination() ?>
    </div>
    <section class="gradient_cta py-5 bg_grad--orange">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 aos-init aos-animate" data-aos="fade-left">
                    <h2>Book a Demo Today</h2>
                    <div class="mb-4">
                        Protect your people with our dedicated personal safety service for at-risk and lone workers. Combining leading technology with a professional 24/7 Safety Monitoring Center, you can ensure your people get immediate emergency help when they need it most.<br>
                        <br>
                        <h3 class="mb-0">Alternatively, get a free trial of the app</h3><br>
                        Want to try OK Alone? Click the button below and enter your details. It's free and no credit card is required.</div>
                        <button type="button" class="button button-outline" data-bs-toggle="modal" data-bs-target="#demoModal">Book a Demo</button>
                        <a href="#" target="" class="button button-outline">Get a Free Trial</a>
                    </div>
            </div>
        </div>
    </section>
</main>
<?php

get_footer();
?>