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

---

## Session 2 — 2026-06-04

### Completed this session
- ✅ Sidebar redesigned — Zoox-style left panel (GSAP, Lucide icons) → `site/index.html`
- ✅ Sidebar: bare growing arrow on hover (2px line + chevron slides right) → `site/index.html`
- ✅ Sidebar: icon-only social footer in pill island (phone, email, Facebook inline SVG) → `site/index.html`
- ✅ Sidebar: tall portrait image panel with rounded frame + GSAP scale on open → `site/index.html`
- ✅ Sidebar: Policies added as 6th primary nav item, secondary links stripped → `site/index.html`
- ✅ Hero section built — YouTube background video (`rVqR9num8Js`), navy overlay, MACS logo bottom-left → `site/index.html`
- ✅ Debug panel — fixed bottom-right, slider to adjust overlay opacity live → `site/index.html`
- ✅ Logo images processed — colour SK logo in header + sidebar, MACS logo converted to white → `site/images/`
- ✅ Sample images copied to `site/images/samples/` for use across site build

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Homepage (index.html)
**Section:** Section 2 — Wave Divider (Burgundy) + Section 3 — Quotes Carousel
**Search terms to find component:** `"SVG wave divider html css"` or `"quotes carousel auto-cycle vanilla js"` or `"testimonial slider no library"`
**Status:** Hero done. Next is the wave divider SVG that transitions hero → welcome block, then the quotes carousel (Dancing Script, 6-second auto-cycle, 6 quotes).

### Decisions made this session

- **Hamburger menu only (confirmed):** No top nav bar at any breakpoint. Sidebar opens from left.
- **YouTube embed for hero video:** Using iframe embed with `autoplay=1&mute=1&loop=1&playlist=ID&controls=0`. Cover sizing via `max(100%, calc(100vh * 16/9))`.
- **Overlay uses CSS custom property:** `--hero-overlay-opacity` defaults to `0.60`. Debug panel sets it via JS so the value is live-adjustable without touching source.
- **MACS logo placement:** Bottom-left of hero (per client revision doc). Using `St-Brigids-Gisborne-Horizontal-lock-up-COLOUR-1.png` converted to all-white via ImageMagick (`-channel RGB -evaluate set 100%`).
- **SK colour logo in header:** `St-Kevins-vertical-lock-up-COLOUR-1.png` used directly. White version needed for transparent-header state — placeholder comment left in CSS for when client supplies it.
- **Debug panel to be removed before launch:** The entire `<!-- DEBUG PANEL -->` block in index.html.
- **Sidebar image:** `site/images/samples/cosmos_1616537391.jpeg` — client replaces with real school photo before launch.
- **React component stagger effect attempted and reverted:** Tried to port the ReactBits StaggeredMenu pre-layer + text-cycling effect. Multiple z-index and GSAP conflicts. Reverted to the original working sidebar animation (GSAP `x: '-100%'` slide, `tl.from` stagger on items). Not worth re-attempting in vanilla JS without proper isolation — if this effect is wanted, consider implementing it fresh in a separate branch with careful testing.

### Problems to watch out for
- YouTube autoplay is blocked on some browsers unless the video is muted — the embed URL already includes `mute=1` so this is handled.
- The hero iframe has `pointer-events: none` — clicking the hero area will not interact with the video player. Intentional.
- White SK logo not yet available — header logo currently shows colour version over the dark hero. Looks acceptable but not ideal. Remind client to supply a white/reverse version.
- Facebook `href="#"` in sidebar footer — replace with actual school Facebook URL when known.
- Debug panel must be removed before going live — it's clearly marked with a comment but easy to forget.
- `site/images/` is gitignored — logos and samples exist locally only. Will need to be uploaded to hosting separately.

### Files changed this session
- `site/index.html` — major rewrite: Zoox sidebar, GSAP animations, hero section, debug panel, logo swaps, overlay system
- `site/images/logo-sk-colour.png` — copied from `source-docs/St-Kevins-vertical-lock-up-COLOUR-1.png`
- `site/images/macs-logo-white.png` — generated from `sample pictures/St-Brigids-Gisborne-Horizontal-lock-up-COLOUR-1.png` (ImageMagick white conversion)
- `site/images/samples/` — 7 sample images copied from `sample pictures/` folder
- `PRODUCT.md` — created (required by /impeccable skill)
