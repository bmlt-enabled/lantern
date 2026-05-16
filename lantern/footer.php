<?php
/**
 * Site footer.
 *
 * @package Lantern
 */
?>
</main><!-- /#site-content -->

<footer class="lantern-footer" role="contentinfo">
    <span class="lantern-footer__mark" aria-hidden="true">N</span>

    <div class="lantern-shell lantern-shell--wide">

        <div class="lantern-footer__grid">

            <div class="lantern-footer__intro">
                <h4><?php echo esc_html( lantern_service_body_name() ); ?></h4>
                <?php
                $about = lantern_option(
                    'footer_about',
                    __( 'A regional Narcotics Anonymous service body. We are a non-profit fellowship of recovering addicts who meet regularly to help each other stay clean.', 'lantern' )
                );
                if ( $about ) : ?>
                    <p><?php echo wp_kses_post( $about ); ?></p>
                <?php endif; ?>

                <?php
                $helpline = lantern_helpline_number();
                if ( $helpline ) : ?>
                    <p>
                        <strong style="color: var(--lantern-sand); display:block; font-family: var(--lantern-body); font-size: 0.78rem; letter-spacing:0.22em; text-transform:uppercase;"><?php esc_html_e( '24-hour helpline', 'lantern' ); ?></strong>
                        <a href="tel:<?php echo esc_attr( lantern_helpline_tel() ); ?>" style="font-family: var(--lantern-display); font-size: 1.5rem; letter-spacing: -0.01em; color: var(--lantern-paper); text-decoration: none;">
                            <?php echo esc_html( $helpline ); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>

            <?php if ( has_nav_menu( 'public' ) ) : ?>
                <div>
                    <h4><?php esc_html_e( 'For the public', 'lantern' ); ?></h4>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'public',
                        'container'      => false,
                        'menu_class'     => '',
                        'depth'          => 1,
                    ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'members' ) ) : ?>
                <div>
                    <h4><?php esc_html_e( 'For members', 'lantern' ); ?></h4>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'members',
                        'container'      => false,
                        'menu_class'     => '',
                        'depth'          => 1,
                    ) ); ?>
                </div>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <div>
                    <h4><?php esc_html_e( 'Links', 'lantern' ); ?></h4>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => '',
                        'depth'          => 1,
                    ) ); ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="lantern-footer__base">
            <span>
                &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?>
                <?php echo esc_html( lantern_service_body_name() ); ?>
                <?php
                $disclaimer = lantern_option( 'footer_disclaimer', '' );
                if ( $disclaimer ) {
                    echo '&nbsp;·&nbsp;' . esc_html( $disclaimer );
                }
                ?>
            </span>
            <span class="lantern-traditions">
                <?php echo esc_html( lantern_option(
                    'footer_motto',
                    __( '“Our common welfare should come first; personal recovery depends on NA unity.”', 'lantern' )
                ) ); ?>
            </span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
