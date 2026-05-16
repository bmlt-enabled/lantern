<?php
/**
 * Search form.
 *
 * @package Lantern
 */
?>
<form role="search" method="get" class="lantern-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'lantern' ); ?></label>
    <input type="search" id="s" name="s" placeholder="<?php esc_attr_e( 'Search the site…', 'lantern' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
    <button type="submit" class="lantern-btn lantern-btn--ember"><?php esc_html_e( 'Search', 'lantern' ); ?></button>
</form>
