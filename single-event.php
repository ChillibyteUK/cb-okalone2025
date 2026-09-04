<?php
/**
 * Single Event landing page.
 *
 * Uses the standard single-blog card styling, with an event detail block,
 * booth list, and the date-driven "Meet us there" form / post-event message.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$post_id      = get_the_ID();
$strapline    = get_field('event_strapline');
$logo         = get_field('event_logo');
$venue        = get_field('event_venue');
$city         = get_field('event_city');
$booth        = get_field('event_booth');
$official_url = get_field('event_official_url');
$date_range   = cb_event_date_range($post_id);
$is_past      = cb_event_is_past($post_id);
$img          = get_the_post_thumbnail($post_id, 'full', array('class' => 'single-blog__image'));
?>
<main id="main" class="single-blog single-event">

    <section class="breadcrumbs container-xl">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
        ?>
    </section>

    <div class="container-xl">
        <div class="single-blog__post">

            <?php // Co-branding lockup: event logo + OK Alone logo, booth beneath. ?>
            <div class="event-lockup text-center pt-4 px-3">
                <div class="event-lockup__logos d-flex align-items-center justify-content-center gap-3 gap-md-4 flex-wrap">
                    <?php if ($logo) : ?>
                        <img class="event-lockup__logo" src="<?= esc_url($logo['url']); ?>" alt="<?= esc_attr($logo['alt'] ?: get_the_title()); ?>">
                        <span class="event-lockup__divider" aria-hidden="true"></span>
                    <?php endif; ?>
                    <img class="event-lockup__logo event-lockup__logo--oka"
                         src="<?= esc_url(get_stylesheet_directory_uri() . '/img/oka-logo.svg'); ?>"
                         alt="OK Alone">
                </div>
                <?php // Booth is only actionable while the event is upcoming. ?>
                <?php if ($booth && ! $is_past) : ?>
                    <div class="event-lockup__booth mt-3">
                        <span class="event-lockup__booth-label">Find us at</span>
                        <span class="event-lockup__booth-value"><?= esc_html($booth); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($date_range && ! $is_past) : ?>
                <div class="single-blog__date"><?= esc_html($date_range); ?></div>
            <?php endif; ?>

            <h1 class="single-blog__title"><?php the_title(); ?></h1>

            <?php if ($strapline) : ?>
                <p class="single-event__strapline text-center px-4 mb-4"><?= esc_html($strapline); ?></p>
            <?php endif; ?>

            <?= $img; ?>

            <div class="p-4">

                <?php // Structured, visually distinct event detail block. ?>
                <aside class="event-facts p-4 mb-4" aria-label="Event details">
                    <div class="row g-3">
                        <?php if ($date_range) : ?>
                            <div class="col-sm-6 d-flex flex-column">
                                <span class="event-facts__label">Date</span>
                                <span class="event-facts__value"><?= esc_html($date_range); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($venue || $city) : ?>
                            <div class="col-sm-6 d-flex flex-column">
                                <span class="event-facts__label">Where</span>
                                <span class="event-facts__value">
                                    <?= esc_html(implode(', ', array_filter(array($venue, $city)))); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($official_url) : ?>
                            <div class="col-sm-6 d-flex flex-column">
                                <span class="event-facts__label">Event site</span>
                                <span class="event-facts__value">
                                    <a href="<?= esc_url($official_url); ?>" target="_blank" rel="noopener noreferrer">
                                        Visit the official website
                                        <i class="fa-solid fa-arrow-up-right-from-square ms-1" aria-hidden="true"></i>
                                    </a>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>

                <?php // Rich-text body (H2/H3 supported). ?>
                <div class="event-body mb-4">
                    <?php echo add_class_to_first_paragraph(cb_event_render_content(get_the_content())); ?>
                </div>

                <?php // "What you'll see at our booth". ?>
                <?php if (have_rows('event_booth_items')) : ?>
                    <section class="event-booth mb-4">
                        <?php $booth_heading = get_field('event_booth_heading'); ?>
                        <?php if ($booth_heading) : ?>
                            <h2><?= esc_html($booth_heading); ?></h2>
                        <?php endif; ?>
                        <ul class="event-booth__list list-unstyled row g-3 m-0">
                            <?php while (have_rows('event_booth_items')) : the_row();
                                $icon = get_sub_field('icon');
                                $text = get_sub_field('text');
                                ?>
                                <li class="col-sm-6 d-flex align-items-center gap-2">
                                    <?php if ($icon) : ?>
                                        <img class="event-booth__icon" src="<?= esc_url($icon['url']); ?>" alt="" aria-hidden="true">
                                    <?php else : ?>
                                        <span class="event-booth__icon event-booth__icon--bullet">
                                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        </span>
                                    <?php endif; ?>
                                    <span class="event-booth__text"><?= esc_html($text); ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php
                // "Meet us there" — form, or its post-event replacement.
                if (cb_event_form_is_visible($post_id)) :
                    $form_heading = get_field('event_form_heading') ?: 'Meet us there';
                    $form_embed   = get_field('event_form_embed');
                    $form_id      = get_field('event_form_id');
                    ?>
                    <section class="event-meet py-4" id="meet-us-there">
                        <h2><?= esc_html($form_heading); ?></h2>
                        <?php
                        if (! empty($form_embed)) {
                            // Pardot (or other) embed code.
                            echo '<div class="event-meet__embed js-form-embed">' . cb_event_embed_kses($form_embed) . '</div>';
                        } elseif ($form_id && function_exists('gravity_form')) {
                            // Legacy Gravity Form.
                            gravity_form((int) $form_id, false, true, false, null, true);
                        }
                        ?>
                    </section>
                <?php
                else :
                    $pe_heading = get_field('event_postevent_heading');
                    $pe_text    = get_field('event_postevent_text');
                    $pe_cta     = get_field('event_postevent_cta');

                    // Only render the block if there is something to show — keeps
                    // the layout clean with no empty gap when nothing is set.
                    if ($pe_heading || $pe_text || $pe_cta) :
                        ?>
                        <section class="event-meet py-4 text-center">
                            <?php if ($pe_heading) : ?>
                                <h2><?= esc_html($pe_heading); ?></h2>
                            <?php endif; ?>
                            <?php if ($pe_text) : ?>
                                <div class="mb-4"><?= wp_kses_post($pe_text); ?></div>
                            <?php endif; ?>
                            <?php if ($pe_cta && ! empty($pe_cta['url'])) : ?>
                                <a href="<?= esc_url($pe_cta['url']); ?>"
                                   class="button button-yellow"
                                   target="<?= esc_attr($pe_cta['target'] ?: '_self'); ?>">
                                    <span><?= esc_html($pe_cta['title'] ?: 'Find out more'); ?></span>
                                </a>
                            <?php endif; ?>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>

            </div><!-- .p-4 -->
        </div><!-- .single-blog__post -->

        <?php // Optional related content, styled like the blog related grid. ?>
        <?php
        $related = get_field('event_related');
        if ($related) :
            ?>
            <div class="blog__related">
                <div class="h2 text-center d-none d-lg-block">Related</div>
                <div class="related__grid">
                    <?php foreach ($related as $rel) :
                        $rel_id   = is_object($rel) ? $rel->ID : (int) $rel;
                        $rel_meta = ('event' === get_post_type($rel_id)) ? cb_event_date_range($rel_id) : get_the_date('F j, Y', $rel_id);
                        ?>
                        <a class="related_card" href="<?= esc_url(get_permalink($rel_id)); ?>">
                            <?= get_the_post_thumbnail($rel_id, 'large', array('class' => 'related_card__image')); ?>
                            <?php if ($rel_meta) : ?>
                                <div class="related_card__meta"><?= esc_html($rel_meta); ?></div>
                            <?php endif; ?>
                            <h3 class="related_card__title"><?= esc_html(get_the_title($rel_id)); ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div><!-- .container-xl -->

    <?php
    // Site-standard gradient CTA.
    set_query_var('grad', 'orange');
    set_query_var('title', 'Book a Demo Today');
    set_query_var('content', '<p>Protect your people with our dedicated personal safety service for at-risk and lone workers. Combining leading technology with a professional 24/7 Safety Monitoring Center, you can ensure your people get immediate emergency help when they need it most.</p>');
    set_query_var('cta', null);
    set_query_var('modal_trigger', array('Yes'));
    get_template_part('page-templates/blocks/cb_gradient_cta');
    ?>

</main>
<?php
get_footer();
