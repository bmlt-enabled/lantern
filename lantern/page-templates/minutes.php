<?php
/**
 * Template Name: Minutes
 *
 * Publishes service-committee meeting minutes via the BMLT Minutes plugin's
 * [minutes] shortcode. Degrades to a friendly notice when the plugin is absent.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section" style="padding-bottom: 2rem;">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 2rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Records', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php endif; endwhile; ?>
        </header>
    </div>
</section>

<section class="lantern-section" style="padding-top:0;">
    <div class="lantern-shell">
        <?php if ( lantern_has_shortcode( 'minutes' ) ) : ?>
            <div class="lantern-minutes-wrap">
                <?php echo do_shortcode( '[minutes]' ); ?>
            </div>
        <?php else : ?>
            <div class="lantern-notice">
                <h2><?php esc_html_e( 'BMLT Minutes plugin is not active', 'lantern' ); ?></h2>
                <p>
                    <?php
                    printf(
                        /* translators: %s: link to the BMLT Minutes plugin */
                        wp_kses( __( 'Install %s to publish committee meeting minutes here.', 'lantern' ), array( 'a' => array( 'href' => array(), 'rel' => array(), 'target' => array() ) ) ),
                        '<a href="https://wordpress.org/plugins/bmlt-minutes/" rel="noopener" target="_blank">BMLT Minutes</a>'
                    );
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
