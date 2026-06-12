/* ════════════════════════════════════════════════════════════════
   sk-layout.js — Shared header/footer injection + global behaviours
   Load at end of <body>, before page-specific scripts.
════════════════════════════════════════════════════════════════ */
(function () {
  'use strict';

  /* ── Active page detection ── */
  var rawPage = window.location.pathname.split('/').pop() || '';
  var page    = rawPage.replace('.html', '') || 'index';

  /* ── Nav items ── */
  var NAV_ITEMS = [
    { href: 'about.html',      label: 'About Us'   },
    { href: 'learning.html',   label: 'Learning'   },
    { href: 'community.html',  label: 'Community'  },
    { href: 'enrolments.html', label: 'Enrolments' },
    { href: 'contact.html',    label: 'Contact'    },
  ];

  var ARROW = '<span class="sk-nav-arrow-line"></span>'
    + '<span class="sk-nav-arrow-chevron">'
    + '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">'
    + '<polyline points="5,3 11,8 5,13"/></svg></span>';

  function buildNavItems() {
    return NAV_ITEMS.map(function (item) {
      var id       = item.href.replace('.html', '');
      var isActive = id === page;
      var cls      = isActive ? ' class="sk-nav-item is-active" aria-current="page"' : ' class="sk-nav-item"';
      return '<a href="' + item.href + '"' + cls + '>'
        + '<span class="sk-nav-item-label">' + item.label + '</span>'
        + '<span class="sk-nav-arrow" aria-hidden="true">' + ARROW + '</span>'
        + '</a>';
    }).join('');
  }

  /* ════════════════════════════════
     HEADER HTML
  ════════════════════════════════ */
  var headerHTML = [
    '<header class="sk-header is-transparent" id="sk-header">',
    '  <button class="sk-hamburger" id="sk-hamburger-btn" aria-label="Open navigation" aria-expanded="false">',
    '    <span></span><span></span><span></span>',
    '  </button>',
    '  <a href="index.html" class="sk-header__logo-link" aria-label="St Kevin\'s Primary School — Home">',
    '    <img id="sk-logo-hero" src="images/logo-sk-white.png" alt="St Kevin\'s Primary School, Hampton Park" class="sk-logo-hero">',
    '    <img id="sk-logo-sticky" src="images/logo-sk-colour.png" alt="" class="sk-logo-sticky" aria-hidden="true">',
    '  </a>',
    '  <button class="sk-search-btn" id="sk-search-btn" aria-label="Search site" aria-expanded="false">',
    '    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">',
    '      <circle cx="9.5" cy="9.5" r="7"/><line x1="14.5" y1="14.5" x2="21" y2="21"/>',
    '    </svg>',
    '  </button>',
    '</header>',

    '<div class="sk-search-panel" id="sk-search-panel" role="search" aria-label="Site search">',
    '  <div class="sk-search-inner">',
    '    <form class="sk-search-form" id="sk-search-form" autocomplete="off">',
    '      <span class="sk-search-icon" aria-hidden="true">',
    '        <svg width="18" height="18" viewBox="0 0 22 22" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">',
    '          <circle cx="9.5" cy="9.5" r="7"/><line x1="14.5" y1="14.5" x2="21" y2="21"/>',
    '        </svg>',
    '      </span>',
    '      <input type="search" class="sk-search-input" id="sk-search-input" placeholder="Search St Kevin\'s…" aria-label="Search">',
    '      <button type="submit" class="sk-search-submit">Search</button>',
    '    </form>',
    '    <button class="sk-search-close-btn" id="sk-search-close-btn" aria-label="Close search">',
    '      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="#374151" stroke-width="2" stroke-linecap="round">',
    '        <line x1="2" y1="2" x2="16" y2="16"/><line x1="16" y1="2" x2="2" y2="16"/>',
    '      </svg>',
    '    </button>',
    '  </div>',
    '  <div class="sk-search-results" id="sk-search-results" aria-live="polite"></div>',
    '</div>',

    '<div class="sk-nav-backdrop" id="sk-nav-backdrop"></div>',

    '<aside class="sk-nav-sidebar" id="sk-nav-sidebar" role="dialog" aria-modal="true" aria-label="Site navigation">',
    '  <div class="sk-sidebar-content">',
    '    <div class="sk-sidebar-header">',
    '      <button class="sk-sidebar-close" id="sk-sidebar-close" aria-label="Close navigation">',
    '        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">',
    '          <line x1="2" y1="2" x2="14" y2="14"/><line x1="14" y1="2" x2="2" y2="14"/>',
    '        </svg>',
    '      </button>',
    '      <a href="index.html" class="sk-sidebar-logo-link" aria-label="St Kevin\'s home">',
    '        <img src="images/logo-sk-macs-combined.png" alt="St Kevin\'s Primary School, Hampton Park" class="sk-sidebar-logo">',
    '      </a>',
    '    </div>',
    '    <nav class="sk-sidebar-nav" aria-label="Primary navigation">',
    buildNavItems(),
    '    </nav>',
    '    <div class="sk-sidebar-footer">',
    '      <div class="sk-sidebar-socials">',
    '        <a href="tel:0397098600" class="sk-social-btn sk-social-btn--phone" aria-label="Call us: (03) 9709 8600">',
    '          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">',
    '            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.37 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 5.5 5.5l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>',
    '          </svg>',
    '        </a>',
    '        <a href="mailto:administration@skhamptonpark.catholic.edu.au" class="sk-social-btn sk-social-btn--mail" aria-label="Email us">',
    '          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">',
    '            <rect class="env-body" x="2" y="4" width="20" height="16" rx="2"/>',
    '            <polyline class="env-flap" points="22,6 12,13 2,6"/>',
    '          </svg>',
    '        </a>',
    '        <a href="https://www.facebook.com/skhamptonpark" class="sk-social-btn sk-social-btn--fb" aria-label="Find us on Facebook" target="_blank" rel="noopener noreferrer">',
    '          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">',
    '            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
    '          </svg>',
    '        </a>',
    '      </div>',
    '    </div>',
    '  </div>',
    '  <div class="sk-sidebar-image" aria-hidden="true">',
    '    <div class="sk-sidebar-image-frame">',
    '      <img src="images/samples/cosmos_1616537391.jpeg" alt="" loading="eager">',
    '    </div>',
    '  </div>',
    '</aside>',
  ].join('\n');

  /* ════════════════════════════════
     FOOTER HTML
  ════════════════════════════════ */
  var footerHTML = [
    '<footer class="sk-footer" id="sk-footer" aria-label="Site footer">',
    '  <svg class="sk-footer__deco" viewBox="0 0 1440 560" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">',
    '    <circle cx="64"  cy="72"  r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="96"  cy="72"  r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="128" cy="72"  r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="64"  cy="104" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="96"  cy="104" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="128" cy="104" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="64"  cy="136" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="96"  cy="136" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="128" cy="136" r="2.8" fill="rgba(255,255,255,0.04)"/>',
    '    <circle cx="1312" cy="444" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1344" cy="444" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1376" cy="444" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1312" cy="476" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1344" cy="476" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1376" cy="476" r="2.4" fill="rgba(255,255,255,0.033)"/>',
    '    <circle cx="1420" cy="88"  r="5"   fill="#8A2232" opacity="0.22"/>',
    '    <circle cx="38"   cy="480" r="4"   fill="#8A2232" opacity="0.18"/>',
    '    <rect x="1378" y="180" width="16"  height="2.5" rx="1.25" fill="rgba(255,255,255,0.09)"/>',
    '    <rect x="1385" y="173" width="2.5" height="16"  rx="1.25" fill="rgba(255,255,255,0.09)"/>',
    '    <rect x="54"   y="370" width="12" height="2"  rx="1" fill="#8A2232" opacity="0.28"/>',
    '    <rect x="59"   y="365" width="2"  height="12" rx="1" fill="#8A2232" opacity="0.28"/>',
    '    <path d="M 1298 530 Q 1350 502 1402 530" stroke="rgba(255,255,255,0.055)" stroke-width="1.5" stroke-linecap="round" fill="none"/>',
    '  </svg>',
    '  <div class="sk-footer__inner">',
    '    <p class="sk-footer__tagline">A community where every child is known, supported and inspired to flourish</p>',
    '    <div class="sk-footer__rule" aria-hidden="true"></div>',
    '    <div class="sk-footer__logos">',
    '      <a href="https://www.macs.edu.au" class="sk-footer__logo-link" aria-label="Melbourne Archdiocese Catholic Schools — opens in new tab" target="_blank" rel="noopener noreferrer">',
    '        <img src="images/macs-logo-white.png" alt="Melbourne Archdiocese Catholic Schools" class="sk-footer__logo-img sk-footer__logo-img--macs" loading="lazy">',
    '      </a>',
    '      <a href="index.html" class="sk-footer__logo-link" aria-label="St Kevin\'s Primary School — Home">',
    '        <img src="images/logo-sk-white.png" alt="St Kevin\'s Primary School Hampton Park" class="sk-footer__logo-img sk-footer__logo-img--sk" loading="lazy">',
    '      </a>',
    '    </div>',
    '    <div class="sk-footer__cols">',
    '      <div class="sk-footer__col">',
    '        <h3 class="sk-footer__col-head">Contact Us</h3>',
    '        <address class="sk-footer__address">',
    '          <div class="sk-footer__contact-row">',
    '            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
    '            <span>120 Hallam Rd, Hampton Park VIC 3976</span>',
    '          </div>',
    '          <div class="sk-footer__contact-row">',
    '            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.06 6.06l.95-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
    '            <a href="tel:0397098600">(03) 9709 8600</a>',
    '          </div>',
    '          <div class="sk-footer__contact-row">',
    '            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
    '            <a href="mailto:administration@skhamptonpark.catholic.edu.au">administration@<wbr>skhamptonpark.catholic.edu.au</a>',
    '          </div>',
    '        </address>',
    '        <p class="sk-footer__hours">Monday to Friday &nbsp;&middot;&nbsp; 8:00am – 4:00pm</p>',
    '      </div>',
    '      <div class="sk-footer__col">',
    '        <h3 class="sk-footer__col-head">Quick Links</h3>',
    '        <nav class="sk-footer__nav" aria-label="Footer navigation">',
    '          <a href="contact.html"    class="sk-footer__link">Contact</a>',
    '          <a href="enrolments.html" class="sk-footer__link">Enrolments</a>',
    '          <a href="enrolments.html" class="sk-footer__link">School Tours</a>',
    '          <a href="#"               class="sk-footer__link">Newsletter</a>',
    '          <a href="#"               class="sk-footer__link">Annual Report</a>',
    '          <a href="policies.html"   class="sk-footer__link">Policies &amp; Compliance</a>',
    '        </nav>',
    '      </div>',
    '      <div class="sk-footer__col">',
    '        <h3 class="sk-footer__col-head">Stay Connected</h3>',
    '        <p class="sk-footer__about">St Kevin\'s is a Christ-centred Catholic primary school in Hampton Park, Melbourne. Part of the Melbourne Archdiocese Catholic Schools community.</p>',
    '        <div class="sk-footer__social">',
    '          <a href="https://www.facebook.com/skhamptonpark" class="sk-footer__social-btn sk-footer__social-btn--fb" aria-label="St Kevin\'s on Facebook" target="_blank" rel="noopener noreferrer">',
    '            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
    '          </a>',
    '          <a href="https://www.skhamptonpark.catholic.edu.au" class="sk-footer__social-btn sk-footer__social-btn--web" aria-label="St Kevin\'s website" target="_blank" rel="noopener noreferrer">',
    '            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
    '          </a>',
    '        </div>',
    '      </div>',
    '    </div>',
    '    <div class="sk-footer__bottom">',
    '      <p class="sk-footer__copy">© 2026 St Kevin\'s Primary School Hampton Park</p>',
    '      <div class="sk-footer__bottom-links">',
    '        <a href="policies.html" class="sk-footer__bottom-link">Policies</a>',
    '        <span class="sk-footer__bottom-sep" aria-hidden="true">·</span>',
    '        <a href="contact.html"  class="sk-footer__bottom-link">Contact</a>',
    '        <span class="sk-footer__bottom-sep" aria-hidden="true">·</span>',
    '        <a href="https://www.skhamptonpark.catholic.edu.au" class="sk-footer__bottom-link" target="_blank" rel="noopener noreferrer">skhamptonpark.catholic.edu.au</a>',
    '      </div>',
    '    </div>',
    '  </div>',
    '</footer>',
  ].join('\n');

  /* ── Inject header ── */
  var headerRoot = document.getElementById('sk-layout-header');
  if (headerRoot) {
    headerRoot.outerHTML = headerHTML;
  } else {
    /* Fallback: replace existing header by ID if placeholder is absent */
    var existingHeader = document.getElementById('sk-header');
    if (existingHeader) existingHeader.outerHTML = headerHTML;
  }

  /* ── Inject footer ── */
  var footerRoot = document.getElementById('sk-layout-footer');
  if (footerRoot) {
    footerRoot.outerHTML = footerHTML;
  } else {
    var existingFooter = document.getElementById('sk-footer');
    if (existingFooter) existingFooter.outerHTML = footerHTML;
  }

  /* ── Inject click spark canvas ── */
  if (!document.getElementById('global-click-spark')) {
    var sparkCanvas = document.createElement('canvas');
    sparkCanvas.id = 'global-click-spark';
    sparkCanvas.style.cssText = 'position:fixed;inset:0;width:100%;height:100%;pointer-events:none;mix-blend-mode:difference;z-index:9999;';
    document.body.appendChild(sparkCanvas);
  }

  /* ── Grab elements now that HTML is in the DOM ── */
  var header      = document.getElementById('sk-header');
  var hamburger   = document.getElementById('sk-hamburger-btn');
  var sidebar     = document.getElementById('sk-nav-sidebar');
  var backdrop    = document.getElementById('sk-nav-backdrop');
  var closeBtn    = document.getElementById('sk-sidebar-close');
  var searchBtn   = document.getElementById('sk-search-btn');
  var searchPanel = document.getElementById('sk-search-panel');
  var searchClose = document.getElementById('sk-search-close-btn');
  var searchInput = document.getElementById('sk-search-input');
  var searchForm  = document.getElementById('sk-search-form');
  var searchRes   = document.getElementById('sk-search-results');

  var navItems    = sidebar.querySelectorAll('.sk-nav-item');
  var footerLinks = sidebar.querySelectorAll('.sk-social-btn');
  var sideHead    = sidebar.querySelector('.sk-sidebar-header');
  var sideImg     = sidebar.querySelector('.sk-sidebar-image img');

  var navOpen    = false;
  var searchOpen = false;
  var lastScrollY       = 0;
  var HIDE_AFTER        = 140;
  var STICKY_THRESHOLD  = 60;

  /* ── Initial GSAP states ── */
  gsap.set(sidebar,     { x: '-100%' });
  gsap.set(backdrop,    { autoAlpha: 0 });
  gsap.set(searchPanel, { autoAlpha: 0, y: -8 });

  /* ── Header: transparent → sticky + hide/show on scroll ── */
  function onScroll() {
    var y       = window.scrollY;
    var scrolled = y > STICKY_THRESHOLD;
    header.classList.toggle('is-scrolled',    scrolled);
    header.classList.toggle('is-transparent', !scrolled);
    if (y > HIDE_AFTER) {
      header.classList.toggle('is-hidden', y > lastScrollY);
    } else {
      header.classList.remove('is-hidden');
    }
    lastScrollY = y;
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ── Open sidebar ── */
  function openNav() {
    navOpen = true;
    hamburger.setAttribute('aria-expanded', 'true');
    var scrollbarW = window.innerWidth - document.documentElement.clientWidth;
    document.body.style.paddingRight = scrollbarW ? scrollbarW + 'px' : '';
    document.body.style.overflow = 'hidden';
    var rm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var tl = gsap.timeline({ defaults: { ease: 'expo.out' } });
    tl.to(backdrop, { autoAlpha: 1, duration: rm ? 0.01 : 0.65 }, 0);
    tl.to(sidebar,  { x: '0%',     duration: rm ? 0.01 : 0.78 }, 0);
    if (sideImg && !rm) {
      tl.from(sideImg, { scale: 1.1, duration: 1.1, ease: 'power3.out', clearProps: 'transform' }, 0);
    }
    tl.from(sideHead, {
      autoAlpha: 0, y: 8,
      duration: rm ? 0 : 0.45, clearProps: 'all'
    }, rm ? 0 : 0.32);
    tl.from(navItems, {
      autoAlpha: 0, x: -22, y: 10,
      duration: rm ? 0 : 0.55,
      stagger:  rm ? 0 : { each: 0.09 },
      clearProps: 'all'
    }, rm ? 0 : 0.38);
    tl.from(footerLinks, {
      autoAlpha: 0, y: 8,
      duration: rm ? 0 : 0.4,
      stagger:  rm ? 0 : { each: 0.07 },
      ease: 'power3.out', clearProps: 'all'
    }, rm ? 0 : 0.76);
    tl.call(function () { closeBtn.focus(); });
  }

  /* ── Close sidebar ── */
  function closeNav() {
    navOpen = false;
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    var rm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var tl = gsap.timeline();
    tl.to(sidebar,  { x: '-100%', duration: rm ? 0.01 : 0.56, ease: 'power4.inOut' }, 0);
    tl.to(backdrop, { autoAlpha: 0, duration: rm ? 0.01 : 0.42, ease: 'power2.in' }, rm ? 0 : 0.08);
  }

  hamburger.addEventListener('click', openNav);
  closeBtn.addEventListener('click',  closeNav);
  backdrop.addEventListener('click',  closeNav);
  navItems.forEach(function (a) { a.addEventListener('click', closeNav); });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      if (navOpen)    closeNav();
      if (searchOpen) closeSearch();
    }
  });

  sidebar.addEventListener('keydown', function (e) {
    if (!navOpen || e.key !== 'Tab') return;
    var focusable = Array.from(
      sidebar.querySelectorAll('button, a, input, [tabindex]:not([tabindex="-1"])')
    ).filter(function (el) { return !el.disabled; });
    if (!focusable.length) return;
    var first = focusable[0];
    var last  = focusable[focusable.length - 1];
    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault(); last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault(); first.focus();
    }
  });

  /* ── Search ── */
  function openSearch() {
    searchOpen = true;
    searchBtn.setAttribute('aria-expanded', 'true');
    gsap.to(searchPanel, { autoAlpha: 1, y: 0, duration: 0.28, ease: 'power2.out' });
    requestAnimationFrame(function () { searchInput.focus(); });
  }
  function closeSearch() {
    searchOpen = false;
    searchBtn.setAttribute('aria-expanded', 'false');
    searchInput.value = '';
    searchRes.textContent = '';
    searchRes.classList.remove('has-message');
    gsap.to(searchPanel, { autoAlpha: 0, y: -8, duration: 0.22, ease: 'power2.in' });
  }

  searchBtn.addEventListener('click',  function () { if (searchOpen) closeSearch(); else openSearch(); });
  searchClose.addEventListener('click', closeSearch);

  searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    var q = searchInput.value.trim();
    if (!q) return;
    searchRes.classList.add('has-message');
    searchRes.innerHTML = '<span style="color:#374151">No results found for “'
      + escapeHtml(q) + '” — full search will be available once all pages are live.</span>';
  });
  searchInput.addEventListener('input', function () {
    if (searchRes.classList.contains('has-message')) {
      searchRes.textContent = '';
      searchRes.classList.remove('has-message');
    }
  });
  function escapeHtml(str) {
    return str.replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  /* ── Hamburger hover: top rises, bottom drops ── */
  (function () {
    var rm    = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (rm) return;
    var spans = hamburger.querySelectorAll('span');
    var top   = spans[0];
    var bot   = spans[2];
    hamburger.addEventListener('mouseenter', function () {
      gsap.to(top, { y: -3, duration: 0.38, ease: 'expo.out' });
      gsap.to(bot, { y:  3, duration: 0.38, ease: 'expo.out' });
    });
    hamburger.addEventListener('mouseleave', function () {
      gsap.to(top, { y: 0, duration: 0.28, ease: 'expo.out' });
      gsap.to(bot, { y: 0, duration: 0.28, ease: 'expo.out' });
    });
    hamburger.addEventListener('click', function () {
      gsap.set([top, bot], { y: 0 });
    });
  })();

  /* ── Sidebar social icon micro-animations ── */
  (function () {
    var rm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (rm) return;

    var phoneBtn = document.querySelector('.sk-social-btn--phone');
    if (phoneBtn) {
      var phoneSvg = phoneBtn.querySelector('svg');
      var phoneTl  = gsap.timeline({ paused: true });
      phoneTl
        .to(phoneSvg, { rotation: 18, duration: 0.18, ease: 'power2.out', transformOrigin: '50% 50%' })
        .to(phoneSvg, { rotation: 0,  duration: 0.5,  ease: 'power3.out' });
      phoneBtn.addEventListener('mouseenter', function () { phoneTl.restart(); });
    }

    var mailBtn = document.querySelector('.sk-social-btn--mail');
    if (mailBtn) {
      var flap   = mailBtn.querySelector('.env-flap');
      var mailTl = gsap.timeline({ paused: true });
      mailTl
        .to(flap, { attr: { points: '22,5 12,2 2,5'  }, duration: 0.2,  ease: 'power2.out' })
        .to(flap, { attr: { points: '22,6 12,13 2,6' }, duration: 0.38, ease: 'power3.inOut' });
      mailBtn.addEventListener('mouseenter', function () { mailTl.restart(); });
    }

    var fbBtn = document.querySelector('.sk-social-btn--fb');
    if (fbBtn) {
      var fbSvg = fbBtn.querySelector('svg');
      var fbTl  = gsap.timeline({ paused: true });
      fbTl
        .to(fbSvg, { y: -4, duration: 0.2,  ease: 'power2.out' })
        .to(fbSvg, { y:  0, duration: 0.45, ease: 'power3.out' });
      fbBtn.addEventListener('mouseenter', function () { fbTl.restart(); });
    }
  })();

  /* ── Lenis smooth scroll + ScrollTrigger sync ── */
  (function () {
    var reduced   = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var isTouch   = window.matchMedia('(pointer: coarse)').matches || ('ontouchstart' in window);
    gsap.registerPlugin(ScrollTrigger);
    if (!reduced && !isTouch && typeof Lenis !== 'undefined') {
      var lenis = new Lenis({
        duration: 1.15,
        easing: function (t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); }
      });
      lenis.on('scroll', ScrollTrigger.update);
      gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
      gsap.ticker.lagSmoothing(0);
    }
  })();

  /* ── Footer entrance animation ── */
  (function () {
    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced) return;
    var footer = document.getElementById('sk-footer');
    if (!footer) return;
    var tagline = footer.querySelector('.sk-footer__tagline');
    var rule    = footer.querySelector('.sk-footer__rule');
    var logos   = footer.querySelector('.sk-footer__logos');
    var cols    = footer.querySelectorAll('.sk-footer__col');
    var bottom  = footer.querySelector('.sk-footer__bottom');
    gsap.set(rule, { scaleX: 0 });
    gsap.timeline({
      scrollTrigger: {
        trigger: footer,
        start:   'top 88%',
        toggleActions: 'play none none none'
      }
    })
    .fromTo(tagline, { y: 22, opacity: 0 }, { y: 0, opacity: 1, duration: 0.85, ease: 'expo.out' })
    .to(rule,        { scaleX: 1, duration: 0.7, ease: 'expo.out', transformOrigin: 'center' }, '-=0.5')
    .fromTo(logos,   { y: 16, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6,  ease: 'expo.out' }, '-=0.35')
    .fromTo(cols,    { y: 18, opacity: 0 }, { y: 0, opacity: 1, duration: 0.65, ease: 'expo.out', stagger: 0.12 }, '-=0.3')
    .fromTo(bottom,  { opacity: 0 },        { opacity: 1,        duration: 0.5,  ease: 'expo.out' }, '-=0.15');
  })();

  /* ── Character-by-character heading reveal ── */
  (function () {
    function splitGraphemes(text) {
      if (typeof Intl !== 'undefined' && 'Segmenter' in Intl) {
        var seg = new Intl.Segmenter('en', { granularity: 'grapheme' });
        return Array.from(seg.segment(text), function (s) { return s.segment; });
      }
      return Array.from(text);
    }

    function setup() {
      var reduced  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      var isMobile = window.matchMedia('(max-width: 768px)').matches;
      var reveals  = document.querySelectorAll('.scroll-text-reveal');

      reveals.forEach(function (el) {
        var text  = el.dataset.text || el.textContent.trim();
        var words = text.split(' ');
        el.innerHTML = '';
        var charIdx = 0;

        words.forEach(function (word, wi) {
          var wordSpan = document.createElement('span');
          wordSpan.className = 'scroll-text-word';

          splitGraphemes(word).forEach(function (char) {
            var charSpan = document.createElement('span');
            charSpan.className = 'scroll-text-char';
            charSpan.textContent = char;
            if (!reduced) {
              /* Mobile: stagger by word so whole words rise together (stagger-up).
                 Desktop: stagger by character for the finer char-by-char reveal. */
              charSpan.style.setProperty('--char-index', isMobile ? wi * 3 : charIdx);
            }
            wordSpan.appendChild(charSpan);
            charIdx++;
          });

          el.appendChild(wordSpan);
          if (wi < words.length - 1) el.appendChild(document.createTextNode(' '));
        });

        if (reduced) el.classList.add('is-visible');
      });

      document.body.classList.add('js-loaded');

      if (reduced) return;

      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });

      reveals.forEach(function (el) { observer.observe(el); });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', setup);
    } else {
      setup();
    }
  })();

  /* ── Click spark ── */
  (function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    var canvas = document.getElementById('global-click-spark');
    if (!canvas) return;
    var ctx    = canvas.getContext('2d');
    var sparks = [];
    var dpr    = window.devicePixelRatio || 1;
    var rafId  = null;

    function resize() {
      canvas.width  = window.innerWidth  * dpr;
      canvas.height = window.innerHeight * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }
    resize();
    window.addEventListener('resize', resize);

    document.addEventListener('click', function (e) {
      var now = performance.now();
      for (var i = 0; i < 10; i++) {
        sparks.push({ x: e.clientX, y: e.clientY, angle: (2 * Math.PI * i) / 10, startTime: now });
      }
      if (!rafId) rafId = requestAnimationFrame(draw);
    });

    function ease(t) { return t * (2 - t); }
    function draw(ts) {
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
      for (var i = sparks.length - 1; i >= 0; i--) {
        var s  = sparks[i];
        var el = ts - s.startTime;
        if (el >= 460) { sparks.splice(i, 1); continue; }
        var p  = el / 460;
        var e  = ease(p);
        var d  = e * 24;
        var ll = 12 * (1 - e);
        var x1 = s.x + d  * Math.cos(s.angle);
        var y1 = s.y + d  * Math.sin(s.angle);
        var x2 = s.x + (d + ll) * Math.cos(s.angle);
        var y2 = s.y + (d + ll) * Math.sin(s.angle);
        ctx.strokeStyle = '#ffffff';
        ctx.lineWidth   = 2;
        ctx.lineCap     = 'round';
        ctx.beginPath();
        ctx.moveTo(x1, y1);
        ctx.lineTo(x2, y2);
        ctx.stroke();
      }
      if (sparks.length) {
        rafId = requestAnimationFrame(draw);
      } else {
        rafId = null;
      }
    }
  })();

})();
