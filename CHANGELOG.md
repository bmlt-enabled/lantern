# Changelog

All notable changes to **Lantern** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Release notes for each tag are automatically generated from the section below
that matches the tag's version number — keep entries in this format and the
release workflow will take care of the rest.

## [Unreleased]

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