/**
 * Captures section screenshots for the admin dashboard preview panel.
 *
 * Prerequisites:
 *   npm install puppeteer   (one-time, in the project root or site/admin/)
 *   PHP server running:  php -S localhost:8081 -t /path/to/site/
 *
 * Usage:
 *   node site/admin/capture-previews.js
 *
 * Output: site/images/admin-previews/{page}-{section}.jpg
 */

const puppeteer = require('puppeteer-core');
const path      = require('path');
const fs        = require('fs');

const BASE_URL  = 'http://localhost:8081';
const OUT_DIR   = path.join(__dirname, '../images/admin-previews');

if (!fs.existsSync(OUT_DIR)) fs.mkdirSync(OUT_DIR, { recursive: true });

const PAGES = [
  {
    id:  'homepage',
    url: `${BASE_URL}/index.html`,
    sections: [
      { id: 'hero',         anchor: 'sk-section-hero' },
      { id: 'quotes',       anchor: 'sk-section-quotes' },
      { id: 'welcome',      anchor: 'sk-section-welcome' },
      { id: 'pillars',      anchor: 'sk-section-pillars' },
      { id: 'effect',       anchor: 'sk-section-effect' },
      { id: 'testimonials', anchor: 'sk-section-testimonials' },
      { id: 'videos',       anchor: 'sk-section-videos' },
      { id: 'cta',          anchor: 'sk-section-enrol-cta' },
    ],
  },
  {
    id:  'about',
    url: `${BASE_URL}/about.html`,
    sections: [
      { id: 'hero',      anchor: 'sk-section-hero' },
      { id: 'smv',       anchor: 'sk-section-smv' },
      { id: 'intro',     anchor: 'sk-section-about-intro' },
      { id: 'principal', anchor: 'sk-section-principal' },
      { id: 'people',    anchor: 'sk-section-people' },
      { id: 'teams',     anchor: 'sk-section-teams' },
      { id: 'parish',    anchor: 'sk-section-parish' },
    ],
  },
  {
    id:  'learning',
    url: `${BASE_URL}/learning.html`,
    sections: [
      { id: 'hero',       anchor: 'sk-section-hero' },
      { id: 'introquote', anchor: 'sk-section-intro-quote' },
      { id: 'faith',      anchor: 'sk-section-faith' },
      { id: 'wellbeing',  anchor: 'sk-section-wellbeing' },
      { id: 'teaching',   anchor: 'sk-section-teaching' },
      { id: 'everychild', anchor: 'sk-section-every-child' },
      { id: 'beyond',     anchor: 'sk-section-beyond' },
    ],
  },
  {
    id:  'community',
    url: `${BASE_URL}/community.html`,
    sections: [
      { id: 'hero',    anchor: 'sk-section-hero' },
      { id: 'intro',   anchor: 'sk-section-intro' },
      { id: 'pillar1', anchor: 'sk-section-pillar-1' },
      { id: 'pillar2', anchor: 'sk-section-pillar-2' },
      { id: 'pillar3', anchor: 'sk-section-pillar-3' },
      { id: 'pillar4', anchor: 'sk-section-pillar-4' },
      { id: 'spirit',  anchor: 'sk-section-spirit' },
    ],
  },
  {
    id:  'enrolments',
    url: `${BASE_URL}/enrolments.html`,
    sections: [
      { id: 'hero',       anchor: 'sk-section-hero' },
      { id: 'intro',      anchor: 'sk-section-intro' },
      { id: 'step1',      anchor: 'sk-section-step1' },
      { id: 'step2',      anchor: 'sk-section-step2' },
      { id: 'step3',      anchor: 'sk-section-step3' },
      { id: 'transition', anchor: 'sk-section-transition' },
      { id: 'closingcta', anchor: 'sk-section-closing-cta' },
    ],
  },
  {
    id:  'contact',
    url: `${BASE_URL}/contact.html`,
    sections: [
      { id: 'hero',  anchor: 'sk-section-hero' },
      { id: 'intro', anchor: 'sk-section-intro' },
      { id: 'git',   anchor: 'sk-section-contact-details' },
    ],
  },
  {
    id:  'policies',
    url: `${BASE_URL}/policies.html`,
    sections: [
      { id: 'hero',       anchor: 'sk-section-hero' },
      { id: 'intro',      anchor: 'sk-section-intro' },
      { id: 'safesmart',  anchor: 'sk-section-safesmart' },
    ],
  },
];

async function capture() {
  const browser = await puppeteer.launch({
    headless: 'new',
    executablePath: '/usr/bin/google-chrome',
    args: ['--no-sandbox', '--disable-setuid-sandbox'],
  });

  for (const page of PAGES) {
    console.log(`\n📄 ${page.id} (${page.url})`);
    const tab = await browser.newPage();
    await tab.setViewport({ width: 1280, height: 900, deviceScaleFactor: 1 });

    try {
      await tab.goto(page.url, { waitUntil: 'networkidle2', timeout: 30000 });
      // Disable all CSS animations/transitions so elements render at their final state
      await tab.addStyleTag({
        content: `*, *::before, *::after {
          animation-duration: 0.001ms !important;
          animation-delay: 0ms !important;
          transition-duration: 0.001ms !important;
          transition-delay: 0ms !important;
        }`
      });
      // Complete any GSAP / ScrollTrigger animations immediately
      await tab.evaluate(() => {
        try {
          if (window.ScrollTrigger) {
            ScrollTrigger.getAll().forEach(t => {
              try { if (t.animation) t.animation.progress(1, true); } catch(e) {}
            });
          }
          if (window.gsap) gsap.globalTimeline.progress(1, true);
        } catch(e) {}
        // Fix elements where GSAP set inline opacity/visibility but didn't finish.
        // We ONLY touch inline styles (el.style.*) — NOT computed styles — to avoid
        // revealing CSS-defined overlays, carousel inactive slides, etc.
        document.querySelectorAll('*').forEach(el => {
          try {
            if (el.style.opacity !== '' && parseFloat(el.style.opacity) < 0.5) {
              el.style.opacity = '1';
            }
            if (el.style.visibility === 'hidden') {
              el.style.visibility = 'visible';
            }
          } catch(e) {}
        });
        // Re-close nav/overlay UI that gsap.set() initialised to autoAlpha:0 —
        // the walk above would have unhidden them, causing a blue overlay.
        ['sk-nav-backdrop', 'sk-nav-sidebar', 'sk-search-panel'].forEach(function(id) {
          var el = document.getElementById(id);
          if (el) { el.style.opacity = '0'; el.style.visibility = 'hidden'; }
        });
      });
      // Let the DOM settle after forcing animations
      await new Promise(r => setTimeout(r, 600));
    } catch (e) {
      console.error(`  ✗ Failed to load ${page.url}: ${e.message}`);
      await tab.close();
      continue;
    }

    for (const section of page.sections) {
      const el = await tab.$(`#${section.anchor}`);
      if (!el) {
        console.warn(`  ⚠ #${section.anchor} not found — skipping`);
        continue;
      }

      // Scroll element into view
      await tab.evaluate(id => {
        const el = document.getElementById(id);
        if (el) el.scrollIntoView({ block: 'start' });
      }, section.anchor);

      await new Promise(r => setTimeout(r, 400));

      const outPath = path.join(OUT_DIR, `${page.id}-${section.id}.jpg`);
      await el.screenshot({ path: outPath, type: 'jpeg', quality: 88 });
      console.log(`  ✓ ${page.id}-${section.id}.jpg`);
    }

    await tab.close();
  }

  await browser.close();
  console.log('\n✅ Done. Screenshots saved to site/images/admin-previews/');
}

capture().catch(err => {
  console.error('Error:', err.message);
  process.exit(1);
});
