<?php
/**
 * Events listing / archive at /resources/events/.
 *
 * Splits events into Upcoming (soonest first) and Past (most recent first),
 * sorted by the queryable event date rather than publish date.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$search_term = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';

$events_query = new WP_Query(array(
    'post_type'      => 'event',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => 'event_start_date',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    's'              => $search_term,
));

// Partition into upcoming vs past using the effective end date.
$upcoming = array();
$past     = array();

if ($events_query->have_posts()) {
    foreach ($events_query->posts as $event_post) {
        if (cb_event_is_past($event_post->ID)) {
            $past[] = $event_post;
        } else {
            $upcoming[] = $event_post;
        }
    }
}
// Past: most recent first.
$past = array_reverse($past);

/**
 * Render a single event card.
 *
 * @param WP_Post $event_post The event.
 */
if (! function_exists('cb_render_event_card')) :
function cb_render_event_card($event_post)
{
    $id    = $event_post->ID;
    $date  = cb_event_date_range($id);
    $city  = get_field('event_city', $id);
    $booth = get_field('event_booth', $id);
    ?>
    <div class="col-md-6 col-lg-4">
        <a href="<?= esc_url(get_permalink($id)); ?>" class="event-card">
            <?php if (has_post_thumbnail($id)) : ?>
                <?= get_the_post_thumbnail($id, 'custom-thumb-275x184', array('class' => 'event-card__image')); ?>
            <?php endif; ?>
            <div class="event-card__inner p-3">
                <h3 class="event-card__title mb-3"><?= esc_html(get_the_title($id)); ?></h3>
                <ul class="event-card__meta list-unstyled m-0 d-flex flex-column gap-1">
                    <?php if ($date) : ?>
                        <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-calendar-day" aria-hidden="true"></i> <span><?= esc_html($date); ?></span></li>
                    <?php endif; ?>
                    <?php if ($city) : ?>
                        <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> <span><?= esc_html($city); ?></span></li>
                    <?php endif; ?>
                    <?php if ($booth) : ?>
                        <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-map-pin" aria-hidden="true"></i> <span><?= esc_html($booth); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
        </a>
    </div>
    <?php
}
endif;
?>
<main id="main" class="resources events-archive">
    <div class="container-xl pt-5">

        <h1><?php post_type_archive_title(); ?></h1>

        <?php
        $description = get_the_archive_description();
        if ($description) :
            ?>
            <div class="taxonomy-description"><?= wp_kses_post($description); ?></div>
        <?php else : ?>
            <p>Come and meet the OK Alone team. Here's where you'll find us next — and where we've been.</p>
        <?php endif; ?>

        <form class="d-flex mb-4" role="search" method="get" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="Search events..." aria-label="Search" value="<?= esc_attr($search_term); ?>">
            <button class="button button-yellow" type="submit">Search</button>
        </form>

        <?php if (empty($upcoming) && empty($past)) : ?>
            <p>No events found<?= $search_term ? ' for "' . esc_html($search_term) . '"' : ''; ?>.</p>
        <?php endif; ?>

        <?php if (! empty($upcoming)) : ?>
            <section class="events-archive__group events-archive__group--upcoming mb-5">
                <h2 class="mb-4">Upcoming events</h2>
                <div class="row g-4">
                    <?php foreach ($upcoming as $event_post) : cb_render_event_card($event_post); endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if (! empty($past)) : ?>
            <section class="events-archive__group events-archive__group--past mb-5">
                <h2 class="mb-4">Past events</h2>
                <div class="row g-4">
                    <?php foreach ($past as $event_post) : cb_render_event_card($event_post); endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

    </div>

    <?php
    set_query_var('grad', 'orange');
    set_query_var('title', 'Book a Demo Today');
    set_query_var('content', '<p>Can\'t make it to an event? Protect your people with our dedicated personal safety service for at-risk and lone workers, backed by a professional 24/7 Safety Monitoring Center.</p>');
    set_query_var('cta', null);
    set_query_var('modal_trigger', array('Yes'));
    get_template_part('page-templates/blocks/cb_gradient_cta');
    ?>
</main>
<?php
wp_reset_postdata();
get_footer();
