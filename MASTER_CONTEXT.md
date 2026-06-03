# Master Context

## Purpose

Top-level working context for the nWork web delivery case study.

This file sits at the project root so future sessions don't depend on chat history.

---

## The Core Thesis

**You don't need WordPress, Webflow, or any CMS to give clients a content editing dashboard.**

Design in Stitch → export clean HTML → connect to a minimal PHP admin — and you get:
- Faster page loads (pure static HTML, no CMS overhead)
- Better security (no plugin ecosystem, no database, no wp-admin attack surface)
- Full code ownership (portable, no vendor lock-in)
- Simpler deployment (any host with PHP)
- Clients can still edit text and images — they just can't break the layout

This is proven on a real project: **nWork** (workforce management SaaS).

---

## Workflow

```
Design (Stitch)
    │
    ▼
Export HTML
    │
    ▼
Animate / refine (Pinegrow + GSAP)  ← optional
    │
    ▼
Connect PHP Admin Dashboard
    │  ├── client edits text/images via editor UI
    │  └── PHP API writes to content.json
    ▼
Static HTML reads content.json on load
    │
    ▼
Deploy anywhere (shared host, VPS, S3+Lambda)
```

---

## Active Project: nWork Case Study — Phase 1 Complete

**What it is**: Workforce management SaaS landing page with connected PHP content dashboard.

**Status**: Phase 1 complete.
- Static HTML frontend (`site/index.html`) — full Stitch design
- PHP admin dashboard (`site/admin/`) — login, tabbed editor, REST API
- Flat JSON content store (`site/content.json`) — no database
- Image upload built into PHP API (`site/images/`)
- Deep merge in API — partial saves don't wipe sibling fields

**Location**: `site/`

**Next**: Phase 2 — wire frontend to fetch content from API on load (hydration).

---

## What Was Tried and Dropped

### Next.js Dashboard + Astro Frontend
- Built a full Next.js content dashboard and Astro frontend
- Problem: too heavy, required Node.js runtime, build step, more infra to self-host
- Decision: replaced with PHP stack — simpler, deployable anywhere, no build step
- Files deleted from `Web Dev/apps/dashboard/` and `Web Dev/apps/public-site/`

### Website Cloning Tools
- `goclone` — mirroring tool, failed on modern WordPress/Elementor sites
- `ai-website-cloner-template` — better understood as an agent workflow, not a direct downloader
- Decision: preferred owned-code approach — inspect → extract → rebuild

---

## Reusable Pattern (for future clients)

1. Design in Stitch → export HTML
2. Drop HTML into `site/index.html`
3. Copy `site/admin/` (login + editor + api) — parameterize for client's content sections
4. Update `site/content.json` with client's initial content
5. Deploy on any PHP host
6. Hand client the `/admin` URL and password

---

## File Structure

```
nWork/
├── site/                    # Full deliverable (frontend + admin)
│   ├── index.html           # Static HTML landing page
│   ├── content.json         # Content source of truth
│   ├── images/              # Uploaded images (gitignored)
│   └── admin/
│       ├── index.php        # Login
│       ├── editor.php       # Content editor
│       └── api.php          # REST API
│
├── Web Dev/                 # Monorepo remnants (research, infra, old experiments)
├── CLAUDE.md                # Detailed project context
├── MASTER_CONTEXT.md        # This file
└── .gitignore
```

---

## Immediate Next Steps

1. **Phase 2** — Frontend hydration: wire `index.html` JS fetch → `api.php` so edits go live without touching files
2. **Phase 3** — Image picker UI in admin editor
3. **Case study write-up** — document the WordPress-bypass approach as a reusable client delivery pattern
4. **Apply pattern** to next client site
