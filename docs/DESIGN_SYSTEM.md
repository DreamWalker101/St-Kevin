# St Kevin's Hampton Park — Style Reference
> warm editorial community

**Theme:** light with dark accent sections

St Kevin's employs a warm, editorial, community-driven aesthetic that balances institutional authority with genuine approachability. The design grounds itself in deep navy and burgundy red — the school's core colours — against generous whitespace and warm cream surfaces. The layout borrows from editorial magazine design: full-bleed hero imagery, oversized circular image crops that break their containers, flowing script accent text, and organic wave dividers between sections. The overall feel is trustworthy, nurturing, and culturally rich — reflecting a diverse Catholic school community where belonging is the central message. Inspired by Green School's immersive, mission-driven storytelling layout.

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Deep Navy | `#051E42` | `--color-deep-navy` | Primary brand colour for headers, navigation, footer, primary buttons, body text, and dark feature sections — the authoritative backbone of the entire UI |
| Burgundy Red | `#8A2232` | `--color-burgundy-red` | Accent colour for CTAs, italic taglines, decorative wave dividers, hover states, and attention-drawing elements — used sparingly for maximum impact (10% of palette) |
| Pure White | `#FFFFFF` | `--color-pure-white` | Primary page background and text on dark surfaces — the dominant surface colour providing clean, bright foundations |
| Warm Cream | `#FBF9F7` | `--color-warm-cream` | Slightly warm alternative background for sections that need subtle differentiation from pure white without introducing colour — adds editorial warmth inspired by Green School's #f8f5f0 |
| Cloud Grey | `#F4F6F8` | `--color-cloud-grey` | Neutral section background for alternating content blocks, form areas, and secondary surfaces |
| Border Mist | `#E2E6EA` | `--color-border-mist` | Default boundary and separator colour for hairline borders, input fields, card outlines, and dividers |
| Slate Text | `#6B7280` | `--color-slate-text` | Secondary text colour for supporting copy, captions, metadata, and less prominent information |
| Navy Tint | `#0A2D5C` | `--color-navy-tint` | Slightly lighter navy for hover states on primary buttons and interactive elements on dark backgrounds |
| Red Soft | `#F4E3E6` | `--color-red-soft` | Very light burgundy tint for subtle accent backgrounds, highlighted cards, or gentle emphasis areas |

## Tokens — Typography

### Montserrat — The primary heading typeface used across all section titles, navigation items, buttons, and structural text. Its geometric forms convey modern confidence while remaining highly readable at all sizes. Weights range from 600 for sub-headings to 800 for hero display text. · `--font-montserrat`
- **Source:** Google Fonts
- **Weights:** 600, 700, 800
- **Sizes:** 18px, 22px, 28px, 36px, 48px, 56px
- **Line height:** 1.1, 1.2, 1.25, 1.3
- **Letter spacing:** -0.02em, -0.01em
- **Role:** All headings from H1 display down to H4 sub-sections. Navigation labels. Button text. Card titles. Footer headings.

### Inter — The workhorse body typeface for all running text, descriptions, form labels, and interface copy. Its clarity at small sizes and neutral tone let the content speak without typographic interference. · `--font-inter`
- **Source:** Google Fonts
- **Weights:** 400, 500
- **Sizes:** 14px, 16px, 18px
- **Line height:** 1.5, 1.6, 1.7
- **Letter spacing:** -0.01em, normal
- **Role:** Body paragraphs, card descriptions, form inputs, footer text, navigation sub-items, metadata, captions.

### Dancing Script — Used exclusively for italic taglines, emotional accent text, and the school motto/tagline. This calligraphic script introduces warmth and personality, bridging the gap between institutional authority and human connection. Always used in burgundy red or white on dark backgrounds. · `--font-dancing-script`
- **Source:** Google Fonts
- **Weights:** 400, 700
- **Sizes:** 20px, 24px, 28px
- **Line height:** 1.4, 1.5
- **Letter spacing:** normal
- **Role:** School tagline ("A community where every child is known..."), section taglines ("Every child matters here"), Our Story/Our Mission/Our Vision sub-headings on About page. NEVER used for body text, buttons, or navigation.

### Type Scale

| Role | Font | Weight | Size | Line Height | Letter Spacing | Token |
|------|------|--------|------|-------------|----------------|-------|
| caption | Inter | 500 | 14px | 1.6 | normal | `--text-caption` |
| body | Inter | 400 | 16px | 1.7 | normal | `--text-body` |
| body-lg | Inter | 400 | 18px | 1.7 | -0.01em | `--text-body-lg` |
| tagline | Dancing Script | 400 | 24px | 1.4 | normal | `--text-tagline` |
| tagline-lg | Dancing Script | 700 | 28px | 1.4 | normal | `--text-tagline-lg` |
| heading-sm | Montserrat | 600 | 22px | 1.3 | -0.01em | `--text-heading-sm` |
| heading | Montserrat | 600 | 28px | 1.25 | -0.01em | `--text-heading` |
| heading-lg | Montserrat | 700 | 36px | 1.2 | -0.02em | `--text-heading-lg` |
| display | Montserrat | 700 | 48px | 1.1 | -0.02em | `--text-display` |
| display-lg | Montserrat | 800 | 56px | 1.1 | -0.02em | `--text-display-lg` |

## Tokens — Spacing & Shapes

**Density:** generous — a school website should breathe, giving content space to be absorbed by parents and families browsing on all devices

### Spacing Scale

| Name | Value | Token |
|------|-------|-------|
| 4 | 4px | `--spacing-4` |
| 8 | 8px | `--spacing-8` |
| 12 | 12px | `--spacing-12` |
| 16 | 16px | `--spacing-16` |
| 24 | 24px | `--spacing-24` |
| 32 | 32px | `--spacing-32` |
| 48 | 48px | `--spacing-48` |
| 64 | 64px | `--spacing-64` |
| 80 | 80px | `--spacing-80` |
| 96 | 96px | `--spacing-96` |
| 120 | 120px | `--spacing-120` |
| 156 | 156px | `--spacing-156` |

### Border Radius

| Element | Value |
|---------|-------|
| buttons | 8px |
| cards | 12px |
| input fields | 8px |
| image containers | 16px |
| circular images | 50% (always) |
| badges/pills | 999px |
| nav overlay | 0px (fullscreen) |

### Layout

- **Max content width:** 1200px
- **Grid:** 12 column
- **Column gap:** 24px
- **Section padding (desktop):** 96px vertical
- **Section padding (tablet):** 64px vertical
- **Section padding (mobile):** 48px vertical
- **Section gap:** 0px (sections flow edge-to-edge, separated by wave dividers not whitespace gaps)

## Components

### Primary Button (Navy Filled)
**Role:** Main call-to-action — "Book a Tour", "Enquire", "Learn More"

Deep Navy background (#051E42), Pure White text (#FFFFFF), 8px border-radius, 14px 28px padding. Montserrat 600 at 16px. Hover: background shifts to Navy Tint (#0A2D5C). Transition: 0.2s ease.

### Accent Button (Burgundy Filled)
**Role:** High-priority CTA — "Enrol Now", "Book a School Tour"

Burgundy Red background (#8A2232), Pure White text (#FFFFFF), 8px border-radius, 14px 28px padding. Montserrat 600 at 16px. Hover: slight brightness increase. Used ONLY for the single most important action on a page.

### Secondary Button (Outline)
**Role:** Supporting actions — "Learn More", "View All", "Read More"

Transparent background, Deep Navy text (#051E42), 2px solid Deep Navy border, 8px border-radius, 14px 28px padding. Montserrat 600 at 16px. Hover: fills with Deep Navy, text becomes white.

### Hero Section
**Role:** Full-viewport opening statement — sets emotional tone immediately.

Full-bleed image (100vw × 100vh or 80vh minimum). Subtle dark gradient overlay from bottom (rgba(5,30,66,0.3)). St Kevin's logo centered. MACS logo top-right, small, white mono version. Hamburger icon top-left, white. No text overlay on hero image — the image carries the emotion. Below hero: burgundy wave SVG divider transitions to the next white section.

### Oversized Circular Image
**Role:** Feature images for alternating content sections — Belonging, Learning, Faith, Community.

Circular crop (border-radius: 50%). Sized at 110–120% of parent column width with overflow hidden on the container. This deliberate oversizing creates visual tension and editorial drama — the image "bleeds" beyond its logical space. Subtle box-shadow: 0 8px 24px rgba(0,0,0,0.08). Alternates left/right across sections.

### Wave Divider
**Role:** Organic section transitions replacing hard edges between white and dark sections.

SVG path element, full-width, rendered as a decorative element between sections. Colours: Burgundy Red (#8A2232) for hero-to-content transitions. Deep Navy (#051E42) for content-to-dark-section transitions. Height: 60–80px. Curved sinusoidal wave shape — not angular, not geometric. Matches the organic, community feel.

### Dark Feature Section
**Role:** Full-width immersive sections — "The St Kevin's Effect", "Our People"

Deep Navy background (#051E42), full viewport width. All text white (#FFFFFF) or white at 80% opacity for secondary text. Headings in Montserrat 700. Script taglines in Dancing Script, white. Contains internal components (testimonial cards, team blocks) on this dark surface.

### Testimonial Card
**Role:** Parent/student quotes displayed in carousel within dark feature sections.

No visible background (inherits dark section). Circular portrait image (80px diameter, border: 3px solid white). Quote text in Inter 400 italic at 16px, white. Attribution in Inter 500 at 14px, white 80% opacity. Cards arranged 3-across on desktop, 1 at a time on mobile. Left/right arrow navigation.

### Video Thumbnail Card
**Role:** Placeholder or link to school videos.

Deep Navy background (#051E42), 12px border-radius. St Kevin's logo centered in white. Circular play button icon: Burgundy Red background, white triangle. Shadow: 0 8px 24px rgba(0,0,0,0.08). Grid layout: 2×2 on desktop, 1 column on mobile.

### Content Card (Light)
**Role:** Quick links, news items, highlights.

Pure White background (#FFFFFF), 1px solid Border Mist (#E2E6EA), 12px border-radius, 32px padding. Shadow: 0 8px 24px rgba(0,0,0,0.08). Heading in Montserrat 600, body in Inter 400.

### Fullscreen Navigation Overlay
**Role:** Hamburger menu opens to fullscreen nav.

Deep Navy background (#051E42), 100vw × 100vh, z-index: 9999. Navigation links in Montserrat 700 at 36px, white, centered vertically. Links: About Us, Learning, Community, Enrolments, Contact. Close icon (×) top-right, white. Transition: fade in 0.3s ease.

### Footer
**Role:** Persistent site-wide footer.

Deep Navy background (#051E42). Text: white at 90% opacity. Two logos side by side: MACS (left) + St Kevin's (right). Three columns: Contact Info | Quick Links | Resources. Quick Links: Contact, Enrolments, School Tours, Newsletter, Annual Report, Policies & Compliance. Bottom bar: copyright, thin Border Mist top border at 20% opacity.

### Enrolment CTA Section
**Role:** Conversion-focused section near page bottom.

Split layout: text content left (60%), large photo right (40%). Dark background or image with overlay. Heading in Montserrat 700, white. Tagline in Dancing Script, white. Accent Button: "BOOK A TOUR" in Burgundy Red filled style.

## Do's and Don'ts

### Do
- Use Deep Navy (#051E42) as the primary structural colour — it should carry 20% of the visual weight across headers, text, buttons, footer, and dark feature sections.
- Apply Burgundy Red (#8A2232) only for CTAs, italic taglines, and decorative wave dividers — never for large surface areas. It represents 10% of the palette maximum.
- Keep 70% of all surfaces white or warm cream to maintain the open, welcoming feel critical for a school website.
- Use Dancing Script exclusively for taglines and emotional accent text — it should feel like a handwritten personal touch, not a default font choice.
- Make circular images oversized (110–120% of column width) to create the editorial tension visible in the mockups — this is a signature design element.
- Use wave/curve SVG dividers between sections — never use hard horizontal lines or abrupt colour transitions.
- Maintain generous section padding (96px desktop) — parents browsing school websites need content to breathe and feel welcoming, not dense.
- Ensure both MACS and St Kevin's logos appear together in header and footer — MACS left, St Kevin's right, equal visual weight.
- Use Inter for ALL body text without exception — consistency in running text builds trust.
- Apply the dark navy full-width section treatment for emotionally important moments (The St Kevin's Effect, Our People) — these are immersive storytelling sections.

### Don't
- Do not introduce a visible top navigation bar — the mockup specifies hamburger-only navigation with a fullscreen overlay.
- Never use more than one accent colour per section — Burgundy Red is the only accent. Do not add orange, gold, or other warm tones.
- Do not use flat, squared image containers for feature sections — the signature look is oversized circles with visual overflow.
- Avoid harsh drop shadows — surfaces should feel gently elevated (0 8px 24px rgba(0,0,0,0.08)) or flat. No Material Design elevation.
- Do not use full black (#000000) for any text — Deep Navy (#051E42) serves as the darkest text colour on light backgrounds.
- Never use Dancing Script for buttons, navigation, form labels, or body text — it is strictly decorative for taglines and emotional moments.
- Do not break the alternating left/right rhythm of the homepage content sections (Belonging right, Learning left, Faith right, Community left).
- Avoid generic stock imagery — all photos should feel authentic, diverse, and specific to the school community. Grey placeholders until real photos arrive.
- Do not use more than 3 font families (Montserrat, Inter, Dancing Script) — introducing a fourth breaks the established system.
- Never omit the wave divider between the hero and the first content section — it is a core brand element.

## Surfaces

| Level | Name | Value | Purpose |
|-------|------|-------|---------|
| 0 | Pure White | `#FFFFFF` | Dominant page background — hero welcome block, alternating content sections, form areas |
| 1 | Warm Cream | `#FBF9F7` | Gentle warm alternative for sections needing subtle differentiation — about intro, parish connection |
| 2 | Cloud Grey | `#F4F6F8` | Neutral alternate sections — enrolment pathway, contact form backgrounds, card containers |
| 3 | Deep Navy | `#051E42` | Immersive dark sections — The St Kevin's Effect, Our People, footer, fullscreen nav overlay |
| 4 | Red Soft | `#F4E3E6` | Rare highlight surface — featured announcement card, key date callout. Use extremely sparingly. |

## Imagery

Imagery is the emotional core of this school website. Photos should be authentic, vibrant, and culturally diverse — reflecting the real St Kevin's community of Hampton Park. Key characteristics:

- **Circular crops** dominate content sections — oversized, bleeding beyond containers
- **Full-bleed heroes** at page tops — warm, natural lighting, outdoor settings preferred
- **Children in navy school uniforms** are the primary subjects — always active (learning, playing, praying, creating), never posed stock-style
- **Group shots** emphasise diversity and belonging — mixed ethnicities, ages, abilities
- **Teacher-student interactions** convey care and connection
- **No heavy filters** — warm natural colour grading, slightly lifted shadows for an inviting feel
- **Video thumbnails** use navy backgrounds with centered school logo and red play button
- **Placeholder convention:** dark grey (#374151) circles/rectangles with white section label text centered

## Layout

The page uses a full-viewport-width canvas with internally constrained content (max-width 1200px, centered). The hero section is a full-bleed image with no text overlay, immediately establishing emotional connection through authentic school photography. A burgundy wave SVG transitions into the welcome block — centred text with bold display heading and script tagline.

Content sections alternate between image-left/text-right and text-left/image-right, creating a natural reading rhythm. Circular images are deliberately oversized, extending beyond their grid column to create editorial tension. Each section features a Montserrat heading, Inter body paragraph, and Dancing Script italic tagline in Burgundy Red.

Dark navy full-width sections (The St Kevin's Effect, Our People) break the white rhythm and create immersive storytelling moments. These contain internal layouts: testimonial carousels, team grids, alternating blocks — all on the dark surface.

The footer mirrors the dark navy sections and contains dual logos, contact information, and quick links in a clean three-column layout.

Mobile behaviour: all content stacks to single column. Circular images become full-width. Section padding reduces to 48px. Hero maintains full viewport height. Navigation remains hamburger at all breakpoints.

## Agent Prompt Guide

Quick Colour Reference:
- text: #051E42 (Deep Navy)
- background: #FFFFFF (Pure White)
- warm background: #FBF9F7 (Warm Cream)
- neutral background: #F4F6F8 (Cloud Grey)
- border: #E2E6EA (Border Mist)
- secondary text: #6B7280 (Slate Text)
- accent: #8A2232 (Burgundy Red)
- primary action: #051E42 (Deep Navy filled)
- accent action: #8A2232 (Burgundy Red filled)
- dark section: #051E42 (Deep Navy)

Example Component Prompts:

1. **Create a Primary CTA Button:** #051E42 background, #FFFFFF text, 8px radius, 14px 28px padding. Montserrat 600 at 16px. Hover transitions to #0A2D5C. Use for "Book a Tour", "Enquire", "Learn More".

2. **Create an alternating content section:** White background. Left column (50%): Montserrat 600 heading at 28px in #051E42, Inter 400 body at 16px in #051E42, Dancing Script 400 tagline at 20px in #8A2232 italic. Right column (50%): oversized circular image (110% column width, border-radius 50%, overflow hidden on parent, box-shadow 0 8px 24px rgba(0,0,0,0.08)). Next section mirrors: image left, text right.

3. **Create The St Kevin's Effect section:** Full-width #051E42 background. Centred Montserrat 700 heading at 36px in white. Inter 400 sub-text at 18px in white 80% opacity. Below: 3 testimonial cards in a row — each with 80px circular portrait (3px white border), Inter 400 italic quote at 16px in white, Inter 500 attribution at 14px in white 70% opacity. Left/right arrow icons for carousel. Burgundy wave SVG at top transitioning from white section above.

4. **Create the hero section:** 100vw × 80vh minimum. Full-bleed background image, object-fit cover. Gradient overlay: linear-gradient(to bottom, rgba(5,30,66,0.1), rgba(5,30,66,0.4)). Hamburger icon absolute top-left 24px, white, 28px. MACS logo absolute top-right 24px. St Kevin's logo absolute center top. Below hero: burgundy (#8A2232) wave SVG divider, 70px height.

5. **Create the fullscreen nav overlay:** Fixed position, 100vw × 100vh, #051E42 background, z-index 9999. Centred vertically: list of 5 links in Montserrat 700 at 36px, white, 24px gap between links. Close button (×) absolute top-right 24px, white, 32px. Fade-in animation 0.3s ease.

6. **Create the footer:** Full-width #051E42 background. Max-width 1200px centered content. Top row: MACS logo (left) + St Kevin's logo (right), white versions. Three columns below: Column 1 — address, phone, email in Inter 400 at 14px white 90%. Column 2 — "St Kevin's Hampton Park" heading in Montserrat 600 at 16px white, then quick links (Contact, Enrolments, School Tours) in Inter 400 at 14px white 80%. Column 3 — Newsletter, Annual Report, Policies links. Bottom bar: 1px top border at white 20% opacity, copyright text Inter 400 at 12px white 60%.

## Quick Start

### CSS Custom Properties

```css
:root {
  /* Colors */
  --color-deep-navy: #051E42;
  --color-burgundy-red: #8A2232;
  --color-pure-white: #FFFFFF;
  --color-warm-cream: #FBF9F7;
  --color-cloud-grey: #F4F6F8;
  --color-border-mist: #E2E6EA;
  --color-slate-text: #6B7280;
  --color-navy-tint: #0A2D5C;
  --color-red-soft: #F4E3E6;

  /* Typography — Font Families */
  --font-montserrat: 'Montserrat', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --font-inter: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --font-dancing-script: 'Dancing Script', cursive;

  /* Typography — Scale */
  --text-caption: 14px;
  --leading-caption: 1.6;
  --tracking-caption: normal;
  --text-body: 16px;
  --leading-body: 1.7;
  --tracking-body: normal;
  --text-body-lg: 18px;
  --leading-body-lg: 1.7;
  --tracking-body-lg: -0.01em;
  --text-tagline: 24px;
  --leading-tagline: 1.4;
  --tracking-tagline: normal;
  --text-tagline-lg: 28px;
  --leading-tagline-lg: 1.4;
  --tracking-tagline-lg: normal;
  --text-heading-sm: 22px;
  --leading-heading-sm: 1.3;
  --tracking-heading-sm: -0.01em;
  --text-heading: 28px;
  --leading-heading: 1.25;
  --tracking-heading: -0.01em;
  --text-heading-lg: 36px;
  --leading-heading-lg: 1.2;
  --tracking-heading-lg: -0.02em;
  --text-display: 48px;
  --leading-display: 1.1;
  --tracking-display: -0.02em;
  --text-display-lg: 56px;
  --leading-display-lg: 1.1;
  --tracking-display-lg: -0.02em;

  /* Typography — Weights */
  --font-weight-regular: 400;
  --font-weight-medium: 500;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;
  --font-weight-extrabold: 800;

  /* Spacing */
  --spacing-4: 4px;
  --spacing-8: 8px;
  --spacing-12: 12px;
  --spacing-16: 16px;
  --spacing-24: 24px;
  --spacing-32: 32px;
  --spacing-48: 48px;
  --spacing-64: 64px;
  --spacing-80: 80px;
  --spacing-96: 96px;
  --spacing-120: 120px;
  --spacing-156: 156px;

  /* Layout */
  --max-width: 1200px;
  --grid-columns: 12;
  --column-gap: 24px;
  --section-padding-desktop: 96px;
  --section-padding-tablet: 64px;
  --section-padding-mobile: 48px;

  /* Border Radius */
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --radius-circle: 50%;
  --radius-pill: 999px;

  /* Named Radii */
  --radius-buttons: 8px;
  --radius-cards: 12px;
  --radius-inputs: 8px;
  --radius-images: 16px;
  --radius-circular: 50%;

  /* Shadows */
  --shadow-soft: 0 8px 24px rgba(0, 0, 0, 0.08);
  --shadow-none: none;

  /* Surfaces */
  --surface-page: #FFFFFF;
  --surface-warm: #FBF9F7;
  --surface-neutral: #F4F6F8;
  --surface-dark: #051E42;
  --surface-accent-soft: #F4E3E6;

  /* Transitions */
  --transition-fast: 0.2s ease;
  --transition-medium: 0.3s ease;

  /* Z-Index */
  --z-nav-overlay: 9999;
  --z-sticky-header: 1000;
  --z-wave-divider: 10;
}
```

### Google Fonts Import

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Inter:wght@400;500&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
```

### Tailwind CDN + Custom Config

```html
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          'deep-navy': '#051E42',
          'burgundy-red': '#8A2232',
          'warm-cream': '#FBF9F7',
          'cloud-grey': '#F4F6F8',
          'border-mist': '#E2E6EA',
          'slate-text': '#6B7280',
          'navy-tint': '#0A2D5C',
          'red-soft': '#F4E3E6',
        },
        fontFamily: {
          'montserrat': ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
          'inter': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
          'script': ['Dancing Script', 'cursive'],
        },
        maxWidth: {
          'content': '1200px',
        },
        borderRadius: {
          'card': '12px',
          'image': '16px',
        },
        boxShadow: {
          'soft': '0 8px 24px rgba(0, 0, 0, 0.08)',
        },
      }
    }
  }
</script>
```

### Wave Divider SVG (Burgundy — Hero to Content)

```html
<svg viewBox="0 0 1440 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full block -mt-1">
  <path d="M0,0 C360,70 1080,0 1440,70 L1440,70 L0,70 Z" fill="#8A2232"/>
</svg>
```

### Wave Divider SVG (Navy — Content to Dark Section)

```html
<svg viewBox="0 0 1440 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full block -mt-1">
  <path d="M0,70 C360,0 1080,70 1440,0 L1440,70 L0,70 Z" fill="#051E42"/>
</svg>
```

## Similar Brands / Design References

- **Green School (greenschool.org)** — The primary design inspiration. Shares the editorial, mission-driven, full-bleed imagery approach with organic shapes and warm storytelling. St Kevin's adapts this language from earthy greens into institutional navy/burgundy.
- **Sacred Heart College (Melbourne)** — Similar Catholic school aesthetic balancing faith, community, and academic messaging with a strong colour palette.
- **Reggio Emilia approach websites** — Share the child-centred photography style and emphasis on learning through community.
- **Kew Primary School** — Clean Australian school website with strong typography and generous whitespace.
