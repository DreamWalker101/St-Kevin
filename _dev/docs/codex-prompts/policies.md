# Build Prompt — policies.html
# St Kevin's Primary School, Hampton Park

---

## Mission

Build `site/policies.html` — a complete, production-quality static HTML page for the Policies & Compliance section of St Kevin's Primary School. This is the simplest page on the site: 4 sections only. The file is currently empty. Build the entire page from scratch.

---

## Hard Constraints (never violate these)

- **No npm. No build step. No framework.** Static HTML only.
- **Tailwind CDN** via `<script src="https://cdn.tailwindcss.com">`
- **GSAP 3.14.2 + ScrollTrigger** for animations
- **Lenis 1.1.14** for smooth scroll
- **One file** — `site/policies.html`. CSS in `<style>`, JS in `<script>` at bottom
- **Google Fonts** via `<link>` in `<head>`: Montserrat (600,700,800), Inter (400,500), Dancing Script (400,700)
- **Semantic HTML** — `<section>`, `<header>`, `<footer>`, `<nav>`, `<main>`
- Output path: `site/policies.html`

---

## Step 1 — Read these files in order before writing a single line

1. **`site/about.html`** — PRIMARY reference. Copy its `<head>`, full `<style>` block, shared HTML (header, sidebar, search, footer), and full shared JS block verbatim.

2. **`site/css/sk-layout.css`** — already loaded via `<link>`. Do not duplicate.

3. **`docs/DESIGN_SYSTEM.md`** — Design tokens, CSS vars.

4. **`docs/CONTENT.md`** → section **"POLICIES — policies.html"** — all approved copy including the SafeSmart embed URL.

5. **`docs/PAGES.md`** → section **"PAGE 7: POLICIES"** — section breakdown (4 sections only).

---

## Step 2 — Head block

Copy `<head>` from `site/about.html`, change:
- `<title>` → `Policies & Compliance — St Kevin's Primary School, Hampton Park`

---

## Step 3 — CSS `<style>` block

Copy the full `<style>` block from `site/about.html`. Then **add** these rules:

### Hero — Navy background, no photo
```css
/* Override: policies hero uses solid navy, no image */
.sk-hero--policy {
  min-height: 40vh;
  background: var(--color-deep-navy);
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 120px 24px 80px;
  position: relative;
  overflow: hidden;
}
.sk-hero--policy .sk-hero-overlay { display: none; } /* no photo, no overlay needed */
.sk-policy-hero__inner { position: relative; z-index: 2; max-width: 720px; margin: 0 auto; }
.sk-policy-hero__eyebrow {
  font-family: var(--font-montserrat);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--color-burgundy-red);
  margin: 0 0 20px;
  display: block;
}
.sk-policy-hero__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(2.25rem, 5.5vw, 4rem);
  font-weight: 800;
  letter-spacing: -0.02em;
  line-height: 1.1;
  color: #fff;
  margin: 0 0 20px;
}
.sk-policy-hero__sub {
  font-family: var(--font-inter);
  font-size: clamp(0.9375rem, 1.5vw, 1.0625rem);
  line-height: 1.75;
  color: rgba(255,255,255,0.65);
  margin: 0;
  max-width: 520px;
  margin-left: auto;
  margin-right: auto;
}
/* Subtle background pattern — concentric rings decoration */
.sk-policy-hero__deco {
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  overflow: hidden;
}
```

### Intro section
```css
.sk-policy-intro {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-policy-intro__inner { max-width: 720px; margin: 0 auto; }
.sk-policy-intro__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  color: var(--color-deep-navy);
  margin: 0 0 20px;
}
.sk-policy-intro__body {
  font-family: var(--font-inter);
  font-size: clamp(1rem, 1.5vw, 1.125rem);
  line-height: 1.8;
  color: var(--color-deep-navy);
  opacity: 0.82;
  margin: 0;
}
@media (max-width: 768px) {
  .sk-policy-intro { padding: var(--section-padding-mobile) 24px; }
}
```

### SafeSmart embed section
```css
.sk-safesmart {
  background: var(--color-warm-cream);
  padding: 0 24px var(--section-padding-desktop);
}
.sk-safesmart__inner {
  max-width: var(--max-width);
  margin: 0 auto;
}
.sk-safesmart__frame {
  border-radius: var(--radius-cards);
  overflow: hidden;
  box-shadow: var(--shadow-soft);
  border: 1px solid var(--color-border-mist);
  min-height: 700px;
}
.sk-safesmart__frame iframe {
  width: 100%;
  min-height: 700px;
  border: 0;
  display: block;
}
@media (max-width: 768px) {
  .sk-safesmart { padding: 0 16px var(--section-padding-mobile); }
  .sk-safesmart__frame, .sk-safesmart__frame iframe { min-height: 500px; }
}
```

---

## Step 4 — Shared HTML components (copy from about.html verbatim)

Copy exactly: header, nav-backdrop, sidebar, search-panel.

**Active nav item:** Policies is NOT in the main sidebar nav (it's footer-only). Do not add `is-active` to any nav item. All items remain default state.

---

## Step 5 — Build sections in order

### Section 1: Hero
**Class:** `sk-hero--policy` (not `sk-hero--short` — this is a different variant)
**No background image.** Navy background only (`#051E42`).

**Decorative SVG background (subtle rings, aria-hidden):**
Two large concentric ring SVGs positioned top-right and bottom-left at low opacity (3–5%), white stroke, no fill. These add visual texture without photography. Example:
```html
<div class="sk-policy-hero__deco" aria-hidden="true">
  <!-- Top-right rings -->
  <svg style="position:absolute;top:-80px;right:-80px;opacity:0.04;" width="500" height="500" viewBox="0 0 500 500" fill="none">
    <circle cx="250" cy="250" r="200" stroke="white" stroke-width="1"/>
    <circle cx="250" cy="250" r="140" stroke="white" stroke-width="1"/>
    <circle cx="250" cy="250" r="80" stroke="white" stroke-width="1"/>
  </svg>
  <!-- Bottom-left rings -->
  <svg style="position:absolute;bottom:-60px;left:-60px;opacity:0.03;" width="360" height="360" viewBox="0 0 360 360" fill="none">
    <circle cx="180" cy="180" r="150" stroke="white" stroke-width="1"/>
    <circle cx="180" cy="180" r="100" stroke="white" stroke-width="1"/>
  </svg>
</div>
```

**Hero text (inside `sk-policy-hero__inner`):**
```
Eyebrow: GOVERNANCE
H1: School Policies
Sub: Our school policies and compliance frameworks are available below.
```

**MACS logo:** Include `.sk-hero-macs` bottom-left (`images/macs-logo-white.png`, 80px) positioned absolutely.

**GSAP entrance (window load):**
```js
gsap.from(['.sk-policy-hero__eyebrow', '.sk-policy-hero__heading', '.sk-policy-hero__sub'], {
  autoAlpha: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.14, delay: 0.2
});
```

---

### Section 2: Wave Divider (Burgundy — navy hero → warm cream content)
```html
<div class="sk-wave-divider sk-wave-divider--burg" id="sk-wave-divider-2" aria-hidden="true">
  <svg class="sk-wave-svg" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path id="sk-wave-path-2" d="M 0 0 L 1440 0 L 1440 14 C 1080 22 360 76 0 88 Z" fill="#8A2232"/>
  </svg>
</div>
```
Wire into WAVES array for on-scroll path morph (same pattern as index.html).

---

### Section 3: Intro
**Class:** `sk-policy-intro` · **Background:** `var(--color-warm-cream)`

**Heading:** `School Policies`

**Body:**
> St Kevin's Primary School operates within the policies and governance frameworks of Melbourne Archdiocese Catholic Schools (MACS). The policies that guide our work in areas such as child safety, wellbeing and governance can be accessed below.

**GSAP entrance:** heading and body fade up from `autoAlpha: 0, y: 32`, `expo.out`, ScrollTrigger `start: 'top 80%'`.

---

### Section 4: SafeSmart Embed
**Class:** `sk-safesmart` · **Background:** `var(--color-warm-cream)`

**Iframe embed URL (exact):**
```
https://safesmartsolutions.com.au/portal/St%20Kevin's%20Primary%20School%20-%20Hampton%20Park/882a137f3d/policy
```

```html
<section class="sk-safesmart" id="sk-safesmart" aria-label="School Policies Portal">
  <div class="sk-safesmart__inner">
    <div class="sk-safesmart__frame">
      <iframe
        src="https://safesmartsolutions.com.au/portal/St%20Kevin's%20Primary%20School%20-%20Hampton%20Park/882a137f3d/policy"
        title="St Kevin's School Policies — SafeSmart Portal"
        loading="lazy"
        allowfullscreen>
      </iframe>
    </div>
  </div>
</section>
```

---

### Section 5: Footer
Copy the entire footer block from `site/about.html` verbatim.

---

## Step 6 — JS (bottom of `<body>`)

Copy the full JS block from `site/about.html` (Lenis, ScrollTrigger, WAVES, header, sidebar, search, click-spark).

The WAVES array needs one entry:
```js
const WAVES = [
  {
    wrapperId: 'sk-wave-divider-2',
    pathId: 'sk-wave-path-2',
    dA: 'M 0 0 L 1440 0 L 1440 14 C 1080 22 360 76 0 88 Z',
    dB: 'M 0 0 L 1440 0 L 1440 6 C 1080 32 360 96 0 110 Z',
    start: 'top 95%',
    end: 'bottom 0%',
  }
];
```

Add:
- Hero entrance on window load
- ScrollTrigger entrance for Section 3 (intro)
- SafeSmart iframe can be loaded statically (no animation needed, just appears)

---

## Guardrails

- **Never use `#FBF9F7` or `#F4F6F8`** — use `var(--color-warm-cream)` and `var(--color-cloud-grey)`.
- **Never use `#FFFFFF` as a section background** — use `var(--color-warm-cream)`.
- **SafeSmart URL must be exact** — `https://safesmartsolutions.com.au/portal/St%20Kevin's%20Primary%20School%20-%20Hampton%20Park/882a137f3d/policy`
- **No top nav bar** — hamburger sidebar only.
- **Policies is NOT in the sidebar nav** — it is footer-only. Do not add `is-active` to any nav item.
- **Dancing Script for taglines only** — not used on this page (policies page is institutional, no script taglines needed).
- **Max content width:** 1200px centred.
- **No debug panels** in output.
- **One `<script>` block** at bottom of `<body>`.
- **Do not call `gsap.registerPlugin(ScrollTrigger)` more than once.**
- **Reduced motion:** guard GSAP entrance animations with `prefers-reduced-motion` check or rely on GSAP's `autoAlpha`.
