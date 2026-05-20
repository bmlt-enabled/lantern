<?php
/**
 * Lantern block styles + block patterns.
 *
 * @package Lantern
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Register Lantern-flavoured variations of core blocks. The CSS for each
 * variation lives in style.css under the `is-style-lantern-*` selectors.
 */
function lantern_register_block_styles() {
    register_block_style( 'core/quote', array(
        'name'  => 'lantern-pullquote',
        'label' => __( 'Lantern pull-quote', 'lantern' ),
    ) );
    register_block_style( 'core/separator', array(
        'name'  => 'lantern-flourish',
        'label' => __( 'Lantern flourish', 'lantern' ),
    ) );
    register_block_style( 'core/button', array(
        'name'  => 'lantern-ember',
        'label' => __( 'Lantern ember', 'lantern' ),
    ) );
}
add_action( 'init', 'lantern_register_block_styles' );

/**
 * Register a "Find a meeting" call-out block pattern users can drop on any
 * page. Renders as a centered hero with title, lede, and a button group.
 */
function lantern_register_block_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    register_block_pattern_category( 'lantern', array(
        'label' => __( 'Lantern', 'lantern' ),
    ) );

    register_block_pattern( 'lantern/find-a-meeting-cta', array(
        'title'       => __( 'Find a meeting — call to action', 'lantern' ),
        'description' => __( 'A centered call-out inviting visitors to find a meeting or call the helpline.', 'lantern' ),
        'categories'  => array( 'lantern', 'call-to-action' ),
        'content'     => <<<HTML
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
<!-- wp:paragraph {"align":"center","className":"lantern-eyebrow"} -->
<p class="has-text-align-center lantern-eyebrow">Whatever it takes</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">You don't have to do this alone.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">A community of recovering addicts meets every day of the week — in person, online, and hybrid.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-lantern-ember"} -->
<div class="wp-block-button is-style-lantern-ember"><a class="wp-block-button__link wp-element-button" href="/meetings/">Find a meeting</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/helpline/">Call the helpline</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
HTML,
    ) );
}
add_action( 'init', 'lantern_register_block_patterns' );
