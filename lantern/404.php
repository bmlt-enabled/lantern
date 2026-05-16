<?php
/**
 * 404 template.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section" style="min-height: 70vh; display: grid; place-items: center;">
    <div class="lantern-shell lantern-shell--narrow lantern-center">
        <span class="lantern-eyebrow" style="justify-content:center;"><?php esc_html_e( 'Lost the thread', 'lantern' ); ?></span>
        <h1 class="lantern-page-title" style="font-size: var(--lantern-step-6);">404</h1>
        <p class="lantern-page-subtitle" style="margin-inline:auto;">
            <?php esc_html_e( 'The page you were looking for can\'t be found. Try one of the paths below — meetings happen every day, in every place.', 'lantern' ); ?>
        </p>
        <div class="lantern-flex" style="justify-content:center; margin-top: 2rem;">
            <a class="lantern-btn lantern-btn--ember" href="<?php echo esc_url( lantern_meeting_finder_url() ); ?>"><?php esc_html_e( 'Find a meeting', 'lantern' ); ?></a>
            <a class="lantern-btn lantern-btn--ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go home', 'lantern' ); ?></a>
        </div>

        <div style="margin-top: 3rem;">
            <?php get_search_form(); ?>
        </div>
    </div>
</section>

<?php get_footer();
