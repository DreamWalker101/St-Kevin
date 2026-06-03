# St Kevin's Hampton Park — Build Progress

---

## Session 1 — 2026-06-04

### Completed this session
- ✅ Repo structure organised → `CLAUDE.md`, `docs/`, `site/`, `source-docs/`, `site/sections/`
- ✅ All source docs ingested → `source-docs/` (xlsx, docx, txt revision doc)
- ✅ Stub HTML files created → `site/about.html`, `learning.html`, `community.html`, `enrolments.html`, `contact.html`, `policies.html`
- ✅ Shared header + fullscreen nav overlay → `site/index.html` + `site/sections/shared/header.html`

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Homepage (index.html)
**Section:** Hero (Section 1 of 14)
**Search terms to find component:** `"fullscreen video hero section dark overlay"` or `"full viewport hero background video autoplay html css"` or `"hero section with fixed hamburger logo overlay"`
**Status:** Not started — header is done, hero comes next

### Decisions made this session

- **MACS logo NOT in header:** Client revision doc says MACS logo goes bottom-left of the hero video as an overlay. Header has: hamburger (left), SK logo (centre), search (right).
- **Search bar on header right:** Added per client revision — was MACS logo in original plan.
- **Circular images = larger than screen:** Client revision explicitly says "make circular image larger than screen size (to attract scrolling)" — goes beyond the 110–120% column width spec in DESIGN_SYSTEM.md.
- **Welcome block below quotes carousel:** Client revision repositioned welcome block to sit under the quotes, not directly under the hero.
- **Burger nav overlay includes contact details strip:** Phone and email in small text at bottom of fullscreen overlay — not in original spec but standard UX.
- **Replaced wrong CLAUDE.md:** The repo had the nWork project CLAUDE.md — replaced with St Kevin's version from the docs zip.

### Problems to watch out for
- `site/images/` is gitignored — placeholder folder exists locally but won't be committed. Placeholder SVGs need to go there for local dev only.
- The `.cpanel.yml` deploy config is already in the repo — don't delete or modify it.
- When real logos arrive, swap the placeholder `<div class="sk-logo-placeholder">` in `index.html` for two `<img>` tags (white version + colour version), toggled by `.is-transparent` / `.is-scrolled` classes on the header.

### Files changed this session
- `CLAUDE.md` — replaced nWork version with St Kevin's project brief
- `docs/DESIGN_SYSTEM.md` — created (extracted from docs zip)
- `docs/CONTENT.md` — created (extracted from docs zip)
- `docs/PAGES.md` — created (extracted from docs zip)
- `site/index.html` — full page shell: CSS custom properties, Tailwind config, header, nav overlay, JS
- `site/about.html` — stub (empty)
- `site/learning.html` — stub (empty)
- `site/community.html` — stub (empty)
- `site/enrolments.html` — stub (empty)
- `site/contact.html` — stub (empty)
- `site/policies.html` — stub (empty)
- `site/sections/shared/header.html` — standalone header fragment (for reference)
- `site/sections/homepage/.gitkeep` — folder placeholder
- `site/sections/about/.gitkeep` — folder placeholder
- `site/sections/learning/.gitkeep` — folder placeholder
- `site/sections/community/.gitkeep` — folder placeholder
- `site/sections/enrolments/.gitkeep` — folder placeholder
- `site/sections/contact/.gitkeep` — folder placeholder
- `source-docs/` — all client source files moved here (xlsx, docx, txt, mockup jpgs, logo png)
- Removed: `MASTER_CONTEXT.md`, `VSCODE_SETUP_GUIDE.md`, `PROGRESS.md` (stale nWork files), both zip archives, `extracted/`
