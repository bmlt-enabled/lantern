# Changelog

All notable changes to **Lantern** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Release notes for each tag are automatically generated from the section below
that matches the tag's version number — keep entries in this format and the
release workflow will take care of the rest.

## [Unreleased]

## [1.0.2] - 2026-05-20

### Added
- The four worldwide-stats values on the about band (weekly-meetings value
  and label, countries value and label) are now Customizer-backed with
  click-to-edit pencils via `selective_refresh` partials.
- The three "Today" side cards (Cleantime, Meeting finder, Events) — six
  strings, label + value per card — are now Customizer-backed with their
  own pencils.
- The pathways section (eyebrow, heading, and all three cards' title /
  description / link label) is now Customizer-backed — 11 new fields, each
  with its own selective-refresh pencil.
- Optional "About us" block on the homepage (heading + rich-body, basic
  HTML allowed) that renders between the journal and the closing CTA.
  Hidden when both fields are blank — fully opt-in for service bodies
  who want to introduce themselves.
- `Contact email` field in the Helpline section (`lantern_contact_email()`
  helper), rendered in the footer and the homepage helpline strip with an
  "Email us:" label. The homepage strip now shows whenever the helpline
  OR the email is set.
- **For Professionals page template** (`Template Name: For Professionals`)
  built from the alnwfl / mvana service-body precedent. Opens with NA's
  standard cooperation intro paragraph, then lists ten professional-
  facing pamphlets (Membership Survey, A Resource in Your Community,
  Information about NA, For Those in Treatment, By Young Addicts, An
  Introduction to NA Meetings, NA Groups and Medication, In Times of
  Illness, NA & Persons Receiving MAT, Mental Health in Recovery) as
  image-left / text-right cards. Each card links directly to the
  current `na.org` PDF. Thumbnails (~20KB each) are vendored under
  `assets/img/professionals/` so the page is self-contained. The intro
  paragraph can be replaced per-site by writing content in the page
  body (block editor); the canned default kicks in when the page is
  empty.
- **Literature page template** (`Template Name: Literature`) modeled on
  the south-coastal-NA layout: a "Recovery Literature" group with
  collapsible Booklets / Informational Pamphlets / Group Readings
  accordions (built on native `<details>`) showing each title's cover
  image, followed by an "E-Literature" retailer grid (Apple Books, Amazon
  Kindle, Google Play, Barnes & Noble), a "How to gift books" link list,
  and an NA World Services disclaimer. All 40 titles are pre-wired with
  their canonical `na.org/e-lit/...` reading-page URLs and the matching
  cover thumbnails hot-linked from NA's CDN (no images bundled with the
  theme). The four retailer cards ship with inline `currentColor` SVG
  marks (Apple, Amazon, Google Play, Barnes & Noble) that tint on hover.
  Lists are hard-coded arrays at the top of the template so service
  bodies can edit titles, URLs, or cover image paths without a Customizer
  round-trip.

### Changed
- Fetch Meditation tabs + accordion now blend with the parchment
  background instead of rendering as stark white cards. Overrides the
  plugin's `.meditation-tab-content`, `.meditation-tab-button`,
  `.meditation-accordion-button`, `.meditation-accordion-panel`, and
  related selectors to use Lantern's paper/paper-deep tones, ink-line
  borders, and ember focus + read-more accents.
- Hero aside redesigned: removed the "At a glance" stats card (cost,
  requirement, weekly/area counts) — it read like a product comparison and
  was off-tone for an NA fellowship site. The aside is now a single larger
  pull-quote, vertically centered in the card.
- Customizer text controls in the Homepage, Helpline, and Footer sections
  now open pre-populated with their default copy instead of blank inputs,
  so admins can see what they're editing. Backed by a new
  `lantern_home_field_defaults()` helper as the single source of truth.
- Pathways section default heading: "Three doors, one fellowship." →
  "Three ways to take part." (clearer, less jargon).
- "Weekly meetings worldwide" figure on the about band: 76,000+ → 79,000+.
- Dropped "hybrid" from the four places it appeared (Meeting finder side
  card, pathways description, "Find a meeting" block pattern, Meeting
  Finder page subtitle) — meeting seekers filter by in-person vs. online,
  not by hybrid.
- Dropped "dances" from the Events side-card descriptor; now reads
  "Conventions, workshops".

### Removed
- `weekly_meeting_count` and `area_count` Service Body Customizer fields
  (only consumed by the retired aside stats card).

## [1.0.1] - 2026-05-20

### Added
- Three block-style variations registered against core blocks: `core/quote`
  → "Lantern pull-quote" (centered display serif framed by ember rules),
  `core/separator` → "Lantern flourish" (three centered dots), and
  `core/button` → "Lantern ember" (terracotta pill with hover lift).
- "Find a meeting" block pattern + dedicated `lantern` pattern category so
  the call-out is one click away in the block inserter.
- `add_theme_support( 'custom-background' )` with the paper color as the
  default — lets users tweak the page background from Customize.

### Changed
- `Tested up to:` bumped to WordPress 7.0 across `style.css` and `readme.txt`.

## [1.0.0] - 2026-05-20

Initial release.

### Theme

- Editorial design system: Fraunces display serif on warm parchment, terracotta
  ember and sage accents, fluid type scale, paper-grain overlay, sticky frosted
  header.
- Front page with hero, helpline strip, three pathway doors, daily meditation
  panel, upcoming events, dark about-NA band, journal cards, and closing CTA.
- Page templates: Meeting Finder, Events, Cleantime Calculator, Daily
  Meditation, Helpline, For the Public, For Members, Wide.
- `theme.json` exposing the full palette, font families, font sizes, and
  custom page templates to the block editor; matching editor stylesheet.
- WordPress core utility CSS — `.screen-reader-text`, `.sticky`,
  `.bypostauthor`, `.gallery-caption`, `.alignleft` / `.alignright` /
  `.aligncenter` — styled to match the theme.
- Sidebar widget area (rendered via `sidebar.php`) plus three footer columns
  that prefer their widget area when widgets are placed and fall back to
  matching nav menus when not.

### Customizer

- Service Body identity, Helpline, BMLT server, Homepage copy, Footer, and a
  four-color Palette override.
- **Page links** section: every navigable link on the homepage, For the
  Public, and For Members templates has a `dropdown-pages` picker so admins
  can route each card at any page. Empty slots hide their card rather than
  dead-linking.
- Live click-to-edit homepage in the Customizer preview: hero tagline, hero
  lede, hero quote, about paragraphs, pillar quote, and closing CTA all use
  `selective_refresh` partials with `postMessage` transport.

### BMLT plugin integration

- Defensive integration with the BMLT plugin family — Crumb, Crouton, Mayo
  Events Manager, Fetch Meditation, NACC, BMLT-Workflow, and Bread. Missing
  plugins render a friendly notice instead of breaking.
- Plugin CSS overrides rebind every embed to the Lantern palette: Crumb via
  its `#crumb-widget` host variables, Crouton via its `bmlt-*` class hooks,
  and similar for the other plugins.

### Local development

- Docker-based stack: `Dockerfile` (WordPress beta + PHP 8.3 + wp-cli +
  xdebug), `docker-compose.yml`, and a `Makefile` with `dev`, `install`,
  `plugin-deps`, `theme-test-data`, `build`, `lint`, `bash`, `wp`, `nuke`,
  and friends. WordPress debug notices route to `logs/php-debug.log`.
- `make install` scaffolds the demo site: installs WordPress, activates the
  theme + any sibling BMLT plugins that have their composer deps in place,
  creates the canonical pages, assigns each its matching page template, and
  pre-populates every `lantern_link_*` Customizer mod.
</content>
</invoke>