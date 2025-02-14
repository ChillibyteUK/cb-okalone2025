<section class="img_title_text_cards py-5">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <h2 class="text-center"><?=get_field('title')?></h2>
            <?php
        }
        ?>
        <div class="row g-4 justify-content-center">
            <?php
            if (have_rows('cards')) {
                while (have_rows('cards')) {
                    the_row();
                    $l = get_sub_field('url');
                    ?>
                    <div class="col-md-4">
                        <?php
                        if ($l) {
                            ?>
                            <a class="img_title_text_cards__card" href="<?= esc_url($l) ?>">
                            <?php
                        } else {
                            ?>
                            <div class="img_title_text_cards__card">
                            <?php
                        }
                        ?>
                        <?= wp_get_attachment_image(get_sub_field('image'), 'large', false, ['class' => 'img_title_text_cards__image']) ?>
                        <div class="h4 mb-0"><?= esc_html(get_sub_field('title')) ?></div>
                        <?php
                        if ($content = get_sub_field('content')) {
                            ?>
                            <div class="fs-300 text--mid-grey"><?= esc_html($content) ?></div>
                            <?php
                        }
                        if ($l) {
                            ?>
                            </a>
                            <?php
                        } else {
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                <?php
                }
            }
            ?>
        </div>
    </div>
</section>
