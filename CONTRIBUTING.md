# Contributing to Lantern

## How to contribute

1. Fork the repository
2. Create a branch from `main`
3. Make your changes
4. Run `make lint` to confirm PHP files parse cleanly
5. Test locally with `make dev` + `make install`
6. Send a pull request to `main`

Take a look at the [issues](https://github.com/bmlt-enabled/bmlt-wp-theme/issues) for bugs and feature requests that you might be able to help with.

## Local development setup

Lantern uses Docker. You don't need PHP or MySQL installed locally — everything runs inside containers.

```bash
make dev          # start WordPress + MariaDB, watch logs
make install      # install WP, activate Lantern + sibling BMLT plugins, scaffold demo pages
make open         # open http://localhost:8080 in a browser (admin / admin)
```

The compose file mounts:

- `./lantern` → `/var/www/html/wp-content/themes/lantern`
- `../` → `/var/www/html/wp-content/plugins` (so sibling BMLT plugin repos load automatically)

Edit any file under `lantern/` and refresh — changes are live.

### Useful Make targets

| Target                  | Purpose                                                                   |
|-------------------------|---------------------------------------------------------------------------|
| `make help`             | List every target                                                         |
| `make dev`              | Foreground `docker compose up`                                            |
| `make up` / `make down` | Detached up / down                                                        |
| `make restart`          | Down + up                                                                 |
| `make logs`             | Tail container logs                                                       |
| `make bash`             | Shell in the WordPress container                                          |
| `make mysql`            | MySQL CLI in the db container                                             |
| `make wp CMD="…"`       | Run a wp-cli command (e.g. `make wp CMD="plugin list"`)                   |
| `make install`          | First-time WordPress install + theme/plugin activation + page scaffolding |
| `make lint`             | `php -l` on every theme file                                              |
| `make build`            | Produce `build/lantern.zip`                                               |
| `make nuke`             | Wipe DB volume — start completely over                                    |

## Code standards

### PHP

- WordPress coding style (4-space indent, `snake_case` functions, prefixed `lantern_*`).
- All user-facing strings wrapped in i18n functions with the `lantern` text domain.
- Escape on output: `esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`.
- `make lint` runs `php -l` on every file — keep it green before opening a PR.

### CSS

- Design tokens live in `lantern/style.css` under `:root` as `--lantern-*` custom properties.
- Plugin overrides go in `lantern/assets/css/plugins.css`. Prefer the plugin's *own* CSS variables (e.g. `#crumb-widget` host vars) over reaching into internal class names — they change less often.
- Use `color-mix(in srgb, …)` for tints so palette overrides cascade through.

### Templates

- New page templates go in `lantern/page-templates/` with a `Template Name:` header.
- Add the matching entry to `theme.json`'s `customTemplates` array so it's visible in the block editor's Template panel.
- Plugin integrations must be defensive: check `lantern_has_shortcode( 'tag' )` and render a `.lantern-notice` block when the plugin is missing. Never assume a shortcode exists.

### Customizer

- Every user-editable string belongs in **Appearance → Customize**, not hardcoded in the template.
- Register settings in `lantern/inc/customizer.php` with a `lantern_` prefix and a `sanitize_callback`.

## Testing

Lantern doesn't ship automated tests. Verify manually:

1. `make install` — clean WordPress, theme activates without errors.
2. Front page renders with default copy (no PHP notices in the apache log; `make logs`).
3. Activate each BMLT plugin in turn — verify the matching page template embeds it correctly.
4. Toggle Customize → Palette colors — confirm the theme + plugin embeds both retune.
5. Test responsive breakpoints in browser dev tools (mobile nav at ≤960px).

If you add a feature large enough to warrant a test, please include manual reproduction steps in the PR description.

## Release process

Releases follow the WordPress.org pattern. Bump `Version:` in:

- `lantern/style.css`
- `lantern/functions.php` (`LANTERN_VERSION` constant)
- `lantern/readme.txt` (`Stable tag:`)

Then `make build` produces `build/lantern.zip`. Tag the release in GitHub.

## Code of conduct

We follow the [12 Traditions](https://na.org/?ID=ips-eng-index) — principles before personalities. Be kind, assume the best about your fellow contributors, and remember why we're here.
