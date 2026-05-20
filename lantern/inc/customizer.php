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

    /* ===================== Page links ===================== */
    // One dropdown-pages picker per navigable slot. Templates resolve URLs
    // through {@see lantern_page_url()} so admins can route each link at any
    // page without editing template files.
    $wp_customize->add_section( 'lantern_links', array(
        'title'       => __( 'Page links', 'lantern' ),
        'description' => __( 'Point each themed link at a page. Leave blank to fall back to slug-based detection (e.g. /newcomer). Slots without a page hide their card.', 'lantern' ),
        'priority'    => 28,
    ) );
    foreach ( lantern_link_slots() as $slot => $args ) {
        $wp_customize->add_setting( 'lantern_link_' . $slot, array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ) );
        $wp_customize->add_control( 'lantern_link_' . $slot, array(
            'section' => 'lantern_links',
            'label'   => $args['label'],
            'type'    => 'dropdown-pages',
            'allow_addition' => true,
        ) );
    }

    /* ===================== Homepage copy ===================== */
    $wp_customize->add_section( 'lantern_home', array(
        'title'    => __( 'Homepage copy', 'lantern' ),
        'priority' => 35,
    ) );

    // key => [ label, input-type, css-selector-in-front-page ]
    $home_fields = array(
        'home_tagline'    => array( __( 'Hero tagline (HTML allowed: em, span.lantern-underline)', 'lantern' ), 'textarea', '.lantern-hero__title' ),
        'home_lede'       => array( __( 'Hero lede paragraph', 'lantern' ),         'textarea', '.lantern-hero__lede' ),
        'hero_quote'      => array( __( 'Hero quote (aside)', 'lantern' ),          'text',     '.lantern-edit-hero-quote' ),
        'about_blurb'     => array( __( 'About paragraph 1', 'lantern' ),           'textarea', '.lantern-edit-about-blurb' ),
        'about_blurb_2'   => array( __( 'About paragraph 2', 'lantern' ),           'textarea', '.lantern-edit-about-blurb-2' ),
        'pillar_quote'    => array( __( 'Pillar quote (dark band)', 'lantern' ),    'textarea', '.lantern-edit-pillar-quote' ),
        'closing_title'   => array( __( 'Closing CTA title (HTML allowed)', 'lantern' ), 'text',     '.lantern-edit-closing-title' ),
        'closing_lede'    => array( __( 'Closing CTA paragraph', 'lantern' ),       'textarea', '.lantern-edit-closing-lede' ),
    );
    foreach ( $home_fields as $key => $args ) {
        $wp_customize->add_setting( 'lantern_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( 'lantern_' . $key, array(
            'section' => 'lantern_home',
            'label'   => $args[0],
            'type'    => $args[1],
        ) );

        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial( 'lantern_' . $key, array(
                'selector'        => $args[2],
                'settings'        => array( 'lantern_' . $key ),
                'render_callback' => function() use ( $key ) {
                    return lantern_render_home_partial( $key );
                },
            ) );
        }
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
 * Render one home-page editable field for the Customizer's selective-refresh
 * preview. The output must match what front-page.php emits inside the same
 * wrapper element (the selector points at), so a partial refresh swaps just
 * the text node without breaking layout.
 */
function lantern_render_home_partial( $key ) {
    $defaults = array(
        'home_tagline'  => __( 'You never have to <em>use</em> again. You never have to be <span class="lantern-underline">alone.</span>', 'lantern' ),
        'home_lede'     => __( 'A community of recovering addicts in service to each other. Find a meeting, read today\'s meditation, or reach the helpline.', 'lantern' ),
        'hero_quote'    => __( '“We do recover.”', 'lantern' ),
        'about_blurb'   => __( 'Narcotics Anonymous is a global, peer-based program of recovery from addiction. Membership is free, requires only the desire to stop using, and is open to any addict regardless of substance. We meet, in-person and online, in church basements, community centers, hospitals, and prisons — every day of the week.', 'lantern' ),
        'about_blurb_2' => __( 'The program is non-religious, non-political, and not affiliated with any other organization. It is a fellowship — members helping members, one day at a time.', 'lantern' ),
        'pillar_quote'  => __( '“The therapeutic value of one addict helping another is without parallel.”', 'lantern' ),
        'closing_title' => __( 'Whatever it takes. <em>Today.</em>', 'lantern' ),
        'closing_lede'  => __( 'You don\'t have to be clean to walk into a meeting. You just have to want to be.', 'lantern' ),
    );
    $value = lantern_option( $key, $defaults[ $key ] ?? '' );

    // home_tagline allows light inline markup — others are plain text.
    if ( in_array( $key, array( 'home_tagline', 'closing_title' ), true ) ) {
        return wp_kses( $value, array(
            'em'   => array(),
            'span' => array( 'class' => array() ),
            'br'   => array(),
        ) );
    }
    return esc_html( $value );
}

/**
 * Enqueue the customizer-preview script (live-binds postMessage settings).
 */
function lantern_customize_preview_js() {
    wp_enqueue_script(
        'lantern-customize-preview',
        LANTERN_URI . 'assets/js/customizer-preview.js',
        array( 'customize-preview' ),
        LANTERN_VERSION,
        true
    );
}
add_action( 'customize_preview_init', 'lantern_customize_preview_js' );

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
