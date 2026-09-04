<?php
/**
 * Single Webinar.
 *
 * One template, two states via `webinar_state` (Auto / Upcoming / On-demand):
 * Upcoming shows the registration form; On-demand shows the recording. Header,
 * detail, speakers and body are shared so a page moves from one to the other
 * as a content edit.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$post_id     = get_the_ID();
$subhead     = get_field('webinar_subhead');
$timezones   = get_field('webinar_timezones');
$duration    = get_field('webinar_duration');
$date_full   = cb_webinar_date($post_id, 'l, j F Y');
$date_short  = cb_webinar_date($post_id, 'j M Y');
$is_ondemand = cb_webinar_is_ondemand($post_id);
$speakers    = get_field('webinar_speakers');
?>
<main id="main" class="single-blog single-webinar">

    <section class="breadcrumbs container-xl">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        }
        ?>
    </section>

    <div class="container-xl">
        <div class="single-blog__post">

            <?php if ($date_short) : ?>
                <div class="single-blog__date">
                    <?= esc_html($date_short); ?><?php if (! $is_ondemand) : ?> · Live webinar<?php else : ?> · On-demand<?php endif; ?>
                </div>
            <?php endif; ?>

            <h1 class="single-blog__title"><?php the_title(); ?></h1>

            <?php if ($subhead) : ?>
                <p class="single-webinar__subhead text-center px-4 mb-4"><?= esc_html($subhead); ?></p>
            <?php endif; ?>

            <div class="p-4">

                <?php // Structured detail block. ?>
                <aside class="webinar-facts p-4 mb-4" aria-label="Webinar details">
                    <div class="row g-3">
                        <?php if ($date_full) : ?>
                            <div class="col-sm-4 d-flex flex-column">
                                <span class="webinar-facts__label">Date</span>
                                <span class="webinar-facts__value"><?= esc_html($date_full); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($timezones) : ?>
                            <div class="col-sm-4 d-flex flex-column">
                                <span class="webinar-facts__label">Time</span>
                                <span class="webinar-facts__value"><?= esc_html($timezones); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($duration) : ?>
                            <div class="col-sm-4 d-flex flex-column">
                                <span class="webinar-facts__label">Duration</span>
                                <span class="webinar-facts__value"><?= esc_html($duration); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>

                <?php // Speakers. ?>
                <?php if ($speakers) : ?>
                    <section class="webinar-speakers mb-4">
                        <h2><?= count($speakers) > 1 ? 'Speakers' : 'Speaker'; ?></h2>
                        <div class="row g-4">
                            <?php foreach ($speakers as $sp) :
                                $meta = array_filter(array($sp['job_title'] ?? '', $sp['company'] ?? ''));
                                ?>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="webinar-speaker d-flex align-items-center gap-3">
                                        <?php if (! empty($sp['headshot']['url'])) : ?>
                                            <img class="webinar-speaker__photo"
                                                 src="<?= esc_url($sp['headshot']['sizes']['thumbnail'] ?? $sp['headshot']['url']); ?>"
                                                 alt="<?= esc_attr($sp['headshot']['alt'] ?: $sp['name']); ?>">
                                        <?php endif; ?>
                                        <span class="webinar-speaker__meta">
                                            <span class="webinar-speaker__name"><?= esc_html($sp['name']); ?></span>
                                            <?php if ($meta) : ?>
                                                <span class="webinar-speaker__role"><?= esc_html(implode(', ', $meta)); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php
                // On-demand: responsive YouTube recording, above the body copy.
                if ($is_ondemand) :
                    $youtube = get_field('webinar_youtube');
                    if ($youtube) :
                        $oembed = wp_oembed_get($youtube);
                        if ($oembed) :
                            ?>
                            <div class="webinar-video ratio ratio-16x9 mb-4"><?= $oembed; ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php // Body copy (H2/H3 supported). ?>
                <div class="webinar-body mb-4">
                    <?php echo add_class_to_first_paragraph(cb_event_render_content(get_the_content())); ?>
                </div>

                <?php // What you'll learn. ?>
                <?php if (have_rows('webinar_learn_items')) : ?>
                    <section class="webinar-learn mb-4">
                        <?php $learn_heading = get_field('webinar_learn_heading'); ?>
                        <?php if ($learn_heading) : ?>
                            <h2><?= esc_html($learn_heading); ?></h2>
                        <?php endif; ?>
                        <ul class="webinar-learn__list list-unstyled row g-3 m-0">
                            <?php while (have_rows('webinar_learn_items')) : the_row(); ?>
                                <li class="col-sm-6 d-flex align-items-start gap-2">
                                    <span class="webinar-learn__icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                    <span class="webinar-learn__text"><?= esc_html(get_sub_field('text')); ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                <?php endif; ?>

                <?php
                if ($is_ondemand) :
                    // Optional (non-gated) CTA below the recording.
                    $cta_heading = get_field('webinar_cta_heading');
                    $cta_text    = get_field('webinar_cta_text');
                    $cta_link    = get_field('webinar_cta');
                    if ($cta_heading || $cta_text || $cta_link) :
                        ?>
                        <section class="webinar-cta py-4 text-center">
                            <?php if ($cta_heading) : ?>
                                <h2><?= esc_html($cta_heading); ?></h2>
                            <?php endif; ?>
                            <?php if ($cta_text) : ?>
                                <div class="mb-3"><?= wp_kses_post($cta_text); ?></div>
                            <?php endif; ?>
                            <?php if ($cta_link && ! empty($cta_link['url'])) : ?>
                                <a href="<?= esc_url($cta_link['url']); ?>"
                                   class="button button-yellow"
                                   target="<?= esc_attr($cta_link['target'] ?: '_self'); ?>">
                                    <span><?= esc_html($cta_link['title'] ?: 'Find out more'); ?></span>
                                </a>
                            <?php endif; ?>
                        </section>
                    <?php endif; ?>
                <?php
                else :
                    // Upcoming: registration form (Pardot embed).
                    $form_heading = get_field('webinar_form_heading') ?: 'Register for this webinar';
                    $form_embed   = get_field('webinar_form_embed');
                    if ($form_embed) :
                        ?>
                        <section class="webinar-register py-4" id="webinar-register">
                            <h2><?= esc_html($form_heading); ?></h2>
                            <div class="webinar-register__embed js-form-embed"><?= cb_event_embed_kses($form_embed); ?></div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>

            </div><!-- .p-4 -->
        </div><!-- .single-blog__post -->
    </div><!-- .container-xl -->

    <?php
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
