<?php
/**
 * Widget areas — optional sidebar + footer columns for service bodies that
 * prefer drag-and-drop over Customizer fields.
 *
 * @package Lantern
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function lantern_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'lantern' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Optional sidebar used by some page templates.', 'lantern' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'Footer column %d', 'lantern' ), $i ),
            'id'            => 'footer-' . $i,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'lantern_widgets_init' );
