# Build Prompt — contact.html
# St Kevin's Primary School, Hampton Park

---

## Mission

Build `site/contact.html` — a complete, production-quality, fully animated static HTML page for the Contact Us section of St Kevin's Primary School. The file is currently empty. Build the entire page from scratch.

---

## Hard Constraints (never violate these)

- **No npm. No build step. No framework.** Static HTML only.
- **Tailwind CDN** via `<script src="https://cdn.tailwindcss.com">` — utility classes only
- **GSAP 3.14.2 + ScrollTrigger** for all animations
- **Lenis 1.1.14** for smooth scroll, connected to ScrollTrigger
- **One file** — `site/contact.html`. CSS in `<style>`, JS in `<script>` at bottom
- **Google Fonts** via `<link>` in `<head>`: Montserrat (600,700,800), Inter (400,500), Dancing Script (400,700)
- **Semantic HTML** — `<section>`, `<header>`, `<footer>`, `<nav>`, `<address>`
- **Mobile-first** — single column at ≤768px
- Output path: `site/contact.html`

---

## Step 1 — Read these files in order before writing a single line

1. **`site/about.html`** — PRIMARY reference. Copy its `<head>`, full `<style>` block, shared HTML (header, sidebar, search, footer), and shared JS block verbatim.

2. **`site/css/sk-layout.css`** — already loaded via `<link>`. Do not duplicate.

3. **`docs/DESIGN_SYSTEM.md`** — CSS vars, component specs, button styles, surface colours.

4. **`docs/CONTENT.md`** → section **"CONTACT US — contact.html"** — all approved copy and contact details.

5. **`docs/PAGES.md`** → section **"PAGE 6: CONTACT US"** — section layout specs.

---

## Step 2 — Head block

Copy `<head>` from `site/about.html`, change:
- `<title>` → `Contact Us — St Kevin's Primary School, Hampton Park`

---

## Step 3 — CSS `<style>` block

Copy the full `<style>` block from `site/about.html`. Then **add** these rules:

### Intro
```css
.sk-contact-intro {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-contact-intro__inner { max-width: 680px; margin: 0 auto; }
.sk-contact-intro__body {
  font-family: var(--font-inter);
  font-size: clamp(1.0625rem, 2vw, 1.25rem);
  line-height: 1.8;
  color: var(--color-deep-navy);
  opacity: 0.85;
}
@media (max-width: 768px) {
  .sk-contact-intro { padding: var(--section-padding-mobile) 24px; }
}
```

### Get in Touch — Split layout (details + map)
```css
.sk-get-in-touch {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
}
.sk-get-in-touch__grid {
  max-width: var(--max-width);
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 64px;
  align-items: start;
}
.sk-get-in-touch__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.75rem, 3.5vw, 2.75rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  line-height: 1.15;
  color: var(--color-deep-navy);
  margin: 0 0 36px;
}
.sk-contact-detail {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;
}
.sk-contact-detail__icon {
  width: 44px; height: 44px;
  border-radius: 10px;
  background: var(--color-cloud-grey);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.sk-contact-detail__icon svg { display: block; }
.sk-contact-detail__label {
  font-family: var(--font-montserrat);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--color-slate-text);
  margin: 0 0 4px;
  display: block;
}
.sk-contact-detail__value {
  font-family: var(--font-inter);
  font-size: 16px;
  line-height: 1.6;
  color: var(--color-deep-navy);
  margin: 0;
  text-decoration: none;
}
a.sk-contact-detail__value:hover { color: var(--color-burgundy-red); }
.sk-map-frame {
  border-radius: var(--radius-cards);
  overflow: hidden;
  box-shadow: var(--shadow-soft);
  height: 400px;
}
.sk-map-frame iframe {
  width: 100%; height: 100%;
  border: 0; display: block;
}
@media (max-width: 900px) {
  .sk-get-in-touch__grid { grid-template-columns: 1fr; gap: 40px; }
  .sk-get-in-touch { padding: var(--section-padding-mobile) 24px; }
  .sk-map-frame { height: 280px; }
}
```

### Office Hours
```css
.sk-office-hours {
  background: var(--color-cloud-grey);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-office-hours__inner { max-width: 520px; margin: 0 auto; }
.sk-office-hours__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.25rem, 2.5vw, 1.75rem);
  font-weight: 700;
  letter-spacing: -0.01em;
  color: var(--color-deep-navy);
  margin: 0 0 16px;
}
.sk-office-hours__time {
  font-family: var(--font-inter);
  font-size: clamp(1rem, 1.5vw, 1.125rem);
  line-height: 1.7;
  color: var(--color-deep-navy);
  opacity: 0.82;
  margin: 0;
}
@media (max-width: 768px) {
  .sk-office-hours { padding: var(--section-padding-mobile) 24px; }
}
```

### Send a Message + Visit CTA sections
```css
.sk-contact-cta {
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-contact-cta--cream { background: var(--color-warm-cream); }
.sk-contact-cta--white { background: var(--color-warm-cream); }
.sk-contact-cta__inner { max-width: 640px; margin: 0 auto; }
.sk-contact-cta__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.5rem, 3vw, 2.25rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  color: var(--color-deep-navy);
  margin: 0 0 20px;
}
.sk-contact-cta__body {
  font-family: var(--font-inter);
  font-size: 16px;
  line-height: 1.75;
  color: var(--color-deep-navy);
  opacity: 0.82;
  margin: 0 0 36px;
}
@media (max-width: 768px) {
  .sk-contact-cta { padding: var(--section-padding-mobile) 24px; }
}
```

### Stay Connected — social strip
```css
.sk-stay-connected {
  background: var(--color-warm-cream);
  padding: var(--section-padding-desktop) 24px;
  text-align: center;
}
.sk-stay-connected__inner { max-width: 560px; margin: 0 auto; }
.sk-stay-connected__heading {
  font-family: var(--font-montserrat);
  font-size: clamp(1.25rem, 2.5vw, 1.75rem);
  font-weight: 700;
  letter-spacing: -0.01em;
  color: var(--color-deep-navy);
  margin: 0 0 12px;
}
.sk-stay-connected__body {
  font-family: var(--font-inter);
  font-size: 15px;
  line-height: 1.7;
  color: var(--color-deep-navy);
  opacity: 0.78;
  margin: 0 0 36px;
}
.sk-social-strip {
  display: flex;
  justify-content: center;
  gap: 16px;
}
.sk-social-chip {
  display: inline-flex; align-items: center; gap: 10px;
  padding: 12px 22px;
  border-radius: 999px;
  background: var(--color-cloud-grey);
  border: 1px solid var(--color-border-mist);
  text-decoration: none;
  font-family: var(--font-montserrat);
  font-size: 13px;
  font-weight: 600;
  color: var(--color-deep-navy);
  transition: background var(--transition-fast), border-color var(--transition-fast);
}
.sk-social-chip:hover { background: var(--color-deep-navy); color: #fff; border-color: var(--color-deep-navy); }
.sk-social-chip svg { flex-shrink: 0; }
@media (max-width: 768px) {
  .sk-stay-connected { padding: var(--section-padding-mobile) 24px; }
  .sk-social-strip { flex-direction: column; align-items: center; }
}
```

### Shared buttons
```css
.sk-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 14px 28px; border-radius: var(--radius-buttons);
  font-family: var(--font-montserrat); font-weight: 600; font-size: 15px;
  letter-spacing: 0.02em; text-decoration: none; border: none; cursor: pointer;
  transition: background var(--transition-fast), color var(--transition-fast);
}
.sk-btn--primary { background: var(--color-deep-navy); color: #fff; }
.sk-btn--primary:hover { background: var(--color-navy-tint); }
.sk-btn--accent { background: var(--color-burgundy-red); color: #fff; }
.sk-btn--accent:hover { filter: brightness(1.08); }
```

---

## Step 4 — Shared HTML components (copy from about.html verbatim)

Copy exactly: header, nav-backdrop, sidebar, search-panel.

**Active nav item:** `is-active` + `aria-current="page"` on the **Contact** link in sidebar.

---

## Step 5 — Build sections in order

### Section 1: Hero
**Class:** `sk-hero sk-hero--short` (60vh)
**Image:** `images/samples/cosmos_547543300.jpeg` — playground, welcoming, outdoor
**Overlay:** `rgba(5,30,66,0.60)`

**Text overlay (centred):**
```
Eyebrow: CONTACT US (Montserrat 700, 11px, 0.18em, burgundy-red, uppercase)
H1: We'd Love to Hear From You (Montserrat 800, clamp(2.5rem,6vw,5rem), white)
```
**MACS logo:** bottom-left, `images/macs-logo-white.png`
**GSAP hero entrance:** eyebrow `y: -16 → 0`, h1 `y: 28 → 0`, staggered, `expo.out`.

---

### Section 2: Wave Divider (Burgundy)
```html
<div class="sk-wave-divider sk-wave-divider--burg" id="sk-wave-divider-2" aria-hidden="true">
  <svg class="sk-wave-svg" viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path id="sk-wave-path-2" d="M 0 0 L 1440 0 L 1440 14 C 1080 22 360 76 0 88 Z" fill="#8A2232"/>
  </svg>
</div>
```
Wire into WAVES array for on-scroll path morph.

---

### Section 3: Intro
**Class:** `sk-contact-intro` · **Background:** `var(--color-warm-cream)`

**Copy:**
> We would love to hear from you. Whether you have a question, would like to visit the school, or simply want to learn more about St Kevin's, our team is here to help.

---

### Section 4: Get in Touch
**Class:** `sk-get-in-touch` · **Background:** `var(--color-warm-cream)`
**Layout:** Left column = contact details, Right column = Google Maps embed

**Left column heading:** `Get in Touch`

**Contact details (three rows using `.sk-contact-detail` pattern):**

1. **Phone** — icon: phone SVG — value: `(03) 9709 8600` (tel link)
2. **Email** — icon: envelope SVG — value: `administration@skhamptonpark.catholic.edu.au` (mailto link)
3. **Address** — icon: location-pin SVG — value: `120 Hallam Rd, Hampton Park VIC 3976`

Use clean inline SVG icons (16–20px, stroke `var(--color-deep-navy)`, stroke-width 1.5). No external icon library.

**Right column — Google Maps iframe:**
```html
<div class="sk-map-frame">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143....!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTIwIEhhbGxhbSBSZCwgSGFtcHRvbiBQYXJrIFZJQyAzOTc2!5e0!3m2!1sen!2sau!4v0"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    title="St Kevin's Primary School location"
    aria-label="Google Maps showing St Kevin's Primary School at 120 Hallam Rd, Hampton Park VIC 3976">
  </iframe>
</div>
```
Note: Use a real Google Maps embed URL for "120 Hallam Rd, Hampton Park VIC 3976". Search Google Maps for this address and use the embed share link.

**GSAP:** Fade up left column, then map frame, `expo.out`, stagger 0.2s.

---

### Section 5: School Office Hours
**Class:** `sk-office-hours` · **Background:** `var(--color-cloud-grey)`

**Heading:** `School Office Hours`
**Time:** `Monday to Friday: 8:00am – 4:00pm`

---

### Section 6: Send Us a Message
**Class:** `sk-contact-cta sk-contact-cta--white` · **Background:** `var(--color-warm-cream)`

**Heading:** `Send Us a Message`
**Body:** `If you have a question or would like more information, you are welcome to contact us using the enquiry form.`
**Button:** `General Enquiry Form` → `sk-btn sk-btn--primary` (href="#" placeholder)

---

### Section 7: Visit Our School
**Class:** `sk-contact-cta sk-contact-cta--cream` · **Background:** `var(--color-warm-cream)` with a subtle top border `1px solid var(--color-border-mist)`

**Heading:** `Visit Our School`
**Body:** `We always welcome families who would like to see St Kevin's in action. School tours run throughout the year and provide the opportunity to explore our learning spaces and meet members of our community.`
**Button:** `Book a School Tour` → `sk-btn sk-btn--accent`

---

### Section 8: Stay Connected
**Class:** `sk-stay-connected` · **Background:** `var(--color-warm-cream)`

**Heading:** `Stay Connected`
**Body:** `Follow along with life at St Kevin's through our school communications and social media.`

**Social chips (flex row, centred):**
1. Facebook chip — inline Facebook SVG icon (20px) + label `Facebook`
2. Schoolzine chip — inline letter/newsletter SVG icon + label `School Newsletter`

Both `href="#"` placeholder.

**GSAP:** Fade up heading + body, then chips stagger in.

---

### Section 9: Footer
Copy footer block from `site/about.html` verbatim.

---

## Step 6 — JS (bottom of `<body>`)

Copy the full JS block from `site/about.html` (Lenis, ScrollTrigger, WAVES, header, sidebar, search, click-spark).

Add:
- Hero entrance on window load
- ScrollTrigger entrances for all sections 3–8

---

## Guardrails

- **Never use `#FBF9F7` or `#F4F6F8`** — correct: `#F6F3EE` / `#F0EDE5`. Always use CSS vars.
- **Never use `#FFFFFF` as a section background** — use `var(--color-warm-cream)`.
- **Never invent copy** — use only text from `docs/CONTENT.md`.
- **Contact details are exact** — phone: `(03) 9709 8600`, email: `administration@skhamptonpark.catholic.edu.au`, address: `120 Hallam Rd, Hampton Park VIC 3976`.
- **No top nav bar** — hamburger sidebar only.
- **Dancing Script for taglines only.**
- **No icon library CDN** — use inline SVG for all icons.
- **Max content width:** 1200px centred.
- **No debug panels** in output.
- **One `<script>` block** at bottom of `<body>`.
- **Do not call `gsap.registerPlugin(ScrollTrigger)` more than once.**
- **Reduced motion:** guard GSAP entrance animations with `prefers-reduced-motion` check or rely on GSAP's `autoAlpha` graceful degradation.
