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

---

## Session 4 — 2026-06-04

### Completed this session
- ✅ Sections 3–8 — Quotes Carousel + Welcome Block + Pinned Image Scroll built → `site/index.html`
- ✅ Section 3 — Quotes Carousel: 6-second auto-cycle, Dancing Script font, 6 parent quotes, dot navigation, fully accessible (aria-live, aria-selected, focus-visible)
- ✅ Section 4 — Welcome Block: Montserrat 800 uppercase heading, Dancing Script tagline, client copy from CONTENT.md
- ✅ Sections 5–8 — GSAP pinned image scroll: Codrops gsap-pinned-image-mask-reveal pattern adapted, 4 content blocks (Belonging / Learning / Faith / Growing Together), cosmos images, clipPath wipe on scrub, NO background colour transitions (user requirement), mobile interleaved layout via CSS order + JS
- ✅ Text entrances: GSAP expo.out stagger per visible pillar item (h2 → p → tagline), triggered on viewport entry
- ✅ Section 2 — Wave Divider (Burgundy) rebuilt as on-scroll morphing SVG path (Codrops OnScrollPathAnimations pattern) → `site/index.html`
- ✅ Tape ribbon scrapped — replaced with single-path SVG, `viewBox="0 0 1440 120"`, `preserveAspectRatio="none"` for full-bleed scaling
- ✅ Path morph: dA (rest, ~50px amplitude) → dB (peak, ~100px amplitude), identical M C C L L Z command structure for clean GSAP `attr.d` interpolation
- ✅ GSAP ScrollTrigger `scrub: 1.4`, `start: 'top 90%', end: 'top 10%'` — morph happens as divider traverses the viewport, confident/editorial feel
- ✅ WAVES config array in JS — Section 9 + 11 entries commented and ready to plug in when those sections are built
- ✅ CSS wave divider system — three modifier classes: `--burg`, `--navy`, `--navy-inv` for all three transition types

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Homepage (index.html)
**Section:** Section 3 — Quotes Carousel
**Search terms to find component:** `"quotes carousel auto-cycle vanilla js"` or `"testimonial slider no library"` or `"Dancing Script font carousel"`
**Status:** Wave divider done. Next: Quotes Carousel — Dancing Script, 6-second auto-cycle, 6 quotes from CONTENT.md, white background.

### Decisions made this session
- **Codrops OnScrollPathAnimations pattern chosen** — on-scroll path morph replaces the previous twisted ribbon. User referenced https://github.com/codrops/OnScrollPathAnimations and the Codrops tutorial as the target aesthetic.
- **All three wave dividers (Sec 2, 9, 11) will use this pattern** — same WAVES config array, different fill colors.
- **dA → dB morph on scroll**: both states use identical SVG command structure so no MorphSVGPlugin required. GSAP standard `attr.d` tween handles it.
- **No horizontal drift** — the old tape ribbon used GSAP x-translate across scroll. The new system uses pure path morphing. Cleaner, no oversized 2400px viewBox needed.

### Problems to watch out for
- All prior session problems still apply (images gitignored, Facebook href="#", debug panel to remove).
- Section 9 and 11 wave dividers need their `dA`/`dB` paths designed when those sections are built — placeholder comments in the WAVES array in JS.

### Files changed this session
- `site/index.html` — wave divider system: CSS, HTML (Section 2), JS (WAVES morph config)

---

## Session 3 — 2026-06-04

### Completed this session
- ✅ Debug panel expanded — SK logo size slider, MACS logo size slider, white logos toggle → `site/index.html`
- ✅ Sample images wired — all 7 cosmos_ images copied to `site/images/samples/`, logos to `site/images/` → `site/images/`
- ✅ Image-to-section mapping decided — cosmos_ images assigned to specific homepage sections (see Decisions)
- ✅ Header dual-logo system — `logo-sk-white.png` over hero, `logo-sk-colour.png` on scroll, CSS opacity crossfade → `site/index.html`
- ✅ Header smart sticky — hides on scroll down, reveals on scroll up (kicks in past 140px) → `site/index.html`
- ✅ Header logo shrinks 30% on scroll — `scale(0.7)` via `expo.out` transition, anchored `transform-origin: top center` → `site/index.html`
- ✅ Header logo positioned correctly — `top: 16px` prevents overflow above viewport → `site/index.html`
- ✅ MACS hero logo set to 100px → `site/index.html`
- ✅ Sidebar logo swapped to combined MACS+SK horizontal lockup (`logo-sk-macs-combined.png`) at 80px → `site/index.html`
- ✅ Nav item labels slide right on hover — `translateX(6px)` matching arrow timing → `site/index.html`
- ✅ Social icon micro-animations — GSAP-driven: phone tips/answers, envelope flap morphs open via `attr.points`, Facebook floats up with elastic bounce → `site/index.html`
- ✅ Lucide CDN removed — replaced all icons with inline SVGs for full animation control → `site/index.html`
- ✅ Sidebar open/close completely reworked — premium `expo.out` 0.78s open, `power4.inOut` 0.56s close, unhurried stagger → `site/index.html`

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Homepage (index.html)
**Section:** Section 2 — Wave Divider (Burgundy) + Section 3 — Quotes Carousel
**Search terms to find component:** `"SVG wave divider html css"` or `"quotes carousel auto-cycle vanilla js"` or `"testimonial slider no library"`
**Status:** Hero done, header/sidebar polished. Next is the burgundy wave SVG divider below the hero, then the quotes carousel (Dancing Script, 6-second auto-cycle, 6 quotes from CONTENT.md).

### Decisions made this session

- **Dual header logos via CSS opacity:** `logo-sk-white.png` (white text version) is the default over the dark hero. `logo-sk-colour.png` fades in when `is-scrolled` class is applied. No JS src-swapping — pure CSS opacity transition.
- **White logo file confirmed:** `St-Kevins-text-white-same-size.png` in `sample pictures/` — same icon, white "St. Kevin's" text. Copied to `site/images/logo-sk-white.png`.
- **Sidebar logo = combined lockup:** `St-Kevins-vertical-lock-up-COLOUR-1 (1).png` (MACS + SK horizontal) copied to `site/images/logo-sk-macs-combined.png` and used in sidebar header at 80px.
- **Sidebar logo needs `max-width: 100%`:** The combined lockup is landscape — without width constraint it overflows the sidebar column silently.
- **Social icons — no hover background, GSAP path animation instead:** Hover background removed entirely. GSAP animates actual SVG geometry: `attr.points` on envelope flap, `rotation` with `elastic.out` on phone, `y` bounce on Facebook.
- **Image section mapping (homepage):**
  - `cosmos_1226555780` → Belonging (3 kids writing, warm)
  - `cosmos_1113100871` → Learning with Purpose (classroom)
  - `cosmos_1074538081` → Faith in Action (art/craft group)
  - `cosmos_226684284` → Growing Together (floor activity)
  - `cosmos_547543300` → Welcome Block feature image (playground)
  - `cosmos_1616537391` → Sidebar panel + Enrolments CTA
  - `cosmos_1263936189` → duplicate of art/craft (reuse as needed)
- **Debug panel to be removed before launch** — overlay opacity, logo size sliders, white logos toggle all in `<!-- DEBUG PANEL -->` block.

### Problems to watch out for
- `site/images/` is gitignored — all images (logos, samples, combined lockup) exist locally only. Must be uploaded to cPanel separately at deploy time.
- Facebook `href="#"` in sidebar social strip — replace with actual school Facebook URL when known.
- MACS logo in hero is white (`macs-logo-white.png`) — looks correct over dark overlay. If overlay opacity is reduced below ~0.3 the logo may lose contrast against a bright video frame.
- `logo-sk-white.png` has coloured cross/people icons (navy+burgundy) — navy parts blend into dark hero but burgundy remains visible. Fully white version would look better; remind client to supply one.
- Debug panel `--hero-overlay-opacity` CSS var must be removed (or defaulted in CSS) before launch — currently JS sets it on load.

### Files changed this session
- `site/index.html` — major update: debug panel expansion, dual logo system, smart sticky header, logo shrink on scroll, sidebar logo swap, nav label hover animation, social icon GSAP animations, Lucide removed, sidebar open/close rework
- `site/images/logo-sk-white.png` — copied from `sample pictures/St-Kevins-text-white-same-size.png`
- `site/images/logo-sk-macs-combined.png` — copied from `site/images/St-Kevins-vertical-lock-up-COLOUR-1 (1).png`
- `site/images/macs-logo-colour.png` — copied from `sample pictures/St-Brigids-Gisborne-Horizontal-lock-up-COLOUR-1.png`
- `site/images/samples/` — all 7 cosmos_ jpeg images present (previously session 2)

---

## Session 5 — 2026-06-06

### Completed this session
- ✅ about.html — Hero (60vh, `sk-hero--short`) + Wave Divider Burgundy (carried over from prior session context) → `site/about.html`
- ✅ Footer logos — global update: height 110px, gap 60px via CSS vars (`--footer-logo-h`, `--footer-logo-gap`) → `site/index.html`, `site/about.html`
- ✅ Section 3 — About St Kevin's Intro — centred Montserrat 800 heading + Inter body, Warm Cream bg → `site/about.html`
- ✅ Sections 4–6 — Our Story / Our Mission / Our Vision — scroll-driven sticky panel (300vh track, sticky 100vh), Dancing Script headings, Inter body, GSAP ScrollTrigger slide progression, magnetic CTA, clip-path entrance, arrow + elastic spring animations → `site/about.html`

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** About Us (about.html)
**Section:** Section 7 — Our Principal
**Search terms to find component:** `"video thumbnail play button overlay html css"` or `"video card play button centred"` or `"principal message video card with text below"`
**Status:** Not started — sections 3–6 done, Section 7 is next

### Decisions made this session
- **"Pure White bg" = Warm Cream globally:** Body background is `var(--color-warm-cream)` (`#FBF9F7`) on all pages. PAGES.md "Pure White" sections simply inherit the page background — no explicit white bg needed. All comment labels in about.html updated to reflect this.
- **Sections 4–6 combined into one scroll-driven sticky component:** User brought in a CodePen scrolling story (3-slide sticky, scroll-driven) and adapted it rather than building 3 separate stacked text blocks.
- **Image column kept in sections 4–6:** Despite PAGES.md saying "no images" for these sections, the chosen component has a right image column — placeholder dark grey divs used. Client can replace with real photos.
- **CTA in sections 4–6 = "Book a Tour" → enrolments.html:** Chosen to give the story/mission/vision scroll a meaningful conversion action.
- **Mobile (≤900px) for sections 4–6:** Sticky collapses to stacked single-column; dot pagination still works as tap navigation; magnetic CTA hover effect disabled.
- **Footer logo sizes = 110px height, 60px gap:** Applied via CSS variable defaults in both files. Any future page copies the footer block and inherits the same values automatically.

### Lessons learned this session
- **CTA magnetic hover — disable on mobile:** `gsap.quickTo` magnetic tracking causes jarring jumps on touch devices. Guard with `window.matchMedia('(max-width: 900px)').matches`.
- **clip-path entrance on pill buttons:** `inset(0 100% 0 0)` → `inset(0 0% 0 0)` is a clean left-to-right wipe with no extra markup. Works on `border-radius` elements without needing `round` suffix.
- **Scroll-driven sticky + Lenis:** Set `position: sticky; top: 0` on the panel inside a `height: 300vh` wrapper — ScrollTrigger drives slide index via `onUpdate`. No need to fight Lenis; it syncs with ScrollTrigger already.
- **Always Read about.html before Write:** The file was empty and Write failed because it had not been read. Always Read first even if the file was just created.

### Problems to watch out for
- All prior session problems still apply (images gitignored, Facebook href="#", debug panel to remove before launch).
- Section 7 (Our Principal) requires a video thumbnail — if no real video yet, use the dark grey placeholder pattern with a play icon overlay.
- The scroll-driven sticky section (4–6) needs `gsap.registerPlugin(ScrollTrigger)` — already called in the wave morph script block. Do not call it again in the SMV script or it will conflict.

### Files changed this session
- `site/index.html` — footer logo CSS vars updated (`--footer-logo-h: 110px`, `--footer-logo-gap: 60px`)
- `site/about.html` — major build: Section 3 intro, Sections 4–6 scroll-driven sticky component (CSS + HTML + JS), footer logo vars aligned, comment labels updated from "Pure White" to "Warm Cream"

---

## Session 6 — 2026-06-06

### Completed this session
- ✅ learning.html — Section 1 Hero built from stub → `site/learning.html`
  - Full-bleed `cosmos_1113100871.jpeg` (wide classroom, natural light, children at wooden tables)
  - Navy overlay `#051E42` at `opacity: 0.60` — exact same CSS var as homepage hero (`--hero-overlay-opacity`)
  - Centred "Learning with Purpose" h1 (Montserrat 800, `clamp(38px, 7vw, 82px)`) + Inter body text
  - Burgundy decorative rule (36×2px) above heading — craft detail, not an eyebrow label
  - Animated scroll dot indicator at bottom (looping, `power1.inOut`, `repeat: -1`)
  - GSAP entrance: rule expands (`expo.out`) → heading rises → body follows → scroll dot fades in
  - `prefers-reduced-motion` handled — elements visible without JS, no opacity-gating
  - "Learning" marked active in sidebar nav (`is-active`, `aria-current="page"`)
  - Burgundy wave divider below hero (same SVG path as index.html)
  - Full shared header/nav/sidebar/search/click-spark/Lenis scripts included

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Learning with Purpose (learning.html)
**Section:** Section 2 — Intro body (centred text, warm cream/white bg)
**Search terms to find component:** `"editorial lead paragraph typography section"` or `"centred intro text block school website"` or `"body text intro white background web design"`
**Status:** Not started — hero done, wave divider in place. Section 2 is just a centred paragraph block, no image.

### Decisions made this session
- **`cosmos_1113100871.jpeg` for learning hero** — widest landscape shot, natural light, children at wooden tables, greenery through windows. Most cinematic of the 7 available samples. `object-position: center 28%` to show upper classroom area.
- **Burgundy rule instead of eyebrow text** — avoids the "small caps label above every heading" AI scaffold pattern. Pure 36×2px graphic accent.
- **Intro body copy source** — CONTENT.md has no dedicated intro paragraph for learning.html. Will use homepage "Learning with Purpose" section body: "Learning at St Kevin's is both structured and meaningful, grounded in evidence-informed teaching and rich opportunities for inquiry."
- **Sections 3–7 component** — will reuse the `.sk-pillar` CSS already in index.html (alternating circular image + text). Extract and adapt rather than reinvent.

### Lessons learned this session
- **Pre-animation headless screenshot captures blank text** — `chromium-browser --headless` screenshots before GSAP fires. Fix: `--virtual-time-budget=4000` lets animations run first. Essential for verifying GSAP hero entrances.
- **Mobile heading at 1× DPR can look truncated** — take mobile screenshots at 2× DPR to confirm true wrapping. 1× DPR screenshots can appear to cut off text that actually wraps correctly.

### Problems to watch out for
- Sections 3–7 reuse sample images from homepage — tune `object-position` per image so focal points (faces, group moments) stay visible inside the circle crop.
- `.sk-pillar` CSS in index.html has `is-dark` variants for navy bg — learning.html sections are all light bg so only the light-mode variant is needed. Strip dark variants to keep the CSS lean.
- Section 8 (Footer) must be a clean copy of index.html footer block — same CSS vars, same HTML structure. Keep in sync across pages.

### Files changed this session
- `site/learning.html` — built from stub: complete hero section (CSS + HTML + GSAP JS), burgundy wave divider, full shared header/nav/sidebar component

---

## Session 7 — 2026-06-06

### Completed this session
- ✅ index.html — Section 9 wave added (cream → navy, `--navy-inv` class, id=`sk-wave-divider-9`, wired in WAVES morph array)
- ✅ index.html — Fixed `--navy-inv` CSS bug: `var(--color-navy)` was undefined → corrected to `var(--color-deep-navy)`
- ✅ index.html — Section 11 wave: added IDs (`sk-wave-divider-11`, `sk-wave-path-11`), wired in WAVES morph array
- ✅ index.html — Section 12 Video Grid built: 2×2 grid, 4 placeholder videos (Google sample bucket), hover-to-preview (muted), click-to-play/pause, GSAP scroll entrance, drop shadows with hover lift, SVG concentric-circle deco, category + duration badges, navy overlay with SK logo, play/pause icon toggle
- ✅ context updated — footer (Section 14) confirmed already built in a prior session
- ✅ SECTION_CHECKLIST.md created — track completion state across all pages

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** Learning with Purpose (`learning.html`)
**Section:** Section 2 — Intro body (centred text paragraph, warm cream bg)
**Status:** Not started — hero + wave divider done, this is a simple centred text block next.

### Decisions made this session
- **Section 9 wave fill = `#FBF9F7` (warm cream):** Container bg is deep navy. Creates warm cream shape at top of navy section — pillars colour receding as Effect section begins.
- **Section 11 wave already existed** — just missing IDs. The comment "effect (navy) → enrolments (cream)" was accurate; only IDs were missing for GSAP scroll morph.
- **Video Grid uses Google sample bucket MP4s:** Placeholder URLs (`ForBiggerBlazes`, `ForBiggerEscapes`, `ForBiggerFun`, `ElephantsDream`) — client replaces with real Drive/hosted videos before launch.
- **Hover preview = muted:** School context — autoplay with sound on hover would be jarring. Click also plays muted for simplicity; client can enable sound in JS if needed.
- **SVG deco = concentric rings:** Two sets — large navy rings top-right (opacity 0.045), smaller burgundy rings bottom-left (opacity 0.035). Echoes the circular motif from pillar and enrolments sections.

### Problems to watch out for
- Video Grid placeholder URLs are external (Google CDN) — they will stream fine in dev but should be replaced with hosted school videos before launch.
- `logo-sk-white.png` used as overlay logo inside video cards — this is gitignored with all other `site/images/`. Ensure it uploads to hosting.
- All prior session warnings still apply (Facebook href="#", debug panel removal, images not in git).

### Files changed this session
- `site/index.html` — Section 9 wave (CSS fix + HTML + WAVES JS), Section 11 IDs + WAVES JS, Section 12 Video Grid (CSS + HTML + JS)
- `PROGRESS.md` — this update
- `SECTION_CHECKLIST.md` — created (new file)

---

## Session 8 — 2026-06-06

### Completed this session
- ✅ index.html — Floating SVG accent decoratives added to Section 10 (testimonial): 6 marks (dot grid, asterisk, diamond, arc, cross, concentric rings) in navy/burgundy at 8–14% opacity with independent float animations (8–16s, staggered delays)
- ✅ index.html — Floating SVG accent decoratives added to Section 5–8 (pillar right column): 5 marks (dot grid, asterisk, cross+dot, diamond, concentric target) in white at 10–18% opacity, hidden on mobile
- ✅ about.html — About St Kevin's Intro (Section 3) redesigned: centred layout → editorial split grid (large 900-weight display heading left, tagline + body right), burgundy rule accent, responsive collapse
- ✅ about.html — Story/Mission/Vision panel (Sections 4–6) polished: warm cream background added, dot indicator height/opacity bumped, body text opacity + line-height improved, image slides now have real sample photos with hover-zoom (`.sk-smv__img-photo`), label repositioned as overlay
- ✅ site/images/ — tracked in git (removed from .gitignore), all logos + sample photos committed and pushed for cross-device sync
- ✅ GPT image prompt written — sprite sheet brief for 20 illustrated school-themed icons (flat line-art, navy + burgundy, 4×5 grid, transparent bg)

### In progress
- Nothing in progress — clean stop

### Resume here next session
**Page:** About Us (`about.html`)
**Section:** Section 7 — Our Principal (video thumbnail + text block, play button)
**Search terms:** "video thumbnail play button card HTML CSS" / "principal bio section split layout"
**Status:** Not started — Story/Mission/Vision (Sections 4–6) complete, Section 7 is next

### Decisions made this session
- **Floating SVG accents use CSS keyframe animation (not GSAP scrub):** Pillar section is GSAP-pinned, so CSS `@keyframes skAccentUp/Down/Spin` at different speeds/delays gives organic floating without coupling to the scrub timeline. Reduced-motion respected via `animation: none !important` on `.sk-accent`.
- **Pillar accents = white at 18% opacity:** Background alternates white→navy→burgundy→navy. White is invisible on the first (white) panel — acceptable tradeoff; accents are most effective on the dark panels where visual interest is highest anyway.
- **About Intro font-weight: 900:** Added `wght@900` to Google Fonts link to support the editorial display heading. Previously only 600/700/800 loaded.
- **`.sk-wave-divider--burg` background fix:** Was `var(--color-deep-navy)` (wrong — makes it invisible on navy), corrected to `#FBF9F7` (warm cream) so the burg wave creates the correct cream-background container for the burgundy SVG shape.
- **About Intro layout = split grid (1fr 0.62fr):** Moved from centred single-column to editorial two-column. Left: oversized display heading. Right: script tagline + body copy. Collapses to single column at 860px.
- **Image illustrations deferred to PNG swap:** CTA visual column uses circular sample photo as placeholder. GPT image prompt provided for client to generate illustrated assets — will replace once received.

### Lessons learned this session
- **CSS animation + inline `transform` conflict:** Don't apply both `transform: translateY(-50%)` in `style=""` and a CSS `@keyframes` that also uses `transform` on the same element — the animation overrides the inline style entirely. Use percentage-based `top` instead of transform-centering.
- **Pillar section deco z-index:** Images have `z-index: 1–4` from `data-order`. Deco layer must be `z-index: 5` to float above all images, but `pointer-events: none` ensures it never blocks interaction.
- **generative_ui_agents repo (evaluated this session):** Not applicable to this stack. All 7 projects require React + Next.js + npm + Python backend. Our constraint (static HTML, Tailwind CDN, cPanel) makes them incompatible.

### Problems to watch out for
- Debug panel (Testimonials dev sliders) is still in the HTML — remove before handing to client.
- Facebook link in footer still `href="#"` — needs real URL.
- Placeholder videos in Section 12 are external Google CDN — must be replaced with school-hosted videos before launch.
- GPT illustrated PNG prompt was written but not yet generated/integrated — follow up with client.

### Files changed this session
- `site/index.html` — floating SVG accents: `@keyframes`, `.sk-effect__deco`, `.sk-pillar__deco` CSS + all HTML accent elements
- `site/about.html` — About Intro redesign (split grid, 900-weight heading, burgundy rule), SMV panel polish (bg, dots, body text, image hover-zoom), wave divider bg fix
- `.gitignore` — removed `site/images/` exclusion, added `.gstack/`
- `PROGRESS.md` — Sessions 7 + 8 written
- `SECTION_CHECKLIST.md` — created (full cross-page section tracker)
