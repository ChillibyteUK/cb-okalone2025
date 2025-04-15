<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'single-blog__image')) ?? null;
$cats = get_the_category();
$ids = wp_list_pluck($cats, 'term_id');
$catNames = wp_list_pluck($cats, 'name');
?>
<main id="main" class="single-blog">
    <?php
?>
    <section class="breadcrumbs container-xl">
        <?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
}
?>
    </section>
    <div class="container-xl">
        <div class="single-blog__post">
            <div class="single-blog__date">
                <?= get_the_date('F j, Y') ?>
            </div>
            <h1 class="single-blog__title"><?=get_the_title()?></h1>
            <?php
                $count = estimate_reading_time_in_minutes(get_the_content(), 200, true, true) ?? null;
                if ($count) {
                    // echo '<div class="fs-300">' . $count . '</div>';
                }

            ?>
            <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
                <?php
                foreach ($catNames as $cat) {
                    echo '<a href="' . get_category_link(get_cat_ID($cat)) . '" class="single-blog__category">' . $cat . '</a>';
                }
                ?>
            </div>
            <?=$img?>
            <div class="p-4">
            <?php
$content = get_the_content(); // Get raw content

// Check if the content has blocks
if (has_blocks($content)) {
    // Parse and safely render Gutenberg blocks
    $blocks = parse_blocks($content);
    $content = '';
    foreach ($blocks as $block) {
        // Ensure only valid blocks are rendered
        if (isset($block['blockName'])) {
            if ($block['blockName'] === 'core/embed') {
                $url = $block['attrs']['url'] ?? strip_tags($block['innerHTML']);
                $content .= '<div class="text-center py-4">' . wp_oembed_get($url) . '</div>' ?: render_block($block);
            } else {
                $content .= render_block($block);
            }
        } else {
            // Handle non-block content gracefully
            $content .= $block['innerHTML'] ?? '';
        }
    }
} else {
    // Apply content filters for non-block content
    $content = apply_filters('the_content', $content);
}

$content = wp_oembed_get($content) ?: $content;
$content = do_shortcode($content);

// Add class to the first paragraph
echo add_class_to_first_paragraph($content);
?>

            </div>
        </div>

        <div class="blog__related">
            <div class="h2 text-center d-none d-lg-block">Related Blogs</div>
            <div class="related__grid">
            <?php
        
        $r = new WP_Query(array(
            'category__in' => $ids,
            'posts_per_page' => 4,
            'post__not_in' => array(get_the_ID())
        ));
        while ($r->have_posts()) {
            $r->the_post();
            ?>
                <a class="related_card"
                    href="<?=get_the_permalink()?>">
                    <?=get_the_post_thumbnail(get_the_ID(), 'large', ['class' => 'related_card__image'] )?>
                    <div class="related_card__meta">
                        <?= get_the_date('F j, Y') ?>
                    </div>
                    <div class="related_card__content">
                        <h3 class="related_card__title">
                            <?=get_the_title()?>
                        </h3>
                    </div>
                    <div class="related_card__excerpt pb-4">
                        <?=wp_trim_words(get_the_content(), 20)?>
                    </div>
                </a>
            <?php
        }
        ?>
            </div>
        </div>
        <?php
        get_template_part('page-templates/blocks/cb_author_stacey');
        ?>
    </div>
    <section class="gradient_cta py-5 bg_grad--orange">
        <div class="gradient_cta__image" data-aos="fade" style="--bg-url:url('/wp-content/uploads/2025/04/woman-on-ok-alone-laptop.png')"></div>
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