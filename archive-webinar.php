<?php
/**
 * Webinars listing / archive at /resources/webinars/.
 *
 * Upcoming webinars first (soonest), then On-demand recordings (most recent),
 * split by the effective webinar state.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$search_term = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';

$webinars_query = new WP_Query(array(
    'post_type'      => 'webinar',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => 'webinar_datetime',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    's'              => $search_term,
));

$upcoming  = array();
$ondemand  = array();

if ($webinars_query->have_posts()) {
    foreach ($webinars_query->posts as $webinar_post) {
        if (cb_webinar_is_ondemand($webinar_post->ID)) {
            $ondemand[] = $webinar_post;
        } else {
            $upcoming[] = $webinar_post;
        }
    }
}
// On-demand: most recent first.
$ondemand = array_reverse($ondemand);

/**
 * Render a single webinar card.
 *
 * @param WP_Post $webinar_post The webinar.
 */
if (! function_exists('cb_render_webinar_card')) :
function cb_render_webinar_card($webinar_post)
{
    $id      = $webinar_post->ID;
    $date    = cb_webinar_date($id, 'j M Y');
    $speaker = cb_webinar_first_speaker($id);
    ?>
    <div class="col-md-6 col-lg-4">
        <a href="<?= esc_url(get_permalink($id)); ?>" class="webinar-card">
            <?php if (has_post_thumbnail($id)) : ?>
                <?= get_the_post_thumbnail($id, 'custom-thumb-275x184', array('class' => 'webinar-card__image')); ?>
            <?php endif; ?>
            <div class="webinar-card__inner p-3">
                <h3 class="webinar-card__title mb-3"><?= esc_html(get_the_title($id)); ?></h3>
                <ul class="webinar-card__meta list-unstyled m-0 d-flex flex-column gap-1">
                    <?php if ($date) : ?>
                        <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-calendar-day" aria-hidden="true"></i> <span><?= esc_html($date); ?></span></li>
                    <?php endif; ?>
                    <?php if ($speaker) : ?>
                        <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-user" aria-hidden="true"></i> <span><?= esc_html($speaker); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
        </a>
    </div>
    <?php
}
endif;
?>
<main id="main" class="resources webinars-archive">
    <div class="container-xl pt-5">

        <h1><?php post_type_archive_title(); ?></h1>

        <?php
        $description = get_the_archive_description();
        if ($description) :
            ?>
            <div class="taxonomy-description"><?= wp_kses_post($description); ?></div>
        <?php else : ?>
            <p>Live sessions and on-demand recordings from the OK Alone team.</p>
        <?php endif; ?>

        <form class="d-flex mb-4" role="search" method="get" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="Search webinars..." aria-label="Search" value="<?= esc_attr($search_term); ?>">
            <button class="button button-yellow" type="submit">Search</button>
        </form>

        <?php if (empty($upcoming) && empty($ondemand)) : ?>
            <p>No webinars found<?= $search_term ? ' for "' . esc_html($search_term) . '"' : ''; ?>.</p>
        <?php endif; ?>

        <?php if (! empty($upcoming)) : ?>
            <section class="webinars-archive__group mb-5">
                <h2 class="mb-4">Upcoming webinars</h2>
                <div class="row g-4">
                    <?php foreach ($upcoming as $webinar_post) : cb_render_webinar_card($webinar_post); endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (! empty($ondemand)) : ?>
            <section class="webinars-archive__group mb-5">
                <h2 class="mb-4">On-demand recordings</h2>
                <div class="row g-4">
                    <?php foreach ($ondemand as $webinar_post) : cb_render_webinar_card($webinar_post); endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

    </div>

    <?php
    set_query_var('grad', 'orange');
    set_query_var('title', 'Book a Demo Today');
    set_query_var('content', '<p>Protect your people with our dedicated personal safety service for at-risk and lone workers, backed by a professional 24/7 Safety Monitoring Center.</p>');
    set_query_var('cta', null);
    set_query_var('modal_trigger', array('Yes'));
    get_template_part('page-templates/blocks/cb_gradient_cta');
    ?>
</main>
<?php
wp_reset_postdata();
get_footer();
