<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package cb-peoplesafe
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

?>

<div class="footer pb-3">
    <div class="container py-5">
        <div class="row px-4 px-md-0">
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <img
                    src="<?=get_stylesheet_directory_uri()?>/img/oka-logo--wo.svg">
                <div class="py-4">Part of Peoplesafe, the world's largest provider of personal safety technology.</div>
                <a href="/contact-us/" class="button button-yellow"><span>Get in touch</span></a>
                <div class="social mb-4">
                    <?=do_shortcode('[social_in_icon]')?>
                    <?=do_shortcode('[social_yt_icon]')?>
                    <?=do_shortcode('[social_tw_icon]')?>
                </div>
                <!-- div class="">
                    <div class="nav-title">Newsletter Sign Up</div>
                    <form target="_blank" method="GET" action="https://peoplesafe.co.uk/newsletter-signup/"
                        style="height: auto; display: inline;">
                        <div class="mb-3">
                            <label for="NewsletterEmail" class="form-label visually-hidden d-none">Email address</label>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="input-group">
                            <input type="email" class="form-control required" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Email address" required>
                            <button type="submit" class="btn btn-primary" style="font-weight: 400;">Sign Up</button>
                        </div>
                    </form>
                </div -->
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <div class="nav-title">Solutions</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_solutions')); ?>
                <div class="nav-title">Partners</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_partners')); ?>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start mb-4">
                <div class="nav-title">About OK Alone</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_about')); ?>
                <div class="nav-title">Sectors</div>
                <ul class="menu">
                    <?php
                    $parent = get_page_by_path('sectors');
                    $q = new WP_Query(array(
                        'post_type' => 'page',
                        'post_parent' => $parent->ID,
                        'posts_per_page' => -1,
                        'orderby' => 'name',
                        'order' => 'ASC',
                    ));
                    while ($q->have_posts()) {
                        $q->the_post();
                        $title = html_entity_decode(get_the_title());
                        echo '<li><a href="' . get_the_permalink() . '">' . $title . '</a></li>';
                    }
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3 text-center text-md-start">
                <div class="nav-title">Resources</div>
                <?php wp_nav_menu(array('theme_location' => 'footer_resources')); ?>
            </div>
        </div>
    </div>
    <div class="colophon">
        <div class="container d-flex justify-content-between flex-wrap py-2">
            <div>&copy; <?=date('Y')?> Peoplesafe Personal Safety Ltd - <a href="/work-alone-monitoring-terms/">Terms</a> - <a href="/work-alone-monitoring-privacy/">Privacy</a> - <a href="/fair-use-policy/">Fair Use Policy</a> - <a href="/gdpr/">GDPR/The Canadian Privacy Act</a></div>
            <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb"
                title="Digital Marketing by Chillibyte"></a>
        </div>
    </div>
</div>
<!-- modal_form -->
<div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title text-center mx-auto" id="demoLabel">
                    <div class="h3 text-black">Book a Demo</div>
                </div>
                <button type="button" class="btn-modal btn-close align-self-start" style="background:none;border:none"
                    data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div>To book a demo of any of our solutions or a consultation with one of our personal safety experts,
                    please fill in the form below.</div>
                <iframe loading="lazy" style="border: 0;" src="<?= esc_url( get_field( 'demo_form_url', 'option' ) ); ?>"
                    width="100%" height="1200" frameborder="0" scrolling="auto" id="myiframe"></iframe>
            </div>
        </div>
    </div>
</div>
</div><!-- #page -->
<div class="side-buttons side-buttons--right">
    <a href="/contact-us/">
        <div class="side-button enquire-button">Enquire</div>
    </a>
</div>

<script>
    // swiper equal height
    function setEqualHeight(slider) {
        // console.log('resizing '+slider);
        let maxHeight = 0;
        const slides = document.querySelectorAll(slider);

        // Remove existing heights to recalculate
        slides.forEach(slide => {
            slide.style.height = 'auto';
        });

        // Find the maximum height
        slides.forEach(slide => {
            if (slide.offsetHeight > maxHeight) {
                maxHeight = slide.offsetHeight;
            }
        });

        // Set all slides to the maximum height
        slides.forEach(slide => {
            slide.style.height = `${maxHeight}px`;
        });
    }
</script>
<?php wp_footer(); ?>
<!-- Start of okalone Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=ca494108-82b7-45fc-be22-331c70729459"> </script>
<!-- End of okalone Zendesk Widget script -->
</body>

</html>