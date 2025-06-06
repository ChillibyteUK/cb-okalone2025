<section class="top_tab_group py-5">
    <div class="container-xl">
        <div class="top_tab_group__inner">
            <?php
            $i = 'x' . random_str(4);
            $active = 'active';
            $c = 1;
            $d = 0;
            $fade = 'data-aos="fade" data-aos-delay="' . $d . '"';
            while (have_rows('tabs')) {
                the_row();


                $icon = wp_get_attachment_image_url(get_sub_field('tab_icon'), 'medium', false);
                $tab_title = get_sub_field('tab_title');
                $pre_title = get_sub_field('pre_title');
                $link = get_sub_field('link') ?? null;
                $image = wp_get_attachment_image(get_sub_field('image'), 'large', false, array('class' => 'content__image', 'width' => 500, 'height' => 500, 'alt' => $tab_title));
            ?>
                <div data-aos="fade" data-aos-delay="<?= $d ?>">
                    <div class="pill <?= $active ?>" aria-controls="<?= $i ?>_tab_<?= $c ?>">
                        <img class="pill__icon" src="<?= $icon ?>">
                        <div class="pill__title"><?= $tab_title ?></div>
                    </div>
                </div>
                <div class="content <?= $active ?>" id="<?= $i ?>_tab_<?= $c ?>" <?= $fade ?>>
                    <?= $image ?>
                    <div class="content__inner">
                        <div class="fs-300 fw-900 text--orange-400"><?= $pre_title ?></div>
                        <h2><?= get_sub_field('title') ?></h2>
                        <p><?= get_sub_field('content') ?></p>
                        <?php
                        if (!empty($link)) {
                            ?>
                        <a href="<?= $link['url'] ?>" class="button button-outline mb-2"><?= $link['title'] ?></a>
                            <?php
                        }
                        $demo = get_sub_field('book_demo') ?? null;
                        if (!empty($demo)) {
                            ?>
                            <button type="button" class="button button-yellow mb-2 me-2 text-center w-100 w-md-auto d-inline" data-bs-toggle="modal" data-bs-target="#demoModal"><span>Book a Demo</span></button>
                            <?php
                        }
        
                        ?>
                    </div>
                </div>
            <?php
                $c++;
                $d += 50;
                $active = '';
                $fade = '';
            }
            ?>
        </div>
    </div>
</section>