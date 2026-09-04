<?php
/**
 * Webinars
 *
 * Registers the `webinar` custom post type. A single template covers both
 * states via the `webinar_state` toggle: Upcoming (registration form) and
 * On-demand (recording), auto-switching on the webinar datetime when set to
 * Auto — mirroring the Events form auto-hide.
 *
 * @package cb-okalone2025
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (! defined('CB_WEBINARS_BASE')) {
    define('CB_WEBINARS_BASE', 'resources/webinars');
}

/**
 * Register the Webinar post type.
 */
function cb_register_webinar_cpt()
{
    $labels = array(
        'name'               => 'Webinars',
        'singular_name'      => 'Webinar',
        'menu_name'          => 'Webinars',
        'all_items'          => 'All Webinars',
        'add_new'            => 'Add New Webinar',
        'add_new_item'       => 'Add New Webinar',
        'edit_item'          => 'Edit Webinar',
        'new_item'           => 'New Webinar',
        'view_item'          => 'View Webinar',
        'view_items'         => 'View Webinars',
        'search_items'       => 'Search Webinars',
        'not_found'          => 'No webinars found',
        'not_found_in_trash' => 'No webinars found in Trash',
        'featured_image'         => 'Thumbnail image',
        'set_featured_image'     => 'Set thumbnail image',
        'remove_featured_image'  => 'Remove thumbnail image',
        'use_featured_image'     => 'Use as thumbnail image',
        'item_published'     => 'Webinar published.',
        'item_updated'       => 'Webinar updated.',
    );

    register_post_type('webinar', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => CB_WEBINARS_BASE,
        'menu_icon'     => 'dashicons-video-alt2',
        'menu_position' => 23,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'  => true,
        'rewrite'       => array(
            'slug'       => CB_WEBINARS_BASE,
            'with_front' => false,
            'pages'      => true,
            'feeds'      => false,
        ),
    ));
}
add_action('init', 'cb_register_webinar_cpt');

/**
 * Top-priority rewrite rules for the webinars archive (see cb-events.php for
 * the rationale — the flat /resources/%postname%/ post rule could otherwise
 * shadow the one-segment archive URL).
 */
function cb_webinar_rewrite_rules()
{
    add_rewrite_rule('^' . CB_WEBINARS_BASE . '/?$', 'index.php?post_type=webinar', 'top');
    add_rewrite_rule('^' . CB_WEBINARS_BASE . '/page/([0-9]{1,})/?$', 'index.php?post_type=webinar&paged=$matches[1]', 'top');
}
add_action('init', 'cb_webinar_rewrite_rules');

/**
 * Flush rewrite rules once after deploy / on theme (re)activation.
 */
function cb_webinar_maybe_flush_rewrites()
{
    if ('1' !== get_option('cb_webinar_rewrites_flushed')) {
        cb_register_webinar_cpt();
        cb_webinar_rewrite_rules();
        flush_rewrite_rules(false);
        update_option('cb_webinar_rewrites_flushed', '1');
    }
}
add_action('init', 'cb_webinar_maybe_flush_rewrites', 20);
add_action('after_switch_theme', function () {
    delete_option('cb_webinar_rewrites_flushed');
});

/**
 * The effective state of a webinar: 'upcoming' or 'on-demand'.
 *
 * Honours the manual override; in 'auto' it flips to on-demand once the
 * webinar datetime has passed.
 *
 * @param int|null $post_id Optional post ID.
 * @return string 'upcoming' | 'on-demand'
 */
function cb_webinar_state($post_id = null)
{
    $post_id = $post_id ?: get_the_ID();
    $state   = get_field('webinar_state', $post_id) ?: 'auto';

    if ('on-demand' === $state) {
        return 'on-demand';
    }
    if ('upcoming' === $state) {
        return 'upcoming';
    }

    // Auto: compare stored datetime (site-local 'Y-m-d H:i:s') to now.
    $datetime = get_field('webinar_datetime', $post_id);
    if (! $datetime) {
        return 'upcoming';
    }

    return ($datetime < current_time('Y-m-d H:i:s')) ? 'on-demand' : 'upcoming';
}

/**
 * Whether a webinar is on-demand (recording) rather than upcoming.
 *
 * @param int|null $post_id Optional post ID.
 * @return bool
 */
function cb_webinar_is_ondemand($post_id = null)
{
    return 'on-demand' === cb_webinar_state($post_id);
}

/**
 * Formatted webinar date, e.g. "12 May 2026".
 *
 * @param int|null $post_id Optional post ID.
 * @param string   $format  PHP date format.
 * @return string
 */
function cb_webinar_date($post_id = null, $format = 'j M Y')
{
    $post_id  = $post_id ?: get_the_ID();
    $datetime = get_field('webinar_datetime', $post_id);
    if (! $datetime) {
        return '';
    }
    $ts = strtotime($datetime);
    return $ts ? date_i18n($format, $ts) : '';
}

/**
 * First speaker's name (used on listing cards).
 *
 * @param int|null $post_id Optional post ID.
 * @return string
 */
function cb_webinar_first_speaker($post_id = null)
{
    $post_id  = $post_id ?: get_the_ID();
    $speakers = get_field('webinar_speakers', $post_id);
    if (! empty($speakers) && ! empty($speakers[0]['name'])) {
        return $speakers[0]['name'];
    }
    return '';
}
