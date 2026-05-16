<?php
/**
 * Comments template.
 *
 * @package Lantern
 */

if ( post_password_required() ) {
    return;
}
?>
<section class="lantern-comments">
    <?php if ( have_comments() ) : ?>
        <h2><?php
            /* translators: %s: comment count */
            printf( esc_html( _nx( '%s thought', '%s thoughts', get_comments_number(), 'comment count', 'lantern' ) ), esc_html( number_format_i18n( get_comments_number() ) ) );
        ?></h2>

        <ol class="comment-list">
            <?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true ) ); ?>
        </ol>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
        <?php comment_form(); ?>
    <?php endif; ?>
</section>
