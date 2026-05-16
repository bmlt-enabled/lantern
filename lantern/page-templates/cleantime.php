<?php
/**
 * Template Name: Cleantime Calculator
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell lantern-shell--narrow">
        <header class="lantern-stack" style="margin-bottom: 2.5rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'A day at a time', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0 0 1rem;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lantern-page-subtitle"><?php esc_html_e( 'Enter your clean date and see exactly how far you\'ve come.', 'lantern' ); ?></p>
            <?php endif; endwhile; ?>
        </header>

        <div class="lantern-nacc-wrap">
            <?php if ( lantern_has_shortcode( 'nacc' ) ) : ?>
                <?php echo do_shortcode( '[nacc layout="tabular"]' ); ?>
            <?php else : ?>
                <div class="lantern-notice">
                    <h2><?php esc_html_e( 'NACC plugin is not active', 'lantern' ); ?></h2>
                    <p><?php esc_html_e( 'Install the NACC cleantime calculator plugin to enable this page.', 'lantern' ); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <hr class="lantern-rule">
        <blockquote>
            <?php esc_html_e( 'Just for today — my thoughts will be on my recovery, living and enjoying life without the use of drugs.', 'lantern' ); ?>
            <cite><?php esc_html_e( 'Just For Today', 'lantern' ); ?></cite>
        </blockquote>
    </div>
</section>

<?php get_footer();
