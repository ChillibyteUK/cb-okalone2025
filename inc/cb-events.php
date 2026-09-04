<?php
/**
 * Events
 *
 * Registers the `event` custom post type used for trade-show / conference
 * landing pages, plus helper functions for the date-driven "Meet us there"
 * form auto-hide and the Upcoming/Past listing.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * The URL base for events. Individual events live at /resources/events/[slug]/
 * and the listing archive at /resources/events/.
 */
if (! defined('CB_EVENTS_BASE')) {
    define('CB_EVENTS_BASE', 'resources/events');
}

/**
 * Register the Event post type.
 */
function cb_register_event_cpt()
{
    $labels = array(
        'name'                  => 'Events',
        'singular_name'         => 'Event',
        'menu_name'             => 'Events',
        'all_items'             => 'All Events',
        'add_new'               => 'Add New Event',
        'add_new_item'          => 'Add New Event',
        'edit_item'             => 'Edit Event',
        'new_item'              => 'New Event',
        'view_item'             => 'View Event',
        'view_items'            => 'View Events',
        'search_items'          => 'Search Events',
        'not_found'             => 'No events found',
        'not_found_in_trash'    => 'No events found in Trash',
        'featured_image'        => 'Event hero image',
        'set_featured_image'    => 'Set hero image',
        'remove_featured_image' => 'Remove hero image',
        'use_featured_image'    => 'Use as hero image',
        'item_published'        => 'Event published.',
        'item_updated'          => 'Event updated.',
    );

    register_post_type('event', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => CB_EVENTS_BASE,
        'menu_icon'     => 'dashicons-calendar-alt',
        'menu_position' => 22,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'  => true, // Gutenberg + Yoast SEO meta.
        'rewrite'       => array(
            'slug'       => CB_EVENTS_BASE,
            'with_front' => false,
            'pages'      => true,
            'feeds'      => false,
        ),
    ));
}
add_action('init', 'cb_register_event_cpt');

/**
 * Add explicit, top-priority rewrite rules for the events archive.
 *
 * Posts use a /resources/%postname%/ permalink structure, so the generic
 * single-post rule could otherwise shadow the /resources/events/ archive
 * (treating "events" as a post slug). These rules guarantee the archive and
 * its pagination resolve to the CPT. Single events (/resources/events/[slug]/)
 * are two segments and never collide with the one-segment post rule.
 */
function cb_event_rewrite_rules()
{
    add_rewrite_rule('^' . CB_EVENTS_BASE . '/?$', 'index.php?post_type=event', 'top');
    add_rewrite_rule('^' . CB_EVENTS_BASE . '/page/([0-9]{1,})/?$', 'index.php?post_type=event&paged=$matches[1]', 'top');
}
add_action('init', 'cb_event_rewrite_rules');

/**
 * Flush rewrite rules once after this code is deployed, and whenever the theme
 * is (re)activated, so the new URLs work without a manual Permalinks > Save.
 */
function cb_event_maybe_flush_rewrites()
{
    $flag = get_option('cb_event_rewrites_flushed');
    if ('2' !== $flag) {
        cb_register_event_cpt();
        cb_event_rewrite_rules();
        flush_rewrite_rules(false);
        update_option('cb_event_rewrites_flushed', '2');
    }
}
add_action('init', 'cb_event_maybe_flush_rewrites', 20);
add_action('after_switch_theme', function () {
    delete_option('cb_event_rewrites_flushed');
});

/**
 * Enqueue the embed iframe auto-resize listener on single event/webinar pages.
 */
function cb_embed_resize_enqueue()
{
    if (! is_singular(array('event', 'webinar'))) {
        return;
    }

    $path = get_stylesheet_directory() . '/js/cb-embed-resize.js';
    wp_enqueue_script(
        'cb-embed-resize',
        get_stylesheet_directory_uri() . '/js/cb-embed-resize.js',
        array(),
        file_exists($path) ? filemtime($path) : null,
        true
    );
}
add_action('wp_enqueue_scripts', 'cb_embed_resize_enqueue');

/**
 * Populate the "Choose form" ACF select with the site's Gravity Forms.
 */
function cb_event_load_gf_form_choices($field)
{
    $field['choices'] = array('' => '— Select a form —');

    if (class_exists('GFAPI')) {
        foreach (GFAPI::get_forms() as $form) {
            $field['choices'][ (string) $form['id'] ] = $form['title'];
        }
    }

    return $field;
}
add_filter('acf/load_field/name=event_form_id', 'cb_event_load_gf_form_choices');

/**
 * Get an event's effective end date as a Ymd string.
 *
 * Falls back to the start date when no end date is set. Returns '' if neither
 * is set.
 *
 * @param int|null $post_id Optional post ID. Defaults to current post.
 * @return string Ymd, or '' when unknown.
 */
function cb_event_end_ymd($post_id = null)
{
    $post_id = $post_id ?: get_the_ID();
    $end     = get_field('event_end_date', $post_id);
    $start   = get_field('event_start_date', $post_id);

    return $end ?: ($start ?: '');
}

/**
 * Whether an event is in the past (the day after its end date onwards).
 *
 * @param int|null $post_id Optional post ID.
 * @return bool
 */
function cb_event_is_past($post_id = null)
{
    $end = cb_event_end_ymd($post_id);
    if ('' === $end) {
        return false;
    }

    return current_time('Ymd') > $end;
}

/**
 * Whether the "Meet us there" form should render for this event.
 *
 * Modes (ACF field `event_form_mode`):
 *  - 'auto' : visible up to and including the event end date, hidden the day
 *             after (default).
 *  - 'on'   : always visible.
 *  - 'off'  : always hidden.
 *
 * Always false when no form has been selected.
 *
 * @param int|null $post_id Optional post ID.
 * @return bool
 */
function cb_event_form_is_visible($post_id = null)
{
    $post_id = $post_id ?: get_the_ID();
    $embed   = get_field('event_form_embed', $post_id);
    $form_id = get_field('event_form_id', $post_id);

    // Nothing to show unless a Pardot embed or a (legacy) Gravity Form is set.
    if (empty($embed) && empty($form_id)) {
        return false;
    }

    $mode = get_field('event_form_mode', $post_id) ?: 'auto';

    if ('off' === $mode) {
        return false;
    }
    if ('on' === $mode) {
        return true;
    }

    // 'auto' — hide the day after the event ends.
    return ! cb_event_is_past($post_id);
}

/**
 * Render event body content with the theme's per-block .container-xl wrapping
 * suppressed.
 *
 * The theme wraps every core paragraph/heading/list block in its own
 * .container-xl (see modify_core_add_container in inc/cb-blocks.php). Inside the
 * event card the width is already controlled by the page container and the card
 * padding, so that extra wrapper leaves the body misaligned with the other
 * sections. Temporarily disabling the block render callbacks keeps everything
 * aligned to the card, then restores them so nothing else is affected.
 *
 * @param string $content Raw post content.
 * @return string Rendered HTML.
 */
function cb_event_render_content($content)
{
    $registry = WP_Block_Type_Registry::get_instance();
    $targets  = array('core/paragraph', 'core/heading', 'core/list');
    $saved    = array();

    foreach ($targets as $name) {
        $type = $registry->get_registered($name);
        if ($type && $type->render_callback) {
            $saved[$name]          = $type->render_callback;
            $type->render_callback = null;
        }
    }

    $html = apply_filters('the_content', $content);

    foreach ($saved as $name => $callback) {
        $type = $registry->get_registered($name);
        if ($type) {
            $type->render_callback = $callback;
        }
    }

    return $html;
}

/**
 * Sanitise an admin-entered form embed (e.g. a Pardot <iframe> snippet),
 * allowing the iframe/embed markup while stripping anything unsafe.
 *
 * @param string $html Raw embed markup.
 * @return string Safe HTML.
 */
function cb_event_embed_kses($html)
{
    $allowed = array(
        'iframe' => array(
            'src'               => true,
            'width'             => true,
            'height'            => true,
            'name'              => true,
            'id'                => true,
            'class'             => true,
            'style'             => true,
            'type'              => true,
            'title'             => true,
            'scrolling'         => true,
            'frameborder'       => true,
            'allow'             => true,
            'allowfullscreen'   => true,
            'allowtransparency' => true,
            'loading'           => true,
            'referrerpolicy'    => true,
            'sandbox'           => true,
        ),
        'div' => array('class' => true, 'id' => true, 'style' => true),
        'p'   => array('class' => true, 'style' => true),
        'br'  => array(),
    );

    return wp_kses($html, $allowed);
}

/**
 * Human-readable event date range, e.g. "12–14 May 2026" or "3 May 2026".
 *
 * @param int|null $post_id Optional post ID.
 * @return string
 */
function cb_event_date_range($post_id = null)
{
    $post_id = $post_id ?: get_the_ID();
    $start   = get_field('event_start_date', $post_id);
    $end     = get_field('event_end_date', $post_id);

    if (! $start) {
        return '';
    }

    $start_ts = strtotime($start);
    $end_ts   = $end ? strtotime($end) : $start_ts;

    if (! $start_ts) {
        return '';
    }

    // Single day.
    if (! $end || $start === $end) {
        return date_i18n('j M Y', $start_ts);
    }

    // Same month & year: "12–14 May 2026".
    if (date('Y-m', $start_ts) === date('Y-m', $end_ts)) {
        return date_i18n('j', $start_ts) . '–' . date_i18n('j M Y', $end_ts);
    }

    // Same year, different month: "28 Apr – 2 May 2026".
    if (date('Y', $start_ts) === date('Y', $end_ts)) {
        return date_i18n('j M', $start_ts) . ' – ' . date_i18n('j M Y', $end_ts);
    }

    // Different years.
    return date_i18n('j M Y', $start_ts) . ' – ' . date_i18n('j M Y', $end_ts);
}
