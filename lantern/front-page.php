<?php
/**
 * Front page — the editorial hub. Designed to gracefully degrade when
 * BMLT plugins (crumb / fetch-meditation / nacc / mayo) are not installed:
 * each section detects its shortcode and only renders if it can succeed.
 *
 * @package Lantern
 */

get_header();

$service_body  = lantern_service_body_name();
$tagline       = lantern_option( 'home_tagline', __( 'You never have to <em>use</em> again. You never have to be <span class="lantern-underline">alone.</span>', 'lantern' ) );
$lede          = lantern_option( 'home_lede', __( 'A community of recovering addicts in service to each other. Find a meeting, read today\'s meditation, or reach the helpline.', 'lantern' ) );
$year_founded  = lantern_option( 'year_founded', '1953' );
$founded_label = sprintf( __( 'Serving since %s', 'lantern' ), $year_founded );
$meeting_url   = lantern_meeting_finder_url();
?>

<!-- ===================== HERO ===================== -->
<section class="lantern-hero">
    <div class="lantern-shell lantern-shell--wide">

        <span class="lantern-hero__numerals" aria-hidden="true">NA</span>

        <div class="lantern-hero__grid">
            <div class="lantern-reveal">
                <span class="lantern-eyebrow"><?php echo esc_html( $founded_label ); ?></span>
                <h1 class="lantern-hero__title">
                    <?php
                    // Allow a small bit of markup (em / span.lantern-underline) in the tagline.
                    echo wp_kses( $tagline, array(
                        'em'   => array(),
                        'span' => array( 'class' => array() ),
                        'br'   => array(),
                    ) );
                    ?>
                </h1>
                <p class="lantern-hero__lede"><?php echo esc_html( $lede ); ?></p>

                <div class="lantern-hero__actions">
                    <a class="lantern-btn lantern-btn--ember" href="<?php echo esc_url( $meeting_url ); ?>">
                        <?php esc_html_e( 'Find a meeting', 'lantern' ); ?>
                        <span aria-hidden="true">→</span>
                    </a>
                    <?php $about_url = lantern_page_url( 'about' ); if ( $about_url ) : ?>
                        <a class="lantern-btn lantern-btn--ghost" href="<?php echo esc_url( $about_url ); ?>">
                            <?php esc_html_e( 'About NA', 'lantern' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <aside class="lantern-hero__aside lantern-hero__aside--quote lantern-reveal">
                <p class="lantern-edit-hero-quote" style="margin:0; font-family: var(--lantern-display); font-size: var(--lantern-step-4); line-height: 1.2; color: var(--lantern-ink-soft); font-style: italic;">
                    <?php echo esc_html( lantern_option( 'hero_quote', __( '“We do recover.”', 'lantern' ) ) ); ?>
                </p>
            </aside>
        </div>
    </div>
</section>

<!-- ===================== HELPLINE ===================== -->
<?php
$helpline = lantern_helpline_number();
$email    = lantern_contact_email();
if ( $helpline || $email ) : ?>
<section class="lantern-helpline" aria-labelledby="helpline-label">
    <div class="lantern-shell lantern-shell--wide lantern-helpline__row">
        <?php if ( $helpline ) : ?>
        <div>
            <span class="lantern-helpline__label" id="helpline-label"><?php esc_html_e( '24-Hour Helpline', 'lantern' ); ?></span><br>
            <a class="lantern-helpline__number" href="tel:<?php echo esc_attr( lantern_helpline_tel() ); ?>">
                <?php echo esc_html( $helpline ); ?>
            </a>
        </div>
        <?php endif; ?>

        <?php if ( $email ) : ?>
        <div>
            <span class="lantern-helpline__label"><?php esc_html_e( 'Email us:', 'lantern' ); ?></span><br>
            <a class="lantern-helpline__number" href="mailto:<?php echo esc_attr( $email ); ?>">
                <?php echo esc_html( $email ); ?>
            </a>
        </div>
        <?php endif; ?>

        <p class="lantern-helpline__copy">
            <?php echo esc_html( lantern_option(
                'helpline_copy',
                __( 'A recovering addict is on the other end. Calls are confidential. Available day or night, holidays included.', 'lantern' )
            ) ); ?>
        </p>
    </div>
</section>
<?php endif; ?>

<!-- ===================== PATHWAYS ===================== -->
<section class="lantern-section">
    <div class="lantern-shell lantern-shell--wide">
        <header class="lantern-stack" style="margin-bottom: 2.5rem; max-width: 60ch;">
            <span class="lantern-eyebrow lantern-edit-pathways-eyebrow"><?php echo esc_html( lantern_option( 'pathways_eyebrow', __( 'Where to start', 'lantern' ) ) ); ?></span>
            <h2 class="lantern-edit-pathways-title" style="font-size: var(--lantern-step-4); margin:0;"><?php echo esc_html( lantern_option( 'pathways_title', __( 'Three ways to take part.', 'lantern' ) ) ); ?></h2>
        </header>

        <?php
        $pathways = array(
            array(
                'slot'  => 'help',
                'title' => lantern_option( 'pathway_help_title', __( 'I need help', 'lantern' ) ),
                'desc'  => lantern_option( 'pathway_help_desc',  __( 'New, returning, or someone you love is struggling. Start with a meeting, the helpline, or a few words on what NA actually is.', 'lantern' ) ),
                'url'   => lantern_page_url( 'newcomer' ) ?: $meeting_url,
                'cta'   => lantern_option( 'pathway_help_cta',   __( 'Newcomer info', 'lantern' ) ),
            ),
            array(
                'slot'  => 'meeting',
                'title' => lantern_option( 'pathway_meeting_title', __( 'Find a meeting', 'lantern' ) ),
                'desc'  => lantern_option( 'pathway_meeting_desc',  __( 'Search by city, day, time, or format. In-person and online meetings happen every day of the week.', 'lantern' ) ),
                'url'   => $meeting_url,
                'cta'   => lantern_option( 'pathway_meeting_cta',   __( 'Open the finder', 'lantern' ) ),
            ),
            array(
                'slot'  => 'serve',
                'title' => lantern_option( 'pathway_serve_title', __( 'I serve', 'lantern' ) ),
                'desc'  => lantern_option( 'pathway_serve_desc',  __( 'Subcommittee minutes, event submissions, literature orders, and the trusted-servant calendar live behind the Members door.', 'lantern' ) ),
                'url'   => lantern_page_url( 'members' ),
                'cta'   => lantern_option( 'pathway_serve_cta',   __( 'For members', 'lantern' ) ),
            ),
        );
        $pathways = array_values( array_filter( $pathways, fn( $p ) => ! empty( $p['url'] ) ) );

        if ( $pathways ) {
            echo '<div class="lantern-pathways">';
            $i = 1;
            foreach ( $pathways as $p ) {
                printf(
                    '<a class="lantern-pathway lantern-reveal" href="%6$s">
                        <span class="lantern-pathway__num">%2$s</span>
                        <h3 class="lantern-pathway__title lantern-edit-pathway-%1$s-title">%3$s</h3>
                        <p class="lantern-pathway__desc lantern-edit-pathway-%1$s-desc">%4$s</p>
                        <span class="lantern-pathway__more lantern-edit-pathway-%1$s-cta">%5$s</span>
                    </a>',
                    esc_attr( $p['slot'] ),
                    esc_html( sprintf( '%02d', $i++ ) ),
                    esc_html( $p['title'] ),
                    esc_html( $p['desc'] ),
                    esc_html( $p['cta'] ),
                    esc_url( $p['url'] )
                );
            }
            echo '</div>';
        }
        ?>
    </div>
</section>

<!-- ===================== TODAY (Meditation + cleantime + quick refs) ===================== -->
<section class="lantern-section lantern-section--deep">
    <div class="lantern-shell lantern-shell--wide">
        <header class="lantern-stack" style="margin-bottom: 2.5rem;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'Today', 'lantern' ); ?></span>
            <h2 style="font-size: var(--lantern-step-4); margin:0;">
                <?php echo esc_html( wp_date( __( 'l, F j', 'lantern' ) ) ); ?>
            </h2>
        </header>

        <div class="lantern-today">

            <!-- Meditation -->
            <div class="lantern-today__main lantern-reveal">
                <?php if ( lantern_has_shortcode( 'jft' ) || lantern_has_shortcode( 'fetch_meditation' ) ) : ?>
                    <p class="lantern-today__date"><?php esc_html_e( 'Just for today', 'lantern' ); ?></p>
                    <?php
                    $excerpt_target = lantern_page_url( 'meditation' );
                    if ( $excerpt_target ) {
                        echo do_shortcode( '[jft excerpt="true" read_more_url="' . esc_url( $excerpt_target ) . '"]' );
                    } else {
                        echo do_shortcode( '[jft]' );
                    }
                    ?>
                <?php else : ?>
                    <p class="lantern-today__date"><?php esc_html_e( 'A daily reading', 'lantern' ); ?></p>
                    <h3 class="lantern-today__title"><?php esc_html_e( 'Install Fetch Meditation for daily readings.', 'lantern' ); ?></h3>
                    <p>
                        <?php
                        /* translators: %s: plugin name */
                        printf(
                            esc_html__( 'Lantern automatically displays the day\'s %s reading here. Install and activate the plugin from the WordPress directory to enable.', 'lantern' ),
                            '<em>Fetch Meditation</em>'
                        );
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Side cards -->
            <div class="lantern-today__side">

                <?php $cleantime_url = lantern_page_url( 'cleantime' ); if ( $cleantime_url ) : ?>
                <a class="lantern-side-card lantern-reveal" href="<?php echo esc_url( $cleantime_url ); ?>">
                    <span>
                        <span class="lantern-side-card__label lantern-edit-side-cleantime-label"><?php echo esc_html( lantern_option( 'side_cleantime_label', __( 'Cleantime', 'lantern' ) ) ); ?></span>
                        <span class="lantern-side-card__value lantern-edit-side-cleantime-value"><?php echo esc_html( lantern_option( 'side_cleantime_value', __( 'How long have you been clean?', 'lantern' ) ) ); ?></span>
                    </span>
                    <span class="lantern-side-card__arrow" aria-hidden="true">→</span>
                </a>
                <?php endif; ?>

                <a class="lantern-side-card lantern-reveal" href="<?php echo esc_url( $meeting_url ); ?>">
                    <span>
                        <span class="lantern-side-card__label lantern-edit-side-meetings-label"><?php echo esc_html( lantern_option( 'side_meetings_label', __( 'Meeting finder', 'lantern' ) ) ); ?></span>
                        <span class="lantern-side-card__value lantern-edit-side-meetings-value"><?php echo esc_html( lantern_option( 'side_meetings_value', __( 'In-person · Online', 'lantern' ) ) ); ?></span>
                    </span>
                    <span class="lantern-side-card__arrow" aria-hidden="true">→</span>
                </a>

                <?php $events_url = lantern_page_url( 'events' ); if ( $events_url ) : ?>
                <a class="lantern-side-card lantern-reveal" href="<?php echo esc_url( $events_url ); ?>">
                    <span>
                        <span class="lantern-side-card__label lantern-edit-side-events-label"><?php echo esc_html( lantern_option( 'side_events_label', __( 'Events', 'lantern' ) ) ); ?></span>
                        <span class="lantern-side-card__value lantern-edit-side-events-value"><?php echo esc_html( lantern_option( 'side_events_value', __( 'Conventions, workshops', 'lantern' ) ) ); ?></span>
                    </span>
                    <span class="lantern-side-card__arrow" aria-hidden="true">→</span>
                </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- ===================== UPCOMING EVENTS ===================== -->
<?php
$events = lantern_upcoming_events( 5 );
$mayo_available = lantern_has_shortcode( 'mayo_event_list' );
if ( ! empty( $events ) || $mayo_available ) : ?>
<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-flex" style="justify-content: space-between; margin-bottom: 1rem; align-items: end;">
            <div>
                <span class="lantern-eyebrow"><?php esc_html_e( 'On the calendar', 'lantern' ); ?></span>
                <h2 style="font-size: var(--lantern-step-4); margin:0;"><?php esc_html_e( 'Upcoming events', 'lantern' ); ?></h2>
            </div>
            <?php if ( $events_url = lantern_page_url( 'events' ) ) : ?>
                <a class="lantern-pathway__more" href="<?php echo esc_url( $events_url ); ?>">
                    <?php esc_html_e( 'All events', 'lantern' ); ?>
                </a>
            <?php endif; ?>
        </header>

        <?php if ( ! empty( $events ) ) : ?>
            <div class="lantern-events">
                <?php foreach ( $events as $event ) :
                    $date  = $event['date'] ? strtotime( $event['date'] ) : false;
                    $month = $date ? wp_date( 'M', $date ) : '';
                    $day   = $date ? wp_date( 'j', $date ) : '';
                ?>
                    <a class="lantern-event lantern-reveal" href="<?php echo esc_url( $event['permalink'] ); ?>">
                        <span class="lantern-event__date">
                            <strong><?php echo esc_html( $day ); ?></strong>
                            <span><?php echo esc_html( $month ); ?></span>
                        </span>
                        <span>
                            <h3 class="lantern-event__title"><?php echo esc_html( $event['title'] ); ?></h3>
                            <p class="lantern-event__meta">
                                <?php
                                $meta_parts = array();
                                if ( $event['time'] )     { $meta_parts[] = esc_html( $event['time'] ); }
                                if ( $event['location'] ) { $meta_parts[] = esc_html( $event['location'] ); }
                                echo implode( ' · ', $meta_parts );
                                ?>
                            </p>
                        </span>
                        <span class="lantern-event__arrow" aria-hidden="true">→</span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php elseif ( $mayo_available ) : ?>
            <?php echo do_shortcode( '[mayo_event_list per_page="5" show_pagination="false"]' ); ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- ===================== INTRO / ABOUT-NA ===================== -->
<section class="lantern-section lantern-section--ink">
    <div class="lantern-shell">
        <div class="lantern-grid-2" style="gap: clamp(2rem, 4vw, 5rem); align-items: start;">
            <div>
                <span class="lantern-eyebrow"><?php esc_html_e( 'What is NA?', 'lantern' ); ?></span>
                <h2 style="font-size: var(--lantern-step-4); margin: 0 0 1.5rem;">
                    <?php esc_html_e( 'A non-profit, member-led fellowship of recovering addicts.', 'lantern' ); ?>
                </h2>
                <p class="lantern-edit-about-blurb" style="color: rgba(247,241,230,0.8);">
                    <?php echo esc_html( lantern_option(
                        'about_blurb',
                        __( 'Narcotics Anonymous is a global, peer-based program of recovery from addiction. Membership is free, requires only the desire to stop using, and is open to any addict regardless of substance. We meet, in-person and online, in church basements, community centers, hospitals, and prisons — every day of the week.', 'lantern' )
                    ) ); ?>
                </p>
                <p class="lantern-edit-about-blurb-2" style="color: rgba(247,241,230,0.8);">
                    <?php echo esc_html( lantern_option(
                        'about_blurb_2',
                        __( 'The program is non-religious, non-political, and not affiliated with any other organization. It is a fellowship — members helping members, one day at a time.', 'lantern' )
                    ) ); ?>
                </p>
            </div>
            <div>
                <blockquote style="margin:0; border-color: var(--lantern-ember); color: rgba(247,241,230,0.9);">
                    <span class="lantern-edit-pillar-quote"><?php echo esc_html( lantern_option(
                        'pillar_quote',
                        __( '“The therapeutic value of one addict helping another is without parallel.”', 'lantern' )
                    ) ); ?></span>
                    <cite style="color: var(--lantern-sand);">
                        <?php esc_html_e( 'Basic Text', 'lantern' ); ?>
                    </cite>
                </blockquote>

                <hr class="lantern-rule" style="border-color: rgba(247,241,230,0.16); margin: 2rem 0;">

                <div class="lantern-grid-2" style="gap: 1.5rem;">
                    <div>
                        <p class="lantern-edit-stat-meetings-value" style="font-family: var(--lantern-display); font-size: var(--lantern-step-3); color: var(--lantern-paper); margin: 0;"><?php echo esc_html( lantern_option( 'stat_meetings_value', __( '79,000+', 'lantern' ) ) ); ?></p>
                        <p class="lantern-edit-stat-meetings-label" style="font-size: var(--lantern-step--1); color: var(--lantern-sand); margin: 0;"><?php echo esc_html( lantern_option( 'stat_meetings_label', __( 'weekly meetings worldwide', 'lantern' ) ) ); ?></p>
                    </div>
                    <div>
                        <p class="lantern-edit-stat-countries-value" style="font-family: var(--lantern-display); font-size: var(--lantern-step-3); color: var(--lantern-paper); margin: 0;"><?php echo esc_html( lantern_option( 'stat_countries_value', __( '143', 'lantern' ) ) ); ?></p>
                        <p class="lantern-edit-stat-countries-label" style="font-size: var(--lantern-step--1); color: var(--lantern-sand); margin: 0;"><?php echo esc_html( lantern_option( 'stat_countries_label', __( 'countries reached', 'lantern' ) ) ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== JOURNAL / ANNOUNCEMENTS ===================== -->
<?php
$latest = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'no_found_rows'  => true,
) );
if ( $latest->have_posts() ) : ?>
<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-flex" style="justify-content: space-between; margin-bottom: 2rem; align-items: end;">
            <div>
                <span class="lantern-eyebrow"><?php esc_html_e( 'Announcements', 'lantern' ); ?></span>
                <h2 style="font-size: var(--lantern-step-4); margin:0;"><?php esc_html_e( 'From the journal', 'lantern' ); ?></h2>
            </div>
            <a class="lantern-pathway__more" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>">
                <?php esc_html_e( 'All posts', 'lantern' ); ?>
            </a>
        </header>

        <div class="lantern-grid-3">
            <?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
                <article class="lantern-reveal">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>" style="display:block; aspect-ratio: 4/3; overflow:hidden; border-radius: var(--lantern-radius); background: var(--lantern-paper-deep);">
                            <?php the_post_thumbnail( 'lantern-card', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
                        </a>
                    <?php endif; ?>
                    <p class="lantern-post-meta" style="margin: 1rem 0 0.25rem;">
                        <span><?php echo esc_html( get_the_date() ); ?></span>
                    </p>
                    <h3 style="font-size: var(--lantern-step-2); margin: 0 0 0.5rem;">
                        <a href="<?php the_permalink(); ?>" style="text-decoration:none;"><?php the_title(); ?></a>
                    </h3>
                    <p style="margin: 0; color: var(--lantern-ink-soft);"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===================== ABOUT THIS SERVICE BODY (optional) ===================== -->
<?php
$custom_title = lantern_option( 'custom_section_title', '' );
$custom_body  = lantern_option( 'custom_section_body', '' );
if ( $custom_title || $custom_body ) : ?>
<section class="lantern-section lantern-custom-section">
    <div class="lantern-shell lantern-shell--narrow">
        <span class="lantern-eyebrow"><?php esc_html_e( 'About us', 'lantern' ); ?></span>
        <?php if ( $custom_title ) : ?>
            <h2 style="font-size: var(--lantern-step-4); margin: 0 0 1.5rem;"><?php echo esc_html( $custom_title ); ?></h2>
        <?php endif; ?>
        <?php if ( $custom_body ) : ?>
            <div class="lantern-custom-section__body" style="font-size: var(--lantern-step-0); color: var(--lantern-ink-soft);">
                <?php echo wp_kses_post( wpautop( $custom_body ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- ===================== CLOSING CTA ===================== -->
<section class="lantern-section" style="padding-bottom: 6rem;">
    <div class="lantern-shell lantern-shell--narrow lantern-center">
        <span class="lantern-eyebrow" style="justify-content:center;"><?php esc_html_e( 'A word at the end', 'lantern' ); ?></span>
        <h2 class="lantern-edit-closing-title" style="font-size: var(--lantern-step-5); margin: 0 0 1.5rem;">
            <?php
            echo wp_kses_post( lantern_option(
                'closing_title',
                __( 'Whatever it takes. <em>Today.</em>', 'lantern' )
            ) );
            ?>
        </h2>
        <p class="lantern-edit-closing-lede" style="font-size: var(--lantern-step-1); color: var(--lantern-ink-soft); max-width: 50ch; margin: 0 auto 2rem;">
            <?php echo esc_html( lantern_option(
                'closing_lede',
                __( 'You don\'t have to be clean to walk into a meeting. You just have to want to be.', 'lantern' )
            ) ); ?>
        </p>
        <a class="lantern-btn lantern-btn--ember" href="<?php echo esc_url( $meeting_url ); ?>">
            <?php esc_html_e( 'Find your meeting', 'lantern' ); ?>
            <span aria-hidden="true">→</span>
        </a>
    </div>
</section>

<?php get_footer();
