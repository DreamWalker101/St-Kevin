# Build Prompt — enrolments.html
# St Kevin's Primary School, Hampton Park

---

## Mission

Build `site/enrolments.html` — a complete, production-quality, fully animated static HTML page for the Enrolments section of St Kevin's Primary School. The file is currently empty. Build the entire page from scratch.

---

## Hard Constraints (never violate these)

- **No npm. No build step. No framework.** Static HTML only.
- **Tailwind CDN** via `<script src="https://cdn.tailwindcss.com">` — utility classes only
- **GSAP 3.14.2 + ScrollTrigger** for all animations. Never use CSS `@keyframes` for primary entrance motion.
- **Lenis 1.1.14** for smooth scroll, connected to ScrollTrigger
- **One file** — `site/enrolments.html`. All CSS in `<style>`, all JS in `<script>` at bottom of `<body>`
- **Google Fonts** via `<link>` in `<head>`: Montserrat (600,700,800), Inter (400,500), Dancing Script (400,700)
- **Semantic HTML** — `<section>`, `<header>`, `<footer>`, `<nav>`, `<figure>`, `<ol>`
- **Mobile-first** — single column at ≤768px, 48px vertical section padding on mobile
- Output path: `site/enrolments.html`

---

## Step 1 — Read these files in order before writing a single line

1. **`site/about.html`** — PRIMARY reference. Copy its `<head>`, `<style>` block, shared HTML (header, sidebar, search, footer), and shared JS (Lenis, GSAP, header scroll, sidebar, search, click-spark) verbatim. Do not reinvent any shared component.

2. **`site/css/sk-layout.css`** — already loaded via `<link>`. Do not duplicate its rules.

3. **`site/index.html`** — Read the Enrolments CTA section (Section 13) for the split-layout image + text pattern. Read the pillar sections (Sections 5–8) for the circular image pattern used in Section 6 of this page.

4. **`docs/DESIGN_SYSTEM.md`** — Design tokens, CSS vars, component specs, button styles.

5. **`docs/CONTENT.md`** → section **"ENROLMENTS — enrolments.html"** — all approved copy.

6. **`docs/PAGES.md`** → section **"PAGE 5: ENROLMENTS"** — section order and layout specs.

---

## Step 2 — Head block

Copy the entire `<head>` block from `site/about.html`, then change:
- `<title>` → `Enrolments — St Kevin's Primary School, Hampton Park`
- Keep all CDN links, Google Fonts, Tailwind config, sk-layout.css link identical

---

## Step 3 — CSS `<style>` block

Copy the entire `<style>` block from `site/about.html`. Then **add** these rules:

### Intro section
```css
.sk-enrol-intro {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-enrol-intro__inner { max-width: 720px; margin: 0 auto; }
.sk-enrol-intro__body {
  font-family: var(--font-inter);
  font-size: clamp(1.0625rem, 2vw, 1.25rem);
  line-height: 1.8;
  color: var(--color-deep-navy);
  opacity: 0.85;
  margin: 0 0 64px;
}
@media (max-width: 768px) {
  .sk-enrol-intro { padding: var(--section-padding-mobile) 24px; }
}
```

### Pathway steps (Visit → Enquire → Enrol → Begin)
```css
.sk-pathway {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0;
  flex-wrap: wrap;
  row-gap: 24px;
  max-width: 760px;
  margin: 0 auto;
}
.sk-pathway__step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  flex: 1;
  min-width: 120px;
}
.sk-pathway__num {
  width: 52px; height: 52px;
  border-radius: 50%;
  background: var(--color-deep-navy);
  color: #fff;
  font-family: var(--font-montserrat);
  font-weight: 700;
  font-size: 18px;
  display: flex; align-items: center; justify-content: center;
}
.sk-pathway__label {
  font-family: var(--font-montserrat);
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.04em;
  color: var(--color-deep-navy);
  text-transform: uppercase;
  text-align: center;
}
.sk-pathway__arrow {
  color: var(--color-burgundy-red);
  font-size: 22px;
  padding: 0 4px;
  margin-top: -24px;
  flex-shrink: 0;
}
@media (max-width: 600px) {
  .sk-pathway { flex-direction: column; align-items: center; }
  .sk-pathway__arrow { transform: rotate(90deg); margin: 0; }
}
```

### Content cards (Visit Us / Start the Conversation / Enrolment Process)
```css
.sk-enrol-step {
  padding: var(--section-padding-desktop) 24px;
}
.sk-enrol-step--grey { background: var(--color-cloud-grey); }
.sk-enrol-step--cream { background: var(--color-warm-cream); }
.sk-enrol-step__card {
  max-width: 760px;
  margin: 0 auto;
  background: #fff;
  border: 1px solid var(--color-border-mist);
  border-radius: var(--radius-cards);
  padding: 48px;
  box-shadow: var(--shadow-soft);
}
.sk-enrol-step__label {
  font-family: var(--font-montserrat);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--color-burgundy-red);
  margin: 0 0 16px;
}
.sk-enrol-step__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  line-height: 1.15;
  color: var(--color-deep-navy);
  margin: 0 0 20px;
}
.sk-enrol-step__body {
  font-family: var(--font-inter);
  font-size: 16px;
  line-height: 1.75;
  color: var(--color-deep-navy);
  opacity: 0.82;
  margin: 0 0 12px;
}
.sk-enrol-step__dates {
  font-family: var(--font-inter);
  font-size: 14px;
  line-height: 1.7;
  color: var(--color-slate-text);
  margin: 0 0 32px;
}
.sk-enrol-step__actions {
  display: flex; gap: 16px; flex-wrap: wrap;
}
@media (max-width: 768px) {
  .sk-enrol-step { padding: var(--section-padding-mobile) 24px; }
  .sk-enrol-step__card { padding: 32px 24px; }
}
```

### Buttons — follow DESIGN_SYSTEM.md specs
```css
.sk-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 14px 28px;
  border-radius: var(--radius-buttons);
  font-family: var(--font-montserrat);
  font-weight: 600;
  font-size: 15px;
  letter-spacing: 0.02em;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: background var(--transition-fast), color var(--transition-fast);
}
.sk-btn--primary {
  background: var(--color-deep-navy);
  color: #fff;
}
.sk-btn--primary:hover { background: var(--color-navy-tint); }
.sk-btn--accent {
  background: var(--color-burgundy-red);
  color: #fff;
}
.sk-btn--accent:hover { filter: brightness(1.08); }
.sk-btn--outline {
  background: transparent;
  color: var(--color-deep-navy);
  border: 2px solid var(--color-deep-navy);
}
.sk-btn--outline:hover { background: var(--color-deep-navy); color: #fff; }
```

### Transition to School section (circular image + text)
Copy `.sk-pillar` CSS from `site/index.html` — same pattern as the homepage alternating sections.

### Closing CTA section — Every Child Known
```css
.sk-enrol-closing {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-enrol-closing__inner { max-width: 680px; margin: 0 auto; }
.sk-enrol-closing__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(2rem, 4.5vw, 3.25rem);
  font-weight: 800;
  letter-spacing: -0.02em;
  line-height: 1.1;
  color: var(--color-deep-navy);
  margin: 0 0 24px;
}
.sk-enrol-closing__body {
  font-family: var(--font-inter);
  font-size: clamp(1rem, 1.6vw, 1.125rem);
  line-height: 1.8;
  color: var(--color-deep-navy);
  opacity: 0.82;
  margin: 0 0 40px;
}
.sk-enrol-closing__tagline {
  font-family: var(--font-dancing-script);
  font-size: clamp(1.5rem, 3vw, 2rem);
  color: var(--color-burgundy-red);
  font-style: italic;
  margin: 32px 0 0;
  display: block;
}
@media (max-width: 768px) {
  .sk-enrol-closing { padding: var(--section-padding-mobile) 24px; }
}
```

---

## Step 4 — Shared HTML components (copy from about.html verbatim)

Copy these blocks exactly, changing only the active nav item:
1. `<header class="sk-header ...">` — full header
2. `<div class="sk-nav-backdrop ...">` — backdrop
3. `<nav class="sk-nav-sidebar ...">` — full sidebar with all nav items
4. `<div class="sk-search-panel ...">` — search panel

**Active nav item:** Add `is-active` class and `aria-current="page"` to **Enrolments** link in the sidebar.

---

## Step 5 — Build sections in order

### Section 1: Hero
**Class:** `sk-hero sk-hero--short` (60vh minimum)
**Image:** `images/samples/cosmos_1616537391.jpeg` — warm, school portrait
**Overlay opacity:** `0.60` via CSS var `--hero-overlay-opacity`

**Text overlay (centred, lower third of hero):**
```
Eyebrow: ENROLMENTS (Montserrat 700, 11px, 0.18em letter-spacing, burgundy-red, uppercase)
H1: Join Our Community (Montserrat 800, clamp(3rem,7vw,5.5rem), white)
```

**MACS logo:** bottom-left, `images/macs-logo-white.png`

**GSAP hero entrance (window load):**
Stagger eyebrow → h1 from `autoAlpha: 0`, eyebrow from `y: -16`, h1 from `y: 28`, `expo.out`.

---

### Section 2: Wave Divider (Burgundy)
```html
<div class="sk-wave-divider sk-wave-divider--burg" id="sk-wave-divider-2" aria-hidden="true">
  <svg class="sk-wave-svg" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path id="sk-wave-path-2" d="M 0 0 L 1440 0 L 1440 14 C 1080 22 360 76 0 88 Z" fill="#8A2232"/>
  </svg>
</div>
```
Wire into WAVES morph array for on-scroll path animation (same pattern as index.html).

---

### Section 3: Intro + Pathway
**Background:** `var(--color-warm-cream)` · **Class:** `sk-enrol-intro`

**Body copy:**
> Choosing a school is an important decision for every family. We would love to welcome you to St Kevin's and help you discover what makes our community special.

**Pathway visual** (below body, centred, 4 steps):
```
① VISIT → ② ENQUIRE → ③ ENROL → ④ BEGIN
```
Each step: circular navy number badge + uppercase label below. Arrows between steps in burgundy.

**GSAP:** Fade up the body paragraph, then stagger pathway steps with `stagger: 0.1`.

---

### Section 4: Visit Us
**Background:** `var(--color-cloud-grey)` · **Class:** `sk-enrol-step sk-enrol-step--grey`

**Card content:**
- Label: `Step 1`
- Heading: `Visit Us`
- Body: `The best way to experience St Kevin's is to visit. Throughout the year we offer school tours and open days where families can see learning in action and explore our school.`
- Dates (smaller text, slate-text):
  - `Open Days — March 18, April 1, April 29, May 13`
  - `School Tours — Most Wednesdays at 9:30am`
- Button: `Book a School Tour` → accent button (`sk-btn sk-btn--accent`)

**GSAP:** Card slides up from `y: 50, autoAlpha: 0`, `expo.out`, ScrollTrigger `start: 'top 80%'`.

---

### Section 5: Start the Conversation
**Background:** `var(--color-warm-cream)` · **Class:** `sk-enrol-step sk-enrol-step--cream`

**Card content:**
- Label: `Step 2`
- Heading: `Start the Conversation`
- Body: `If you would like to learn more about St Kevin's, we invite you to get in touch. Our team is always happy to answer questions and provide further information about our school.`
- Buttons (side by side, flex-wrap):
  - `Enrolment Enquiry` → primary button (`sk-btn sk-btn--primary`)
  - `Request a Prospectus` → outline button (`sk-btn sk-btn--outline`)

---

### Section 6: The Enrolment Process
**Background:** `var(--color-cloud-grey)` · **Class:** `sk-enrol-step sk-enrol-step--grey`

**Card content:**
- Label: `Step 3`
- Heading: `The Enrolment Process`
- Body: `When you are ready to apply, you can complete our enrolment form online. Once submitted, our office team will guide you through the next steps of the enrolment process.`
- Button: `Begin Enrolment Application` → accent button

---

### Section 7: Transition to School
**Background:** `var(--color-warm-cream)` · **Layout:** Image RIGHT, text LEFT
**Image:** `images/samples/cosmos_226684284.jpeg` — children, collaborative floor activity
**Use `.sk-pillar` CSS pattern (oversized circular image)**

**Copy:**
- Heading: `Transition to School` (Montserrat 700)
- Body: `Starting school is an exciting milestone for every child. Our transition program, which runs across three mornings over three weeks in November, helps children become familiar with the school, meet their teachers and begin forming friendships before their first day.`
- Tagline (Dancing Script, burgundy): `A warm welcome before day one.`

---

### Section 8: Every Child Known (Closing CTA)
**Background:** `var(--color-warm-cream)` · **Class:** `sk-enrol-closing`
**Layout:** Full-width centred

**Copy:**
- Heading: `Every Child Known`
- Body: `At St Kevin's every child is known, supported and encouraged to flourish. We look forward to welcoming new families into our community.`
- Primary button: `Book a School Tour`
- Script tagline: `Come and discover St Kevin's.`

**GSAP entrance:** Stagger heading → body → button → tagline, `expo.out`, `stagger: 0.14`.

---

### Section 9: Footer
Copy the entire footer block from `site/about.html` verbatim.

---

## Step 6 — JS (bottom of `<body>`)

Copy the full JS block from `site/about.html` (Lenis, ScrollTrigger, WAVES, header, sidebar, search, click-spark).

Then add:
- Hero entrance (window load): eyebrow and h1 stagger
- ScrollTrigger entrances for sections 3–8
- Pathway step stagger animation

---

## Guardrails

- **Never use `#FBF9F7` or `#F4F6F8`** — correct values: `#F6F3EE` (warm-cream), `#F0EDE5` (cloud-grey). Use CSS vars.
- **Never use `#FFFFFF` as a section background** — only as a card interior background.
- **Never use `#000000` for text** — use `var(--color-deep-navy)`.
- **Never invent copy** — use only text from `docs/CONTENT.md`.
- **Button `href="#"`** — placeholder until real form URLs are provided. That's fine for now.
- **No top nav bar** — hamburger + sidebar only.
- **One accent button per section maximum** — the most important CTA only.
- **Dancing Script for taglines only** — not headings, not buttons.
- **Circular images:** `border-radius: 50%`, `overflow: hidden` on container, 110–120% column width.
- **Max content width:** 1200px centred.
- **No debug panels or dev tools** in the output.
- **One `<script>` block** at the bottom of `<body>`.
- **Do not call `gsap.registerPlugin(ScrollTrigger)` more than once.**
