<?php
/**
 * Single post template.
 *
 * @package Lantern
 */

get_header(); ?>

<article <?php post_class( 'lantern-content' ); ?>>
    <div class="lantern-shell lantern-shell--narrow">

        <?php while ( have_posts() ) : the_post(); ?>
            <header class="lantern-stack" style="margin-bottom: 3rem;">
                <span class="lantern-eyebrow"><?php esc_html_e( 'Journal', 'lantern' ); ?></span>
                <h1 class="lantern-page-title"><?php the_title(); ?></h1>
                <p class="lantern-post-meta">
                    <span><?php echo esc_html( get_the_date() ); ?></span>
                    <?php $author = get_the_author(); if ( $author ) : ?>
                        <span>·</span>
                        <span><?php echo esc_html( $author ); ?></span>
                    <?php endif; ?>
                    <?php if ( has_category() ) : ?>
                        <span>·</span>
                        <span><?php the_category( ', ' ); ?></span>
                    <?php endif; ?>
                </p>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="lantern-rule"></div>
                    <?php the_post_thumbnail( 'lantern-hero', array( 'class' => 'alignwide' ) ); ?>
                <?php endif; ?>
            </header>

            <div class="lantern-content__inner">
                <?php the_content(); ?>
                <?php wp_link_pages( array(
                    'before' => '<nav class="lantern-pagination">',
                    'after'  => '</nav>',
                ) ); ?>

                <?php if ( has_tag() ) : ?>
                    <hr class="lantern-rule">
                    <p class="lantern-flex" style="font-size: var(--lantern-step--1);">
                        <span class="lantern-eyebrow" style="margin-bottom:0;"><?php esc_html_e( 'Filed under', 'lantern' ); ?></span>
                        <?php the_tags( '', ' · ', '' ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <?php if ( comments_open() || get_comments_number() ) : ?>
                <div class="lantern-content__inner" style="margin-top: 4rem;">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>

    </div>
</article>

<?php get_footer();
