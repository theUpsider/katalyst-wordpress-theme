# AGENTS.md — Katalyst WordPress Theme

## What this is

Hybrid classic/block WordPress theme for the KATALYST research project (Hochschule Kempten). Requires WordPress 6.5+, PHP 8.1+. Targets WP 6.9.x.

There is **no build system** (no npm, no Composer, no bundler). PHP, CSS, and JS are edited directly. Deployment = copying the directory into `wp-content/themes/katalyst` and activating.

---

## Directory layout

```
functions.php          theme bootstrap — loads inc/ files only
inc/
  theme-setup.php      theme_support, nav menus, asset enqueue, contact form handler, seeding
  template-data.php    static site content (German copy, nav anchors, component data)
  template-tags.php    helper functions used by templates
  render.php           render helpers (logo motif, section headers)
assets/css/theme.css   ALL actual CSS (style.css is metadata only)
assets/js/theme.js     feed filtering, reveal animations, mobile nav
parts/
  header.html          block template part — navigation wired by seed at runtime
  footer.html          block template part
patterns/              8 PHP files: hero about pillars components research news partners contact
                       used both as WP block patterns AND assembled into the front page on seed
page-templates/        dashboard-layout.php, narrative-layout.php
theme.json             palette, spacing, typography — WP 6.9 schema v3
```

---

## Critical: seeding system

On `after_switch_theme` and every `init` (guarded by `katalyst_seed_version` option), the theme:

1. **Builds homepage content** from `patterns/*.php` in order: `hero → about → pillars → components → research → news → partners → contact` (PHP tags stripped, raw block HTML concatenated).
2. **Creates or updates the static front page** (`page_on_front`) — only overwrites if content still contains `wp:pattern` references (frozen state).
3. **Creates a `wp_navigation` post** ("Primary Navigation") with anchor links.
4. **Creates/updates a `wp_template_part` DB record** for "header", wiring the nav `ref` ID.

**`KATALYST_SEED_VERSION` = `'1.2'`** — bump this constant in `inc/theme-setup.php` to force a reseed on next page load.

**`reseed-homepage.php`** — one-time helper. Visit `/?katalyst_reseed=1` as admin to force-rebuild the front page from patterns. Delete afterwards.

---

## Content patterns

- `patterns/*.php` files are the single source of truth for homepage sections.
- Each file contains WP block HTML with embedded PHP calls (`katalyst_data()`, `katalyst_asset_url()`, etc.).
- Changing a pattern file **does not automatically update** an existing live front page — the page content is stored in the DB. Trigger a reseed (bump seed version or use reseed helper) to push changes to the DB.

---

## Static data

All German copy lives in `inc/template-data.php` → `katalyst_get_theme_data()`. Keys: `nav`, `hero`, `feed`, `about`, `pillars`, `components`, `research`, `news`, `partners`, `contact`, `footer`.

Functions in `inc/template-tags.php` prefer live WP posts/menus and fall back to static data:
- `katalyst_get_feed_items()` — live posts → static feed fallback
- `katalyst_get_news_data()` — live posts → static news fallback
- `katalyst_get_navigation_items()` — registered nav menu → static nav fallback

---

## Design tokens (theme.json)

- Content width: `840px`, wide: `1360px`
- Color slugs: `background`, `surface`, `surface-strong`, `ink`, `ink-muted`, `line`, `blue`, `blue-light`, `blue-dark`, `green`, `footer`
- Default WP palette is **disabled** (`"defaultPalette": false`)
- Font families: `display` = Space Grotesk, `mono` = JetBrains Mono (loaded from Google Fonts)
- Font sizes: `xs sm base lg xl hero` (hero uses `clamp`)

---

## Asset pipeline

- `style.css` — WP theme metadata only; says "main styles enqueued from assets/css/theme.css"
- `assets/css/theme.css` — all CSS, also registered as editor style
- `assets/js/theme.js` — localized with `katalystTheme.frontPageUrl`
- Version string comes from the `Version` header in `style.css`

---

## Navigation

Two registered nav menu locations: `primary`, `footer`.  
The header block template part uses a `wp_navigation` post (not a classic menu). The seed wires the correct `ref` ID on first activation. If the header nav is broken, check:
1. The `katalyst_nav_id` option in the DB.
2. The `wp_template_part` DB record for "header" (it overrides `parts/header.html`).

---

## Contact form

- Shortcode: `[katalyst_contact_form]`
- POST handler: `admin-post.php` action `katalyst_contact`
- Nonce action: `katalyst_contact_form`
- Redirects back to referrer with `?contact-status=success|error|invalid#kontakt`

---

## Conventions

- All functions prefixed `katalyst_`
- Text domain: `katalyst`
- German UI copy — `__( '...', 'katalyst' )` even for content strings
- No `as any`, no suppressed errors
- `file_get_contents()` in seed functions has `// phpcs:ignore WordPress.WP.AlternativeFunctions` — intentional
- `body_class` adds `katalyst-site`; front page also gets `grid-on`

---

## No CI / no tests

There is no test suite, no linter config, no CI pipeline in this repo. Manual WordPress activation is the verification step.
