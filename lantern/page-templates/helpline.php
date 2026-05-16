<?php
/**
 * Template Name: Helpline
 *
 * Generic dedicated helpline page — large prominent number, call/text actions, FAQ.
 *
 * @package Lantern
 */

get_header();

$helpline = lantern_helpline_number();
$tel      = lantern_helpline_tel();
?>

<section class="lantern-section" style="padding-top: clamp(2rem, 2rem + 4vw, 6rem);">
    <div class="lantern-shell lantern-shell--narrow lantern-center">
        <span class="lantern-eyebrow" style="justify-content:center;"><?php esc_html_e( '24/7, every day', 'lantern' ); ?></span>
        <h1 style="font-size: var(--lantern-step-5); margin: 0 0 1rem;"><?php the_title(); ?></h1>

        <?php if ( $helpline ) : ?>
            <a href="tel:<?php echo esc_attr( $tel ); ?>" style="display:block; font-family: var(--lantern-display); font-size: clamp(2.5rem, 2rem + 6vw, 6rem); color: var(--lantern-ember); text-decoration: none; line-height: 1; margin: 1rem 0 1.5rem; letter-spacing: -0.02em; font-variation-settings: 'opsz' 144, 'SOFT' 30;">
                <?php echo esc_html( $helpline ); ?>
            </a>
            <a class="lantern-btn lantern-btn--ember" href="tel:<?php echo esc_attr( $tel ); ?>"><?php esc_html_e( 'Tap to call', 'lantern' ); ?></a>
        <?php endif; ?>

        <div style="margin-top: 3rem; text-align: left;">
            <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
        </div>
    </div>
</section>

<section class="lantern-section lantern-section--deep">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 2rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'What happens when you call', 'lantern' ); ?></span>
            <h2 style="font-size: var(--lantern-step-3); margin: 0;"><?php esc_html_e( 'A recovering addict picks up.', 'lantern' ); ?></h2>
        </header>
        <div class="lantern-grid-3">
            <div>
                <h3 style="font-size: var(--lantern-step-1);"><?php esc_html_e( 'It\'s anonymous', 'lantern' ); ?></h3>
                <p><?php esc_html_e( 'No names required, no records kept. The first tradition of our program is anonymity.', 'lantern' ); ?></p>
            </div>
            <div>
                <h3 style="font-size: var(--lantern-step-1);"><?php esc_html_e( 'It\'s free', 'lantern' ); ?></h3>
                <p><?php esc_html_e( 'NA charges nothing for help. No insurance, no intake. Just a person on the other end.', 'lantern' ); ?></p>
            </div>
            <div>
                <h3 style="font-size: var(--lantern-step-1);"><?php esc_html_e( 'It\'s a meeting away', 'lantern' ); ?></h3>
                <p><?php esc_html_e( 'The volunteer can help you find a meeting close to you tonight, in-person or online.', 'lantern' ); ?></p>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
