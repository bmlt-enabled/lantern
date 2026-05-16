<?php
/**
 * Archive template.
 *
 * @package Lantern
 */

get_header(); ?>

<section class="lantern-section">
    <div class="lantern-shell">

        <header class="lantern-stack" style="margin-bottom: 3rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Archive', 'lantern' ); ?></span>
            <h1 class="lantern-page-title"><?php the_archive_title(); ?></h1>
            <?php
            $description = get_the_archive_description();
            if ( $description ) {
                echo '<p class="lantern-page-subtitle">' . wp_kses_post( $description ) . '</p>';
            }
            ?>
        </header>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class( 'lantern-post-card' ); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a class="lantern-post-card__thumb" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'lantern-card' ); ?>
                        </a>
                    <?php else : ?>
                        <a class="lantern-post-card__thumb" href="<?php the_permalink(); ?>" aria-hidden="true" style="display:grid; place-items:center; color: var(--lantern-ink-faint); font-family: var(--lantern-display); font-size: 3rem;">
                            <?php echo esc_html( strtoupper( substr( get_the_title(), 0, 1 ) ) ); ?>
                        </a>
                    <?php endif; ?>
                    <div>
                        <p class="lantern-post-meta">
                            <span><?php echo esc_html( get_the_date() ); ?></span>
                        </p>
                        <h2 class="lantern-post-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <p class="lantern-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32, '…' ) ); ?></p>
                        <a class="lantern-pathway__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'lantern' ); ?></a>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php lantern_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Nothing here yet.', 'lantern' ); ?></p>
        <?php endif; ?>

    </div>
</section>

<?php get_footer();
