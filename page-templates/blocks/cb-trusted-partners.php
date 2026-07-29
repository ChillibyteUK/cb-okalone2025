<?php
/**
 * Logo slider block.
 */

defined( 'ABSPATH' ) || exit;

$title = get_field( 'title' ) ?: 'Trusted partners';
$logos = get_field( 'logos' );

if ( empty( $logos ) || ! is_array( $logos ) ) {
    return;
}
?>

<section class="partner-strip">
    <div class="container-xl">

        <div class="partner-strip__inner">

            <div class="partner-strip__heading" data-aos="fade">
                <span><?php echo esc_html( $title ); ?></span>
            </div>

            <div
                class="swiper partner-strip__slider"
                data-aos="fade"
                data-aos-delay="100"
            >
                <div class="swiper-wrapper">

                    <?php foreach ( $logos as $logo_id ) : ?>
                        <div class="swiper-slide partner-strip__slide">
                            <div class="partner-strip__logo">
                                <?php
                                echo wp_get_attachment_image(
                                    $logo_id,
                                    'large',
                                    false,
                                    [
                                        'loading' => 'lazy',
                                    ]
                                );
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

        <?php if ( get_field( 'show_case_study_link' ) ) : ?>
            <div class="partner-strip__link text-center" data-aos="fade" data-aos-delay="200">
                <a href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>" class="button button-yellow">
                    <span>View our case studies</span>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
add_action(
    'wp_footer',
    function () {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.partner-strip__slider').forEach(function (slider) {
                    new Swiper(slider, {
                        loop: true,
                        speed: 650,
                        grabCursor: true,
                        watchOverflow: true,

                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true
                        },

                        slidesPerView: 1.4,
                        slidesPerGroup: 1,
                        spaceBetween: 12,

                        breakpoints: {
                            480: {
                                slidesPerView: 2.2,
                                spaceBetween: 12
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 14
                            },
                            992: {
                                slidesPerView: 4,
                                spaceBetween: 14
                            },
                            1200: {
                                slidesPerView: 5,
                                spaceBetween: 16
                            }
                        }
                    });
                });
            });
        </script>
        <?php
    },
    9999
);