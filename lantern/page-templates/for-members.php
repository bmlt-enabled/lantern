<?php
/**
 * Template Name: For Members
 *
 * Member-facing landing: subcommittees, minutes, event submissions,
 * trusted-servant contacts, service guides.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 3rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'For members', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lantern-page-subtitle">
                    <?php esc_html_e( 'Service is the practice of putting principles before personalities. Tools for trusted servants live here.', 'lantern' ); ?>
                </p>
            <?php endif; endwhile; ?>
        </header>

        <?php
        $cards = array(
            array( __( 'Minutes & reports', 'lantern' ),       __( 'Recent area & regional minutes, treasurer reports.', 'lantern' ),   get_permalink( get_page_by_path( 'minutes' ) ) ?: '#' ),
            array( __( 'Subcommittees', 'lantern' ),           __( 'PR, H&I, Activities, Literature, Outreach, and more.', 'lantern' ), get_permalink( get_page_by_path( 'subcommittees' ) ) ?: '#' ),
            array( __( 'Events & calendar', 'lantern' ),       __( 'Submit an event, see the trusted-servant calendar.', 'lantern' ),   get_permalink( get_page_by_path( 'events' ) ) ?: '#' ),
            array( __( 'Meeting changes', 'lantern' ),         __( 'Add, change, or close a meeting via the BMLT workflow.', 'lantern' ), get_permalink( get_page_by_path( 'meeting-changes' ) ) ?: '#' ),
            array( __( 'Service guides', 'lantern' ),          __( 'Local & world service handbooks, by-laws, motions.', 'lantern' ),   get_permalink( get_page_by_path( 'service-guides' ) ) ?: '#' ),
            array( __( 'Printable meeting list', 'lantern' ),  __( 'PDF schedule, freshly generated from BMLT.', 'lantern' ),           get_permalink( get_page_by_path( 'meeting-list' ) ) ?: '#' ),
        );
        ?>
        <div class="lantern-pathways">
            <?php $i = 1; foreach ( $cards as $c ) : ?>
                <a class="lantern-pathway" href="<?php echo esc_url( $c[2] ); ?>">
                    <span class="lantern-pathway__num"><?php printf( '0%d', $i++ ); ?></span>
                    <h3 class="lantern-pathway__title"><?php echo esc_html( $c[0] ); ?></h3>
                    <p class="lantern-pathway__desc"><?php echo esc_html( $c[1] ); ?></p>
                    <span class="lantern-pathway__more"><?php esc_html_e( 'Open', 'lantern' ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if ( lantern_has_shortcode( 'bmltwf-meeting-update-form' ) ) : ?>
            <hr class="lantern-rule">
            <h2 style="font-size: var(--lantern-step-3);"><?php esc_html_e( 'Update a meeting', 'lantern' ); ?></h2>
            <p><?php esc_html_e( 'Submit an add, change, or close request — it will be reviewed by a trusted servant before it goes live.', 'lantern' ); ?></p>
            <?php echo do_shortcode( '[bmltwf-meeting-update-form]' ); ?>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
