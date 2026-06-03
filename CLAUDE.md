# nWork Project — Claude.md

## What This Is

A case study in building a modern web delivery stack **without WordPress or page builders**.

The core thesis: you can connect a designed HTML frontend directly to a lightweight PHP dashboard
to give clients content editing capabilities — with better security, faster development, and full
ownership — than any CMS or drag-and-drop platform provides.

Built for **nWork** (workforce management SaaS) as a real-world proof of the approach.

---

## Why Not WordPress / Webflow / etc.

| Problem with traditional CMS | Our approach |
|-------------------------------|--------------|
| Attack surface (plugins, wp-admin, SQLi) | No database, no plugin ecosystem — PHP session + flat JSON |
| Slow page loads (server-side rendering overhead) | Pure static HTML — instant load, no PHP on frontend |
| Vendor lock-in (theme ecosystem, proprietary builders) | Own every line of HTML/CSS — portable anywhere |
| Overengineered for simple content edits | Clients edit text/images only — no layout risk |
| Complex deployments | Drop files on any host with PHP — done |

---

## Architecture

```
┌─────────────────────┐       ┌─────────────────────┐
│  Static HTML        │       │  PHP Admin Dashboard │
│  site/index.html    │       │  site/admin/         │
│                     │       │  - index.php (login) │
│  Reads content.json │       │  - editor.php (tabs) │
│  via JS fetch on    │◀──────│  - api.php (REST)    │
│  page load          │       └──────────┬──────────┘
└─────────────────────┘                  │ writes
                                         ▼
                               ┌─────────────────────┐
                               │  site/content.json  │
                               │  (source of truth)  │
                               └─────────────────────┘
                               ┌─────────────────────┐
                               │  site/images/       │
                               │  (uploaded via API) │
                               └─────────────────────┘
```

---

## Stack

| Layer | Tech | File |
|-------|------|------|
| Frontend | Static HTML + Tailwind CDN | `site/index.html` |
| Admin UI | PHP + Tailwind CDN | `site/admin/editor.php` |
| Auth | PHP session (password) | `site/admin/index.php` |
| API | PHP REST (no framework) | `site/admin/api.php` |
| Content store | Flat JSON file | `site/content.json` |
| Image store | Local filesystem | `site/images/` |

No Node.js. No build step. No database. No framework.

---

## What's Built

### Frontend — `site/index.html`
- Full Stitch-designed landing page for nWork (workforce management SaaS)
- Sections: Hero, Features, Capabilities, Benefits, Testimonials, FAQ, CTA, Footer
- Tailwind CDN, Material Symbols, Plus Jakarta Sans / Inter / Space Grotesk
- Static by default — JS fetch hydrates content from API on load (Phase 2)

### PHP Admin Dashboard — `site/admin/`
- **`index.php`** — login page, password-based PHP session auth
- **`editor.php`** — tabbed content editor covering all page sections
- **`api.php`** — REST API:
  - `GET` → returns full `content.json`
  - `POST` → deep-merges patch into `content.json`
  - `POST ?action=upload` → image upload → `site/images/`, returns URL
  - `GET ?action=images` → lists all uploaded images
  - Auth-gated: returns 401 if no valid session

### Deep Merge (critical)
PHP `deepMerge()` in `api.php` recursively merges associative arrays so saving
one field (e.g. `hero.heading`) doesn't wipe sibling fields. Indexed arrays are replaced wholesale.

---

## Content Model

```json
{
  "hero": {
    "badge": "...", "heading": "...", "subheading": "...",
    "ctaLabel": "...", "statNumber": "...", "statLabel": "...", "image": "images/..."
  },
  "features": { "cards": [{ "title": "...", "description": "..." }] },
  "capabilities": { "heading": "...", "subheading": "...", "cards": [...] },
  "benefits": { ... },
  "testimonials": { ... },
  "faq": { ... },
  "cta": { ... },
  "footer": { ... }
}
```

---

## File Structure

```
nWork/
├── site/                        # The entire deliverable
│   ├── index.html               # Static HTML frontend
│   ├── content.json             # Content source of truth
│   ├── images/                  # Client-uploaded images (gitignored)
│   └── admin/
│       ├── index.php            # Login (password: nwork2026)
│       ├── editor.php           # Tabbed content editor
│       └── api.php              # REST API + image upload
│
├── CLAUDE.md                    # This file
├── MASTER_CONTEXT.md            # Top-level project context
└── .gitignore
```

---

## How to Run

```bash
cd /home/ahmed/Desktop/nWork/site
php -S localhost:8000
```

| URL | What |
|-----|------|
| http://localhost:8000 | Frontend |
| http://localhost:8000/admin/ | Admin login |
| http://localhost:8000/admin/api.php | API |

**Password**: `nwork2026` (change before any real deployment)

---

## Known Issues / Next Steps

### Phase 2 — Frontend Hydration
Frontend currently static. Need to wire `index.html` to fetch from `api.php` on load:
```js
fetch('/admin/api.php')
  .then(r => r.json())
  .then(content => { /* inject into DOM */ })
```
Or serve `index.html` via PHP and inject server-side.

### Phase 3 — Image Picker in Editor
Currently images are uploaded via API but there's no picker UI in the editor.
Add a modal grid of uploaded images — click to insert URL into a field.

### Phase 4 — Deployment Guide
Document how to deploy on shared hosting (cPanel), VPS (Nginx + PHP-FPM), or similar.
This is part of the case study: show how simple the deploy is vs WordPress.

---

## Design Specs (nWork Brand)

| Token | Value |
|-------|-------|
| Primary (purple) | `#5d5699` |
| Primary container | `#bcb4ff` |
| Tertiary (green) | `#476733` |
| Tertiary container | `#c9eaa0` |
| Background | `#fbf9f8` |
| Surface container | `#f0eded` |
| Headline font | Plus Jakarta Sans |
| Body font | Inter |
| Label font | Space Grotesk |

---

## Notes

- `content.json` path in `api.php` uses `__DIR__` — always resolves correctly regardless of server root
- Session cookie is the only auth mechanism — no tokens, no DB
- `site/images/` is gitignored — client uploads are not tracked in version control
- The `Web Dev/` directory (old Next.js + Astro approach) has been deleted — superseded by this PHP stack
