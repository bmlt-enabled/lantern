=== Lantern ===

Contributors: bmltenabled
Tags: block-styles, custom-colors, custom-logo, custom-menu, editor-style, featured-images, footer-widgets, full-width-template, theme-options, threaded-comments, translation-ready, wide-blocks
Requires at least: 6.4
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.2
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Lantern is an editorial-style WordPress theme for non-profit community sites. Configure your organisation, helpline, and palette from Appearance → Customize.

== Description ==

Lantern is a generic, brandable WordPress theme designed for NA regions, areas, and zonal forums. It pairs a warm editorial aesthetic (Fraunces display serif on parchment, terracotta accents, sage and gold secondaries) with first-class integration of the BMLT plugin family. Where most NA service-body sites look corporate or generic, Lantern feels considered and human — like a quiet meeting room rather than an enterprise homepage.

= Plugin integrations =

Out of the box, Lantern auto-detects and integrates with:

* **Crumb** or **Crouton** — either BMLT meeting finder works. The Meeting Finder page template embeds whichever is active; pick the one your service body already uses.
* **Mayo Events Manager** — the homepage shows the next five upcoming events, and the Events page template renders the full list + submission form.
* **Fetch Meditation** — the homepage "Today" panel shows the JFT excerpt; a dedicated Daily Meditation page template runs the tabbed both-books view.
* **NACC** — the Cleantime Calculator page template renders the calculator with the Lantern type/color system.
* **BMLT-Workflow** — the For Members page template can render the meeting update form.
* **BMLT Minutes** — the Minutes page template publishes committee meeting minutes via the [minutes] shortcode.
* **Bread** — the Members page links to the PDF meeting list when present.

Every shortcode integration is defensive: if a plugin isn't installed, Lantern shows a clear notice with the plugin name and where to get it, instead of breaking.

= Out-of-the-box pages =

After install, create pages with these slugs (or pick them in Customize → BMLT & plugins → Meeting finder page) and Lantern will discover them automatically:

* `/meetings` (or `/meeting-finder`) — uses Meeting Finder template
* `/events` — uses Events template
* `/cleantime` — uses Cleantime Calculator template
* `/daily-meditation` (or `/meditation`) — uses Daily Meditation template
* `/helpline` — uses Helpline template
* `/public` — uses For the Public template
* `/members` — uses For Members template
* `/minutes` — uses Minutes template (BMLT Minutes plugin)
* `/about` — pillar page (linked from hero)
* `/newcomer`, `/for-families`, `/professionals`, `/literature` — linked from For the Public
* `/subcommittees`, `/meeting-changes`, `/service-guides`, `/meeting-list` — linked from For Members

= Customizing =

All branding lives in **Appearance → Customize**:

* **Service Body** — name, tagline, founding year, weekly meeting count, area count
* **Helpline** — phone number + supporting copy (shown in header, footer, homepage strip)
* **BMLT & plugins** — root server URL + page assignments
* **Homepage copy** — every line of homepage text is editable here
* **Footer** — about blurb, disclaimer, motto/tradition line
* **Palette** — override Paper, Ink, Ember, or Sage to recolor the entire theme

Menus to assign (Appearance → Menus):

* **Primary Navigation** — main header menu
* **For the Public** — footer column
* **For Members** — footer column
* **Footer Links** — bottom footer column
* **Utility** — top-right (reserved)

== Installation ==

1. Upload the `bmlt-wp-theme` folder to `/wp-content/themes/`, or install from a `.zip` via Appearance → Themes → Add New.
2. Activate "Lantern" under Appearance → Themes.
3. Visit Customize → Service Body, Helpline, and BMLT & plugins to enter your details.
4. Install the BMLT plugins you'd like to use (Crumb, Mayo, Fetch Meditation, NACC, BMLT-Workflow, Bread).
5. Create pages with the slugs listed above (or apply the matching Page Template from the page editor's Template selector).

== Frequently Asked Questions ==

= Do I have to install all the plugins? =

No. Lantern detects each plugin independently. Each page template and homepage section degrades gracefully — if Fetch Meditation isn't active, the Today panel shows a friendly notice; if Mayo isn't active, the events strip is hidden, and so on. Install only what you need.

= Can I change the colors? =

Yes — Customize → Palette gives you four overrides (Paper, Ink, Ember, Sage). For deeper edits, every color is a CSS custom property in `style.css` (look for `--lantern-*`) and the same tokens are exposed via `theme.json` for the block editor.

= Does it support the block editor? =

Yes. `theme.json` ships the full Lantern palette, font families, and font sizes as block-editor presets. Editor styles match the front-end so the writing experience and reader experience stay aligned.

= Is it translation-ready? =

Yes. All user-facing strings use the `lantern` text domain. Drop a `.mo` file in `/wp-content/themes/bmlt-wp-theme/languages/`.

== Changelog ==

See [CHANGELOG.md](https://github.com/bmlt-enabled/bmlt-wp-theme/blob/main/CHANGELOG.md) for the full version history.

= 1.0.2 =
* New Minutes page template — integrates the BMLT Minutes plugin's [minutes] shortcode behind a defensive check, with the output restyled to the Lantern palette.
* Replaced the "At a glance" hero aside (cost/requirement stats card) with a single larger pull-quote.
* Customizer Homepage, Helpline, and Footer text controls now open pre-populated with their default copy instead of empty inputs.
* Worldwide-stats values on the about band, the three "Today" side cards, and the full pathways section (eyebrow + heading + all three cards' title/description/link label) are all Customizer-backed with click-to-edit pencils.
* New optional "About us" block on the homepage (heading + body, basic HTML allowed) — hidden until you fill it in.
* New "Contact email" field in the Helpline section, rendered in the footer and homepage strip with an "Email us:" label.
* New Literature page template — collapsible Booklets / Pamphlets / Group Readings accordions plus an E-Literature retailer grid (Apple Books, Amazon Kindle, Google Play, Barnes & Noble) and gift-link list.
* New For Professionals page template — NA's cooperation intro paragraph followed by ten professionally-targeted pamphlets (Membership Survey, A Resource in Your Community, etc.) as image-left / text-right cards. Thumbnails are vendored locally; PDFs link to na.org.
* Pathways default heading changed from "Three doors, one fellowship." to "Three ways to take part." and the worldwide weekly-meetings figure updated from 76,000+ to 79,000+.
* Copy cleanup: dropped "hybrid" from four places (people search in-person vs. online) and dropped "dances" from the Events side-card descriptor.
* Removed the unused `weekly_meeting_count` and `area_count` Service Body fields.

= 1.0.1 =
* Added three block-style variations — Lantern pull-quote, Lantern flourish separator, Lantern ember button.
* Added a "Find a meeting" block pattern and a Lantern pattern category.
* Added custom-background theme support so users can override the paper color from Customize.
* Updated Tested up to: 7.0.

= 1.0.0 =
* Initial release.

== Copyright ==

Lantern WordPress Theme, Copyright 2026 BMLT Enabled
Lantern is distributed under the terms of the GNU GPL v2 or later.

This theme bundles the following third-party resources, used in accordance
with their respective licenses:

* Fraunces font family, by Phaedra Charles, Flavia Zimbardi & Lasko Dzurovski.
  License: SIL Open Font License v1.1 — http://scripts.sil.org/OFL
  Source: https://fonts.google.com/specimen/Fraunces

* Instrument Sans font family, by Instrument & Rodrigo Fuenzalida.
  License: SIL Open Font License v1.1 — http://scripts.sil.org/OFL
  Source: https://fonts.google.com/specimen/Instrument+Sans

Both font families are loaded from the Google Fonts CDN, which is the only
remote resource the theme uses. WordPress.org's theme directory permits
Google Fonts as an explicit exception to the no-remote-resources rule.
