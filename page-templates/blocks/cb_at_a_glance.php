<?php
/**
 * CB At a Glance block.
 *
 * @package cb-okalone2025
 */

defined('ABSPATH') || exit;

$strapline = get_field('strapline');
$headline  = get_field('headline');
$text      = get_field('text');

$glance_stat_1      = get_field('glance_stat_1');
$glance_strapline_1 = get_field('glance_strapline_1');
$glance_stat_2      = get_field('glance_stat_2');
$glance_strapline_2 = get_field('glance_strapline_2');
$glance_points      = get_field('glance_points');

$block_id = !empty($block['anchor'])
    ? sanitize_title($block['anchor'])
    : wp_unique_id('cb-at-a-glance-');

$classes = array('cb-at-a-glance');

if (!empty($block['className'])) {
    $classes[] = sanitize_html_class($block['className']);
}

if (!empty($block['align'])) {
    $classes[] = 'align' . sanitize_html_class($block['align']);
}
?>

<section
    id="<?= esc_attr($block_id); ?>"
    class="<?= esc_attr(implode(' ', $classes)); ?>"
>

    <div class="container-xl position-relative">
        <div class="row g-5 align-items-top">

            <div class="col-12 col-lg-7">
                <div class="cb-at-a-glance__content">

                    <?php if ($strapline) : ?>
                        <div class="cb-at-a-glance__strapline d-inline-flex align-items-center mt-5 mt-lg-0">
                            <span class="cb-at-a-glance__strapline-dot"></span>
                            <span><?= esc_html($strapline); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($headline) : ?>
                        <h1 class="cb-at-a-glance__headline">
                            <?= wp_kses_post($headline); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="cb-at-a-glance__text">
                            <?= wp_kses_post(wpautop($text)); ?>
                        </div>
                    <?php endif; ?>

                    <div class="cb-at-a-glance__buttons d-flex flex-column flex-sm-row flex-wrap">

                            <button
                                class="button button-yellow text-center"
                                 data-bs-toggle="modal" data-bs-target="#newSectionsModal"
                            >
                                <span>Partner with Us</span>
                            </button>
                            <button
                                class="button button-outline text-center"
                                 data-bs-toggle="modal" data-bs-target="#newSectionsModal"
                            >
                                <span>Talk to Our Team</span>
                            </button>

                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-5">
                <aside class="cb-at-a-glance__panel">

                    <div class="cb-at-a-glance__panel-label">
                        At a glance
                    </div>

                    <?php if (
                        $glance_stat_1 ||
                        $glance_strapline_1 ||
                        $glance_stat_2 ||
                        $glance_strapline_2
                    ) : ?>
                        <div class="row g-3 cb-at-a-glance__stats">

                            <div class="col-6">
                                <div class="cb-at-a-glance__stat h-100 text-center">
                                    <?php if ($glance_stat_1) : ?>
                                        <div class="cb-at-a-glance__stat-value fs-4">
                                            <?= esc_html($glance_stat_1); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($glance_strapline_1) : ?>
                                        <div class="cb-at-a-glance__stat-label">
                                            <?= esc_html($glance_strapline_1); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="cb-at-a-glance__stat h-100 text-center">
                                    <?php if ($glance_stat_2) : ?>
                                        <div class="cb-at-a-glance__stat-value fs-4">
                                            <?= esc_html($glance_stat_2); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($glance_strapline_2) : ?>
                                        <div class="cb-at-a-glance__stat-label">
                                            <?= esc_html($glance_strapline_2); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                    <?php if ($glance_points) : ?>
                        <div class="cb-at-a-glance__points">

                            <?php foreach ($glance_points as $point) :
                                $icon        = $point['icon'] ?? null;
                                $point_title = $point['title'] ?? '';
                                $point_text  = $point['text'] ?? '';
                                ?>

                                <div class="cb-at-a-glance__point d-flex align-items-center">

                                    <?php if ($icon) : ?>
                                        <div class="cb-at-a-glance__point-icon d-flex align-items-center justify-content-center">
                                            <?= wp_get_attachment_image(
                                                $icon['ID'],
                                                'thumbnail',
                                                false,
                                                array(
                                                    'class'   => 'img-fluid',
                                                    'loading' => 'lazy',
                                                    'alt'     => $icon['alt'] ?: $point_title,
                                                )
                                            ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="cb-at-a-glance__point-content">
                                        <?php if ($point_title) : ?>
                                            <div class="cb-at-a-glance__point-title">
                                                <?= esc_html($point_title); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($point_text) : ?>
                                            <div class="cb-at-a-glance__point-text">
                                                <?= esc_html($point_text); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>

                </aside>
            </div>

        </div>
    </div>
</section>