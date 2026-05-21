<?php
/**
 * Template Name: Literature
 *
 * Recovery literature index — booklets, IPs, group readings — plus
 * e-book retailer links. Listings are intentionally hard-coded here
 * because NA's literature catalog rarely changes; service bodies can
 * tweak titles, URLs, or cover image URLs by editing the arrays below.
 *
 * Cover images and PDF pages are served directly from na.org's CDN
 * (`na.org/wp-content/uploads/...` and `na.org/e-lit/...`), so no images
 * are bundled with the theme. If NA reorganizes those paths, update the
 * arrays here.
 *
 * @package Lantern
 */

get_header();

$cdn = 'https://na.org/wp-content/uploads/2024/05/';

$booklets = array(
    array( 'title' => __( 'NA White Booklet: Narcotics Anonymous', 'lantern' ),         'url' => 'https://na.org/e-lit/white-booklet/',                  'image' => $cdn . 'White-Booklet-e1717010586732.webp' ),
    array( 'title' => __( 'The Group Booklet', 'lantern' ),                             'url' => 'https://na.org/e-lit/the-group-booklet/',              'image' => $cdn . 'Group-Booklet-300px.webp' ),
    array( 'title' => __( 'Twelve Concepts for NA Service', 'lantern' ),                'url' => 'https://na.org/e-lit/twelve-concepts-for-na-service/', 'image' => $cdn . '12-Concepts-for-NA-Service-e1717010547583.webp' ),
    array( 'title' => __( 'An Introductory Guide to Narcotics Anonymous', 'lantern' ),  'url' => 'https://na.org/e-lit/an-introductory-guide-to-na/',    'image' => $cdn . 'Intro-Guide-300px.webp' ),
    array( 'title' => __( 'Behind the Walls', 'lantern' ),                              'url' => 'https://na.org/e-lit/behind-the-walls/',               'image' => $cdn . 'Behind-the-Walls-e1717010621923.webp' ),
    array( 'title' => __( 'In Times of Illness', 'lantern' ),                           'url' => 'https://na.org/e-lit/in-times-of-illness/',            'image' => $cdn . 'In-Times-of-Illness-e1717010610682.webp' ),
    array( 'title' => __( 'Working Step Four in Narcotics Anonymous', 'lantern' ),      'url' => 'https://na.org/e-lit/working-step-four-in-na/',        'image' => $cdn . 'Working-Step-Four-e1717010574434.webp' ),
    array( 'title' => __( 'Narcotics Anonymous: A Resource in Your Community', 'lantern' ), 'url' => 'https://na.org/e-lit/na-a-resource-in-your-community/', 'image' => $cdn . 'NA-A-Resource-e1717010560471.webp' ),
);

$pamphlets = array(
    array( 'title' => __( 'IP #1, Who, What, How, and Why', 'lantern' ),                          'url' => 'https://na.org/e-lit/ip-1-who-what-how-and-why/',           'image' => $cdn . 'IP-1.webp' ),
    array( 'title' => __( 'IP #2, The Group', 'lantern' ),                                        'url' => 'https://na.org/e-lit/ip-2-the-group/',                      'image' => $cdn . 'IP-2.webp' ),
    array( 'title' => __( 'IP #5, Another Look', 'lantern' ),                                     'url' => 'https://na.org/e-lit/ip-5-another-look/',                   'image' => $cdn . 'IP-5.webp' ),
    array( 'title' => __( 'IP #6, Recovery & Relapse', 'lantern' ),                               'url' => 'https://na.org/e-lit/ip-6-recovery-relapse/',               'image' => $cdn . 'IP-6.webp' ),
    array( 'title' => __( 'IP #7, Am I an Addict?', 'lantern' ),                                  'url' => 'https://na.org/e-lit/ip-7-am-i-an-addict/',                 'image' => $cdn . 'IP-7.webp' ),
    array( 'title' => __( 'IP #8, Just for Today', 'lantern' ),                                   'url' => 'https://na.org/e-lit/ip-8-just-for-today/',                 'image' => $cdn . 'IP-8.webp' ),
    array( 'title' => __( 'IP #9, Living the Program', 'lantern' ),                               'url' => 'https://na.org/e-lit/ip-9-living-the-program/',             'image' => $cdn . 'IP-9.webp' ),
    array( 'title' => __( 'IP #11, Sponsorship', 'lantern' ),                                     'url' => 'https://na.org/e-lit/ip-11-sponsorship/',                   'image' => $cdn . 'IP-11.webp' ),
    array( 'title' => __( 'IP #12, The Triangle of Self-Obsession', 'lantern' ),                  'url' => 'https://na.org/e-lit/ip-12-the-triangle-of-self-obsession/', 'image' => $cdn . 'IP-12.webp' ),
    array( 'title' => __( 'IP #13, By Young Addicts…', 'lantern' ),                               'url' => 'https://na.org/e-lit/ip-13-by-young-addicts/',              'image' => $cdn . 'IP-13.webp' ),
    array( 'title' => __( 'IP #14, One Addict\'s Experience…', 'lantern' ),                       'url' => 'https://na.org/e-lit/ip-14-one-addicts-experience/',        'image' => $cdn . 'IP-14.webp' ),
    array( 'title' => __( 'IP #15, PI and the NA Member', 'lantern' ),                            'url' => 'https://na.org/e-lit/ip-15-pi-and-the-na-member/',          'image' => $cdn . 'IP-15.webp' ),
    array( 'title' => __( 'IP #16, For the Newcomer', 'lantern' ),                                'url' => 'https://na.org/e-lit/ip-16-for-the-newcomer/',              'image' => $cdn . 'IP-16.webp' ),
    array( 'title' => __( 'IP #17, For Those in Treatment', 'lantern' ),                          'url' => 'https://na.org/e-lit/ip-17-for-those-in-treatment/',        'image' => $cdn . 'IP-17.webp' ),
    array( 'title' => __( 'IP #19, Self-Acceptance', 'lantern' ),                                 'url' => 'https://na.org/e-lit/ip-19-self-acceptance/',               'image' => $cdn . 'IP-19.webp' ),
    array( 'title' => __( 'IP #20, Hospitals & Institutions Service and the NA Member', 'lantern' ), 'url' => 'https://na.org/e-lit/ip-20-hi-service-and-the-na-member/', 'image' => $cdn . 'IP-20.webp' ),
    array( 'title' => __( 'IP #21, The Loner — Staying Clean in Isolation', 'lantern' ),          'url' => 'https://na.org/e-lit/ip-21-the-loner/',                     'image' => $cdn . 'IP-21.webp' ),
    array( 'title' => __( 'IP #22, Welcome to Narcotics Anonymous', 'lantern' ),                  'url' => 'https://na.org/e-lit/ip-22-welcome-to-na/',                 'image' => $cdn . 'IP-22.webp' ),
    array( 'title' => __( 'IP #23, Staying Clean on the Outside', 'lantern' ),                    'url' => 'https://na.org/e-lit/ip-23-staying-clean-on-the-outside/',  'image' => $cdn . 'IP-23.webp' ),
    array( 'title' => __( 'IP #24, Money Matters, Self-Support in NA', 'lantern' ),               'url' => 'https://na.org/e-lit/ip-24-money-matters-self-support-in-na/', 'image' => $cdn . 'IP-24.webp' ),
    array( 'title' => __( 'IP #26, Accessibility for Those with Additional Needs', 'lantern' ),   'url' => 'https://na.org/e-lit/ip-26-accessibility/',                 'image' => $cdn . 'IP-26.webp' ),
    array( 'title' => __( 'IP #27, For the Parents…', 'lantern' ),                                'url' => 'https://na.org/e-lit/ip-27-for-the-parents/',               'image' => $cdn . 'IP-27.webp' ),
    array( 'title' => __( 'IP #28, Funding NA Services', 'lantern' ),                             'url' => 'https://na.org/e-lit/ip-28-funding-na-services/',           'image' => $cdn . 'IP-28.webp' ),
    array( 'title' => __( 'IP #29, An Introduction to NA Meetings', 'lantern' ),                  'url' => 'https://na.org/e-lit/ip-29-introduction-to-na-meetings/',   'image' => $cdn . 'IP-29.webp' ),
    array( 'title' => __( 'IP #30, Mental Health in Recovery', 'lantern' ),                       'url' => 'https://na.org/e-lit/ip-30-mental-health-in-recovery/',     'image' => $cdn . 'IP-30.webp' ),
);

$readings = array(
    array( 'title' => __( 'How It Works (Group Reading)', 'lantern' ),                            'url' => 'https://na.org/e-lit/how-it-works-group-reading/',          'image' => $cdn . 'GRC-How-it-Works-300px.webp' ),
    array( 'title' => __( 'Just for Today (Group Reading)', 'lantern' ),                          'url' => 'https://na.org/e-lit/just-for-today-group-reading/',        'image' => $cdn . 'GRC-JFT-300px.webp' ),
    array( 'title' => __( 'The Twelve Traditions of NA (Group Reading)', 'lantern' ),             'url' => 'https://na.org/e-lit/the-twelve-traditions-of-na-group-reading/', 'image' => $cdn . 'GRC-Twelve-Traditions-300px.webp' ),
    array( 'title' => __( 'We Do Recover (Group Reading)', 'lantern' ),                           'url' => 'https://na.org/e-lit/we-do-recover-group-reading/',         'image' => $cdn . 'GRC-We-Do-Recover-300px.webp' ),
    array( 'title' => __( 'What Is the Narcotics Anonymous Program? (Group Reading)', 'lantern' ), 'url' => 'https://na.org/e-lit/what-is-the-na-program-group-reading/', 'image' => $cdn . 'GRC-What-Is-NA-Program-300px.webp' ),
    array( 'title' => __( 'Who Is an Addict? (Group Reading)', 'lantern' ),                       'url' => 'https://na.org/e-lit/who-is-an-addict/',                    'image' => $cdn . 'GRC-Who-Is-an-Addict-300px.webp' ),
    array( 'title' => __( 'Why Are We Here? (Group Reading)', 'lantern' ),                        'url' => 'https://na.org/e-lit/why-are-we-here-group-reading/',       'image' => $cdn . 'GRC-Why-Are-We-Here-300px.webp' ),
);

// Inline SVG marks for the four retailers. All use `currentColor`, so the
// stroke/fill tints from `.lantern-ebook-card__icon` color — no per-brand
// palette baked into the SVG itself.
$icon_apple = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="1.2"/><path d="M16.36 16.83c-.45.66-.92 1.31-1.66 1.32-.73.02-.97-.43-1.81-.43-.84 0-1.1.41-1.79.45-.71.03-1.26-.71-1.71-1.37-.93-1.34-1.64-3.79-.69-5.44.48-.83 1.32-1.35 2.24-1.36.7-.01 1.36.47 1.79.47.43 0 1.23-.58 2.07-.49.35.01 1.34.14 1.97 1.07-.05.03-1.18.69-1.17 2.06.01 1.64 1.43 2.18 1.45 2.19-.02.05-.23.78-.69 1.53zM13.42 7.7c.39-.47.66-1.13.59-1.78-.57.02-1.26.38-1.66.85-.36.41-.68 1.07-.6 1.71.64.05 1.29-.32 1.67-.78z" fill="currentColor"/></svg>';
$icon_amazon = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M14.7 11.4c-.3 0-.5 0-.8.1-1.7.2-3.5.7-3.5 2.7 0 1 .5 1.7 1.4 1.7.7 0 1.3-.4 1.7-.9.5-.7.5-1.3.5-2v-1.6h-.3zm2.5 5.4c-.2.2-.4.2-.6.1-.9-.7-1-1-1.5-1.7-1.4 1.4-2.4 1.9-4.2 1.9-2.2 0-3.9-1.4-3.9-4 0-2.1 1.1-3.5 2.7-4.2 1.4-.6 3.3-.7 4.8-.9V7.7c0-.6.1-1.3-.3-1.8-.3-.5-.9-.6-1.5-.6-1 0-1.9.5-2.1 1.6-.1.2-.2.5-.5.5l-2.6-.3c-.2-.1-.5-.2-.4-.6.6-3.1 3.4-4.1 5.9-4.1 1.3 0 2.9.3 3.9 1.3 1.3 1.2 1.2 2.7 1.2 4.4v4c0 1.2.5 1.7.9 2.4.2.2.2.5 0 .7-.5.4-1.4 1.2-1.8 1.6zm3.6 1.6c-2.6 1.9-6.4 2.9-9.7 2.9-4.6 0-8.7-1.7-11.9-4.5-.2-.2 0-.5.3-.4 3.4 2 7.6 3.2 11.9 3.2 2.9 0 6.1-.6 9-1.8.4-.2.8.3.4.6zm1.1-1.2c-.3-.4-2.2-.2-3-.1-.2 0-.3-.2-.1-.3 1.5-1.1 4-.8 4.3-.4.3.4-.1 2.9-1.5 4.1-.2.2-.4.1-.3-.1.3-.8 1-2.7.6-3.2z" fill="currentColor"/></svg>';
$icon_google = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M3.6 1.7c-.3.3-.5.8-.5 1.5v17.6c0 .7.2 1.2.5 1.5l.1.1L13.5 12.5v-.2L3.7 1.7h-.1z" fill="currentColor"/><path d="M16.8 15.8l-3.3-3.3v-.2l3.3-3.3.1.1 3.9 2.2c1.1.6 1.1 1.7 0 2.3l-3.9 2.2-.1.1z" fill="currentColor" opacity=".75"/><path d="M16.9 15.7L13.5 12.3 3.6 22.3c.4.4 1 .4 1.7 0l11.6-6.6" fill="currentColor" opacity=".55"/><path d="M16.9 8.9L5.3 2.3c-.7-.4-1.3-.4-1.7 0l9.9 9.9 3.4-3.3z" fill="currentColor" opacity=".9"/></svg>';
$icon_bn = '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="M6 3.5h11a1 1 0 0 1 1 1V20a.5.5 0 0 1-.5.5H7A2.5 2.5 0 0 1 4.5 18V5A1.5 1.5 0 0 1 6 3.5z" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M4.5 18A2.5 2.5 0 0 1 7 15.5h11" fill="none" stroke="currentColor" stroke-width="1.3"/></svg>';

$ebook_retailers = array(
    array(
        'name' => __( 'Apple Books', 'lantern' ),
        'url'  => 'https://books.apple.com/us/author/fellowship-of-narcotics-anonymous/id560642479?see-all=books',
        'icon' => $icon_apple,
    ),
    array(
        'name' => __( 'Amazon Kindle', 'lantern' ),
        'url'  => 'https://www.amazon.com/author/naworldservices',
        'icon' => $icon_amazon,
    ),
    array(
        'name' => __( 'Google Play', 'lantern' ),
        'url'  => 'https://play.google.com/store/books/author?id=Fellowship+of+Narcotics+Anonymous',
        'icon' => $icon_google,
    ),
    array(
        'name' => __( 'Barnes & Noble', 'lantern' ),
        'url'  => 'https://www.barnesandnoble.com/s/%22Narcotics+Anonymous+Fellowship%22?Ntk=P_key_Contributor_List&Ns=P_Sales_Rank&Ntx=mode+matchall',
        'icon' => $icon_bn,
    ),
);

$gift_links = array(
    array( 'label' => __( 'iBooks/iTunes for iOS and Mac', 'lantern' ),         'url' => 'https://support.apple.com/en-us/HT201783' ),
    array( 'label' => __( 'Amazon (Kindle)', 'lantern' ),                       'url' => 'https://www.wikihow.com/Gift-a-Kindle-Book-on-Amazon' ),
    array( 'label' => __( 'Google Play (for all Android devices)', 'lantern' ), 'url' => 'https://support.google.com/googleplay/answer/2850372?co=GENIE.Platform%3DAndroid&hl=en' ),
);

/**
 * Inline helper: render a category accordion with a grid of literature cards.
 */
$render_section = function ( $title, $items, $open = false ) {
    if ( empty( $items ) ) {
        return;
    }
    printf(
        '<details class="lantern-lit-section"%s><summary class="lantern-lit-section__summary"><span>%s</span><span class="lantern-lit-section__chevron" aria-hidden="true">▾</span></summary><div class="lantern-lit-grid">',
        $open ? ' open' : '',
        esc_html( $title )
    );
    foreach ( $items as $item ) {
        $url   = ! empty( $item['url'] )   ? $item['url']   : '#';
        $image = ! empty( $item['image'] ) ? $item['image'] : '';
        $title_html = esc_html( $item['title'] );
        $image_html = $image
            ? sprintf(
                '<span class="lantern-lit-card__cover"><img src="%s" alt="" loading="lazy" decoding="async"></span>',
                esc_url( $image )
            )
            : '';
        printf(
            '<a class="lantern-lit-card" href="%s" target="_blank" rel="noopener">%s<span class="lantern-lit-card__title">%s</span></a>',
            esc_url( $url ),
            $image_html, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — assembled above with esc_url
            $title_html
        );
    }
    echo '</div></details>';
};
?>

<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 3rem; max-width: 60ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Read', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lantern-page-subtitle">
                    <?php esc_html_e( 'Narcotics Anonymous booklets, informational pamphlets, group readings, and e-book editions.', 'lantern' ); ?>
                </p>
            <?php endif; endwhile; ?>
        </header>

        <h2 class="lantern-lit-heading"><?php esc_html_e( 'Recovery Literature', 'lantern' ); ?></h2>

        <?php
        $render_section( __( 'Booklets', 'lantern' ),                $booklets,  true );
        $render_section( __( 'Informational Pamphlets', 'lantern' ), $pamphlets, false );
        $render_section( __( 'Group Readings', 'lantern' ),          $readings,  false );
        ?>

        <h2 class="lantern-lit-heading" style="margin-top: 4rem;"><?php esc_html_e( 'E-Literature', 'lantern' ); ?></h2>
        <p class="lantern-lit-intro">
            <?php esc_html_e( 'NA literature is also available as e-books from the following retailers. Choose the platform you prefer.', 'lantern' ); ?>
        </p>

        <div class="lantern-ebook-grid">
            <?php foreach ( $ebook_retailers as $r ) : ?>
                <a class="lantern-ebook-card" href="<?php echo esc_url( $r['url'] ); ?>" target="_blank" rel="noopener">
                    <span class="lantern-ebook-card__icon" aria-hidden="true">
                        <?php echo $r['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — hard-coded SVG above ?>
                    </span>
                    <span class="lantern-ebook-card__name"><?php echo esc_html( $r['name'] ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <h3 class="lantern-lit-subheading"><?php esc_html_e( 'How to gift books on these platforms', 'lantern' ); ?></h3>
        <ul class="lantern-lit-gift-list">
            <?php foreach ( $gift_links as $g ) : ?>
                <li><a href="<?php echo esc_url( $g['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $g['label'] ); ?></a></li>
            <?php endforeach; ?>
        </ul>

        <p class="lantern-lit-disclaimer">
            <?php
            printf(
                /* translators: %s: NA World Services link. */
                esc_html__( 'All free literature is hosted by %s and is the property of NA World Services, Inc. NAWS does not endorse any of the e-book retailers above; they simply provide the platform needed to bring an e-book to the reader. Links open in a new tab.', 'lantern' ),
                '<a href="https://www.na.org/" target="_blank" rel="noopener">na.org</a>' // phpcs:ignore
            );
            ?>
        </p>
    </div>
</section>

<?php get_footer();
