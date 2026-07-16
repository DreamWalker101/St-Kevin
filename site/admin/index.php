<?php
session_start([
    'cookie_httponly' => true,
    'cookie_secure'   => true,
    'cookie_samesite' => 'Strict',
]);
require_once __DIR__ . '/config.php';

// Already authenticated
if (isset($_SESSION['sk_auth'])) {
    header('Location: editor.php');
    exit;
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$emailsFile    = __DIR__ . '/emails.json';
$allowedEmails = file_exists($emailsFile)
    ? array_map('strtolower', json_decode(file_get_contents($emailsFile), true) ?: [])
    : [];

$step   = 'email'; // 'email' | 'otp'
$error  = '';
$notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postStep = $_POST['step'] ?? '';

    // ── Step 1: Request OTP ──────────────────────────────────────────────────
    if ($postStep === 'email') {
        $email = strtolower(trim($_POST['email'] ?? ''));

        $lastRequest = $_SESSION['sk_otp_last_request'] ?? 0;
        if (time() - $lastRequest < 60) {
            $step   = 'otp';
            $notice = 'A code was already sent. Check your inbox — or wait 60 seconds to request a new one.';
        } else {
            $_SESSION['sk_otp_last_request'] = time();

            if (in_array($email, $allowedEmails, true)) {
                $otp    = sprintf('%06d', random_int(0, 999999));
                $expiry = time() + 600;

                $_SESSION['sk_otp_hash']     = password_hash($otp, PASSWORD_BCRYPT, ['cost' => 10]);
                $_SESSION['sk_otp_email']    = $email;
                $_SESSION['sk_otp_expiry']   = $expiry;
                $_SESSION['sk_otp_attempts'] = 0;

                $siteName  = OTP_FROM_NAME;
                $fromEmail = OTP_FROM_EMAIL;
                $subject   = "Your admin login code — {$siteName}";
                $body      = "Your one-time login code is:\n\n    {$otp}\n\nThis code expires in 10 minutes.\nDo not share it with anyone.\n\n\xe2\x80\x94 {$siteName}";
                $headers   = "From: {$siteName} <{$fromEmail}>\r\n"
                           . "Reply-To: {$fromEmail}\r\n"
                           . "Content-Type: text/plain; charset=UTF-8";

                if (defined('DEV_MODE') && DEV_MODE) {
                    // Staging: log the code instead of emailing (dev.on5.io mail is unreliable)
                    $logLine = date('Y-m-d H:i:s') . " | email={$email} | otp={$otp}\n";
                    file_put_contents(__DIR__ . '/otp-debug.log', $logLine, FILE_APPEND);
                } else {
                    // -f sets the envelope sender so Exim uses a valid local
                    // return-path; without it PHP mail() is silently dropped.
                    mail($email, $subject, $body, $headers, '-f ' . $fromEmail);
                }
            }
            // Same response whether email is allowed or not (prevents enumeration)
            $step   = 'otp';
            $notice = 'If that email is authorised, a 6-digit code has been sent. Check your inbox.';
        }
    }

    // ── Step 2: Verify OTP ───────────────────────────────────────────────────
    elseif ($postStep === 'otp') {
        $step = 'otp';
        $otp  = preg_replace('/\D/', '', trim($_POST['otp'] ?? ''));

        if (empty($_SESSION['sk_otp_hash'])) {
            $error = 'No code was requested. Please start again.';
            $step  = 'email';
        } elseif (time() > ($_SESSION['sk_otp_expiry'] ?? 0)) {
            session_unset();
            $error = 'Your code has expired. Please request a new one.';
            $step  = 'email';
        } elseif (($_SESSION['sk_otp_attempts'] ?? 0) >= 5) {
            session_unset();
            $error = 'Too many incorrect attempts. Please request a new code.';
            $step  = 'email';
        } else {
            $_SESSION['sk_otp_attempts']++;

            if (password_verify($otp, $_SESSION['sk_otp_hash'])) {
                $email = $_SESSION['sk_otp_email'];
                session_regenerate_id(true);
                $_SESSION['sk_auth']  = true;
                $_SESSION['sk_email'] = $email;
                unset(
                    $_SESSION['sk_otp_hash'],
                    $_SESSION['sk_otp_email'],
                    $_SESSION['sk_otp_expiry'],
                    $_SESSION['sk_otp_attempts'],
                    $_SESSION['sk_otp_last_request']
                );
                header('Location: editor.php');
                exit;
            }

            $remaining = 5 - $_SESSION['sk_otp_attempts'];
            if ($remaining <= 0) {
                session_unset();
                $error = 'Too many incorrect attempts. Please request a new code.';
                $step  = 'email';
            } else {
                $error = "Incorrect code. {$remaining} attempt" . ($remaining === 1 ? '' : 's') . " remaining.";
            }
        }
    }

    // ── Start over ───────────────────────────────────────────────────────────
    elseif ($postStep === 'back') {
        session_unset();
        $step = 'email';
    }
}

// Resume OTP step if a pending code exists in session
if ($step === 'email' && isset($_SESSION['sk_otp_hash']) && time() < ($_SESSION['sk_otp_expiry'] ?? 0)) {
    $step = 'otp';
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
      background-color: #F6F3EE;
      border-bottom: 1px solid #E2E6EA;
      border-radius: 16px 16px 0 0;
      padding: 28px 32px 24px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }
    .sk-card-title {
      font-family: 'Montserrat', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: rgba(5,30,66,0.5);
      text-align: center;
      line-height: 1.2;
      letter-spacing: 0.04em;
      text-transform: uppercase;
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
    .sk-input.otp-input {
      font-size: 22px;
      font-weight: 700;
      text-align: center;
      letter-spacing: 0.18em;
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
    .sk-btn-secondary {
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 14px;
      font-size: 13px;
      color: rgba(5, 30, 66, 0.45);
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
      text-decoration: underline;
      text-underline-offset: 3px;
      font-family: 'Inter', sans-serif;
    }
    .sk-btn-secondary:hover { color: #051E42; }
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
    .sk-notice {
      display: flex;
      align-items: flex-start;
      gap: 8px;
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      border-radius: 10px;
      padding: 10px 14px;
      margin-bottom: 20px;
      color: #166534;
      font-size: 13px;
      line-height: 1.5;
      font-family: 'Inter', sans-serif;
    }
    .sk-notice svg { flex-shrink: 0; margin-top: 1px; }
    .sk-step-hint {
      font-size: 13px;
      color: rgba(5, 30, 66, 0.5);
      line-height: 1.6;
      margin-bottom: 20px;
      font-family: 'Inter', sans-serif;
    }
    .sk-step-hint strong { color: #051E42; font-weight: 600; }
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
      <img src="../images/logo-sk-macs-combined.png" alt="St Kevin's Primary School, Hampton Park" style="height:56px;width:auto;">
      <h1 class="sk-card-title">Content Admin</h1>
    </div>

    <!-- Card body -->
    <div class="sk-card-body">

      <?php if ($error): ?>
      <div class="sk-error">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
          <circle cx="8" cy="8" r="7.25" stroke="#B91C1C" stroke-width="1.5"/>
          <path d="M8 4.5v4" stroke="#B91C1C" stroke-width="1.5" stroke-linecap="round"/>
          <circle cx="8" cy="11" r="0.75" fill="#B91C1C"/>
        </svg>
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
      </div>
      <?php endif; ?>

      <?php if ($notice && !$error): ?>
      <div class="sk-notice">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
          <circle cx="8" cy="8" r="7.25" stroke="#166534" stroke-width="1.5"/>
          <path d="M8 7v5" stroke="#166534" stroke-width="1.5" stroke-linecap="round"/>
          <circle cx="8" cy="5" r="0.75" fill="#166534"/>
        </svg>
        <?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?>
      </div>
      <?php endif; ?>

      <?php if ($step === 'email'): ?>
      <!-- ── Step 1: Email ── -->
      <form method="POST" autocomplete="off" novalidate>
        <input type="hidden" name="step" value="email">
        <label class="sk-input-label" for="email">Email Address</label>
        <input
          id="email"
          type="email"
          name="email"
          class="sk-input"
          placeholder="you@example.com"
          required
          autofocus
        >
        <button type="submit" class="sk-btn">Send Login Code</button>
      </form>

      <?php else: ?>
      <!-- ── Step 2: OTP ── -->
      <p class="sk-step-hint">
        Enter the <strong>6-digit code</strong> sent to your email address.
        It expires in <strong>10 minutes</strong>.
      </p>
      <form method="POST" autocomplete="off" novalidate>
        <input type="hidden" name="step" value="otp">
        <label class="sk-input-label" for="otp">Login Code</label>
        <input
          id="otp"
          type="text"
          name="otp"
          class="sk-input otp-input"
          placeholder="000000"
          maxlength="6"
          inputmode="numeric"
          pattern="\d{6}"
          required
          autofocus
        >
        <button type="submit" class="sk-btn">Verify Code</button>
      </form>
      <form method="POST">
        <input type="hidden" name="step" value="back">
        <button type="submit" class="sk-btn-secondary">Use a different email address</button>
      </form>
      <?php endif; ?>

    </div>
  </div>

  <p class="sk-page-footer">St Kevin's Primary School, Hampton Park</p>

</body>
</html>
