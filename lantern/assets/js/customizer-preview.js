/**
 * Customizer preview wiring for Lantern.
 *
 * Settings that use `transport: 'postMessage'` need a JS handler to live-update
 * their target element in the preview iframe. Each handler matches a selector
 * declared in inc/customizer.php's selective-refresh partial.
 */
( function( $ ) {
    'use strict';

    function bindText( setting, selector ) {
        wp.customize( setting, function( value ) {
            value.bind( function( to ) {
                $( selector ).text( to );
            } );
        } );
    }

    function bindHtml( setting, selector ) {
        wp.customize( setting, function( value ) {
            value.bind( function( to ) {
                $( selector ).html( to );
            } );
        } );
    }

    // Hero
    bindHtml( 'lantern_home_tagline',  '.lantern-hero__title' );
    bindText( 'lantern_home_lede',     '.lantern-hero__lede' );
    bindText( 'lantern_hero_quote',    '.lantern-edit-hero-quote' );

    // About band
    bindText( 'lantern_about_blurb',   '.lantern-edit-about-blurb' );
    bindText( 'lantern_about_blurb_2', '.lantern-edit-about-blurb-2' );
    bindText( 'lantern_pillar_quote',  '.lantern-edit-pillar-quote' );

    // Closing CTA
    bindHtml( 'lantern_closing_title', '.lantern-edit-closing-title' );
    bindText( 'lantern_closing_lede',  '.lantern-edit-closing-lede' );

} )( jQuery );
