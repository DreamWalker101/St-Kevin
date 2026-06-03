<?php
session_start();
if (!isset($_SESSION['nwork_auth'])) {
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
  <title>nWork — Content Editor</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#5d5699',
            'primary-light': '#bcb4ff',
            tertiary: '#476733',
            'tertiary-light': '#c9eaa0',
            surface: '#fbf9f8',
            'surface-container': '#f0eded',
            'surface-container-low': '#f6f3f2',
            'surface-container-high': '#eae8e7',
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f6f3f2; }
    .signature-gradient { background: linear-gradient(135deg, #5d5699, #bcb4ff); }
    .material-symbols-outlined { font-family: 'Material Symbols Outlined'; font-weight: normal; font-style: normal; font-size: 20px; line-height: 1; text-transform: none; display: inline-block; white-space: nowrap; -webkit-font-smoothing: antialiased; }
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }
    .tab-btn { transition: all 0.15s ease; }
    .tab-btn.active { background: white; color: #5d5699; font-weight: 700; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
    .field-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #737a66; margin-bottom: 6px; display: block; }
    .field-input { width: 100%; border: 1px solid #d4d4d4; border-radius: 10px; padding: 10px 14px; font-size: 14px; font-family: 'Inter', sans-serif; transition: border-color 0.15s, box-shadow 0.15s; background: white; }
    .field-input:focus { outline: none; border-color: #bcb4ff; box-shadow: 0 0 0 3px rgba(188,180,255,0.2); }
    textarea.field-input { resize: vertical; min-height: 80px; }
    .card-group { background: #f0eded; border-radius: 14px; padding: 16px; margin-bottom: 12px; }
    .card-group-label { font-size: 10px; font-weight: 800; color: #5d5699; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 10px; }
    .save-btn { background: linear-gradient(135deg, #5d5699, #bcb4ff); color: white; border: none; border-radius: 12px; padding: 12px 28px; font-size: 14px; font-weight: 700; cursor: pointer; transition: opacity 0.15s, transform 0.1s; }
    .save-btn:hover { opacity: 0.9; }
    .save-btn:active { transform: scale(0.97); }
    .section-title { font-size: 18px; font-weight: 800; color: #1b1c1c; margin-bottom: 4px; }
    .section-subtitle { font-size: 13px; color: #737a66; margin-bottom: 24px; }
    .divider { height: 1px; background: #e4e2e1; margin: 20px 0; }
  </style>
</head>
<body class="min-h-screen">

  <!-- Top Navigation -->
  <header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 h-14 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="signature-gradient w-8 h-8 rounded-xl flex items-center justify-center">
          <span class="text-white font-black text-sm">n</span>
        </div>
        <span class="font-black text-gray-900">nWork</span>
        <span class="text-gray-300 text-sm mx-1">/</span>
        <span class="text-sm text-gray-500 font-medium">Content Editor</span>
      </div>
      <div class="flex items-center gap-3">
        <a href="../index.html" target="_blank" class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 transition px-3 py-1.5 rounded-lg hover:bg-gray-100">
          <span class="material-symbols-outlined text-base">open_in_new</span>
          Preview Site
        </a>
        <a href="?logout=1" class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-red-600 transition px-3 py-1.5 rounded-lg hover:bg-red-50">
          <span class="material-symbols-outlined text-base">logout</span>
          Logout
        </a>
      </div>
    </div>
  </header>

  <div class="max-w-6xl mx-auto px-6 py-8">

    <!-- Tab Bar -->
    <div class="bg-surface-container rounded-2xl p-1.5 flex gap-1 mb-8 overflow-x-auto">
      <?php
      $tabs = [
        'hero'          => ['label' => 'Hero',          'icon' => 'home'],
        'features'      => ['label' => 'Features',      'icon' => 'grid_view'],
        'capabilities'  => ['label' => 'Capabilities',  'icon' => 'bolt'],
        'benefits'      => ['label' => 'Benefits',      'icon' => 'favorite'],
        'testimonials'  => ['label' => 'Testimonials',  'icon' => 'format_quote'],
        'faq'           => ['label' => 'FAQ',            'icon' => 'help'],
        'cta'           => ['label' => 'CTA',            'icon' => 'ads_click'],
        'footer'        => ['label' => 'Footer',         'icon' => 'bottom_navigation'],
      ];
      $first = true;
      foreach ($tabs as $key => $tab):
      ?>
      <button onclick="switchTab('<?= $key ?>', this)"
        class="tab-btn <?= $first ? 'active' : '' ?> flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-500 whitespace-nowrap">
        <span class="material-symbols-outlined text-base"><?= $tab['icon'] ?></span>
        <?= $tab['label'] ?>
      </button>
      <?php $first = false; endforeach; ?>
    </div>

    <!-- ===== HERO TAB ===== -->
    <div id="tab-hero" class="tab-panel active">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Hero Section</div>
        <div class="section-subtitle">The first thing visitors see — make it count.</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="md:col-span-2">
            <label class="field-label">Main Heading</label>
            <textarea id="hero-heading" class="field-input" rows="2"><?= v($c['hero']['heading'] ?? '') ?></textarea>
          </div>
          <div class="md:col-span-2">
            <label class="field-label">Subheading</label>
            <textarea id="hero-sub" class="field-input" rows="2"><?= v($c['hero']['subheading'] ?? '') ?></textarea>
          </div>
          <div>
            <label class="field-label">CTA Button Label</label>
            <input type="text" id="hero-cta" class="field-input" value="<?= v($c['hero']['ctaLabel'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Badge Text</label>
            <input type="text" id="hero-badge" class="field-input" value="<?= v($c['hero']['badge'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Stat Number (e.g. 50+)</label>
            <input type="text" id="hero-stat-num" class="field-input" value="<?= v($c['hero']['statNumber'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Stat Label (e.g. Clients Secured)</label>
            <input type="text" id="hero-stat-label" class="field-input" value="<?= v($c['hero']['statLabel'] ?? '') ?>">
          </div>
        </div>

        <div class="divider"></div>
        <div class="card-group">
          <div class="card-group-label">Hero Image</div>
          <div class="flex items-center gap-5">
            <div class="w-28 h-28 rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex-shrink-0 flex items-center justify-center">
              <?php $heroImg = $c['hero']['image'] ?? ''; ?>
              <img id="hero-img-preview" src="<?= $heroImg ? '../' . v($heroImg) : '' ?>"
                   class="w-full h-full object-cover <?= $heroImg ? '' : 'hidden' ?>">
              <?php if (!$heroImg): ?>
              <span class="material-symbols-outlined text-gray-300 text-3xl">image</span>
              <?php endif; ?>
            </div>
            <input type="hidden" id="hero-img-val" value="<?= v($heroImg) ?>">
            <div class="flex flex-col gap-2">
              <button type="button" onclick="openMediaLibrary('hero-img-val','hero-img-preview')"
                class="flex items-center gap-2 text-sm font-semibold text-white rounded-xl px-4 py-2 transition"
                style="background:linear-gradient(135deg,#5d5699,#bcb4ff)">
                <span class="material-symbols-outlined text-base">photo_library</span>
                Change Image
              </button>
              <button type="button" onclick="clearImage('hero-img-val','hero-img-preview')"
                class="flex items-center gap-2 text-sm text-gray-400 hover:text-red-500 transition px-1">
                <span class="material-symbols-outlined text-sm">delete</span>
                Remove
              </button>
            </div>
          </div>
        </div>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('hero')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Hero</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== FEATURES TAB ===== -->
    <div id="tab-features" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Feature Cards</div>
        <div class="section-subtitle">The 3 cards shown in the features section.</div>

        <?php for ($i = 0; $i < 3; $i++):
          $card = $c['features']['cards'][$i] ?? [];
        ?>
        <div class="card-group">
          <div class="card-group-label">Card <?= $i+1 ?></div>
          <div class="grid grid-cols-1 gap-3">
            <div>
              <label class="field-label">Title</label>
              <input type="text" id="feat-<?= $i ?>-title" class="field-input" value="<?= v($card['title'] ?? '') ?>">
            </div>
            <div>
              <label class="field-label">Description</label>
              <textarea id="feat-<?= $i ?>-desc" class="field-input" rows="2"><?= v($card['description'] ?? '') ?></textarea>
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('features')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Features</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== CAPABILITIES TAB ===== -->
    <div id="tab-capabilities" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Capabilities (Dark Section)</div>
        <div class="section-subtitle">The dark bento grid section with stats below.</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
          <div>
            <label class="field-label">Section Heading</label>
            <input type="text" id="cap-heading" class="field-input" value="<?= v($c['capabilities']['heading'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Section Subheading</label>
            <input type="text" id="cap-subheading" class="field-input" value="<?= v($c['capabilities']['subheading'] ?? '') ?>">
          </div>
        </div>

        <div class="divider"></div>
        <div class="card-group-label" style="color:#1b1c1c;font-size:13px;font-weight:700;margin-bottom:12px;">Capability Cards</div>

        <?php for ($i = 0; $i < 4; $i++):
          $card = $c['capabilities']['cards'][$i] ?? [];
        ?>
        <div class="card-group">
          <div class="card-group-label">Card <?= $i+1 ?></div>
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="field-label">Title</label>
              <input type="text" id="cap-card-<?= $i ?>-title" class="field-input" value="<?= v($card['title'] ?? '') ?>">
            </div>
            <div>
              <label class="field-label">Description</label>
              <input type="text" id="cap-card-<?= $i ?>-desc" class="field-input" value="<?= v($card['description'] ?? '') ?>">
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="card-group-label" style="color:#1b1c1c;font-size:13px;font-weight:700;margin-bottom:12px;">Stats Row</div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <?php for ($i = 0; $i < 4; $i++):
            $stat = $c['capabilities']['stats'][$i] ?? [];
          ?>
          <div class="card-group">
            <div class="card-group-label">Stat <?= $i+1 ?></div>
            <div>
              <label class="field-label">Number</label>
              <input type="text" id="stat-<?= $i ?>-num" class="field-input" value="<?= v($stat['number'] ?? '') ?>">
            </div>
            <div class="mt-2">
              <label class="field-label">Label</label>
              <input type="text" id="stat-<?= $i ?>-label" class="field-input" value="<?= v($stat['label'] ?? '') ?>">
            </div>
          </div>
          <?php endfor; ?>
        </div>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('capabilities')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Capabilities</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== BENEFITS TAB ===== -->
    <div id="tab-benefits" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Benefits Section</div>
        <div class="section-subtitle">The green kinetic oval section.</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
          <div>
            <label class="field-label">Heading</label>
            <input type="text" id="benefits-heading" class="field-input" value="<?= v($c['benefits']['heading'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Subheading (inside pill)</label>
            <input type="text" id="benefits-subheading" class="field-input" value="<?= v($c['benefits']['subheading'] ?? '') ?>">
          </div>
          <div class="md:col-span-2">
            <label class="field-label">Description</label>
            <textarea id="benefits-desc" class="field-input" rows="3"><?= v($c['benefits']['description'] ?? '') ?></textarea>
          </div>
        </div>

        <div class="divider"></div>
        <div style="font-size:13px;font-weight:700;color:#1b1c1c;margin-bottom:12px;">Benefit Items</div>

        <?php for ($i = 0; $i < 3; $i++):
          $item = $c['benefits']['items'][$i] ?? [];
        ?>
        <div class="card-group">
          <div class="card-group-label">Item <?= $i+1 ?></div>
          <label class="field-label">Text</label>
          <input type="text" id="benefit-<?= $i ?>-text" class="field-input" value="<?= v($item['text'] ?? '') ?>">
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="card-group">
          <div class="card-group-label">Section Image</div>
          <div class="flex items-center gap-5">
            <div class="w-28 h-28 rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex-shrink-0 flex items-center justify-center">
              <?php $benefitsImg = $c['benefits']['image'] ?? ''; ?>
              <img id="benefits-img-preview" src="<?= $benefitsImg ? '../' . v($benefitsImg) : '' ?>"
                   class="w-full h-full object-cover <?= $benefitsImg ? '' : 'hidden' ?>">
              <?php if (!$benefitsImg): ?>
              <span class="material-symbols-outlined text-gray-300 text-3xl">image</span>
              <?php endif; ?>
            </div>
            <input type="hidden" id="benefits-img-val" value="<?= v($benefitsImg) ?>">
            <div class="flex flex-col gap-2">
              <button type="button" onclick="openMediaLibrary('benefits-img-val','benefits-img-preview')"
                class="flex items-center gap-2 text-sm font-semibold text-white rounded-xl px-4 py-2 transition"
                style="background:linear-gradient(135deg,#5d5699,#bcb4ff)">
                <span class="material-symbols-outlined text-base">photo_library</span>
                Change Image
              </button>
              <button type="button" onclick="clearImage('benefits-img-val','benefits-img-preview')"
                class="flex items-center gap-2 text-sm text-gray-400 hover:text-red-500 transition px-1">
                <span class="material-symbols-outlined text-sm">delete</span>
                Remove
              </button>
            </div>
          </div>
        </div>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('benefits')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Benefits</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== TESTIMONIALS TAB ===== -->
    <div id="tab-testimonials" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Testimonials</div>
        <div class="section-subtitle">Client quotes shown in the social proof section.</div>

        <?php
        $testimonials = $c['testimonials'] ?? [];
        for ($i = 0; $i < 3; $i++):
          $t = $testimonials[$i] ?? [];
        ?>
        <div class="card-group">
          <div class="card-group-label">Testimonial <?= $i+1 ?></div>
          <div class="grid grid-cols-1 gap-3">
            <div>
              <label class="field-label">Quote</label>
              <textarea id="testi-<?= $i ?>-quote" class="field-input" rows="3"><?= v($t['quote'] ?? '') ?></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="field-label">Name</label>
                <input type="text" id="testi-<?= $i ?>-name" class="field-input" value="<?= v($t['name'] ?? '') ?>">
              </div>
              <div>
                <label class="field-label">Role / Company</label>
                <input type="text" id="testi-<?= $i ?>-role" class="field-input" value="<?= v($t['role'] ?? '') ?>">
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('testimonials')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Testimonials</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== FAQ TAB ===== -->
    <div id="tab-faq" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">FAQ Section</div>
        <div class="section-subtitle">Frequently asked questions shown in the grid.</div>

        <?php
        $faqs = $c['faq'] ?? [];
        for ($i = 0; $i < 4; $i++):
          $faq = $faqs[$i] ?? [];
        ?>
        <div class="card-group">
          <div class="card-group-label">FAQ <?= $i+1 ?></div>
          <div class="grid grid-cols-1 gap-3">
            <div>
              <label class="field-label">Question</label>
              <input type="text" id="faq-<?= $i ?>-q" class="field-input" value="<?= v($faq['question'] ?? '') ?>">
            </div>
            <div>
              <label class="field-label">Answer</label>
              <textarea id="faq-<?= $i ?>-a" class="field-input" rows="3"><?= v($faq['answer'] ?? '') ?></textarea>
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('faq')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save FAQ</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== CTA TAB ===== -->
    <div id="tab-cta" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Call to Action</div>
        <div class="section-subtitle">The bottom conversion section.</div>

        <div class="grid grid-cols-1 gap-5">
          <div>
            <label class="field-label">Heading</label>
            <input type="text" id="cta-heading" class="field-input" value="<?= v($c['cta']['heading'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Description</label>
            <textarea id="cta-desc" class="field-input" rows="3"><?= v($c['cta']['description'] ?? '') ?></textarea>
          </div>
          <div>
            <label class="field-label">Button Label</label>
            <input type="text" id="cta-btn" class="field-input" value="<?= v($c['cta']['ctaLabel'] ?? '') ?>">
          </div>
        </div>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('cta')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save CTA</span>
          </button>
        </div>
      </div>
    </div>

    <!-- ===== FOOTER TAB ===== -->
    <div id="tab-footer" class="tab-panel">
      <div class="bg-white rounded-3xl p-8 shadow-sm">
        <div class="section-title">Footer</div>
        <div class="section-subtitle">Contact info, links, and copyright.</div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
          <div>
            <label class="field-label">Email Address</label>
            <input type="email" id="footer-email" class="field-input" value="<?= v($c['footer']['email'] ?? '') ?>">
          </div>
          <div>
            <label class="field-label">Copyright Text</label>
            <input type="text" id="footer-copyright" class="field-input" value="<?= v($c['footer']['copyright'] ?? '') ?>">
          </div>
          <div class="md:col-span-2">
            <label class="field-label">Tagline (below email)</label>
            <input type="text" id="footer-tagline" class="field-input" value="<?= v($c['footer']['tagline'] ?? '') ?>">
          </div>
        </div>

        <div class="divider"></div>
        <div style="font-size:13px;font-weight:700;color:#1b1c1c;margin-bottom:12px;">Social Links</div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
          <?php foreach (['instagram', 'twitter', 'facebook', 'linkedin'] as $soc): ?>
          <div class="card-group">
            <div class="card-group-label"><?= ucfirst($soc) ?></div>
            <label class="field-label">URL</label>
            <input type="text" id="social-<?= $soc ?>" class="field-input" value="<?= v($c['footer']['social'][$soc] ?? '') ?>">
          </div>
          <?php endforeach; ?>
        </div>

        <div class="divider"></div>
        <div style="font-size:13px;font-weight:700;color:#1b1c1c;margin-bottom:12px;">Footer Links</div>
        <?php
        $links = $c['footer']['links'] ?? [];
        for ($i = 0; $i < count($links); $i++):
          $link = $links[$i];
        ?>
        <div class="card-group">
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="field-label">Label</label>
              <input type="text" id="link-<?= $i ?>-label" class="field-input" value="<?= v($link['label'] ?? '') ?>">
            </div>
            <div>
              <label class="field-label">URL</label>
              <input type="text" id="link-<?= $i ?>-href" class="field-input" value="<?= v($link['href'] ?? '') ?>">
            </div>
          </div>
        </div>
        <?php endfor; ?>

        <div class="divider"></div>
        <div class="flex justify-end">
          <button class="save-btn" onclick="saveSection('footer')">
            <span class="flex items-center gap-2"><span class="material-symbols-outlined text-base">save</span>Save Footer</span>
          </button>
        </div>
      </div>
    </div>

  </div><!-- end max-w container -->

  <!-- ===== MEDIA LIBRARY MODAL ===== -->
  <div id="media-modal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeMediaLibrary()"></div>
    <!-- Panel -->
    <div class="absolute inset-4 md:inset-10 bg-white rounded-3xl flex flex-col shadow-2xl overflow-hidden">
      <!-- Header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
        <div class="flex items-center gap-3">
          <span class="material-symbols-outlined text-xl" style="color:#5d5699">photo_library</span>
          <h2 class="text-lg font-bold text-gray-900">Media Library</h2>
          <span id="media-count" class="text-xs bg-gray-100 text-gray-500 rounded-full px-2.5 py-0.5 font-medium"></span>
        </div>
        <div class="flex items-center gap-3">
          <label class="flex items-center gap-2 text-sm font-semibold text-white rounded-xl px-4 py-2 cursor-pointer hover:opacity-90 transition"
                 style="background:linear-gradient(135deg,#5d5699,#bcb4ff)">
            <span class="material-symbols-outlined text-base">upload</span>
            Upload New
            <input type="file" id="media-upload-input" accept="image/*" multiple class="hidden" onchange="uploadMediaImages(this)">
          </label>
          <button onclick="closeMediaLibrary()"
            class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
            <span class="material-symbols-outlined text-base text-gray-600">close</span>
          </button>
        </div>
      </div>
      <!-- Upload progress bar -->
      <div id="media-progress-bar" class="h-1 hidden" style="background:linear-gradient(90deg,#5d5699,#bcb4ff);animation:prog 1s linear infinite;background-size:200% 100%"></div>
      <!-- Grid -->
      <div class="flex-1 overflow-y-auto p-6">
        <div id="media-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4"></div>
        <div id="media-empty" class="hidden items-center justify-center h-64 flex-col text-center">
          <span class="material-symbols-outlined text-6xl text-gray-200 mb-3">photo_library</span>
          <p class="text-gray-400 font-semibold">No images yet</p>
          <p class="text-sm text-gray-300 mt-1">Click "Upload New" to add your first image</p>
        </div>
      </div>
    </div>
  </div>
  <style>
    @keyframes prog { 0%{background-position:0 0} 100%{background-position:-200% 0} }
  </style>

  <!-- Toast notification -->
  <div id="toast" class="fixed bottom-6 right-6 z-50 hidden">
    <div class="flex items-center gap-3 bg-gray-900 text-white text-sm px-5 py-3.5 rounded-2xl shadow-2xl">
      <span class="material-symbols-outlined text-green-400 text-base" id="toast-icon">check_circle</span>
      <span id="toast-msg">Saved!</span>
    </div>
  </div>

<script>
// ─── Tab switching ────────────────────────────────────────────
function switchTab(name, btn) {
  document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  btn.classList.add('active');
}

// ─── Save helpers ─────────────────────────────────────────────
function get(id) {
  const el = document.getElementById(id);
  return el ? el.value : undefined;
}

async function postContent(data) {
  const res = await fetch('api.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });
  return res.json();
}

function toast(msg, ok = true) {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  document.getElementById('toast-icon').textContent = ok ? 'check_circle' : 'error';
  t.classList.remove('hidden');
  setTimeout(() => t.classList.add('hidden'), 2500);
}

// ─── Section savers ───────────────────────────────────────────
const savers = {
  hero: () => ({
    hero: {
      heading: get('hero-heading'),
      subheading: get('hero-sub'),
      ctaLabel: get('hero-cta'),
      badge: get('hero-badge'),
      statNumber: get('hero-stat-num'),
      statLabel: get('hero-stat-label'),
      image: get('hero-img-val'),
    }
  }),

  features: () => ({
    features: {
      cards: [0, 1, 2].map(i => ({
        title: get(`feat-${i}-title`),
        description: get(`feat-${i}-desc`),
      }))
    }
  }),

  capabilities: () => ({
    capabilities: {
      heading: get('cap-heading'),
      subheading: get('cap-subheading'),
      cards: [0, 1, 2, 3].map(i => ({
        title: get(`cap-card-${i}-title`),
        description: get(`cap-card-${i}-desc`),
      })),
      stats: [0, 1, 2, 3].map(i => ({
        number: get(`stat-${i}-num`),
        label: get(`stat-${i}-label`),
      }))
    }
  }),

  benefits: () => ({
    benefits: {
      heading: get('benefits-heading'),
      subheading: get('benefits-subheading'),
      description: get('benefits-desc'),
      image: get('benefits-img-val'),
      items: [0, 1, 2].map(i => ({ text: get(`benefit-${i}-text`) }))
    }
  }),

  testimonials: () => ({
    testimonials: [0, 1, 2].map(i => ({
      quote: get(`testi-${i}-quote`),
      name: get(`testi-${i}-name`),
      role: get(`testi-${i}-role`),
    }))
  }),

  faq: () => ({
    faq: [0, 1, 2, 3].map(i => ({
      question: get(`faq-${i}-q`),
      answer: get(`faq-${i}-a`),
    }))
  }),

  cta: () => ({
    cta: {
      heading: get('cta-heading'),
      description: get('cta-desc'),
      ctaLabel: get('cta-btn'),
    }
  }),

  footer: () => {
    const links = [];
    let i = 0;
    while (document.getElementById(`link-${i}-label`) !== null) {
      links.push({ label: get(`link-${i}-label`), href: get(`link-${i}-href`) });
      i++;
    }
    return {
      footer: {
        email: get('footer-email'),
        copyright: get('footer-copyright'),
        tagline: get('footer-tagline'),
        social: {
          instagram: get('social-instagram'),
          twitter: get('social-twitter'),
          facebook: get('social-facebook'),
          linkedin: get('social-linkedin'),
        },
        links
      }
    };
  }
};

async function saveSection(section) {
  const btn = event.currentTarget;
  btn.disabled = true;
  btn.style.opacity = '0.6';
  try {
    const data = savers[section]();
    const result = await postContent(data);
    if (result.success) {
      toast('Saved successfully!');
    } else {
      toast(result.error || 'Save failed', false);
    }
  } catch (e) {
    toast('Network error — check server', false);
  }
  btn.disabled = false;
  btn.style.opacity = '';
}

// ─── Media Library ────────────────────────────────────────────
let _mlInputId   = null;
let _mlPreviewId = null;

function openMediaLibrary(inputId, previewId) {
  _mlInputId   = inputId;
  _mlPreviewId = previewId;
  document.getElementById('media-modal').classList.remove('hidden');
  loadMediaImages();
}

function closeMediaLibrary() {
  document.getElementById('media-modal').classList.add('hidden');
}

async function loadMediaImages() {
  const grid  = document.getElementById('media-grid');
  const empty = document.getElementById('media-empty');
  grid.innerHTML = '<div class="col-span-full py-16 text-center text-sm text-gray-400">Loading…</div>';
  empty.classList.add('hidden');
  empty.classList.remove('flex');

  try {
    const res    = await fetch('api.php?action=images');
    const images = await res.json();

    document.getElementById('media-count').textContent = images.length + (images.length === 1 ? ' file' : ' files');

    if (images.length === 0) {
      grid.innerHTML = '';
      empty.classList.remove('hidden');
      empty.classList.add('flex');
      return;
    }

    grid.innerHTML = images.map(img => `
      <div class="group relative aspect-square rounded-2xl overflow-hidden bg-gray-100 cursor-pointer
                  border-2 border-transparent hover:border-[#5d5699] transition-all shadow-sm hover:shadow-md"
           onclick="selectMediaImage('${img.url}')">
        <img src="../${img.url}" class="w-full h-full object-cover" loading="lazy">
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all
                    flex flex-col items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
          <span class="material-symbols-outlined text-white text-3xl">check_circle</span>
          <span class="text-white text-xs font-semibold px-2 text-center leading-tight"
                style="text-shadow:0 1px 3px rgba(0,0,0,.5)">${img.name}</span>
        </div>
      </div>
    `).join('');
  } catch (e) {
    grid.innerHTML = '<div class="col-span-full py-16 text-center text-sm text-red-400">Failed to load images</div>';
  }
}

function selectMediaImage(url) {
  if (_mlInputId) {
    document.getElementById(_mlInputId).value = url;
  }
  if (_mlPreviewId) {
    const prev = document.getElementById(_mlPreviewId);
    prev.src = '../' + url;
    prev.classList.remove('hidden');
    // hide the placeholder icon if present
    const wrap = prev.parentElement;
    const icon = wrap.querySelector('.material-symbols-outlined');
    if (icon) icon.style.display = 'none';
  }
  closeMediaLibrary();
  toast('Image selected — remember to Save!');
}

function clearImage(inputId, previewId) {
  document.getElementById(inputId).value = '';
  const prev = document.getElementById(previewId);
  prev.src = '';
  prev.classList.add('hidden');
  const wrap = prev.parentElement;
  const icon = wrap.querySelector('.material-symbols-outlined');
  if (icon) icon.style.display = '';
}

async function uploadMediaImages(input) {
  if (!input.files || !input.files.length) return;
  const bar = document.getElementById('media-progress-bar');
  bar.classList.remove('hidden');

  const files = Array.from(input.files);
  let uploaded = 0;
  for (const file of files) {
    const fd = new FormData();
    fd.append('image', file);
    try {
      const res  = await fetch('api.php?action=upload', { method: 'POST', body: fd });
      const data = await res.json();
      if (data.success) uploaded++;
      else toast(data.error || 'Upload failed', false);
    } catch (e) {
      toast('Upload failed', false);
    }
  }

  input.value = '';
  bar.classList.add('hidden');
  if (uploaded > 0) {
    toast(`${uploaded} image${uploaded > 1 ? 's' : ''} uploaded!`);
    await loadMediaImages();
  }
}
</script>
</body>
</html>
