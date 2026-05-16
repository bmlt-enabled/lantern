# Lantern

[![License: GPL v2](https://img.shields.io/badge/License-GPL_v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

A WordPress theme for Narcotics Anonymous service bodies — regions, areas, and zonal forums. Drop in the [BMLT plugins](https://bmlt.app) you already use and the site rebuilds itself around them.

Lantern pairs a warm editorial aesthetic (Fraunces serif on parchment, terracotta accents, sage and gold secondaries) with first-class integration of the BMLT plugin family. Where most NA service-body sites look corporate or generic, Lantern feels considered and human — like a quiet meeting room rather than an enterprise homepage.

## Plugin integrations

Lantern auto-detects and integrates with the following — install only what you need; missing plugins degrade gracefully:

| Plugin                                                                    | Used for                    | Where it appears                                     |
|---------------------------------------------------------------------------|-----------------------------|------------------------------------------------------|
| [Crumb](https://wordpress.org/plugins/crumb/)                             | Meeting finder              | Meeting Finder page template                         |
| [Crouton](https://wordpress.org/plugins/crouton/)                         | Meeting finder              | Meeting Finder page template                         |
| [Mayo Events Manager](https://wordpress.org/plugins/mayo-events-manager/) | Events listing + submission | Front page + Events template                         |
| [Fetch Meditation](https://wordpress.org/plugins/fetch-meditation/)       | JFT / SPAD readings         | Front page "Today" panel + Daily Meditation template |
| [NACC](https://wordpress.org/plugins/nacc-wordpress-plugin/)              | Cleantime calculator        | Cleantime template                                   |
| [BMLT-Workflow](https://github.com/bmlt-enabled/bmlt-workflow)            | Meeting update form         | For Members template                                 |
| [Bread](https://wordpress.org/plugins/bmlt-meeting-list/)                 | PDF meeting list            | Linked from For Members                              |

Lantern supports either Crumb or Crouton as the BMLT meeting finder — pick whichever your service body already uses. The Meeting Finder template embeds whichever is active; if neither is installed, the page shows a friendly notice linking to both.

All plugin styling is rebound to the Lantern palette — Crumb via its `#crumb-widget` host variables, Crouton via its `bmlt-*` class hooks — so the finder, calculator, and forms inherit the theme without any markup changes.

## Installation

1. Download the latest `lantern.zip` from [releases](https://github.com/bmlt-enabled/bmlt-wp-theme/releases) — or run `make build` from this repo.
2. WordPress admin → **Appearance → Themes → Add New → Upload Theme**.
3. Activate **Lantern**.
4. **Appearance → Customize** → fill in **Service Body**, **Helpline**, and **BMLT & plugins**.
5. Install the BMLT plugins you'd like to use.
6. Create pages with the documented slugs (or apply the matching page template from the page editor's Template selector).

### Out-of-the-box pages

Create pages with these slugs and Lantern will discover them automatically:

| Slug                                 | Template             | Purpose                                            |
|--------------------------------------|----------------------|----------------------------------------------------|
| `meetings` (or `meeting-finder`)     | Meeting Finder       | Crumb meeting finder, full-width                   |
| `events`                             | Events               | Mayo event list + optional submission form         |
| `cleantime`                          | Cleantime Calculator | NACC calculator                                    |
| `daily-meditation` (or `meditation`) | Daily Meditation     | JFT + SPAD tabbed                                  |
| `helpline`                           | Helpline             | Large clickable number, FAQ                        |
| `public`                             | For the Public       | Newcomer / families / professionals / literature   |
| `members`                            | For Members          | Minutes, subcommittees, events, BMLT-Workflow form |
| `about`                              | (default)            | About-NA pillar page — linked from hero            |

## Customization

All branding lives in **Appearance → Customize**:

- **Service Body** — name, tagline, founded year, weekly meeting count, area count
- **Helpline** — phone number + supporting copy (shown in header, footer, homepage strip)
- **BMLT & plugins** — root server URL + page assignments
- **Homepage copy** — every line of homepage text is editable
- **Footer** — about blurb, disclaimer, motto / tradition line
- **Palette** — override Paper, Ink, Ember, or Sage to recolor the entire theme

Menu locations (Appearance → Menus):

- **Primary Navigation** — main header
- **For the Public** — footer column
- **For Members** — footer column
- **Footer Links** — bottom footer column
- **Utility** — top-right (reserved)

## Local development

Lantern ships with a Docker setup that mirrors the rest of the BMLT family:

```bash
make dev          # docker compose up, watch logs
make install      # wp-cli: install WP, activate Lantern + sibling BMLT plugins, scaffold pages
make open         # browser to http://localhost:8080  (admin / admin)
make bash         # shell inside the WordPress container
make wp CMD="theme list"
make build        # produces build/lantern.zip ready for upload
make nuke         # wipe DB volume + start over
```

The compose file mounts the parent directory as `wp-content/plugins`, so if your `~/workspace/git/bmlt-enabled/` layout has Crumb, Mayo, NACC, etc. as siblings to this repo, they all become available inside the WordPress container automatically.

Visit `http://localhost:8080` (HTTP) or `https://localhost:7443` (HTTPS) once `make install` finishes.

## Repository layout

```
bmlt-wp-theme/
├── lantern/                ← the WordPress theme (mounted to themes/lantern)
│   ├── style.css, functions.php, theme.json
│   ├── header.php, footer.php, index.php, page.php, single.php, …
│   ├── front-page.php
│   ├── page-templates/     ← Meeting Finder, Events, Cleantime, Meditation, …
│   ├── inc/                ← customizer.php, template-tags.php, widgets.php
│   ├── assets/             ← css/{theme,plugins,editor}, js/theme.js
│   └── readme.txt          ← WP.org-style readme (theme metadata)
├── Dockerfile              ← WordPress beta + PHP 8.3 + xdebug
├── docker-compose.yml      ← wordpress + mariadb
├── Makefile                ← help / build / dev / install / lint / nuke / …
├── README.md               ← you are here
├── CONTRIBUTING.md
├── AGENTS.md               ← guidance for AI agents working on this repo
└── LICENSE                 ← GPL v2
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md).

## License

GPL v2 or later — see [LICENSE](LICENSE).
