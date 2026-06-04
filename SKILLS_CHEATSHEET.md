# 🎯 ST KEVIN'S — SKILLS CHEAT SHEET

> All commands typed directly into Claude Code chat. This file lives in the repo root — open it anytime you need a reference.

---

# 📑 CONTENTS

| # | Section | What it covers |
|---|---|---|
| 1 | [⏱ SESSION COMMANDS](#️-session-commands) | `/resume` and `/end` — start and end every session |
| 2 | [✨ IMPECCABLE](#-impeccable--design-polish) | Design polish, audit, bolder, quieter, typeset |
| 3 | [🎨 TASTE-SKILL REPO](#-taste-skill-repo--installed-skills) | 4 installed aesthetic skills — soft-skill, taste-skill, minimalist-skill, image-to-code |
| 4 | [🖥 FRONTEND-DESIGN](#-frontend-design--production-ui) | Production-grade UI when you have no component to paste |
| 5 | [🎬 GSAP](#-gsap--animation-hyperframes) | HyperFrames video composition animations |
| 6 | [⚡ GSAP-CORE](#-gsap-core--core-animation-api) | Core GSAP tweens, easing, staggers |
| 7 | [📜 GSAP-SCROLLTRIGGER](#-gsap-scrolltrigger--scroll-animations) | Scroll-linked animations, parallax, pinning |
| 8 | [🗺 QUICK DECISION GUIDE](#-quick-decision-guide) | "What do I use for X?" — one-liner answers |
| 9 | [📋 SESSION WORKFLOW](#-session-workflow) | Step-by-step for a standard session |

---

# ⏱ SESSION COMMANDS

> Custom commands built for this project. They read and write `PROGRESS.md` automatically.

| Command | When | What happens |
|---|---|---|
| `/resume` | **Start** of every session | Reads all 4 docs + PROGRESS.md → briefs you on exactly where to start |
| `/end` | **End** of every session | Logs completed sections → updates resume point → commits everything to git |

> ⚠️ **First session only:** paste the full contents of `CLAUDE_CODE_HANDOFF.md` instead of `/resume`. Every session after that uses `/resume`.

> 💡 `/resume` re-reads CLAUDE.md, DESIGN_SYSTEM.md, CONTENT.md, and PAGES.md every time. This is intentional — prevents Claude drifting on brand colours, copy, or layout specs across sessions.

---

# ✨ IMPECCABLE — Design Polish

> Think of this as a senior designer doing a final pass on whatever Claude just built. Use it **after** a section is built.

## Commands

| Command | When to use | What it does |
|---|---|---|
| `/impeccable polish` | After any section is built | Full quality pass — spacing, contrast, typography, responsiveness |
| `/impeccable audit` | Before showing client / after page assembly | Accessibility (a11y) + responsive check across all breakpoints |
| `/impeccable bolder` | Section looks flat, safe, or generic | Stronger contrast, bigger type, more defined visual hierarchy |
| `/impeccable quieter` | Section is cluttered or overwhelming | Strips noise, adds whitespace, calms the palette |
| `/impeccable typeset` | Font hierarchy feels off | Fixes scale, line height, letter-spacing, font pairing |
| `/impeccable animate` | Section needs motion added | Adds intentional scroll reveals and micro-interactions |
| `/impeccable colorize` | Palette feels wrong or off-brand | Reworks colour usage against the brand tokens |
| `/impeccable layout` | Section structure feels awkward | Reworks grid, column structure, spacing rhythm |
| `/impeccable craft` | No UIverse component — building from scratch | Full shape-then-build flow: defines layout intent before writing code |

## ⚠️ Important Note

Impeccable looks for a `PRODUCT.md` to understand the brand. Since this project uses `CLAUDE.md` + `docs/DESIGN_SYSTEM.md`, always add this when running it:

```
/impeccable polish — use CLAUDE.md and docs/DESIGN_SYSTEM.md as the brand reference
```

---


# 🎨 TASTE-SKILL REPO — Installed Skills

> Source: [github.com/leonxlnx/taste-skill](https://github.com/leonxlnx/taste-skill)
> 4 skills installed from this repo. All are aesthetic/design-direction skills — they shape *how* Claude designs, not what it builds.

| Skill | Command | Best for |
|---|---|---|
| `soft-skill` | `/skill soft-skill` | Warm editorial aesthetic — **activate every session** |
| `taste-skill` | `/skill taste-skill` | Reads the brief first, infers direction before designing |
| `minimalist-skill` | `/skill minimalist-skill` | Ultra-clean, typographic, zero-gradient sections |
| `image-to-code-skill` | `/skill image-to-code-skill` | Generates a design image first, then codes to match |

---

## soft-skill

> Sets the warm, premium, editorial vibe for the entire session. Activate **once at the start**, before building anything.

**Activate:** `/skill soft-skill`

**Always add after activating:**
> `"Use Editorial Luxury mode — warm creams, high-contrast serif headings, paper feel."`

| What it enforces | What it bans |
|---|---|
| Premium display fonts — Clash Display, Plus Jakarta Sans, Geist | Inter, Roboto, Arial |
| Nested double-bezel card architecture | Generic 1px grey borders |
| Pill buttons with nested icon circle | Harsh dark drop shadows |
| Heavy spacing — `py-24` to `py-40` | Bootstrap 3-column grids |
| Spring-physics motion — `cubic-bezier(0.32,0.72,0,1)` | `linear` / `ease-in-out` transitions |
| Staggered scroll-triggered fade-ups | — |

**Aesthetic modes** (Claude picks based on context — guide it for St Kevin's):

| Mode | Feel | When |
|---|---|---|
| **Editorial Luxury** ⭐ | Warm creams, serif headings, paper texture | St Kevin's — always use this |
| Ethereal Glass | OLED black, mesh gradients | Tech / SaaS — not for St Kevin's |
| Soft Structuralism | White/grey, bold grotesk | Health / consumer |

---

## taste-skill

> Smarter than soft-skill for brand-new sections — reads the brief and outputs a "Design Read" before touching any code.

**Activate:** `/skill taste-skill`

**What it does differently from soft-skill:** soft-skill locks in a fixed aesthetic. taste-skill first outputs a one-line read like:
> `"Reading this as: school/childcare landing for parents, editorial warm, leaning toward serif headings + generous whitespace."`

Then it designs to that. Better starting point when you have no UIverse component to paste.

**Best combo:** `/skill soft-skill` + `/skill taste-skill` — taste-skill reads the room, soft-skill enforces the warmth.

**Use when:** Building a section from scratch with no reference component and you want Claude to think before designing.

---

## minimalist-skill

> Ultra-clean, typographic, editorial style. Zero gradients, zero heavy shadows, warm monochrome palette.

**Activate:** `/skill minimalist-skill`

| Enforces | Bans |
|---|---|
| Extreme typographic contrast — serif display + sans body | Inter, Roboto, Open Sans |
| Warm monochrome palette — off-blacks, charcoals, muted greys | Coloured section backgrounds |
| Bento grid layouts | Generic drop shadows (`shadow-md`, `shadow-lg`) |
| Ultra-diffuse, near-invisible shadows | Gradients, neon, glassmorphism |
| Tight letter-spacing on display heads (`-0.02em` to `-0.04em`) | Pill-shaped cards or large containers |

**Use when:** A section needs to breathe — Policies page, a pullquote, a text-heavy content block, or any section where typography IS the design.

---

## image-to-code-skill

> Claude generates a high-quality design image first, analyses it deeply, then codes to match it exactly.

**Activate:** `/skill image-to-code-skill`

**Use when:** You have a visual concept but nothing on UIverse comes close. Instead of describing the section and hoping for the best, Claude designs it visually first.

**Workflow:**
1. `/skill image-to-code-skill`
2. Describe the section — purpose, feel, key elements
3. Claude generates a design mockup image
4. Claude analyses the image and codes to match it
5. `/impeccable polish` — final quality pass

**Best for:** Hero sections, feature showcases, any section where visual impact is the priority.

---

# 🖥 FRONTEND-DESIGN — Production UI

> Anthropic's official frontend design skill. Use when you want Claude to take **creative ownership** of a layout rather than adapting a pasted component.

```
/skill frontend-design
```

## When to use vs. impeccable

| Situation | Use |
|---|---|
| You have a UIverse/CodePen component to adapt | Don't need this — paste the component, Claude adapts it |
| No component — building from scratch | `/skill frontend-design` or `/impeccable craft` |
| Section is built but needs quality pass | `/impeccable polish` |
| Want distinctive layout for nav / footer | `/skill frontend-design` |

## What it focuses on

| Area | Approach |
|---|---|
| Typography | Characterful, unexpected font pairings — never generic |
| Colour | Commits to a dominant palette with sharp accents, CSS variables throughout |
| Motion | CSS scroll reveals, staggered entries, high-impact hover states |
| Layout | Asymmetry, overlap, diagonal flow, grid-breaking elements |
| Texture | Gradient meshes, noise overlays, layered transparencies |

> 💡 Claude will pick a tone and commit hard. If it goes the wrong direction, guide it:
> `"Keep the layout but make it warmer and more editorial — less brutalist."`

> ✅ Always follow with `/impeccable polish` to sanity-check against brand rules.

---

# 🎬 GSAP — Animation (HyperFrames)

> GSAP reference for **HyperFrames video compositions only** (HeyGen). Not for standard website scroll animation — use `gsap-scrolltrigger` for that.

```
/skill gsap
```

## HyperFrames Contract

All timelines must be **paused** and registered on `window.__timelines`. HyperFrames scrubs the timeline — it doesn't auto-play.

```js
window.__timelines = window.__timelines || {};
const tl = gsap.timeline({ paused: true });

tl.from(".title", { y: 48, opacity: 0, duration: 0.6, ease: "power3.out" }, 0);
tl.to(".accent", { scaleX: 1, duration: 0.5, ease: "power2.out" }, 0.25);

window.__timelines["main"] = tl; // key must match data-composition-id
```

## Rules

| ✅ Do | ❌ Don't |
|---|---|
| Pause all timelines | Call `tl.play()` for render-critical motion |
| Register on `window.__timelines` | Use `repeat: -1` (HyperFrames renders finite durations) |
| Use finite loops | Build timelines inside async code or event handlers |

---

# ⚡ GSAP-CORE — Core Animation API

> Official GSAP core skill — tweens, easing, staggers, responsive animation, reduced-motion handling. Activate alongside `gsap-scrolltrigger` when adding scroll animations.

```
/skill gsap-core
```

## Core Methods

```js
gsap.to(".el", { x: 100, opacity: 1, duration: 0.6 });        // animate TO
gsap.from(".el", { y: 48, opacity: 0, duration: 0.8 });       // animate FROM (entrances)
gsap.fromTo(".el", { opacity: 0 }, { opacity: 1 });            // explicit start + end
gsap.from(".card", { y: 32, opacity: 0, stagger: 0.1 });      // stagger multiple elements
```

## Easing Reference

| Ease | Feel | Use for |
|---|---|---|
| `power3.out` | Fast start, smooth stop | Most entrances ⭐ |
| `power2.inOut` | Smooth accel + decel | Transitions |
| `back.out(1.7)` | Slight overshoot | Playful UI elements |
| `elastic.out(1, 0.3)` | Spring bounce | Attention moments |
| `none` | Linear | Progress bars, scrubbed animations |

## Transform Properties

> Always use GSAP properties — never raw CSS `transform` strings.

| GSAP | CSS equivalent |
|---|---|
| `x`, `y` | translateX/Y (px) |
| `xPercent`, `yPercent` | translateX/Y (%) |
| `scale` | scale |
| `rotation` | rotate (deg) |
| `opacity` | opacity |

> ❌ Never animate `top`, `left`, `width`, `height` — only `transform` + `opacity` for performance.

## Reduced Motion (required on every animation)

```js
gsap.matchMedia().add("(prefers-reduced-motion: no-preference)", () => {
  gsap.from(".hero", { y: 48, opacity: 0, duration: 0.8 });
});
```

---

# 📜 GSAP-SCROLLTRIGGER — Scroll Animations

> Handles scroll-linked animations, pinned sections, parallax, and scrubbed timelines. The most-used GSAP feature on editorial sites like St Kevin's.

```
/skill gsap-core
/skill gsap-scrolltrigger
```

> ⚠️ Always activate **both** — ScrollTrigger is a plugin that sits on top of gsap-core.

## Setup

```js
gsap.registerPlugin(ScrollTrigger); // must register first
```

## Basic Scroll Trigger

```js
gsap.from(".section-content", {
  y: 40,
  opacity: 0,
  duration: 0.9,
  ease: "power3.out",
  scrollTrigger: {
    trigger: ".section-content",
    start: "top 80%",      // top of element hits 80% down the viewport
    toggleActions: "play none none none"
  }
});
```

## toggleActions Reference

Format: `"onEnter  onLeave  onEnterBack  onLeaveBack"`

| Value | Meaning |
|---|---|
| `play` | Play the animation |
| `reverse` | Play in reverse |
| `none` | Do nothing |
| `reset` | Reset to start |

> ⭐ Most common for St Kevin's: `"play none none none"` — plays once when scrolled into view.

## Scrub (tied to scroll position)

```js
scrollTrigger: {
  trigger: ".parallax-image",
  start: "top bottom",
  end: "bottom top",
  scrub: 1     // 1 = 1s lag behind scroll position
}
```

## Pin (stick while scrolling)

```js
scrollTrigger: {
  trigger: ".sticky-section",
  start: "top top",
  end: "+=500",     // pin for 500px of scroll distance
  pin: true,
  anticipatePin: 1
}
```

## ⭐ St Kevin's — Recommended Section Entrance Pattern

Paste this at the bottom of any assembled page to add warm editorial reveals across all sections:

```js
gsap.registerPlugin(ScrollTrigger);

document.querySelectorAll("section").forEach(section => {
  gsap.from(section.querySelectorAll("h2, h3, p, img, .card"), {
    y: 40,
    opacity: 0,
    duration: 0.9,
    ease: "power3.out",
    stagger: 0.12,
    scrollTrigger: {
      trigger: section,
      start: "top 75%",
      toggleActions: "play none none none"
    }
  });
});
```

---

# 🗺 QUICK DECISION GUIDE

| I want to... | Use this |
|---|---|
| Start a session | `/resume` |
| End a session | `/end` |
| Set the warm/premium vibe for the session | `/skill soft-skill` |
| Polish a section after building it | `/impeccable polish` |
| Make a section feel less flat/generic | `/impeccable bolder` |
| Calm down a section that's too busy | `/impeccable quieter` |
| Fix font hierarchy | `/impeccable typeset` |
| Check accessibility before client review | `/impeccable audit` |
| Build a section with no UIverse component | `/skill frontend-design` or `/impeccable craft` |
| Add scroll reveal animations | `/skill gsap-core` + `/skill gsap-scrolltrigger` |
| Add a pinned / parallax section | `/skill gsap-scrolltrigger` |
| Build a HyperFrames video composition | `/skill gsap` |

---

# 📋 SESSION WORKFLOW

## Standard Session

```
1.  /resume                         ← brief from PROGRESS.md
2.  /skill soft-skill               ← set warm editorial aesthetic
3.  → Claude announces next section with search terms
4.  → You search UIverse / CodePen
5.  → Paste component code + any instructions
6.  → Claude builds the section
7.  /impeccable polish              ← quality pass
8.  → Confirm section looks right
9.  → Repeat steps 3–8 for next section
10. /end                            ← save + commit
```

## Adding Scroll Animation to a Section

```
1.  Section is already built and polished
2.  /skill gsap-core
3.  /skill gsap-scrolltrigger
4.  → "Add scroll-triggered entrance animations to the [section name] section"
5.  /impeccable audit               ← verify reduced-motion is handled
```

## First Session Ever

```
1.  Paste full contents of CLAUDE_CODE_HANDOFF.md
2.  → Claude reads all 4 docs and organises the repo (Phase 1)
3.  → Claude announces Homepage Hero
4.  → Follow Standard Session workflow from step 2 above
```

---

*Last updated: 2026-06-04*
