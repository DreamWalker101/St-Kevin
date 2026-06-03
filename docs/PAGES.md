# St Kevin's Hampton Park — Pages Reference

> Section-by-section breakdown for every page. Each section maps to a component from `DESIGN_SYSTEM.md`.
> Build pages in the order listed. Copy for every section is in `CONTENT.md`.

---

## PAGE 1: HOMEPAGE — index.html
**Priority:** Build first — establishes all reusable patterns

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section | Full-bleed 100vw × 80vh min | Image + gradient overlay | No text on hero. Logos + hamburger only. |
| 2 | Wave divider | Wave Divider (Burgundy) | Full-width SVG | #8A2232 → #FFFFFF | Transitions hero into welcome block |
| 3 | Quotes Carousel | Custom | Centred, single quote visible | Pure White | Large text, Dancing Script, 6-second auto-cycle |
| 4 | Welcome Block | Custom | Centred text, full-width image below | Pure White | "WELCOME TO ST KEVIN'S" display heading + script tagline |
| 5 | Belonging | Oversized Circular Image + text | Image RIGHT, text left | Pure White | First alternating section |
| 6 | Learning with Purpose | Oversized Circular Image + text | Text left, image RIGHT | Pure White | Alternates from Belonging |
| 7 | Faith in Action | Oversized Circular Image + text | Image LEFT, text right | Pure White | Alternates |
| 8 | Growing Together | Oversized Circular Image + text | Text left, image RIGHT | Pure White | Alternates |
| 9 | Wave divider | Wave Divider (Navy) | Full-width SVG | #FFFFFF → #051E42 | Transitions into dark section |
| 10 | The St Kevin's Effect | Dark Feature Section + Testimonial Cards | Centred heading, 3-col cards | Deep Navy #051E42 | Carousel with left/right arrows |
| 11 | Wave divider | Wave Divider (Navy) | Full-width SVG | #051E42 → #FFFFFF | Transitions out of dark section |
| 12 | Video Grid | Video Thumbnail Cards | 2×2 grid | Pure White | Navy thumbnails with play buttons |
| 13 | Enrolments CTA | Enrolment CTA Section | Text left (60%), image right (40%) | Dark overlay on image | Accent button: "BOOK A TOUR" |
| 14 | Footer | Footer | 3-column inside navy | Deep Navy #051E42 | Dual logos, contact, quick links |

### Alternating Section Pattern (sections 5–8)
```
Section 5 (Belonging):     [TEXT ←――――――→ ●IMAGE●]
Section 6 (Learning):      [●IMAGE● ←――――――→ TEXT]
Section 7 (Faith):         [TEXT ←――――――→ ●IMAGE●]
Section 8 (Community):     [●IMAGE● ←――――――→ TEXT]
```
Each circular image is 110–120% of its column width. Parent has `overflow: hidden`. Alternation is left/right per section.

### Homepage Content Model (content.json)
```json
{
  "homepage": {
    "quotes": [
      { "text": "...", "author": "..." }
    ],
    "welcome": {
      "heading": "...",
      "tagline": "..."
    },
    "belonging": {
      "heading": "...",
      "body": "...",
      "tagline": "...",
      "image": "images/..."
    },
    "learning": { ... },
    "faith": { ... },
    "community": { ... },
    "effect": {
      "heading": "...",
      "body": "...",
      "testimonials": [
        { "text": "...", "author": "...", "image": "images/..." }
      ]
    },
    "enrol": {
      "heading": "...",
      "body": "...",
      "tagline": "...",
      "buttonLabel": "...",
      "buttonLink": "..."
    }
  }
}
```

---

## PAGE 2: ABOUT US — about.html
**Priority:** Build second — introduces team grid and dark section patterns

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section | Full-bleed, shorter (60vh) | Image + gradient overlay | No text on hero |
| 2 | Wave divider | Wave Divider (Burgundy) | Full-width SVG | #8A2232 → #FFFFFF | |
| 3 | About St Kevin's Intro | Custom | Centred text block | Pure White | "ABOUT ST KEVIN'S" display heading + body paragraph |
| 4 | Our Story | Custom | Centred, script heading | Warm Cream #FBF9F7 | Dancing Script heading, Inter body |
| 5 | Our Mission | Custom | Centred, script heading | Warm Cream #FBF9F7 | Same pattern as Our Story |
| 6 | Our Vision | Custom | Centred, script heading | Warm Cream #FBF9F7 | Same pattern |
| 7 | Our Principal | Custom | Video thumbnail + text below | Pure White | Play button on video, italic sign-off |
| 8 | Wave divider | Wave Divider (Navy) | Full-width SVG | #FFFFFF → #051E42 | |
| 9 | Our People Intro | Dark Feature Section | Centred heading + body | Deep Navy #051E42 | "OUR PEOPLE" display heading |
| 10 | Foundation Team | Circular Image + text | Image right, text left | Deep Navy #051E42 | White text. Script caption below. |
| 11 | Junior Team | Circular Image + text | Image left, text right | Deep Navy #051E42 | Alternates within dark section |
| 12 | Middle Team | Circular Image + text | Image right, text left | Deep Navy #051E42 | Alternates |
| 13 | Senior Team | Circular Image + text | Image left, text right | Deep Navy #051E42 | Alternates |
| 14 | Wave divider | Wave Divider (Navy) | Full-width SVG | #051E42 → #FFFFFF | Transitions out to light |
| 15 | Specialist Teachers | Circular Image + text | Image left, text right | Pure White | Back to light background |
| 16 | Support Staff | Circular Image + text | Image right, text left | Pure White | Alternates |
| 17 | Our Parish Connection | Split layout | Image left, text right | Warm Cream #FBF9F7 | Church interior photo |
| 18 | Footer | Footer | Same as homepage | Deep Navy #051E42 | |

### Our People — Team Block Pattern
Each team block contains:
1. Team photo (circular, oversized)
2. Team name heading (Montserrat 700, white on dark / navy on light)
3. Description paragraph (Inter 400)
4. "Things you might hear them say:" — 3 italic quotes
5. Script caption (Dancing Script, burgundy on light / white on dark)

---

## PAGE 3: LEARNING WITH PURPOSE — learning.html

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section | Full-bleed with text overlay | Image/video + overlay | "Learning with Purpose" heading overlay |
| 2 | Intro body | Custom | Centred text | Pure White | Body paragraph below hero |
| 3 | Faith and Formation | Oversized Circular Image + text | Image left, text right | Pure White | Bold heading as lead sentence |
| 4 | Belonging and Wellbeing | Oversized Circular Image + text | Text left, image right | Cloud Grey #F4F6F8 | Alternating bg for variety |
| 5 | Teaching that Inspires | Oversized Circular Image + text | Image left, text right | Pure White | |
| 6 | Learning for Every Child | Oversized Circular Image + text | Text left, image right | Cloud Grey #F4F6F8 | |
| 7 | Learning Beyond the Classroom | Oversized Circular Image + text | Image left, text right | Pure White | |
| 8 | Footer | Footer | Same as all pages | Deep Navy #051E42 | |

---

## PAGE 4: COMMUNITY — community.html

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section | Full-bleed | Image + overlay | Community-themed hero |
| 2 | Intro | Custom | Centred text | Pure White | Short intro paragraph |
| 3 | A Welcoming Community | Oversized Circular Image + text | Image right, text left | Pure White | |
| 4 | Partnerships with Families | Oversized Circular Image + text | Text left, image right | Warm Cream #FBF9F7 | |
| 5 | Celebrating Together | Oversized Circular Image + text | Image right, text left | Pure White | |
| 6 | Faith in Community | Oversized Circular Image + text | Text left, image right | Warm Cream #FBF9F7 | |
| 7 | The St Kevin's Spirit | Dark Feature Section | Centred text, full-width | Deep Navy #051E42 | Emotional closing section |
| 8 | Footer | Footer | Same | Deep Navy #051E42 | |

---

## PAGE 5: ENROLMENTS — enrolments.html

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section | Full-bleed, shorter | Image + overlay | Warm, inviting image |
| 2 | Intro + Pathway | Custom | Centred text + visual pathway | Pure White | Visit → Enquire → Enrol → Begin visual steps |
| 3 | Visit Us | Content Card (Light) | Card with text + button | Cloud Grey #F4F6F8 | "Book a School Tour" button |
| 4 | Start the Conversation | Content Card (Light) | Card with text + 2 buttons | Pure White | Enquiry + Prospectus buttons |
| 5 | The Enrolment Process | Content Card (Light) | Card with text + button | Cloud Grey #F4F6F8 | "Begin Enrolment Application" button |
| 6 | Transition to School | Oversized Circular Image + text | Image right, text left | Pure White | Warm photo of young children |
| 7 | Every Child Known | CTA-style closing | Centred text | Warm Cream #FBF9F7 | Emotional closing statement |
| 8 | Footer | Footer | Same | Deep Navy #051E42 | |

---

## PAGE 6: CONTACT US — contact.html

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section (shorter) | Full-bleed | Image + overlay | School entrance or welcoming image |
| 2 | Intro | Custom | Centred text | Pure White | |
| 3 | Get in Touch | Split layout | Contact details left, Google Maps right | Pure White | Phone, email, address |
| 4 | School Office Hours | Custom | Simple centred text block | Cloud Grey #F4F6F8 | Mon–Fri 8am–4pm |
| 5 | Send Us a Message | Custom | Contact form or button | Pure White | "General Enquiry Form" button |
| 6 | Visit Our School | CTA | Text + button | Warm Cream #FBF9F7 | "Book a School Tour" button |
| 7 | Stay Connected | Custom | Social icons + text | Pure White | Facebook + Schoolzine icons |
| 8 | Footer | Footer | Same | Deep Navy #051E42 | |

---

## PAGE 7: POLICIES — policies.html

| # | Section | Component | Layout | Background | Notes |
|---|---------|-----------|--------|------------|-------|
| 1 | Hero | Hero Section (minimal) | Shorter hero, 40vh | Navy background, no photo | "Policies & Compliance" text overlay |
| 2 | Intro | Custom | Centred text | Pure White | MACS governance explanation |
| 3 | SafeSmart Embed | iframe | Full-width contained | Pure White | Embed SafeSmart portal URL |
| 4 | Footer | Footer | Same | Deep Navy #051E42 | |

---

## SHARED COMPONENTS (present on every page)

### Header
- Position: fixed top, transparent over hero, becomes white on scroll (sticky)
- Left: Hamburger menu icon (white on hero, navy after scroll)
- Centre: St Kevin's logo (white on hero, colour after scroll)
- Right: MACS logo (white on hero, colour after scroll)
- Z-index: 1000

### Fullscreen Nav Overlay
- Trigger: hamburger click
- Background: Deep Navy #051E42, 100vw × 100vh
- Links: centred vertically, Montserrat 700 at 36px, white
- Close: × icon top-right
- Transition: fade 0.3s
- Z-index: 9999

### Footer
- Background: Deep Navy #051E42
- Content max-width: 1200px centred
- Row 1: MACS logo (left) + St Kevin's logo (right), white versions
- Row 2: Three columns — Contact Info | Quick Links | Resources
- Row 3: Copyright bar with thin white 20% opacity top border

### Wave Dividers
- Burgundy (#8A2232): hero → white content transitions
- Navy (#051E42): white content → dark section transitions
- Navy inverse: dark section → white content transitions
- SVG markup in DESIGN_SYSTEM.md Quick Start section
