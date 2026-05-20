<?php
/**
 * Sidebar. Rendered only when a template calls get_sidebar() and the user
 * has actually placed widgets in the "Sidebar" area.
 *
 * @package Lantern
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>
<aside class="lantern-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'lantern' ); ?>">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
