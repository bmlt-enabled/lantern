<?php
/**
 * Site header.
 *
 * @package Lantern
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#site-content"><?php esc_html_e( 'Skip to content', 'lantern' ); ?></a>

<header class="lantern-header" role="banner">
    <div class="lantern-shell lantern-shell--wide lantern-header__inner">

        <a class="lantern-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if ( has_custom_logo() ) : ?>
                <span class="lantern-brand__mark"><?php the_custom_logo(); ?></span>
            <?php else : ?>
                <?php
                $mark_letter = strtoupper( substr( wp_strip_all_tags( lantern_service_body_name() ), 0, 1 ) );
                ?>
                <span class="lantern-brand__mark" aria-hidden="true"><?php echo esc_html( $mark_letter ?: 'N' ); ?></span>
            <?php endif; ?>
            <span>
                <span class="lantern-brand__name"><?php echo esc_html( lantern_service_body_name() ); ?></span>
                <?php
                $tag = lantern_option( 'service_body_tag', __( 'Narcotics Anonymous', 'lantern' ) );
                if ( $tag ) : ?>
                    <span class="lantern-brand__tag"><?php echo esc_html( $tag ); ?></span>
                <?php endif; ?>
            </span>
        </a>

        <button class="lantern-burger" type="button" aria-controls="lantern-primary-nav" aria-expanded="false">
            <span class="lantern-burger__bars" aria-hidden="true"><span></span><span></span><span></span></span>
            <span><?php esc_html_e( 'Menu', 'lantern' ); ?></span>
        </button>

        <nav id="lantern-primary-nav" class="lantern-nav" aria-label="<?php esc_attr_e( 'Primary', 'lantern' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => '',
                    'depth'          => 2,
                ) );
            } else {
                lantern_fallback_menu();
            }
            ?>
        </nav>

        <?php
        $helpline = lantern_helpline_number();
        if ( $helpline ) : ?>
            <a class="lantern-header__cta" href="tel:<?php echo esc_attr( lantern_helpline_tel() ); ?>">
                <span class="lantern-header__cta__dot" aria-hidden="true"></span>
                <span>
                    <span style="display:block; font-size: 0.65rem; letter-spacing:0.18em; text-transform:uppercase; opacity:0.6;"><?php esc_html_e( 'Helpline', 'lantern' ); ?></span>
                    <?php echo esc_html( $helpline ); ?>
                </span>
            </a>
        <?php endif; ?>
    </div>
</header>

<main id="site-content" class="lantern-main">
