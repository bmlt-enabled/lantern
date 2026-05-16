<?php
/**
 * Template Name: For the Public
 *
 * A pillar/landing page that points to public-facing resources:
 * meetings, helpline, info, literature.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 3rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'For the public', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lantern-page-subtitle">
                    <?php esc_html_e( 'Resources for newcomers, family members, professionals, and anyone curious about Narcotics Anonymous.', 'lantern' ); ?>
                </p>
            <?php endif; endwhile; ?>
        </header>

        <?php
        $cards = array(
            array(
                'eyebrow' => __( 'I think I might be an addict', 'lantern' ),
                'title'   => __( 'For the newcomer', 'lantern' ),
                'desc'    => __( 'What NA is, what to expect at your first meeting, and how to find one tonight.', 'lantern' ),
                'url'     => get_permalink( get_page_by_path( 'newcomer' ) ) ?: '#',
            ),
            array(
                'eyebrow' => __( 'I\'m worried about someone', 'lantern' ),
                'title'   => __( 'For families', 'lantern' ),
                'desc'    => __( 'How NA can — and can\'t — help, and where loved ones can find their own support.', 'lantern' ),
                'url'     => get_permalink( get_page_by_path( 'for-families' ) ) ?: '#',
            ),
            array(
                'eyebrow' => __( 'I work with addicts', 'lantern' ),
                'title'   => __( 'For professionals', 'lantern' ),
                'desc'    => __( 'Brochures, presentations, and contact info for treatment centers, hospitals, courts, and clergy.', 'lantern' ),
                'url'     => get_permalink( get_page_by_path( 'professionals' ) ) ?: '#',
            ),
            array(
                'eyebrow' => __( 'I want to read', 'lantern' ),
                'title'   => __( 'Literature', 'lantern' ),
                'desc'    => __( 'Information pamphlets, the Basic Text, and other approved NA literature.', 'lantern' ),
                'url'     => get_permalink( get_page_by_path( 'literature' ) ) ?: '#',
            ),
        );
        ?>
        <div class="lantern-pathways">
            <?php foreach ( $cards as $c ) : ?>
                <a class="lantern-pathway" href="<?php echo esc_url( $c['url'] ); ?>">
                    <span class="lantern-pathway__num"><?php echo esc_html( $c['eyebrow'] ); ?></span>
                    <h3 class="lantern-pathway__title"><?php echo esc_html( $c['title'] ); ?></h3>
                    <p class="lantern-pathway__desc"><?php echo esc_html( $c['desc'] ); ?></p>
                    <span class="lantern-pathway__more"><?php esc_html_e( 'Read more', 'lantern' ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer();
