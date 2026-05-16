<?php
/**
 * Lantern — a WordPress theme for NA service bodies.
 *
 * @package Lantern
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'LANTERN_VERSION', '1.0.0' );
define( 'LANTERN_DIR', trailingslashit( get_template_directory() ) );
define( 'LANTERN_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Theme setup: features, menus, image sizes.
 */
function lantern_setup() {
    load_theme_textdomain( 'lantern', LANTERN_DIR . 'languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'custom-logo', array(
        'height'      => 96,
        'width'       => 96,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script', 'navigation-widgets',
    ) );

    register_nav_menus( array(
        'primary'  => __( 'Primary Navigation', 'lantern' ),
        'public'   => __( 'For the Public', 'lantern' ),
        'members'  => __( 'For Members', 'lantern' ),
        'footer'   => __( 'Footer Links', 'lantern' ),
        'utility'  => __( 'Utility (top right)', 'lantern' ),
    ) );

    add_editor_style( 'assets/css/editor.css' );

    // Featured image sizes.
    add_image_size( 'lantern-card', 800, 600, true );
    add_image_size( 'lantern-hero', 1600, 900, true );
}
add_action( 'after_setup_theme', 'lantern_setup' );

/**
 * Content width.
 */
function lantern_content_width() {
    $GLOBALS['content_width'] = 1240;
}
add_action( 'after_setup_theme', 'lantern_content_width', 0 );

/**
 * Enqueue assets — Google Fonts (Fraunces + Instrument Sans), theme CSS/JS.
 */
function lantern_enqueue_assets() {
    // Fonts. Preconnect for performance; one variable file each.
    wp_enqueue_style(
        'lantern-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght,SOFT,WONK@0,9..144,300..900,30..100,0..1;1,9..144,300..900,30..100,0..1&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'lantern',
        get_stylesheet_uri(),
        array( 'lantern-fonts' ),
        LANTERN_VERSION
    );

    // Targeted CSS that retunes BMLT plugin output to fit the theme.
    wp_enqueue_style(
        'lantern-plugins',
        LANTERN_URI . 'assets/css/plugins.css',
        array( 'lantern' ),
        LANTERN_VERSION
    );

    wp_enqueue_script(
        'lantern',
        LANTERN_URI . 'assets/js/theme.js',
        array(),
        LANTERN_VERSION,
        true
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lantern_enqueue_assets' );

/**
 * Preconnect to Google Fonts.
 */
function lantern_resource_hints( $hints, $relation ) {
    if ( 'preconnect' === $relation ) {
        $hints[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' );
        $hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'lantern_resource_hints', 10, 2 );

/**
 * Body classes — page templates / plugin states.
 */
function lantern_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'lantern-singular';
    }
    if ( ! has_nav_menu( 'primary' ) ) {
        $classes[] = 'lantern-no-nav';
    }
    if ( lantern_helpline_number() ) {
        $classes[] = 'lantern-has-helpline';
    }
    return $classes;
}
add_filter( 'body_class', 'lantern_body_classes' );

/**
 * Excerpt length & more.
 */
function lantern_excerpt_length() { return 26; }
add_filter( 'excerpt_length', 'lantern_excerpt_length', 999 );

function lantern_excerpt_more() { return '…'; }
add_filter( 'excerpt_more', 'lantern_excerpt_more' );

/**
 * Walker that supports submenus and current-item classes in the primary nav.
 * Falls back to wp_page_menu when no menu has been assigned.
 */
function lantern_fallback_menu() {
    echo '<ul>';
    wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
    echo '</ul>';
}

/**
 * Pagination wrapper that uses theme styling.
 */
function lantern_pagination() {
    $links = paginate_links( array( 'type' => 'list', 'prev_text' => '←', 'next_text' => '→' ) );
    if ( ! $links ) {
        return;
    }
    // Strip the default <ul> wrapper from paginate_links() to use our flex layout.
    $links = preg_replace( '/^<ul class=\'page-numbers\'>|<\/ul>$/', '', $links );
    $links = str_replace( array( '<li>', '</li>' ), '', $links );
    echo '<nav class="lantern-pagination" aria-label="' . esc_attr__( 'Posts', 'lantern' ) . '">' . wp_kses_post( $links ) . '</nav>';
}

/**
 * Helper: a Customizer-backed text value (sanitized).
 */
function lantern_option( $key, $default = '' ) {
    $value = get_theme_mod( 'lantern_' . $key, $default );
    return is_string( $value ) ? wp_kses_post( $value ) : $value;
}

/**
 * Service body name (falls back to bloginfo).
 */
function lantern_service_body_name() {
    $name = lantern_option( 'service_body_name', '' );
    return $name !== '' ? $name : get_bloginfo( 'name' );
}

/**
 * Helpline number (raw + displayable).
 */
function lantern_helpline_number() {
    return lantern_option( 'helpline_number', '' );
}
function lantern_helpline_tel() {
    return preg_replace( '/[^0-9+]/', '', (string) lantern_helpline_number() );
}

/**
 * BMLT server URL (used as a fallback when shortcodes don't specify).
 */
function lantern_bmlt_server() {
    return esc_url( lantern_option( 'bmlt_server', '' ) );
}

/**
 * Meeting-finder page URL (for buttons throughout the site).
 */
function lantern_meeting_finder_url() {
    $page_id = (int) lantern_option( 'meeting_finder_page', 0 );
    if ( $page_id > 0 ) {
        return get_permalink( $page_id );
    }
    $page = get_page_by_path( 'meetings' ) ?: get_page_by_path( 'meeting-finder' ) ?: get_page_by_path( 'find-a-meeting' );
    return $page ? get_permalink( $page ) : home_url( '/' );
}

/**
 * Detect whether a given plugin is active by shortcode tag.
 */
function lantern_has_shortcode( $tag ) {
    global $shortcode_tags;
    return is_array( $shortcode_tags ) && array_key_exists( $tag, $shortcode_tags );
}

/**
 * Locate an upcoming Mayo event for the homepage card, if Mayo is active.
 * Returns an array of stdClass-ish event arrays or empty.
 */
function lantern_upcoming_events( $limit = 4 ) {
    if ( ! post_type_exists( 'mayo_event' ) ) {
        return array();
    }
    $today = current_time( 'Y-m-d' );
    $q = new WP_Query( array(
        'post_type'      => 'mayo_event',
        'posts_per_page' => $limit,
        'meta_key'       => 'event_start_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'event_start_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
        'no_found_rows'  => true,
    ) );
    $events = array();
    foreach ( $q->posts as $post ) {
        $events[] = array(
            'title'    => get_the_title( $post ),
            'permalink'=> get_permalink( $post ),
            'date'     => get_post_meta( $post->ID, 'event_start_date', true ),
            'time'     => get_post_meta( $post->ID, 'event_start_time', true ),
            'location' => get_post_meta( $post->ID, 'location_name', true ),
        );
    }
    wp_reset_postdata();
    return $events;
}

/**
 * Customizer (separate file for tidiness).
 */
require LANTERN_DIR . 'inc/customizer.php';
require LANTERN_DIR . 'inc/template-tags.php';
require LANTERN_DIR . 'inc/widgets.php';
