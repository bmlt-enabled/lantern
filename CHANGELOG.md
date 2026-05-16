# Changelog

All notable changes to **Lantern** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Release notes for each tag are automatically generated from the section below
that matches the tag's version number — keep entries in this format and the
release workflow will take care of the rest.

## [Unreleased]

## [1.0.0] - 2026-05-16

### Added
- Initial release of the Lantern theme.
- Editorial design system: Fraunces display serif on warm parchment, terracotta
  ember and sage accents, fluid type scale, paper-grain overlay, sticky frosted
  header.
- Front page with hero, helpline strip, three pathway doors, daily meditation
  panel, upcoming events, dark about-NA band, journal cards, and closing CTA.
- Page templates: Meeting Finder, Events, Cleantime Calculator, Daily
  Meditation, Helpline, For the Public, For Members, Wide.
- Defensive integration with BMLT plugins — Crumb, Crouton, Mayo Events
  Manager, Fetch Meditation, NACC, BMLT-Workflow, and Bread. Missing plugins
  render a friendly notice instead of breaking.
- Plugin CSS overrides rebind every embed to the Lantern palette: Crumb via
  its `#crumb-widget` host variables, Crouton via its `bmlt-*` class hooks,
  and similar for the other plugins.
- Customizer panels for Service Body identity, Helpline, BMLT server + page
  assignments, Homepage copy, Footer, and a four-color Palette override.
- `theme.json` exposing the full palette, font families, font sizes, and
  custom page templates to the block editor.
- Editor stylesheet matching the front-end aesthetic.
- Docker-based local development: `Dockerfile`, `docker-compose.yml`, and a
  `Makefile` with `dev`, `install`, `build`, `lint`, `bash`, `wp`, `nuke`,
  and friends.
