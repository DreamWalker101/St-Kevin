# St Kevin's Hampton Park — CLAUDE.md

> This is the master project brief. Claude Code reads this file automatically at the start of every session.
> For detailed specs, see the `_dev/docs/` folder:
> - `_dev/docs/DESIGN_SYSTEM.md` — Full design tokens, components, do's/don'ts, CSS variables, Tailwind config
> - `_dev/docs/CONTENT.md` — All page copy organised by page and section
> - `_dev/docs/PAGES.md` — Page-by-page section breakdown, component mapping, and build order

---

## What We're Building

A static HTML website for **St Kevin's Primary School, Hampton Park** — a Catholic primary school in Melbourne, Australia. Built on the PlainPress stack: pure HTML/CSS/JS frontend + PHP admin dashboard for client content editing.

**No WordPress. No framework. No build step. No npm. Tailwind CDN only.**

The site replaces an existing WordPress site. Design is inspired by [Green School](https://www.greenschool.org/) — editorial, mission-driven, full-bleed imagery, organic shapes — adapted to St Kevin's navy/burgundy brand.

---

## Tech Stack

| Layer | Tech | Notes |
|-------|------|-------|
| Frontend | Static HTML + Tailwind CDN | Each page is a standalone .html file |
| Styling | Tailwind CDN + inline `<style>` for custom CSS | Custom properties defined in each page's `<style>` block |
| Fonts | Google Fonts (Montserrat, Inter, Dancing Script) | Loaded via `<link>` in `<head>` |
| Icons | Material Symbols or inline SVG | No icon library CDN required |
| Admin | PHP dashboard | `site/admin/` — login, editor, REST API |
| Content | Flat JSON | `site/content.json` — source of truth for editable text |
| Images | Local filesystem | `site/images/` — committed to repo |
| Hosting | cPanel shared hosting | GitHub → cPanel auto-deploy via Git Version Control |

---

## Client Details

| Field | Value |
|-------|-------|
| School | St Kevin's Primary School, Hampton Park |
| Principal | Jason Micallef |
| Affiliation | Melbourne Archdiocese Catholic Schools (MACS) |
| Address | 120 Hallam Rd, Hampton Park VIC 3976 |
| Phone | (03) 9709 8600 |
| Email | administration@skhamptonpark.catholic.edu.au |
| Current site | https://www.skhamptonpark.catholic.edu.au/ |
| Staging | https://dev.on5.io/st-kevins/ |

---

## Brand Summary

| Token | Value |
|-------|-------|
| Primary | Navy `#051E42` |
| Accent | Burgundy Red `#8A2232` |
| Background | Warm Cream `#FBF9F7` ← global page background |
| Pure White | `#FFFFFF` ← text/SVG on dark surfaces only |
| Neutral BG | Light Grey `#F4F6F8` |
| Border | Soft Grey `#E2E6EA` |
| Secondary text | Muted Grey `#6B7280` |
| Heading font | Montserrat (600–800) |
| Body font | Inter (400–500) |
| Script accent | Dancing Script (400–700) |

**Full design system with all tokens, components, CSS variables, and Tailwind config → `_dev/docs/DESIGN_SYSTEM.md`**

---

## File Structure

```
st-kevins/
├── CLAUDE.md                    ← This file (project brief)
├── _dev/                        ← Planning/docs — GitHub only, never deployed
│   ├── docs/
│   │   ├── DESIGN_SYSTEM.md     ← Design tokens, components, CSS vars
│   │   ├── CONTENT.md           ← All page copy
│   │   └── PAGES.md             ← Page sections, components, build order
│   ├── source-docs/             ← Original client documents
│   ├── sample-pictures/         ← Reference images
│   ├── PROGRESS.md              ← Master session log
│   └── SECTION_CHECKLIST.md     ← Build status
├── site/
│   ├── index.html               ← Homepage
│   ├── about.html               ← About Us
│   ├── learning.html            ← Learning With Purpose
│   ├── community.html           ← Community
│   ├── enrolments.html          ← Enrolments
│   ├── contact.html             ← Contact Us
│   ├── policies.html            ← Policies & Compliance
│   ├── content.json             ← Editable content (source of truth)
│   ├── images/                  ← All site images (committed to repo)
│   └── admin/
│       ├── index.php            ← Admin login
│       ├── editor.php           ← Tabbed content editor
│       └── api.php              ← REST API + image upload
└── .gitignore
```

---

## Navigation Structure

**Hamburger menu only** — no visible top nav bar at any breakpoint. Opens as fullscreen overlay.

| Label | File | Status |
|-------|------|--------|
| About Us | about.html | Priority 1 |
| Learning | learning.html | Priority 2 |
| Community | community.html | Priority 3 |
| Enrolments | enrolments.html | Priority 4 |
| Contact | contact.html | Priority 5 |

Policies page is linked from footer only, not in main nav.

---

## Working Rules

1. **Read `_dev/docs/DESIGN_SYSTEM.md` before writing any HTML** — it has exact CSS variables, Tailwind config, component specs, and copy-paste SVG dividers.
2. **Read `_dev/docs/CONTENT.md` for all copy** — never invent placeholder text when real copy exists.
3. **Read `_dev/docs/PAGES.md` for section order** — every page has a defined section sequence. Follow it exactly.
4. **Keep everything in one file per page** — HTML, CSS (Tailwind + `<style>` custom), and JS all in the same .html file.
5. **Never install npm packages** or add a build step.
6. **Tailwind CDN** for utility classes, `<style>` block for custom properties and component-specific CSS.
7. **Google Fonts** loaded via `<link>` tag in `<head>`.
8. **All pages share the same header and footer** — duplicate cleanly across files (no JS includes for V1).
9. **When adding a new section, also update content.json** with matching editable fields.
10. **Image placeholders:** dark grey (#374151) circles/rectangles with white label text. Use `site/images/placeholder-{section}.svg` convention.
11. **Ask before creating files not in the pages list.**
12. **Prefer semantic HTML** — use `<section>`, `<nav>`, `<header>`, `<footer>`, `<article>`, `<figure>`. Avoid div soup.
13. **Mobile-first** — design for mobile, scale up. Single column stacking, full-width images, 48px section padding.

---

## Build Order

1. **index.html** (Homepage) — the flagship page, establishes all reusable components
2. **about.html** (About Us) — reuses header/footer, adds team sections
3. **learning.html** — simpler structure, reuses alternating sections
4. **community.html** — similar pattern to learning
5. **enrolments.html** — includes CTA buttons and pathway visual
6. **contact.html** — includes form and Google Maps embed
7. **policies.html** — simple page with SafeSmart embed
8. **Admin dashboard** — adapt PlainPress admin to SK's content model
