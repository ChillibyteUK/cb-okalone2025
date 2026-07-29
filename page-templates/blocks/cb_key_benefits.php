<?php
/**
 * Key Benefits block.
 *
 * @package cb-okalone2025
 */

defined('ABSPATH') || exit;

$strapline = get_field('strapline');
$title     = get_field('title');
$cards     = get_field('cards');

$block_id = !empty($block['anchor'])
    ? sanitize_title($block['anchor'])
    : wp_unique_id('key-benefits-');

$classes = array('key-benefits');

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
        <?php if ($strapline || $title) : ?>
            <div class="key-benefits__header text-center mx-auto">

                <?php if ($strapline) : ?>
                    <div class="key-benefits__strapline d-inline-flex align-items-center">
                        <span class="key-benefits__strapline-line"></span>

                        <span>
                            <?= esc_html($strapline); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h2 class="key-benefits__title">
                        <?= esc_html($title); ?>
                    </h2>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if ($cards) : ?>
            <div class="row g-4 justify-content-center key-benefits__cards">

                <?php foreach ($cards as $card) :
                    $icon       = $card['icon'] ?? null;
                    $card_title = $card['title'] ?? '';
                    $text       = $card['text'] ?? '';
                    ?>

                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="key-benefits__card h-100">

                            <?php if ($icon) : ?>
                                <div class="key-benefits__icon d-flex align-items-center justify-content-center">
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

                            <?php if ($card_title) : ?>
                                <h3 class="key-benefits__card-title h5">
                                    <?= esc_html($card_title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($text) : ?>
                                <div class="key-benefits__text">
                                    <?= wp_kses_post(wpautop($text)); ?>
                                </div>
                            <?php endif; ?>

                        </article>
                    </div>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>
</section>