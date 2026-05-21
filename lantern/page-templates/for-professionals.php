<?php
/**
 * Template Name: For Professionals
 *
 * NA literature curated for non-addict professionals: government,
 * clergy, treatment/healthcare, criminal justice, and private voluntary
 * organisations. Items are hard-coded here because NA's professionals-
 * facing catalog rarely changes; service bodies that want to add or
 * trim entries should edit the `$items` array below.
 *
 * Thumbnails are vendored locally under `assets/img/professionals/`
 * (each ~20KB) so the page renders without depending on a third-party
 * CDN. PDFs themselves are linked from `na.org/wp-content/uploads/...`.
 *
 * @package Lantern
 */

get_header();

$img_base = LANTERN_URI . 'assets/img/professionals/';

$items = array(
    array(
        'image' => $img_base . 'membership-survey.jpg',
        'title' => __( 'Membership Survey', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2025/07/2301_MS_2024_Jul25.pdf',
        'desc'  => __( 'Contains the results of biennial survey of approximately 32,398 members.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'a-resource.jpg',
        'title' => __( 'NA: A Resource in Your Community', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2025/07/1604_NARS_Jul2025.pdf',
        'desc'  => __( 'This pamphlet provides information about local NA services that may be available such as public service announcements, phonelines, literature sales, and NA presentations for health fairs, schools and professional conferences.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'info-about-na.jpg',
        'title' => __( 'Information about NA', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/06/2302-Info-About-NA-2018.pdf',
        'desc'  => __( 'Includes facts about the history of NA, organizational philosophy, and membership demographics.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'for-those-in-treatment.jpg',
        'title' => __( 'For Those in Treatment', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/05/EN3117-IP-17-English.pdf',
        'desc'  => __( 'In this pamphlet, we offer some suggestions and a basic plan of action to help recovering addicts in the transition of treatment, to continuing recovery in Narcotics Anonymous.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'by-young.jpg',
        'title' => __( 'By Young Addicts, For Young Addicts', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/05/EN3113_2008-IP-13-English.pdf',
        'desc'  => __( 'This pamphlet was developed by young members of Narcotics Anonymous to illustrate the fact that young addicts around the world, speaking many different languages, are getting and staying clean in NA.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'intro-to-na.jpg',
        'title' => __( 'An Introduction to NA Meetings', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/05/EN3129-IP-29-English.pdf',
        'desc'  => __( 'Offers a welcoming introduction, and explains practices unfamiliar to those at their first meetings, and provide tips for groups to preserve an atmosphere of recovery.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'na-groups-medication.jpg',
        'title' => __( 'NA Groups and Medication', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/06/EN2205-NA-Groups-and-MEdication-English.pdf',
        'desc'  => __( 'Our Twelve Traditions remind us that medication use is a member\'s personal decision, and is an outside issue for NA groups. This piece is intended for groups as they consider this issue. It does not address members\' personal decisions, nor does it try to change members\' opinions about medication.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'in-times-of-illness.jpg',
        'title' => __( 'In Times of Illness', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/05/In-Times-of-Illness-English.pdf',
        'desc'  => __( 'This relied-upon booklet was recently revised to reflect members\' experiences with challenges such as mental health issues, chronic illness and pain, and supporting members with illnesses. It includes section summaries in the table of contents.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'mat.jpg',
        'title' => __( 'NA and Persons Receiving Medication-Assisted Treatment', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/06/2306_PRMAT_2023.pdf',
        'desc'  => __( 'This pamphlet is intended for professionals who prescribe medication to treat drug addiction. The service pamphlet "NA Groups and Medication" listed above contains a broader discussion of NA members and other medications.', 'lantern' ),
    ),
    array(
        'image' => $img_base . 'mental-health.png',
        'title' => __( 'Mental Health in Recovery', 'lantern' ),
        'url'   => 'https://na.org/wp-content/uploads/2024/05/3130_MHR-IP-30-English.pdf',
        'desc'  => __( 'This piece of literature reflects the shared experiences of NA members, including those who have found it necessary to seek outside help for mental health concerns and other members who are recovering alongside them.', 'lantern' ),
    ),
);

$default_intro = __( 'Although certain traditions guide its relations with other organizations, Narcotics Anonymous welcomes the cooperation of those in government, the clergy, treatment and healthcare professions, criminal justice organizations and private voluntary organizations. NA\'s nonaddict friends have been instrumental in getting Narcotics Anonymous started in many countries and helping NA grow worldwide. NA strives to cooperate with others interested in Narcotics Anonymous. Our more common cooperation approaches are: providing contact information, disseminating recovery literature, and sharing information about recovery.', 'lantern' );
?>

<section class="lantern-section">
    <div class="lantern-shell">
        <header class="lantern-stack" style="margin-bottom: 3rem; max-width: 70ch;">
            <span class="lantern-eyebrow"><?php esc_html_e( 'I work with addicts', 'lantern' ); ?></span>
            <h1 class="lantern-page-title" style="margin: 0;"><?php the_title(); ?></h1>
            <?php while ( have_posts() ) : the_post(); if ( get_the_content() ) : ?>
                <div class="lantern-page-subtitle"><?php the_content(); ?></div>
            <?php else : ?>
                <p class="lantern-page-subtitle"><?php echo esc_html( $default_intro ); ?></p>
            <?php endif; endwhile; ?>
        </header>

        <ul class="lantern-prof-list">
            <?php foreach ( $items as $item ) : ?>
                <li class="lantern-prof-item">
                    <a class="lantern-prof-item__thumb" href="<?php echo esc_url( $item['url'] ); ?>" target="_blank" rel="noopener" aria-hidden="true" tabindex="-1">
                        <img src="<?php echo esc_url( $item['image'] ); ?>" alt="" width="96" height="226" loading="lazy" decoding="async">
                    </a>
                    <div class="lantern-prof-item__body">
                        <h3 class="lantern-prof-item__title">
                            <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank" rel="noopener">
                                <?php echo esc_html( $item['title'] ); ?>
                                <span aria-hidden="true" class="lantern-prof-item__pdf">PDF ↗</span>
                            </a>
                        </h3>
                        <p class="lantern-prof-item__desc"><?php echo esc_html( $item['desc'] ); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php get_footer();
