<?php
/**
 * Lantern Customizer — service body, helpline, BMLT, palette overrides.
 *
 * @package Lantern
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function lantern_customize_register( WP_Customize_Manager $wp_customize ) {

    /* ===================== Service Body ===================== */
    $wp_customize->add_section( 'lantern_service_body', array(
        'title'       => __( 'Service Body', 'lantern' ),
        'priority'    => 20,
        'description' => __( 'Identity for your region, area, or zonal forum.', 'lantern' ),
    ) );

    $controls = array(
        'service_body_name' => array(
            'label'   => __( 'Service body name', 'lantern' ),
            'default' => '',
            'type'    => 'text',
            'desc'    => __( 'Defaults to the site title if left blank.', 'lantern' ),
        ),
        'service_body_tag' => array(
            'label'   => __( 'Brand tagline', 'lantern' ),
            'default' => __( 'Narcotics Anonymous', 'lantern' ),
            'type'    => 'text',
        ),
        'year_founded' => array(
            'label'   => __( 'Year founded', 'lantern' ),
            'default' => '',
            'type'    => 'text',
        ),
        'weekly_meeting_count' => array(
            'label'   => __( 'Weekly meeting count (shown in hero)', 'lantern' ),
            'default' => '',
            'type'    => 'text',
        ),
        'area_count' => array(
            'label'   => __( 'Number of areas (shown in hero)', 'lantern' ),
            'default' => '',
            'type'    => 'text',
        ),
    );

    foreach ( $controls as $key => $args ) {
        $wp_customize->add_setting( 'lantern_' . $key, array(
            'default'           => $args['default'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( 'lantern_' . $key, array(
            'section'     => 'lantern_service_body',
            'label'       => $args['label'],
            'description' => $args['desc'] ?? '',
            'type'        => $args['type'],
        ) );
    }

    /* ===================== Helpline ===================== */
    $wp_customize->add_section( 'lantern_helpline', array(
        'title'    => __( 'Helpline', 'lantern' ),
        'priority' => 25,
    ) );
    $wp_customize->add_setting( 'lantern_helpline_number', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'lantern_helpline_number', array(
        'section'     => 'lantern_helpline',
        'label'       => __( 'Helpline number (display)', 'lantern' ),
        'description' => __( 'Example: 1-866-624-3578. Used in header, footer, and homepage strip.', 'lantern' ),
        'type'        => 'text',
    ) );
    $wp_customize->add_setting( 'lantern_helpline_copy', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'lantern_helpline_copy', array(
        'section'     => 'lantern_helpline',
        'label'       => __( 'Helpline supporting copy', 'lantern' ),
        'type'        => 'textarea',
    ) );

    /* ===================== BMLT / Plugin connections ===================== */
    $wp_customize->add_section( 'lantern_bmlt', array(
        'title'    => __( 'BMLT & plugins', 'lantern' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'lantern_bmlt_server', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'lantern_bmlt_server', array(
        'section'     => 'lantern_bmlt',
        'label'       => __( 'BMLT root server URL', 'lantern' ),
        'description' => __( 'Example: https://bmlt.example.org/main_server', 'lantern' ),
        'type'        => 'url',
    ) );

    $page_setting = function( $key, $label ) use ( $wp_customize ) {
        $wp_customize->add_setting( 'lantern_' . $key, array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( 'lantern_' . $key, array(
            'section' => 'lantern_bmlt',
            'label'   => $label,
            'type'    => 'dropdown-pages',
        ) );
    };
    $page_setting( 'meeting_finder_page', __( 'Meeting finder page', 'lantern' ) );
    $page_setting( 'about_page',          __( 'About-NA page', 'lantern' ) );

    /* ===================== Homepage copy ===================== */
    $wp_customize->add_section( 'lantern_home', array(
        'title'    => __( 'Homepage copy', 'lantern' ),
        'priority' => 35,
    ) );

    $home_fields = array(
        'home_tagline'    => array( __( 'Hero tagline (HTML allowed: em, span.lantern-underline)', 'lantern' ), 'textarea' ),
        'home_lede'       => array( __( 'Hero lede paragraph', 'lantern' ),       'textarea' ),
        'hero_quote'      => array( __( 'Hero quote (aside)', 'lantern' ),         'text' ),
        'about_blurb'     => array( __( 'About paragraph 1', 'lantern' ),          'textarea' ),
        'about_blurb_2'   => array( __( 'About paragraph 2', 'lantern' ),          'textarea' ),
        'pillar_quote'    => array( __( 'Pillar quote (dark band)', 'lantern' ),   'textarea' ),
        'closing_title'   => array( __( 'Closing CTA title (HTML allowed)', 'lantern' ), 'text' ),
        'closing_lede'    => array( __( 'Closing CTA paragraph', 'lantern' ),      'textarea' ),
    );
    foreach ( $home_fields as $key => $args ) {
        $wp_customize->add_setting( 'lantern_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( 'lantern_' . $key, array(
            'section' => 'lantern_home',
            'label'   => $args[0],
            'type'    => $args[1],
        ) );
    }

    /* ===================== Footer ===================== */
    $wp_customize->add_section( 'lantern_footer', array(
        'title'    => __( 'Footer', 'lantern' ),
        'priority' => 40,
    ) );
    $footer_fields = array(
        'footer_about'      => array( __( 'About blurb', 'lantern' ),  'textarea' ),
        'footer_disclaimer' => array( __( 'Disclaimer', 'lantern' ),   'text' ),
        'footer_motto'      => array( __( 'Motto / tradition line', 'lantern' ), 'textarea' ),
    );
    foreach ( $footer_fields as $key => $args ) {
        $wp_customize->add_setting( 'lantern_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ) );
        $wp_customize->add_control( 'lantern_' . $key, array(
            'section' => 'lantern_footer',
            'label'   => $args[0],
            'type'    => $args[1],
        ) );
    }

    /* ===================== Palette overrides ===================== */
    $wp_customize->add_section( 'lantern_palette', array(
        'title'       => __( 'Palette', 'lantern' ),
        'description' => __( 'Override the default Lantern palette for your service body. Leave blank to use the defaults.', 'lantern' ),
        'priority'    => 45,
    ) );

    $colors = array(
        'paper'      => array( __( 'Paper (background)', 'lantern' ), '#f7f1e6' ),
        'ink'        => array( __( 'Ink (deep text / nav)', 'lantern' ), '#1a2538' ),
        'ember'      => array( __( 'Ember (accent / CTAs)', 'lantern' ), '#c7572b' ),
        'sage'       => array( __( 'Sage (secondary)', 'lantern' ),   '#5d7561' ),
    );
    foreach ( $colors as $slug => $args ) {
        $wp_customize->add_setting( 'lantern_color_' . $slug, array(
            'default'           => $args[1],
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lantern_color_' . $slug, array(
            'section' => 'lantern_palette',
            'label'   => $args[0],
        ) ) );
    }
}
add_action( 'customize_register', 'lantern_customize_register' );

/**
 * Print palette overrides as inline CSS.
 */
function lantern_palette_css() {
    $map = array(
        'paper' => 'lantern-paper',
        'ink'   => 'lantern-ink',
        'ember' => 'lantern-ember',
        'sage'  => 'lantern-sage',
    );
    $css = '';
    foreach ( $map as $slug => $token ) {
        $value = get_theme_mod( 'lantern_color_' . $slug, '' );
        if ( $value ) {
            $css .= "--{$token}: " . esc_attr( $value ) . ";\n";
        }
    }
    if ( $css ) {
        echo "<style id='lantern-palette'>:root{\n{$css}}</style>\n";
    }
}
add_action( 'wp_head', 'lantern_palette_css', 100 );
