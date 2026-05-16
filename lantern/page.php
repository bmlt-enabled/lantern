<?php
/**
 * Default page template.
 *
 * @package Lantern
 */

get_header(); ?>

<article <?php post_class( 'lantern-content' ); ?>>
    <div class="lantern-shell lantern-shell--narrow">
        <header class="lantern-stack" style="margin-bottom: 3rem;">
            <?php
            $eyebrow = get_post_meta( get_the_ID(), 'lantern_eyebrow', true );
            if ( $eyebrow ) : ?>
                <span class="lantern-eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
            <?php endif; ?>

            <h1 class="lantern-page-title"><?php the_title(); ?></h1>

            <?php
            $subtitle = get_post_meta( get_the_ID(), 'lantern_subtitle', true );
            if ( $subtitle ) : ?>
                <p class="lantern-page-subtitle"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="lantern-rule"></div>
                <?php the_post_thumbnail( 'lantern-hero', array( 'class' => 'alignwide', 'loading' => 'eager' ) ); ?>
            <?php endif; ?>
        </header>

        <?php while ( have_posts() ) : the_post(); ?>
            <div class="lantern-content__inner">
                <?php the_content(); ?>
                <?php wp_link_pages( array(
                    'before' => '<nav class="lantern-pagination">',
                    'after'  => '</nav>',
                ) ); ?>
            </div>
        <?php endwhile; ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="lantern-content__inner" style="margin-top: 4rem;">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>
    </div>
</article>

<?php get_footer();
