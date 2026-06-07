# Build Prompt — community.html
# St Kevin's Primary School, Hampton Park

---

## Mission

Build `site/community.html` — a complete, production-quality, fully animated static HTML page for the Community section of St Kevin's Primary School. The file is currently empty. Build the entire page from scratch.

---

## Hard Constraints (never violate these)

- **No npm. No build step. No framework.** Static HTML only.
- **Tailwind CDN** via `<script src="https://cdn.tailwindcss.com">` — utility classes only
- **GSAP 3.14.2 + ScrollTrigger** for all animations. Never use CSS `@keyframes` for primary entrance motion.
- **Lenis 1.1.14** for smooth scroll, connected to ScrollTrigger
- **One file** — `site/community.html`. All CSS in `<style>`, all JS in `<script>` at bottom of `<body>`
- **Google Fonts** loaded via `<link>` in `<head>`: Montserrat (600,700,800), Inter (400,500), Dancing Script (400,700)
- **Semantic HTML** — `<section>`, `<header>`, `<footer>`, `<nav>`, `<figure>`, `<article>`
- **Mobile-first** — single column at ≤768px, 48px vertical section padding on mobile
- **No inline `style=""` for layout** — use CSS classes or custom properties
- Output path: `site/community.html`

---

## Step 1 — Read these files in order before writing a single line

1. **`site/about.html`** — PRIMARY reference implementation. The complete `<head>` block, `<style>` CSS (`:root` vars, header, sidebar, search panel, hero, wave dividers, footer), all shared HTML components (header, sidebar, search, footer), and all shared JS (Lenis init, GSAP/ScrollTrigger init, header scroll logic, sidebar open/close, search panel, click-spark) must be copied verbatim or adapted from this file. Do not reinvent any shared component.

2. **`site/css/sk-layout.css`** — already loaded via `<link>`. Do not duplicate its rules.

3. **`site/index.html`** — Read the pillar alternating sections (Sections 5–8, class `.sk-pillar`) for the circular image + text pattern. Read the dark feature section (Section 10 `.sk-effect`) for the dark navy closing pattern. Copy the CSS for `.sk-pillar` and adapt it.

4. **`docs/DESIGN_SYSTEM.md`** — Design tokens, CSS vars, component specs, do's and don'ts.

5. **`docs/CONTENT.md`** → section **"COMMUNITY — community.html"** — all approved copy. Do not invent text.

6. **`docs/PAGES.md`** → section **"PAGE 4: COMMUNITY"** — section order and layout specs.

---

## Step 2 — Head block

Copy the entire `<head>` block from `site/about.html` verbatim, then change:
- `<title>` → `Community — St Kevin's Primary School, Hampton Park`
- Keep all CDN links, Google Fonts, Tailwind config, sk-layout.css link identical

---

## Step 3 — CSS `<style>` block

Copy the entire `<style>` block from `site/about.html`. It contains the `:root` custom properties, header, hamburger, logos, search panel, nav backdrop, sidebar, hero, wave dividers, and footer CSS — all correct and ready to use.

Then **add** these additional rules after the copied block:

### Intro section
```css
.sk-community-intro {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-community-intro__inner {
  max-width: 720px;
  margin: 0 auto;
}
.sk-community-intro__body {
  font-family: var(--font-inter);
  font-size: clamp(1.0625rem, 2vw, 1.25rem);
  line-height: 1.8;
  color: var(--color-deep-navy);
  opacity: 0.85;
}
@media (max-width: 768px) {
  .sk-community-intro { padding: var(--section-padding-mobile) 24px; }
}
```

### Pillar alternating sections (circular image + text)
Copy the `.sk-pillar`, `.sk-pillar__wrap`, `.sk-pillar__text`, `.sk-pillar__circle`, `.sk-pillar__img` CSS block from `site/index.html`. This is the core layout for sections 3–6. Keep it identical — only change BEM names if needed.

**Section backgrounds:**
- Section 3 (A Welcoming Community): `background: var(--color-warm-cream);`
- Section 4 (Partnerships with Families): `background: var(--color-cloud-grey);`
- Section 5 (Celebrating Together): `background: var(--color-warm-cream);`
- Section 6 (Faith in Community): `background: var(--color-cloud-grey);`

### Dark closing section — The St Kevin's Spirit
```css
.sk-spirit {
  background: var(--color-deep-navy);
  color: #fff;
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.sk-spirit__inner {
  max-width: 820px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.sk-spirit__eyebrow {
  font-family: var(--font-montserrat);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--color-burgundy-red);
  margin: 0 0 24px;
}
.sk-spirit__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(2.25rem, 5vw, 3.75rem);
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: #fff;
  margin: 0 0 28px;
}
.sk-spirit__body {
  font-family: var(--font-inter);
  font-size: clamp(1rem, 1.5vw, 1.125rem);
  line-height: 1.8;
  color: rgba(255,255,255,0.78);
  margin: 0 0 48px;
}
.sk-spirit__tagline {
  font-family: var(--font-dancing-script);
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 400;
  color: rgba(255,255,255,0.65);
  margin: 0;
  font-style: italic;
}
@media (max-width: 768px) {
  .sk-spirit { padding: var(--section-padding-mobile) 24px; }
}
```

---

## Step 4 — Shared HTML components (copy from about.html verbatim)

Copy these blocks exactly from `site/about.html`, changing nothing except the active nav item:

1. `<header class="sk-header ...">` — the full header block
2. `<div class="sk-nav-backdrop ...">` — nav backdrop
3. `<nav class="sk-nav-sidebar ...">` — the full sidebar with all nav items and social icons
4. `<div class="sk-search-panel ...">` — search panel

**Active nav item:** In the sidebar nav, add `is-active` class and `aria-current="page"` to the **Community** link `<a href="community.html">`.

---

## Step 5 — Build sections in order

### Section 1: Hero
**Background:** `var(--color-deep-navy)` — use `sk-hero sk-hero--short` (60vh minimum height)
**Image:** `images/samples/cosmos_1226555780.jpeg` — children together, warm
**Overlay:** `rgba(5,30,66,0.60)` via `.sk-hero-overlay`
**Text overlay (centred, positioned bottom 30% of hero):**
```
Eyebrow: COMMUNITY (Montserrat 700, 11px, 0.18em tracking, burgundy-red, uppercase)
H1: Our Community (Montserrat 800, clamp(3rem,7vw,5.5rem), white, -0.02em tracking)
```
**MACS logo:** bottom-left, `images/macs-logo-white.png`, 90px
**Scroll dot indicator:** animated, centred bottom, 32px from edge — 3px × 24px pill, navy bg, looping pulse up

**GSAP entrance (after window load):**
```js
gsap.fromTo('.sk-hero-eyebrow', { autoAlpha: 0, y: -16 }, { autoAlpha: 1, y: 0, duration: 0.9, ease: 'expo.out', delay: 0.2 });
gsap.fromTo('.sk-hero-h1', { autoAlpha: 0, y: 28 }, { autoAlpha: 1, y: 0, duration: 1.1, ease: 'expo.out', delay: 0.4 });
```

---

### Section 2: Wave Divider (Burgundy — hero → content)
```html
<div class="sk-wave-divider sk-wave-divider--burg" id="sk-wave-divider-2" aria-hidden="true">
  <svg class="sk-wave-svg" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path id="sk-wave-path-2" d="M 0 0 L 1440 0 L 1440 14 C 1080 22 360 76 0 88 Z" fill="#8A2232"/>
  </svg>
</div>
```
Register this in a WAVES array and animate path morph on scroll with GSAP ScrollTrigger (same pattern as `site/index.html` WAVES config).

---

### Section 3: Intro
**Background:** `var(--color-warm-cream)` · **Class:** `sk-community-intro`

**Copy:**
> St Kevin's is more than a school. It is a community where families, staff and students walk together in support, friendship and faith.

**GSAP entrance (ScrollTrigger `start: 'top 80%'`):**
```js
gsap.from('.sk-community-intro__body', { autoAlpha: 0, y: 32, duration: 1, ease: 'expo.out' });
```

---

### Section 4: A Welcoming Community
**Background:** `var(--color-warm-cream)` · **Layout:** Image RIGHT, text LEFT
**Image:** `images/samples/cosmos_1226555780.jpeg` — oversized circle (115% of column width)

**Copy:**
- Heading: `A Welcoming Community` (Montserrat 700, 36px, deep navy)
- Body: `Everyone is welcome here. Families from many cultures and backgrounds form the heart of our school community. Together we create a place where every family feels a sense of belonging.`
- Tagline (Dancing Script, burgundy): `Where every family belongs.`

**GSAP entrance:** Stagger `h2 → p → tagline` from `autoAlpha: 0, y: 40`, `expo.out`, `stagger: 0.12`, triggered by ScrollTrigger `start: 'top 80%'`.

---

### Section 5: Partnerships with Families
**Background:** `var(--color-cloud-grey)` · **Layout:** Image LEFT, text RIGHT
**Image:** `images/samples/cosmos_226684284.jpeg` — collaborative floor activity

**Copy:**
- Heading: `Partnerships with Families` (Montserrat 700, 36px)
- Body: `Learning works best when school and home walk together. We value strong relationships with families and believe open communication and partnership help every child flourish.`
- Tagline: `Together for every child.`

**GSAP entrance:** Same stagger pattern, ScrollTrigger.

---

### Section 6: Celebrating Together
**Background:** `var(--color-warm-cream)` · **Layout:** Image RIGHT, text LEFT
**Image:** `images/samples/cosmos_1074538081.jpeg` — group activity, celebration

**Copy:**
- Heading: `Celebrating Together`
- Body: `Community grows through shared moments. School events, celebrations and gatherings bring families together and strengthen the sense of connection across our community.`
- Tagline: `Every season, every story.`

---

### Section 7: Faith in Community
**Background:** `var(--color-cloud-grey)` · **Layout:** Image LEFT, text RIGHT
**Image:** `images/samples/cosmos_1263936189.jpeg`

**Copy:**
- Heading: `Faith in Community`
- Body: `Our faith brings us together. Masses, prayer and parish celebrations are important moments where our community gathers to reflect, celebrate and grow in faith.`
- Tagline: `Guided by Christ, shaped by community.`

---

### Section 8: Wave Divider (Navy — content → dark)
```html
<div class="sk-wave-divider sk-wave-divider--navy" id="sk-wave-divider-8" aria-hidden="true">
  <svg class="sk-wave-svg" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M 0 120 L 1440 120 L 1440 88 C 1080 76 360 22 0 14 Z" fill="#051E42"/>
  </svg>
</div>
```

---

### Section 9: The St Kevin's Spirit
**Background:** `#051E42` (deep navy) · **Class:** `sk-spirit`
**Layout:** Full-width, centred, no image

**Copy:**
- Eyebrow: `THE ST KEVIN'S SPIRIT`
- Heading: `The St Kevin's Spirit`
- Body: `Something special happens when people care for one another. The kindness, generosity and support shown within our community help create a place where children and families truly feel at home.`
- Script tagline: `A community that truly cares.`

**GSAP entrance:**
```js
gsap.from(['.sk-spirit__eyebrow', '.sk-spirit__heading', '.sk-spirit__body', '.sk-spirit__tagline'], {
  autoAlpha: 0, y: 40, duration: 1.1, ease: 'expo.out', stagger: 0.14,
  scrollTrigger: { trigger: '.sk-spirit', start: 'top 75%' }
});
```

---

### Section 10: Footer
Copy the entire footer block from `site/about.html` verbatim — HTML and CSS.

---

## Step 6 — JS (bottom of `<body>`)

Copy the full JS block from `site/about.html`. It includes:
- Lenis initialization: `new Lenis({ autoRaf: false })` with `raf` loop + `ScrollTrigger.update`
- `gsap.registerPlugin(ScrollTrigger)`
- WAVES morph config and ScrollTrigger for wave dividers
- Header scroll behaviour (transparent → scrolled, hide on down / show on up past 140px)
- Sidebar open/close (GSAP `expo.out` 0.78s open, `power4.inOut` 0.56s close, staggered nav items)
- Search panel (GSAP fade)
- Click-spark SVG burst on all clicks

Then **add after** the copied block:
- Hero entrance animations (window load event)
- All ScrollTrigger section entrances for sections 3–9

---

## Guardrails

- **Never use `#FBF9F7` or `#F4F6F8`** — the correct values are `#F6F3EE` (warm-cream) and `#F0EDE5` (cloud-grey). Always use CSS vars `var(--color-warm-cream)` and `var(--color-cloud-grey)`.
- **Never use `#FFFFFF` or `bg-white` as a section background** — use `var(--color-warm-cream)`.
- **Never use `#000000` for text** — use `var(--color-deep-navy)` `#051E42`.
- **Never invent copy** — use only text from `docs/CONTENT.md`.
- **Never add a top navigation bar** — hamburger + sidebar only.
- **Never use a fourth font** — only Montserrat, Inter, Dancing Script.
- **Always use `var(--color-*)` CSS vars** — never hardcode colour hex values in CSS rules (wave SVG fill attributes are the only exception).
- **Dancing Script is for taglines only** — not headings, not buttons, not body text.
- **Circular images must use** `border-radius: 50%` on the `<img>`, with `overflow: hidden` on the container, sized at 110–120% of its column.
- **Max content width:** 1200px centred with `margin: 0 auto`.
- **Reduced motion:** wrap all GSAP animations with `if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches)` or use GSAP's `autoAlpha` which degrades gracefully.
- **No debug panels, sliders, or dev tools** in the final output.
- **Keep all JS in one `<script>` block** at the bottom of `<body>`.
- Do not call `gsap.registerPlugin(ScrollTrigger)` more than once.
