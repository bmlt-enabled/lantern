<?php
/**
 * Template tags — small helpers used across templates.
 *
 * @package Lantern
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Print an eyebrow label.
 */
function lantern_eyebrow( $text ) {
    if ( ! $text ) { return; }
    echo '<span class="lantern-eyebrow">' . esc_html( $text ) . '</span>';
}

/**
 * Print a section heading block: eyebrow + title + optional kicker.
 */
function lantern_section_heading( $eyebrow, $title, $kicker = '' ) {
    echo '<header class="lantern-stack" style="margin-bottom: 2.5rem; max-width: 60ch;">';
    if ( $eyebrow ) {
        echo '<span class="lantern-eyebrow">' . esc_html( $eyebrow ) . '</span>';
    }
    if ( $title ) {
        echo '<h2 style="font-size: var(--lantern-step-4); margin:0;">' . wp_kses_post( $title ) . '</h2>';
    }
    if ( $kicker ) {
        echo '<p style="margin-top:0.75rem; max-width: 56ch; color: var(--lantern-ink-soft);">' . esc_html( $kicker ) . '</p>';
    }
    echo '</header>';
}

/**
 * Resolve a page by slug, returning a permalink or fallback.
 */
function lantern_link_to_slug( $slug, $fallback = '' ) {
    $page = get_page_by_path( $slug );
    return $page ? get_permalink( $page ) : $fallback;
}
