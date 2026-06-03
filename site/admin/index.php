<?php
session_start();
$password = 'nwork2026'; // Change this before deployment

if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['nwork_auth'] = true;
        header('Location: editor.php');
        exit;
    }
    $loginError = true;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['nwork_auth'])) {
    header('Location: editor.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>nWork Dashboard — Login</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#5d5699',
            'primary-container': '#bcb4ff',
            tertiary: '#476733',
            'tertiary-container': '#c9eaa0',
            surface: '#fbf9f8',
            'surface-container': '#f0eded',
            'surface-container-low': '#f6f3f2',
            'on-surface': '#1b1c1c',
            'on-surface-variant': '#434938',
            outline: '#737a66',
            'outline-variant': '#c3c9b2',
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .signature-gradient { background: linear-gradient(135deg, #5d5699, #bcb4ff); }
    .material-symbols-outlined { font-family: 'Material Symbols Outlined'; font-weight: normal; font-style: normal; font-size: 20px; line-height: 1; text-transform: none; display: inline-block; white-space: nowrap; -webkit-font-smoothing: antialiased; }
  </style>
</head>
<body class="min-h-screen bg-surface flex items-center justify-center p-4">
  <!-- Decorative blobs -->
  <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full opacity-10 blur-[120px]" style="background: #5d5699;"></div>
    <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] rounded-full opacity-10 blur-[120px]" style="background: #476733;"></div>
  </div>

  <div class="relative w-full max-w-sm">
    <div class="bg-white rounded-3xl shadow-2xl p-8">
      <!-- Logo -->
      <div class="flex items-center gap-3 mb-8">
        <div class="signature-gradient w-10 h-10 rounded-2xl flex items-center justify-center flex-shrink-0">
          <span class="text-white font-black text-base">n</span>
        </div>
        <div>
          <div class="font-black text-gray-900 text-lg leading-none">nWork</div>
          <div class="text-xs text-gray-400 font-medium">Content Dashboard</div>
        </div>
      </div>

      <h1 class="text-2xl font-bold text-gray-900 mb-1">Welcome back</h1>
      <p class="text-sm text-gray-400 mb-7">Sign in to manage your site content</p>

      <?php if (!empty($loginError)): ?>
      <div class="flex items-center gap-2 bg-red-50 text-red-600 text-sm rounded-xl px-4 py-3 mb-5">
        <span class="material-symbols-outlined text-base">error</span>
        Incorrect password. Please try again.
      </div>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <div class="mb-5">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
          <input
            type="password"
            name="password"
            required
            autofocus
            class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition"
            placeholder="Enter dashboard password"
          >
        </div>
        <button type="submit" class="w-full signature-gradient text-white font-bold rounded-xl py-3 text-sm hover:opacity-90 transition active:scale-95">
          Sign In
        </button>
      </form>

      <p class="text-center text-xs text-gray-300 mt-6">nWork CMS · Powered by nWorks</p>
    </div>
  </div>
</body>
</html>
