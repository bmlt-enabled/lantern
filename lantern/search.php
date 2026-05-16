<?php
/**
 * Search results template.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell">

        <header class="lantern-stack" style="margin-bottom: 3rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Search', 'lantern' ); ?></span>
            <h1 class="lantern-page-title">
                <?php
                /* translators: %s: search query */
                printf( esc_html__( 'Results for “%s”', 'lantern' ), '<em>' . esc_html( get_search_query() ) . '</em>' );
                ?>
            </h1>
            <?php get_search_form(); ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class( 'lantern-post-card' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a class="lantern-post-card__thumb" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'lantern-card' ); ?>
                        </a>
                    <?php endif; ?>
                    <div>
                        <p class="lantern-post-meta">
                            <span><?php echo esc_html( get_the_date() ); ?></span>
                            <span>·</span>
                            <span><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></span>
                        </p>
                        <h2 class="lantern-post-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="lantern-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32, '…' ) ); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php lantern_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No results. Try another search.', 'lantern' ); ?></p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer();
