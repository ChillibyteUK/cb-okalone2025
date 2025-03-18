<section class="three_col_image_icon_cards py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            $d = 0;
            while (have_rows('cards')) {
                the_row();
                $l = get_sub_field('link') ?? null;
                $tag = !empty($l) ? 'a' : 'div';
                $href = !empty($l) ? ' href="' . esc_url($l['url']) . '" target="' . esc_attr($l['target']) . '"' : '';
                ?>
            <div class="col-md-4" data-aos="fade" data-aos-delay="<?=$d?>">
                <<?=$tag?> class="three_col_image_icon_cards__card"<?=$href?>>
                    <div class="three_col_image_icon_cards__image_container">
                        <?=wp_get_attachment_image(get_sub_field('image'),'large',false,['class' => 'three_col_image_icon_cards__image'])?>
                        <?=wp_get_attachment_image(get_sub_field('icon'),'large',false,['class' => 'three_col_image_icon_cards__icon'])?>
                    </div>
                    <h2 class="three_col_image_icon_cards__title h4 mb-0"><?=get_sub_field('title')?></h2>
                    <div class="three_col_image_icon_cards__content fs-300 text--mid-grey"><?=get_sub_field('content')?></div>
                    <?php if (!empty($l)): ?>
                        <div class="three_col_image_icon_cards__button button button-outline"><?=$l['title']?></div>
                    <?php endif; ?>
                </<?=$tag?>>
            </div>
                <?php
                $d += 200;
            }
            ?>
        </div>
    </div>
</section>
