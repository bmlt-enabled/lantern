<?php
/**
 * Template Name: Meeting Finder
 *
 * Embeds whichever BMLT meeting finder plugin is active. Lantern
 * supports either Crumb ([crumb]) or Crouton ([bmlt_tabs]) — pick
 * whichever your service body already uses. If both happen to be
 * active, Crumb is rendered (Crouton has logic to step aside when
 * Crumb is present, so this matches its own behavior).
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section" style="padding-bottom: 2rem;">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 2rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Meetings', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( get_the_content() ) : ?>
                    <div class="lantern-page-subtitle"><?php the_content(); ?></div>
                <?php else : ?>
                    <p class="lantern-page-subtitle">
                        <?php esc_html_e( 'Search by city, day, time, or format. In-person and online meetings happen every day of the week.', 'lantern' ); ?>
                    </p>
                <?php endif; ?>
            <?php endwhile; ?>
        </header>
    </div>
</section>

<section class="lantern-section lantern-bmlt-embed" style="padding-top: 0; padding-bottom: var(--lantern-section-y);">
    <div class="lantern-shell lantern-shell--wide">
        <?php if ( lantern_has_shortcode( 'crumb' ) ) : ?>
            <div class="lantern-crumb-wrap">
                <?php echo do_shortcode( '[crumb]' ); ?>
            </div>
        <?php elseif ( lantern_has_shortcode( 'bmlt_tabs' ) ) : ?>
            <div class="lantern-crouton-wrap">
                <?php echo do_shortcode( '[bmlt_tabs]' ); ?>
            </div>
        <?php else : ?>
            <div class="lantern-notice">
                <h2><?php esc_html_e( 'No meeting finder plugin is active', 'lantern' ); ?></h2>
                <p>
                    <?php esc_html_e( 'Lantern works with either Crumb or Crouton as the BMLT meeting finder — pick whichever your service body prefers. Install and activate one of them, then configure your BMLT server in its settings page.', 'lantern' ); ?>
                </p>
                <p class="lantern-flex">
                    <a class="lantern-btn lantern-btn--ember" href="https://wordpress.org/plugins/crumb/" target="_blank" rel="noopener">
                        <?php esc_html_e( 'Get Crumb', 'lantern' ); ?>
                    </a>
                    <a class="lantern-btn lantern-btn--ghost" href="https://wordpress.org/plugins/crouton/" target="_blank" rel="noopener">
                        <?php esc_html_e( 'Get Crouton', 'lantern' ); ?>
                    </a>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
