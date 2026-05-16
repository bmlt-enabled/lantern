<?php
/**
 * Template Name: Daily Meditation
 *
 * Pulls JFT + SPAD via Fetch Meditation.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell lantern-shell--narrow">
        <header class="lantern-stack" style="margin-bottom: 2.5rem;">
            <span class="lantern-eyebrow"><?php echo esc_html( wp_date( __( 'l, F j', 'lantern' ) ) ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php endif; endwhile; ?>
        </header>

        <div class="lantern-meditation-wrap">
            <?php
            if ( lantern_has_shortcode( 'fetch_meditation' ) ) {
                echo do_shortcode( '[fetch_meditation book="both" tabs_layout="tabs"]' );
            } elseif ( lantern_has_shortcode( 'jft' ) ) {
                echo do_shortcode( '[jft]' );
            } else { ?>
                <div class="lantern-notice">
                    <h2><?php esc_html_e( 'Fetch Meditation is not active', 'lantern' ); ?></h2>
                    <p><?php esc_html_e( 'Install the Fetch Meditation plugin to display JFT and SPAD readings here.', 'lantern' ); ?></p>
                </div>
            <?php }
            ?>
        </div>
    </div>
</section>

<?php get_footer();
