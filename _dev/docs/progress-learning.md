## Session 9 — 2026-06-07

### Completed
- ✅ Section 1 — Hero → `site/learning.html`
  - Full-bleed `cosmos_1113100871.jpeg`, navy overlay at 0.60
  - "Learning with Purpose" h1 (Montserrat 800, clamp 38px–82px)
  - scroll-text-reveal animation on page load (350ms base delay on `.sk-hero-heading .scroll-text-char`)
  - Red decorative rule removed (hero has heading only, no rule)
  - Animated scroll dot indicator
- ✅ Section 2 — Intro Quote → `site/learning.html`
  - Dancing Script blockquote: "Learning at St Kevin's shapes both the mind and the heart."
  - 24px burgundy rule above, Inter sub-paragraph below
  - Background oversized " decorative character (Dancing Script, opacity 0.034)
  - GSAP stagger: rule → quote → sub, autoAlpha 0→1, y 22→0, expo.out
- ✅ Section 3 — Faith and Formation → `site/learning.html`
  - Image LEFT, text right, white bg
  - scroll-text-reveal on h2
  - GSAP clip-path circle reveal (0%→55%, 1.3s expo.out) + text stagger + accent fade-in
  - 3 SVG accents: dot grid (right col burgundy), burgundy cross+dot, spinning asterisk (burgundy)
- ✅ Section 4 — Belonging and Wellbeing → `site/learning.html`
  - Text left, image RIGHT, cloud grey bg
  - scroll-text-reveal on h2
  - 3 SVG accents: burgundy diamond outline, concentric circles (center dot burgundy), dot grid (right col burgundy)
- ✅ Section 5 — Teaching that Inspires → `site/learning.html`
  - Image LEFT, text right, white bg
  - scroll-text-reveal on h2
  - 3 SVG accents: spinning asterisk (burgundy), burgundy arc, 2-col dot grid (right col burgundy)
- ✅ Section 6 — Learning for Every Child → `site/learning.html`
  - Text left, image RIGHT, cloud grey bg
  - scroll-text-reveal on h2
  - 3 SVG accents: burgundy cross+dot, concentric circles (center dot burgundy), 6-point star (burgundy)
- ✅ Section 7 — Learning Beyond the Classroom → `site/learning.html`
  - Image LEFT, text right, white bg
  - scroll-text-reveal on h2
  - 3 SVG accents: spinning asterisk (burgundy), burgundy concentric circles, 3×2 dot grid (right col burgundy)
- ✅ Section 8 — Footer → `site/learning.html`
  - `<div id="sk-layout-footer">` injected by sk-layout.js

### In progress
- Clean stop — nothing in progress. Page is complete.

### Resume here
**Page:** community.html (next in build order)
**Section:** Section 1 — Hero
**Search terms:** `"sk-hero community"` or check PAGES.md PAGE 4 for full section list
**Status:** Not started — file is stub only

### Decisions
- **Cloud grey locked at hsl(38, 18%, 93.5%):** Determined via debug panel (intensity 6.5 on a 0–30 scale). Warmer and slightly lighter than the original `#F0EDE5`. Hardcoded in both `:root` CSS vars and Tailwind config. Debug panel removed after decision.
- **scroll-text-reveal is global:** All section headings (h2) across all pages should use `<span class="scroll-text-reveal" data-text="...">`. Hero h1 headings use the same wrapper but with a CSS base-delay on `.scroll-text-char` to account for page-load timing.
- **Hero heading delay pattern:** `.sk-hero-heading .scroll-text-char { transition-delay: calc(0.35s + var(--char-index, 0) * 28ms); }` — apply this to any page where the hero h1 uses scroll-text-reveal.
- **SVG accent color scheme:** All spinning asterisks → burgundy. All concentric circle center dots → burgundy. Dot grids → right column burgundy, left columns navy. Pre-existing burgundy shapes untouched. Gives each section both brand colors at low opacity.
- **Eyebrow = Dancing Script with inline rule:** `.sk-learn__eyebrow::before` pseudo-element (18×1.5px burgundy line). Not an uppercase label — avoids the AI scaffold eyebrow pattern.
- **`.sk-learn__body` contrast fix:** White bg → `rgba(5,30,66,0.62)` (~5.4:1). Cloud grey bg → `rgba(5,30,66,0.68)` (~5.2:1). Both pass WCAG AA. `var(--color-slate-text)` (#6B7280) fails on both.

### Lessons
- **CSS animation origin vs GSAP inline styles:** CSS `@keyframes` that animate `opacity` will override GSAP's `opacity: 0` initial state because the animation origin sits above the author origin in the CSS cascade. Fix: keep `@keyframes` to `transform` only; let GSAP own `opacity` exclusively.
- **IntersectionObserver fires immediately for in-viewport elements:** The hero heading is already visible on load, so the scroll-text-reveal observer triggers as soon as sk-layout.js sets it up. No special "load" event needed — just add a CSS base delay to control timing.
- **sk-layout.js must load last:** The shared layout script injects header/footer and sets up scroll-text-reveal. Place it after all page-specific scripts so GSAP targets aren't observed before they exist.

### Problems to watch out for
- Debug panel was removed this session — if grey bg needs re-tuning, the value is `hsl(38, 18%, 93.5%)` locked in `:root`.
- All spinning asterisks are now burgundy. If a section feels too warm, the opacity can be dialled back from 0.18–0.19 to 0.12.
- community.html has a dark navy closing section ("The St Kevin's Spirit") — new dark feature pattern not yet established on any secondary page. Will need `.sk-effect`-style dark section CSS or a new component.

### Files changed
- `site/learning.html` — complete page build: all 8 sections, GSAP animations, scroll-text-reveal, SVG accents with brand colors, cloud grey locked, debug panel removed
