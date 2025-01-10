<section class="sector_slider py-5">
    <div class="container-xl" data-aos="fade">
        <h2 class="text-center"><?= get_field('title') ?></h2>
        <p class="text-center mb-4"><?= get_field('intro') ?></p>
        <?php
        $parent_page = get_page_by_path('sectors');

        if ($parent_page) {
            $args = [
                'post_type'      => 'page',
                'post_parent'    => $parent_page->ID,
                'posts_per_page' => -1, // Retrieve all child pages
                'orderby'        => 'menu_order',
                'order'          => 'ASC'
            ];

            $child_pages = new WP_Query($args);

            if ($child_pages->have_posts()) {
        ?>
                <div class="swiper sector_slider__slider mb-4" data-aos="fade">
                    <div class="swiper-wrapper">
                        <?php
                        while ($child_pages->have_posts()) {
                            $child_pages->the_post();
                        ?>
                            <a class="swiper-slide sector_slider__slide" href="<?= get_the_permalink() ?>">
                                <div class="sector_slider__image">
                                    <?= get_the_post_thumbnail(get_the_ID(), 'large') ?>
                                </div>
                                <div class="sector_slider__inner">
                                    <h3><?= get_the_title() ?></h3>
                                </div>
                            </a>
                        <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <div class="swiper-pagination swiper-pagination-sectors"></div>
                </div>
        <?php
            } else {
                echo 'No child pages found.';
            }
        } else {
            echo 'Parent page "/sectors/" not found.';
        }

        ?>
        <div class="text-center">
            <a href="/sectors/" class="button button-outline">View all Industries</a>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var logoSlider = new Swiper('.sector_slider__slider', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination-sectors',
                    dynamicBullets: true,
                },
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 18,
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 18,
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 18,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 18,
                    }
                }
            });
        });
    </script>
<?php
}, 9999);
