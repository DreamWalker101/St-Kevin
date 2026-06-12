<?php
/**
 * St Kevin's Hampton Park — Contact Form Mailer
 * Receives POST from contact.html, sends a branded HTML email, redirects back.
 */

define('RECIPIENT_EMAIL', 'administration@skhamptonpark.catholic.edu.au');
define('RECIPIENT_NAME',  'St Kevin\'s Hampton Park');
define('SITE_URL',        'contact.html');

/* ── Helpers ── */
function redirect(string $status): never {
    header('Location: ' . SITE_URL . '?status=' . $status);
    exit;
}

function sanitise(string $value): string {
    return htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
}

/* ── Gate: POST only ── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('invalid');
}

/* ── Collect & validate ── */
$name         = sanitise($_POST['name']         ?? '');
$email        = trim($_POST['email']            ?? '');
$phone        = sanitise($_POST['phone']        ?? '');
$enquiry_type = sanitise($_POST['enquiry-type'] ?? '');
$message      = sanitise($_POST['message']      ?? '');

if (empty($name) || empty($email) || empty($message)) {
    redirect('missing');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect('invalid-email');
}

/* Guard against header injection */
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (preg_match('/[\r\n]/', $name . $email . $phone . $enquiry_type)) {
    redirect('invalid');
}

/* ── Build HTML email ── */
$email_html = build_email($name, $email, $phone, $enquiry_type, $message);

/* ── Headers ── */
$boundary = md5(uniqid('', true));
$headers  = implode("\r\n", [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . RECIPIENT_NAME . ' <' . RECIPIENT_EMAIL . '>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'X-Mailer: PHP/' . phpversion(),
]);

$subject = 'New Enquiry: ' . ($enquiry_type ?: 'General') . ' — ' . $name;

/* ── Send ── */
$sent = mail(RECIPIENT_EMAIL, $subject, $email_html, $headers);

redirect($sent ? 'sent' : 'error');


/* ══════════════════════════════════════════════
   EMAIL TEMPLATE
   Table-based, inline CSS only — email-safe.
   Tested against Gmail, Outlook, Apple Mail.
══════════════════════════════════════════════ */
function build_email(
    string $name,
    string $email,
    string $phone,
    string $enquiry_type,
    string $message
): string {

    $phone_display        = $phone        ?: '<span style="color:#9ca3af;font-style:italic;">Not provided</span>';
    $enquiry_type_display = $enquiry_type ?: '<span style="color:#9ca3af;font-style:italic;">Not specified</span>';

    /* Inline cross SVG — email-safe, 24×24 */
    $cross_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">'
        . '<rect x="9" y="0" width="4" height="22" rx="2" fill="#8A2232"/>'
        . '<rect x="0" y="7" width="22" height="4" rx="2" fill="#8A2232"/>'
        . '</svg>';

    $sent_at = date('l, j F Y \a\t g:i A T');

    return <<<HTML
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>New Enquiry — St Kevin's Hampton Park</title>
</head>
<body style="margin:0;padding:0;background-color:#f0ede5;font-family:Arial,Helvetica,sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">

  <!-- Wrapper -->
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
         style="background-color:#f0ede5;min-height:100vh;">
    <tr>
      <td align="center" style="padding:40px 16px 48px;">

        <!-- Email card: max 600px -->
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px;width:100%;border-radius:8px;overflow:hidden;box-shadow:0 4px 24px rgba(5,30,66,0.13);">

          <!-- ── HEADER ── -->
          <tr>
            <td style="background-color:#051E42;padding:40px 40px 32px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="padding-bottom:18px;">
                    <!-- Cross divider -->
                    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>$cross_svg</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin:0 0 4px;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.12em;text-transform:uppercase;color:#8A2232;">
                      St Kevin's Primary School
                    </p>
                    <h1 style="margin:0 0 6px;font-family:Arial,Helvetica,sans-serif;font-size:26px;font-weight:bold;letter-spacing:-0.02em;color:#ffffff;line-height:1.15;">
                      New Enquiry
                    </h1>
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:rgba(255,255,255,0.55);font-weight:normal;">
                      Hampton Park, VIC 3976
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ── BURGUNDY BAND ── -->
          <tr>
            <td style="background-color:#8A2232;padding:12px 40px;">
              <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;font-weight:bold;letter-spacing:0.08em;text-transform:uppercase;color:rgba(255,255,255,0.9);">
                Submitted via skhamptonpark.catholic.edu.au
              </p>
            </td>
          </tr>

          <!-- ── BODY ── -->
          <tr>
            <td style="background-color:#ffffff;padding:40px 40px 0;">

              <!-- Intro note -->
              <p style="margin:0 0 32px;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#374151;line-height:1.65;">
                A visitor has submitted an enquiry through the school website contact form.
                Details are below. To reply, use the button at the bottom of this email.
              </p>

              <!-- ── Field rows ── -->

              <!-- Name -->
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="margin-bottom:0;border-top:1px solid #e5e7eb;">
                <tr>
                  <td style="padding:18px 0 18px;border-bottom:1px solid #e5e7eb;vertical-align:top;width:130px;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.1em;text-transform:uppercase;color:#8A2232;">
                      Name
                    </p>
                  </td>
                  <td style="padding:18px 0 18px 24px;border-bottom:1px solid #e5e7eb;vertical-align:top;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:16px;color:#051E42;font-weight:bold;">
                      $name
                    </p>
                  </td>
                </tr>

                <!-- Email -->
                <tr>
                  <td style="padding:18px 0 18px;border-bottom:1px solid #e5e7eb;vertical-align:top;width:130px;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.1em;text-transform:uppercase;color:#8A2232;">
                      Email
                    </p>
                  </td>
                  <td style="padding:18px 0 18px 24px;border-bottom:1px solid #e5e7eb;vertical-align:top;">
                    <a href="mailto:$email"
                       style="font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#051E42;text-decoration:none;border-bottom:1px solid rgba(5,30,66,0.25);">
                      $email
                    </a>
                  </td>
                </tr>

                <!-- Phone -->
                <tr>
                  <td style="padding:18px 0 18px;border-bottom:1px solid #e5e7eb;vertical-align:top;width:130px;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.1em;text-transform:uppercase;color:#8A2232;">
                      Phone
                    </p>
                  </td>
                  <td style="padding:18px 0 18px 24px;border-bottom:1px solid #e5e7eb;vertical-align:top;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#374151;">
                      $phone_display
                    </p>
                  </td>
                </tr>

                <!-- Enquiry Type -->
                <tr>
                  <td style="padding:18px 0 18px;border-bottom:1px solid #e5e7eb;vertical-align:top;width:130px;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.1em;text-transform:uppercase;color:#8A2232;">
                      Enquiry
                    </p>
                  </td>
                  <td style="padding:18px 0 18px 24px;border-bottom:1px solid #e5e7eb;vertical-align:top;">
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#374151;">
                      $enquiry_type_display
                    </p>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Message (full-width block) -->
          <tr>
            <td style="background-color:#ffffff;padding:0 40px 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="padding-top:24px;">
                    <p style="margin:0 0 10px;font-family:Arial,Helvetica,sans-serif;font-size:11px;font-weight:bold;letter-spacing:0.1em;text-transform:uppercase;color:#8A2232;">
                      Message
                    </p>
                    <div style="background-color:#f6f3ee;border-radius:6px;padding:24px;border-left:3px solid #8A2232;">
                      <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:15px;color:#1f2937;line-height:1.7;white-space:pre-wrap;">$message</p>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ── REPLY CTA ── -->
          <tr>
            <td style="background-color:#f6f3ee;padding:32px 40px;border-top:1px solid #e5e7eb;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
                    <p style="margin:0 0 16px;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#6b7280;line-height:1.6;">
                      This email is pre-addressed to <strong style="color:#051E42;">$name</strong>. Hit reply or use the button below.
                    </p>
                    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td style="border-radius:6px;background-color:#051E42;">
                          <a href="mailto:$email?subject=Re: Your enquiry to St Kevin's Hampton Park"
                             style="display:inline-block;padding:14px 28px;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;letter-spacing:0.04em;text-transform:uppercase;color:#ffffff;text-decoration:none;border-radius:6px;">
                            Reply to $name
                          </a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ── FOOTER ── -->
          <tr>
            <td style="background-color:#051E42;padding:32px 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td style="padding-bottom:20px;border-bottom:1px solid rgba(255,255,255,0.1);">
                    <p style="margin:0 0 4px;font-family:Arial,Helvetica,sans-serif;font-size:13px;font-weight:bold;color:#ffffff;letter-spacing:0.02em;">
                      St Kevin's Primary School
                    </p>
                    <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:rgba(255,255,255,0.5);">
                      120 Hallam Rd, Hampton Park VIC 3976
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top:20px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>
                          <p style="margin:0 0 4px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:rgba(255,255,255,0.45);">
                            <a href="tel:0397098600" style="color:rgba(255,255,255,0.45);text-decoration:none;">(03) 9709 8600</a>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <a href="mailto:administration@skhamptonpark.catholic.edu.au" style="color:rgba(255,255,255,0.45);text-decoration:none;">administration@skhamptonpark.catholic.edu.au</a>
                          </p>
                          <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:rgba(255,255,255,0.3);">
                            Melbourne Archdiocese Catholic Schools (MACS)
                          </p>
                        </td>
                        <td align="right" style="vertical-align:bottom;">
                          <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:11px;color:rgba(255,255,255,0.3);">
                            $sent_at
                          </p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Burgundy bottom strip -->
          <tr>
            <td style="background-color:#8A2232;height:5px;font-size:0;line-height:0;">&nbsp;</td>
          </tr>

        </table>
        <!-- /Email card -->

      </td>
    </tr>
  </table>

</body>
</html>
HTML;
}
