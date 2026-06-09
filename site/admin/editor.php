<?php
session_start();
if (!isset($_SESSION['sk_auth'])) {
    header('Location: index.php');
    exit;
}
$contentFile = __DIR__ . '/../content.json';
$c = file_exists($contentFile) ? json_decode(file_get_contents($contentFile), true) : [];
function v($val, $default = '') { return htmlspecialchars($val ?? $default, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>St Kevin's — Content Editor</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy:    '#051E42',
            burgundy:'#8A2232',
            cream:   '#F6F3EE',
            cloud:   '#F0EDE5',
          },
          fontFamily: {
            heading: ['Montserrat', 'sans-serif'],
            body:    ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #F6F3EE; color: #051E42; }

    /* ── Tab bar ── */
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }
    .tab-btn {
      padding: 8px 20px;
      border-radius: 999px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      color: rgba(5,30,66,0.5);
      cursor: pointer;
      border: none;
      background: transparent;
      transition: background 0.15s, color 0.15s, box-shadow 0.15s;
      white-space: nowrap;
    }
    .tab-btn.active {
      background: #ffffff;
      color: #051E42;
      font-weight: 600;
      box-shadow: 0 1px 5px rgba(5,30,66,0.12);
    }
    .tab-btn:hover:not(.active) { color: #051E42; }

    /* ── Card sections ── */
    .section-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 1px 4px rgba(5,30,66,0.07);
      margin-bottom: 20px;
    }
    .section-title {
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: 16px;
      color: #051E42;
      margin-bottom: 4px;
    }
    .section-subtitle {
      font-size: 13px;
      color: rgba(5,30,66,0.5);
      margin-bottom: 20px;
    }
    .divider { height: 1px; background: #E2E6EA; margin: 20px 0; }

    /* ── Group cards (quote / tour groups) ── */
    .group-card {
      background: #F0EDE5;
      border-radius: 10px;
      padding: 16px;
      margin-bottom: 12px;
    }
    .group-label {
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.07em;
      color: #8A2232;
      margin-bottom: 12px;
    }

    /* ── Fields ── */
    .field-label {
      display: block;
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: rgba(5,30,66,0.55);
      margin-bottom: 6px;
    }
    .field-input {
      width: 100%;
      border: 1.5px solid #E2E6EA;
      border-radius: 10px;
      padding: 0 14px;
      height: 44px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
      background: #ffffff;
      color: #051E42;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .field-input:focus {
      outline: none;
      border-color: #051E42;
      box-shadow: 0 0 0 2px rgba(5,30,66,0.15);
    }
    textarea.field-input {
      height: auto;
      min-height: 80px;
      padding: 12px 14px;
      resize: vertical;
    }
    .field-hint {
      font-size: 12px;
      color: rgba(5,30,66,0.45);
      margin-top: 6px;
      line-height: 1.5;
    }

    /* ── Toggle ── */
    .toggle-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 4px;
    }
    .toggle-switch {
      position: relative;
      width: 44px;
      height: 24px;
      flex-shrink: 0;
    }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-track {
      position: absolute;
      inset: 0;
      background: #D1D5DB;
      border-radius: 999px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .toggle-track::after {
      content: '';
      position: absolute;
      top: 3px; left: 3px;
      width: 18px; height: 18px;
      background: white;
      border-radius: 50%;
      transition: transform 0.2s;
    }
    .toggle-switch input:checked + .toggle-track { background: #051E42; }
    .toggle-switch input:checked + .toggle-track::after { transform: translateX(20px); }
    .toggle-label { font-size: 14px; font-family: 'Inter', sans-serif; color: #051E42; }

    .announcement-extra { display: none; }
    .announcement-extra.visible { display: block; }

    /* ── Save button ── */
    .save-btn {
      background: #051E42;
      color: #ffffff;
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
      font-size: 14px;
      height: 44px;
      padding: 0 28px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.15s, opacity 0.15s;
    }
    .save-btn:hover { background: #0A2D5C; }
    .save-btn:disabled { opacity: 0.55; cursor: not-allowed; }

    /* ── Toast ── */
    #toast {
      position: fixed;
      bottom: 28px;
      right: 28px;
      z-index: 9999;
      width: 320px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(5,30,66,0.18);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: opacity 0.3s, transform 0.3s;
      opacity: 0;
      transform: translateY(12px);
      pointer-events: none;
    }
    #toast.show {
      opacity: 1;
      transform: translateY(0);
    }
    #toast .toast-bar {
      position: absolute;
      left: 0; top: 0; bottom: 0;
      width: 4px;
      border-radius: 16px 0 0 16px;
    }
    #toast .toast-bar.success { background: #16A34A; }
    #toast .toast-bar.error   { background: #DC2626; }
    #toast-msg {
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      color: #051E42;
      font-weight: 500;
    }
  </style>
</head>
<body class="min-h-screen">

  <!-- ═══════════════════════════════════════ TOP NAV ═══ -->
  <header style="position:sticky;top:0;z-index:50;background:#ffffff;border-bottom:1px solid #E2E6EA;box-shadow:0 1px 4px rgba(5,30,66,0.06);">
    <div style="max-width:900px;margin:0 auto;padding:0 24px;height:56px;display:flex;align-items:center;justify-content:space-between;">

      <!-- Left: logo mark + wordmark -->
      <div style="display:flex;align-items:center;gap:12px;">
        <!-- Burgundy cross -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect x="10" y="2"  width="4" height="20" rx="2" fill="#8A2232"/>
          <rect x="2"  y="10" width="20" height="4" rx="2" fill="#8A2232"/>
        </svg>
        <span style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:15px;color:#051E42;">St Kevin's</span>
        <span style="color:#D1D5DB;font-size:14px;margin:0 2px;">|</span>
        <span style="font-family:'Inter',sans-serif;font-size:14px;color:rgba(5,30,66,0.5);font-weight:400;">Content Editor</span>
      </div>

      <!-- Right: actions -->
      <div style="display:flex;align-items:center;gap:8px;">
        <a href="../index.html" target="_blank"
           style="display:flex;align-items:center;gap:6px;font-family:'Inter',sans-serif;font-size:13px;color:rgba(5,30,66,0.55);text-decoration:none;padding:6px 14px;border-radius:8px;transition:background 0.15s,color 0.15s;"
           onmouseover="this.style.background='#F0EDE5';this.style.color='#051E42';"
           onmouseout="this.style.background='transparent';this.style.color='rgba(5,30,66,0.55)';">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Preview Site
        </a>
        <a href="?logout=1"
           style="display:flex;align-items:center;gap:6px;font-family:'Inter',sans-serif;font-size:13px;color:rgba(5,30,66,0.55);text-decoration:none;padding:6px 14px;border-radius:8px;transition:background 0.15s,color 0.15s;"
           onmouseover="this.style.background='#FEE2E2';this.style.color='#DC2626';"
           onmouseout="this.style.background='transparent';this.style.color='rgba(5,30,66,0.55)';">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Logout
        </a>
      </div>
    </div>
  </header>

  <!-- ═══════════════════════════════════════ MAIN CONTENT ═══ -->
  <div style="max-width:760px;margin:0 auto;padding:32px 24px 64px;">

    <!-- Tab bar -->
    <div style="background:#F0EDE5;border-radius:999px;padding:5px;display:flex;gap:4px;margin-bottom:32px;overflow-x:auto;">
      <?php
      $tabs = [
        'global'      => 'Global',
        'homepage'    => 'Homepage',
        'enrolments'  => 'Enrolments',
        'about'       => 'About',
        'contact'     => 'Contact',
      ];
      $first = true;
      foreach ($tabs as $key => $label):
      ?>
      <button onclick="switchTab('<?= $key ?>', this)"
        class="tab-btn <?= $first ? 'active' : '' ?>">
        <?= $label ?>
      </button>
      <?php $first = false; endforeach; ?>
    </div>

    <!-- ═══ GLOBAL TAB ═══ -->
    <div id="tab-global" class="tab-panel active">
      <div class="section-card">
        <div class="section-title">School Details</div>
        <div class="section-subtitle">Contact information and social links shown sitewide.</div>

        <div style="display:grid;gap:16px;">
          <div>
            <label class="field-label" for="g-phone">Phone</label>
            <input type="text" id="g-phone" class="field-input"
              value="<?= v($c['global']['phone'] ?? '(03) 9709 8600') ?>">
          </div>
          <div>
            <label class="field-label" for="g-email">Email</label>
            <input type="email" id="g-email" class="field-input"
              value="<?= v($c['global']['email'] ?? 'administration@skhamptonpark.catholic.edu.au') ?>">
          </div>
          <div>
            <label class="field-label" for="g-address">Address</label>
            <input type="text" id="g-address" class="field-input"
              value="<?= v($c['global']['address'] ?? '120 Hallam Rd, Hampton Park VIC 3976') ?>">
          </div>
          <div>
            <label class="field-label" for="g-facebook">Facebook URL</label>
            <input type="url" id="g-facebook" class="field-input"
              value="<?= v($c['global']['facebookUrl'] ?? '#') ?>">
          </div>
          <div>
            <label class="field-label" for="g-principal">Principal Name</label>
            <input type="text" id="g-principal" class="field-input"
              value="<?= v($c['global']['principalName'] ?? 'Jason Micallef') ?>">
          </div>
        </div>

        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end;">
          <button class="save-btn" onclick="saveTab('global', event)">Save Changes</button>
        </div>
      </div>
    </div>

    <!-- ═══ HOMEPAGE TAB ═══ -->
    <div id="tab-homepage" class="tab-panel">

      <!-- Quotes Carousel -->
      <div class="section-card">
        <div class="section-title">Quotes Carousel</div>
        <div class="section-subtitle">Rotating quotes shown on the homepage hero.</div>

        <?php for ($i = 0; $i < 6; $i++):
          $q = $c['homepage']['quotes'][$i] ?? [];
        ?>
        <div class="group-card">
          <div class="group-label">Quote <?= $i + 1 ?></div>
          <div style="display:grid;gap:12px;">
            <div>
              <label class="field-label" for="quote-<?= $i ?>-text">Quote Text</label>
              <textarea id="quote-<?= $i ?>-text" class="field-input"><?= v($q['text'] ?? '') ?></textarea>
            </div>
            <div>
              <label class="field-label" for="quote-<?= $i ?>-author">Author</label>
              <input type="text" id="quote-<?= $i ?>-author" class="field-input"
                value="<?= v($q['author'] ?? '') ?>">
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>

        <!-- Announcement Banner -->
        <div class="section-title" style="margin-bottom:4px;">Announcement Banner</div>
        <div class="section-subtitle">Optional banner shown at top of homepage.</div>

        <?php
          $ann = $c['homepage']['announcement'] ?? [];
          $annEnabled = !empty($ann['enabled']);
        ?>
        <div class="group-card">
          <div class="toggle-row" style="margin-bottom:16px;">
            <label class="toggle-switch">
              <input type="checkbox" id="ann-enabled" <?= $annEnabled ? 'checked' : '' ?>
                onchange="toggleAnnouncement(this.checked)">
              <span class="toggle-track"></span>
            </label>
            <span class="toggle-label">Enable announcement banner</span>
          </div>

          <div id="ann-extra" class="announcement-extra <?= $annEnabled ? 'visible' : '' ?>"
               style="display:<?= $annEnabled ? 'grid' : 'none' ?>;gap:12px;">
            <div>
              <label class="field-label" for="ann-text">Announcement Text</label>
              <input type="text" id="ann-text" class="field-input"
                value="<?= v($ann['text'] ?? '') ?>">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
              <div>
                <label class="field-label" for="ann-linklabel">Link Label</label>
                <input type="text" id="ann-linklabel" class="field-input"
                  value="<?= v($ann['linkLabel'] ?? '') ?>">
              </div>
              <div>
                <label class="field-label" for="ann-linkurl">Link URL</label>
                <input type="url" id="ann-linkurl" class="field-input"
                  value="<?= v($ann['linkUrl'] ?? '') ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end;">
          <button class="save-btn" onclick="saveTab('homepage', event)">Save Changes</button>
        </div>
      </div>
    </div>

    <!-- ═══ ENROLMENTS TAB ═══ -->
    <div id="tab-enrolments" class="tab-panel">

      <!-- Tour Dates -->
      <div class="section-card">
        <div class="section-title">School Tour Dates</div>
        <div class="section-subtitle">Upcoming open day / tour dates shown on the enrolments page.</div>

        <?php for ($i = 0; $i < 3; $i++):
          $tour = $c['enrolments']['tourDates'][$i] ?? [];
        ?>
        <div class="group-card">
          <div class="group-label">Tour <?= $i + 1 ?></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <div>
              <label class="field-label" for="tour-<?= $i ?>-date">Date</label>
              <input type="text" id="tour-<?= $i ?>-date" class="field-input"
                value="<?= v($tour['date'] ?? '') ?>" placeholder="e.g. Wednesday 23 July 2025">
            </div>
            <div>
              <label class="field-label" for="tour-<?= $i ?>-time">Time</label>
              <input type="text" id="tour-<?= $i ?>-time" class="field-input"
                value="<?= v($tour['time'] ?? '') ?>" placeholder="e.g. 9:30 AM">
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>

        <!-- Enquiry Note -->
        <div class="section-title" style="margin-bottom:4px;">Enquiry Note</div>
        <div class="section-subtitle">Short note displayed beneath the enquiry form.</div>
        <div>
          <label class="field-label" for="enrol-enquiry">Enquiry Note</label>
          <textarea id="enrol-enquiry" class="field-input"><?= v($c['enrolments']['enquiryNote'] ?? '') ?></textarea>
        </div>

        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end;">
          <button class="save-btn" onclick="saveTab('enrolments', event)">Save Changes</button>
        </div>
      </div>
    </div>

    <!-- ═══ ABOUT TAB ═══ -->
    <div id="tab-about" class="tab-panel">
      <div class="section-card">
        <div class="section-title">About the School</div>
        <div class="section-subtitle">Key statements shown on the About page.</div>

        <div style="display:grid;gap:16px;">
          <div>
            <label class="field-label" for="about-principal">Principal's Message</label>
            <textarea id="about-principal" class="field-input" style="min-height:120px;"><?= v($c['about']['principalMessage'] ?? '') ?></textarea>
          </div>
          <div>
            <label class="field-label" for="about-mission">Mission Statement</label>
            <textarea id="about-mission" class="field-input"><?= v($c['about']['missionStatement'] ?? '') ?></textarea>
          </div>
          <div>
            <label class="field-label" for="about-vision">Vision Statement</label>
            <textarea id="about-vision" class="field-input"><?= v($c['about']['visionStatement'] ?? '') ?></textarea>
          </div>
        </div>

        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end;">
          <button class="save-btn" onclick="saveTab('about', event)">Save Changes</button>
        </div>
      </div>
    </div>

    <!-- ═══ CONTACT TAB ═══ -->
    <div id="tab-contact" class="tab-panel">
      <div class="section-card">
        <div class="section-title">Contact Page</div>
        <div class="section-subtitle">Settings for the contact page map and details.</div>

        <div>
          <label class="field-label" for="contact-map">Google Maps Embed URL</label>
          <textarea id="contact-map" class="field-input" style="min-height:100px;"><?= v($c['contact']['mapEmbedUrl'] ?? '') ?></textarea>
          <p class="field-hint">Get this from Google Maps &rarr; Share &rarr; Embed a map &rarr; Copy the <strong>iframe src URL only</strong> (not the full &lt;iframe&gt; tag).</p>
        </div>

        <div class="divider"></div>
        <div style="display:flex;justify-content:flex-end;">
          <button class="save-btn" onclick="saveTab('contact', event)">Save Changes</button>
        </div>
      </div>
    </div>

  </div><!-- /main content -->

  <!-- ═══════════════════════════════════════ TOAST ═══ -->
  <div id="toast" role="alert" aria-live="polite">
    <span class="toast-bar" id="toast-bar"></span>
    <span id="toast-msg">Saved!</span>
  </div>

<script>
// ── Tab switching ─────────────────────────────────────────────────────────────
function switchTab(name, btn) {
  document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  btn.classList.add('active');
}

// ── Announcement toggle ───────────────────────────────────────────────────────
function toggleAnnouncement(checked) {
  const extra = document.getElementById('ann-extra');
  if (checked) {
    extra.style.display = 'grid';
  } else {
    extra.style.display = 'none';
  }
}

// ── Helpers ───────────────────────────────────────────────────────────────────
function val(id) {
  const el = document.getElementById(id);
  if (!el) return undefined;
  if (el.type === 'checkbox') return el.checked;
  return el.value;
}

// ── Toast ─────────────────────────────────────────────────────────────────────
let _toastTimer = null;
function showToast(msg, success = true) {
  const t   = document.getElementById('toast');
  const bar = document.getElementById('toast-bar');
  document.getElementById('toast-msg').textContent = msg;
  bar.className = 'toast-bar ' + (success ? 'success' : 'error');
  t.classList.add('show');
  clearTimeout(_toastTimer);
  _toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
}

// ── Build payloads per tab ────────────────────────────────────────────────────
const payloads = {
  global: () => ({
    global: {
      phone:         val('g-phone'),
      email:         val('g-email'),
      address:       val('g-address'),
      facebookUrl:   val('g-facebook'),
      principalName: val('g-principal'),
    }
  }),

  homepage: () => ({
    homepage: {
      quotes: [0,1,2,3,4,5].map(i => ({
        text:   val(`quote-${i}-text`),
        author: val(`quote-${i}-author`),
      })),
      announcement: {
        enabled:   val('ann-enabled'),
        text:      val('ann-text') || '',
        linkLabel: val('ann-linklabel') || '',
        linkUrl:   val('ann-linkurl') || '',
      }
    }
  }),

  enrolments: () => ({
    enrolments: {
      tourDates: [0,1,2].map(i => ({
        date: val(`tour-${i}-date`),
        time: val(`tour-${i}-time`),
      })),
      enquiryNote: val('enrol-enquiry'),
    }
  }),

  about: () => ({
    about: {
      principalMessage: val('about-principal'),
      missionStatement: val('about-mission'),
      visionStatement:  val('about-vision'),
    }
  }),

  contact: () => ({
    contact: {
      mapEmbedUrl: val('contact-map'),
    }
  }),
};

// ── Save ──────────────────────────────────────────────────────────────────────
async function saveTab(tab, event) {
  const btn = event.currentTarget;
  btn.disabled = true;
  const orig = btn.textContent;
  btn.textContent = 'Saving…';

  try {
    const data   = payloads[tab]();
    const res    = await fetch('../admin/api.php', {
      method:  'POST',
      headers: { 'Content-Type': 'application/json' },
      body:    JSON.stringify(data),
    });
    const result = await res.json();
    if (result.success) {
      showToast('Saved!', true);
    } else {
      showToast(result.error || 'Save failed', false);
    }
  } catch (e) {
    showToast('Network error — check server', false);
  }

  btn.disabled = false;
  btn.textContent = orig;
}
</script>
</body>
</html>
