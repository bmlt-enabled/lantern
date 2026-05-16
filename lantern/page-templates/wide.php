<?php
/**
 * Template Name: Wide (full-bleed content)
 *
 * Same as page.php but uses the wide shell — useful for landing pages
 * built entirely from blocks.
 *
 * @package Lantern
 */

get_header(); ?>

<article <?php post_class( 'lantern-content' ); ?>>
    <div class="lantern-shell lantern-shell--wide">
        <header class="lantern-stack" style="margin-bottom: 3rem;">
            <h1 class="lantern-page-title"><?php the_title(); ?></h1>
        </header>

        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
    </div>
</article>

<?php get_footer();
