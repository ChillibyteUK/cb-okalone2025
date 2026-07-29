<?php
/**
 * CB Detailed Card block.
 *
 * @package cb-okalone2025
 */

defined('ABSPATH') || exit;

$strapline = get_field('strapline');
$header    = get_field('header');
$text      = get_field('text');
$cards     = get_field('cards');

$block_id = !empty($block['anchor'])
    ? sanitize_title($block['anchor'])
    : wp_unique_id('cb-detailed-card-');

$classes = array('cb-detailed-card');

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
    <div class="container-xl">

        <?php if ($strapline || $header || $text) : ?>
            <div class="cb-detailed-card__header text-center mx-auto">

                <?php if ($strapline) : ?>
                    <div class="cb-detailed-card__strapline d-inline-flex align-items-center">
                        <span class="cb-detailed-card__strapline-line"></span>

                        <span>
                            <?= esc_html($strapline); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($header) : ?>
                    <h2 class="cb-detailed-card__title">
                        <?= esc_html($header); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="cb-detailed-card__intro mx-auto">
                        <?= wp_kses_post(wpautop($text)); ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if ($cards) : ?>
            <div class="row g-4 cb-detailed-card__cards">

                <?php foreach ($cards as $card) :
                    $icon           = $card['icon'] ?? null;
                    $card_strapline = $card['strapline'] ?? '';
                    $card_title     = $card['title'] ?? '';
                    $card_text      = $card['text'] ?? '';
                    $bullets        = $card['bullets'] ?? '';
                    $ideal          = $card['ideal'] ?? '';
                    ?>

                    <div class="col-12 col-lg-6">
                        <article class="cb-detailed-card__card h-100">

                            <?php if ($icon || $card_strapline) : ?>
                                <div class="cb-detailed-card__card-top d-flex align-items-center">

                                    <?php if ($icon) : ?>
                                        <div class="cb-detailed-card__icon d-flex align-items-center justify-content-center">
                                            <?= wp_get_attachment_image(
                                                $icon['ID'],
                                                'thumbnail',
                                                false,
                                                array(
                                                    'class'   => 'img-fluid',
                                                    'loading' => 'lazy',
                                                    'alt'     => $icon['alt'] ?: $card_title,
                                                )
                                            ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($card_strapline) : ?>
                                        <div class="cb-detailed-card__card-strapline">
                                            <?= esc_html($card_strapline); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                            <?php if ($card_title) : ?>
                                <h3 class="cb-detailed-card__card-title h5">
                                    <?= esc_html($card_title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($card_text) : ?>
                                <div class="cb-detailed-card__card-text">
                                    <?= wp_kses_post(wpautop($card_text)); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($bullets) : ?>
                                <div class="cb-detailed-card__bullets">
                                    <?= wp_kses_post($bullets); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($ideal) : ?>
                                <div class="cb-detailed-card__ideal">
                                    <strong>Ideal for:</strong>
                                    <?= esc_html($ideal); ?>
                                </div>
                            <?php endif; ?>

                            <button data-bs-toggle="modal" data-bs-target="#newSectionsModal" class="button button-yellow text-center w-100 mt-3">APPLY</button>

                        </article>
                    </div>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>