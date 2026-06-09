<?php
session_start();
$password = 'skhp2026';

if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['sk_auth'] = true;
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

if (isset($_SESSION['sk_auth'])) {
    header('Location: editor.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Content Admin — St Kevin's Hampton Park</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #F6F3EE;
    }
    h1, h2, h3, .font-heading {
      font-family: 'Montserrat', sans-serif;
    }
    .sk-card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(5, 30, 66, 0.10), 0 1px 4px rgba(5, 30, 66, 0.06);
      max-width: 400px;
      width: 100%;
    }
    .sk-card-header {
      background-color: #051E42;
      border-radius: 16px 16px 0 0;
      padding: 32px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
    }
    .sk-cross {
      position: relative;
      width: 22px;
      height: 22px;
      flex-shrink: 0;
    }
    .sk-cross::before,
    .sk-cross::after {
      content: '';
      position: absolute;
      background-color: #8A2232;
      border-radius: 2px;
    }
    .sk-cross::before {
      width: 4px;
      height: 22px;
      top: 0;
      left: 9px;
    }
    .sk-cross::after {
      width: 22px;
      height: 4px;
      top: 9px;
      left: 0;
    }
    .sk-label {
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.55);
    }
    .sk-card-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 20px;
      font-weight: 700;
      color: #ffffff;
      text-align: center;
      line-height: 1.2;
    }
    .sk-card-body {
      padding: 32px;
    }
    .sk-input-label {
      display: block;
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #051E42;
      margin-bottom: 8px;
    }
    .sk-input {
      width: 100%;
      height: 48px;
      padding: 0 16px;
      border: 1.5px solid #E2E6EA;
      border-radius: 16px;
      font-family: 'Inter', sans-serif;
      font-size: 15px;
      color: #051E42;
      background: #ffffff;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
      box-sizing: border-box;
    }
    .sk-input:focus {
      border-color: #051E42;
      box-shadow: 0 0 0 2px rgba(5, 30, 66, 0.18);
    }
    .sk-input::placeholder {
      color: #B0B8C4;
    }
    .sk-btn {
      display: block;
      width: 100%;
      height: 48px;
      background-color: #051E42;
      color: #ffffff;
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: background-color 0.15s;
      margin-top: 24px;
    }
    .sk-btn:hover {
      background-color: #0A2D5C;
    }
    .sk-btn:active {
      background-color: #041530;
    }
    .sk-error {
      display: flex;
      align-items: center;
      gap: 8px;
      background: #FEF2F2;
      border: 1px solid #FECACA;
      border-radius: 10px;
      padding: 10px 14px;
      margin-bottom: 20px;
      color: #B91C1C;
      font-size: 13px;
      font-family: 'Inter', sans-serif;
    }
    .sk-error svg {
      flex-shrink: 0;
    }
    .sk-page-footer {
      text-align: center;
      margin-top: 28px;
      font-family: 'Inter', sans-serif;
      font-size: 12px;
      color: rgba(5, 30, 66, 0.38);
      letter-spacing: 0.01em;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-6">

  <div class="sk-card">

    <!-- Card header -->
    <div class="sk-card-header">
      <div class="sk-cross"></div>
      <span class="sk-label">St Kevin's Hampton Park</span>
      <h1 class="sk-card-title">Content Admin</h1>
    </div>

    <!-- Card body -->
    <div class="sk-card-body">

      <?php if (!empty($loginError)): ?>
      <div class="sk-error">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
          <circle cx="8" cy="8" r="7.25" stroke="#B91C1C" stroke-width="1.5"/>
          <path d="M8 4.5v4" stroke="#B91C1C" stroke-width="1.5" stroke-linecap="round"/>
          <circle cx="8" cy="11" r="0.75" fill="#B91C1C"/>
        </svg>
        Incorrect password — try again.
      </div>
      <?php endif; ?>

      <form method="POST" autocomplete="off" novalidate>
        <label class="sk-input-label" for="password">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          class="sk-input"
          placeholder="Enter admin password"
          required
          autofocus
        >
        <button type="submit" class="sk-btn">Sign In</button>
      </form>

    </div>
  </div>

  <p class="sk-page-footer">St Kevin's Primary School, Hampton Park</p>

</body>
</html>
