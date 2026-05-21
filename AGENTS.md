# AGENTS.md — guidance for AI coding agents

This file gives an AI agent (Claude, Cursor, Copilot, Aider, etc.) the context it needs to make safe, useful changes to this repository.

## What this repo is

A WordPress **classic theme** named **Lantern**, designed for Narcotics Anonymous service bodies. It is generic enough that any region/area/zonal forum can install it, configure via the Customizer, and have a working site that integrates with the [BMLT plugin family](https://bmlt.app).

The repository root contains dev infrastructure (Dockerfile, docker-compose.yml, Makefile, docs). The actual theme code lives under `lantern/`. When packaged via `make build`, the contents of `lantern/` become the theme zip.

## Repository layout

```
.
├── lantern/                    ← THE THEME (this is what gets shipped)
│   ├── style.css               theme header + base styles + design tokens
│   ├── theme.json              block editor palette + custom templates
│   ├── functions.php           features, menus, helpers, plugin detection
│   ├── header.php, footer.php
│   ├── front-page.php          editorial homepage with conditional sections
│   ├── index.php, page.php, single.php, archive.php, search.php, 404.php, comments.php
│   ├── searchform.php
│   ├── page-templates/         Template Name: headers — auto-discovered by WP 4.7+
│   │   ├── meeting-finder.php  → Crumb or Crouton (either works)
│   │   ├── events.php          → Mayo
│   │   ├── cleantime.php       → NACC
│   │   ├── meditation.php      → Fetch Meditation
│   │   ├── helpline.php
│   │   ├── for-public.php
│   │   ├── for-members.php     → BMLT-Workflow (defensive try/catch around shortcode)
│   │   ├── for-professionals.php  curated NA literature for professionals; thumbnails vendored under assets/img/professionals/
│   │   ├── literature.php      Booklets / IPs / Group Readings accordions + e-book retailers; cover images hot-linked from na.org CDN
│   │   └── wide.php
│   ├── inc/
│   │   ├── customizer.php      all Customize → … panels
│   │   ├── template-tags.php   small render helpers
│   │   └── widgets.php         sidebar + 3 footer widget areas
│   ├── assets/
│   │   ├── css/plugins.css     overrides for crumb / crouton / mayo / fetch-meditation / nacc / bmlt-workflow / bread / GF / WPForms
│   │   ├── css/editor.css      block editor styles (matches front-end)
│   │   ├── img/professionals/  vendored thumbnails for the For Professionals template (~185 KB total)
│   │   └── js/theme.js         mobile nav toggle, IO reveals, hero parallax
│   └── readme.txt              WP.org-style readme — keep in sync with style.css header
├── Dockerfile                  WordPress beta + PHP 8.3 + xdebug
├── docker-compose.yml          mounts ./lantern as the theme + ../ as plugins
├── Makefile                    help / build / dev / install / lint / nuke / wp
├── README.md, CONTRIBUTING.md, LICENSE, AGENTS.md
└── .dockerignore, .gitignore
```

## Design system

Lantern's aesthetic is intentional — don't drift it toward generic WordPress styling.

- **Typography:** Fraunces (display, variable serif) + Instrument Sans (body). Loaded from Google Fonts in `functions.php`. Use the `--lantern-display` and `--lantern-body` tokens; never hardcode font names.
- **Palette:** Paper `#f7f1e6`, Ink `#1a2538`, Ember `#c7572b`, Sage `#5d7561`, Gold `#b7892b`. Tokens live as `--lantern-*` custom properties in `style.css` and as a palette in `theme.json`. The Customizer's Palette panel injects overrides inline in `wp_head`.
- **Spacing:** clamp-based fluid scale (`--lantern-step-*`, `--lantern-section-y`, `--lantern-gutter`). Prefer the scale to hardcoded sizes.
- **Layout primitives:** `.lantern-shell`, `.lantern-shell--narrow`, `.lantern-shell--wide`, `.lantern-section`, `.lantern-section--deep`, `.lantern-section--ink`.

## Working conventions

### Plugin detection (defensive integration)

Every BMLT plugin integration MUST check before rendering:

```php
if ( lantern_has_shortcode( 'crumb' ) ) {
    echo do_shortcode( '[crumb]' );
} else {
    // .lantern-notice block explaining the plugin and where to get it
}
```

`lantern_has_shortcode()` lives in `functions.php` and checks the global `$shortcode_tags` array. This is more reliable than `is_plugin_active()` because shortcode registration is what we actually depend on. **Never** assume a plugin is installed.

### Customizer-first content

If a string appears on a page template and a service body would plausibly want to change it, it MUST flow through `lantern_option( 'key', 'default' )` and have a matching registration in `inc/customizer.php`. Templates are markup, not copy — copy lives in Customize.

### Escaping

WordPress output rules. Default to:

- `esc_html()` for text
- `esc_attr()` for attribute values
- `esc_url()` for hrefs
- `wp_kses_post()` for rich text that may contain `<em>`, `<strong>`, etc.

`lantern_option()` already runs values through `wp_kses_post()`. When you echo a value that may contain markup (e.g. the hero tagline), wrap it in a *second* `wp_kses()` call that allows the specific tags the template expects (see `front-page.php` — `em`, `span`, `br`).

### Plugin style overrides

In `lantern/assets/css/plugins.css`:

1. Prefer the plugin's **own** CSS variables (e.g. Crumb's `#crumb-widget` host vars, `--bmlt-*` tokens). Document them at the top of the override block — they're a stable contract.
2. If the plugin doesn't expose variables, target class names it controls — and add a brief comment noting where they come from.
3. Avoid `!important` unless the plugin's own styles use it.
4. Use `color-mix(in srgb, …)` for tints so they retune when a service body overrides the palette.

### When adding a page template

1. New file in `lantern/page-templates/<slug>.php` with a `Template Name:` PHPDoc header.
2. Add a matching entry to `theme.json`'s `customTemplates` array (otherwise the block editor's Template panel won't surface it).
3. Document the conventional page slug in `README.md` and `lantern/readme.txt`.

### When adding a Customizer field

1. Register the setting and control in `inc/customizer.php`.
2. Pick a `sanitize_callback` that matches the data type (`sanitize_text_field`, `esc_url_raw`, `absint`, `wp_kses_post`, `sanitize_hex_color`).
3. Read it via `lantern_option( 'key', 'default' )`.

## Local development

```bash
make dev          # docker compose up (wordpress + mariadb)
make install      # one-shot: install WP, activate theme + BMLT plugins, scaffold pages
make wp CMD="…"   # arbitrary wp-cli
make bash         # shell into the wordpress container
make logs         # tail apache logs
make lint         # php -l everything under lantern/
make build        # build/lantern.zip
make nuke         # wipe DB volume (start over)
```

The container exposes `8080` (HTTP) and `7443` (HTTPS). Default WP login after `make install`: **admin / admin**.

## Things NOT to do

- **Don't bundle plugin code into the theme.** Each BMLT plugin is its own repository. Lantern only integrates with them via shortcodes and CSS overrides.
- **Don't hardcode the service body name, helpline, or BMLT server.** Those are Customizer fields.
- **Don't add a build step for CSS or JS.** The theme is plain CSS + vanilla JS by design — service bodies need to be able to fork it and edit a file. No SCSS, no bundlers, no PostCSS.
- **Don't add tracking, analytics, or external CDNs** other than Google Fonts. NA values anonymity; the theme should not phone home.
- **Don't introduce composer/npm dependencies** without a strong reason. The theme ships with zero PHP runtime dependencies.
- **Don't change the directory `lantern/` name** without updating the Dockerfile/compose mount path and the Makefile `THEME_SLUG`.

## When in doubt

Read [README.md](README.md) for the user-facing pitch, [CONTRIBUTING.md](CONTRIBUTING.md) for human contributor workflow, and `lantern/readme.txt` for the WordPress.org-style theme metadata.
