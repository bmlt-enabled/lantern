<?php
/**
 * Template Name: Events
 *
 * Embeds the Mayo event list. Optional submission form below if
 * mayo_event_form is registered.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section" style="padding-bottom: 2rem;">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 2rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Gatherings', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php endif; endwhile; ?>
        </header>
    </div>
</section>

<section class="lantern-section" style="padding-top:0;">
    <div class="lantern-shell">
        <?php if ( lantern_has_shortcode( 'mayo_event_list' ) ) : ?>
            <div class="lantern-mayo-wrap">
                <?php echo do_shortcode( '[mayo_event_list per_page="12" show_filters="true"]' ); ?>
            </div>
        <?php else : ?>
            <div class="lantern-notice">
                <h2><?php esc_html_e( 'Mayo Events plugin is not active', 'lantern' ); ?></h2>
                <p><?php esc_html_e( 'Install Mayo Events Manager to power this page.', 'lantern' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$show_submit = (bool) lantern_option( 'show_event_submission', true );
if ( $show_submit && lantern_has_shortcode( 'mayo_event_form' ) ) : ?>
<section class="lantern-section lantern-section--deep">
    <div class="lantern-shell lantern-shell--narrow">
        <header class="lantern-stack" style="margin-bottom: 2rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Submit', 'lantern' ); ?></span>
            <h2 style="font-size: var(--lantern-step-3); margin: 0;"><?php esc_html_e( 'Have an event to share?', 'lantern' ); ?></h2>
            <p><?php esc_html_e( 'Service-body events, fellowship dinners, recovery dances, conventions — submit it here and a trusted servant will review.', 'lantern' ); ?></p>
        </header>
        <?php echo do_shortcode( '[mayo_event_form]' ); ?>
    </div>
</section>
<?php endif; ?>

<?php get_footer();
