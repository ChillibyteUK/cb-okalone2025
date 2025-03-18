<?php
/*
 * Template Name: Bloglike
 */

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
        <div class="row g-5">
            <div class="col-md-9">
        <div class="single-blog__post pt-0">
            <?=$img?>
            <h1 class="single-blog__title pt-4 pb-0"><?=get_the_title()?></h1>
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
        </div>
        <div class="col-md-3">
            <div class="single-blog__sidebar">
                <h3 class="todo">Sidebar</h3>
            </div>
        </div>
        </div>


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