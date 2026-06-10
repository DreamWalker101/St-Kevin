<?php
// Credentials loaded from deploy-config.php (gitignored — never commit that file)
require_once __DIR__ . '/deploy-config.php';

$provided = $_GET['secret'] ?? '';
if (!hash_equals(DEPLOY_SECRET, $provided)) {
    http_response_code(403);
    die('Forbidden');
}

$repo_path  = '/home/devon5io/public_html/st-kevins-plainpress';
$cpanel_host = 'dev.on5.io:2083';

// Step 1 — Pull latest from GitHub
$pull_url     = "https://{$cpanel_host}/execute/VersionControl/update";
$pull_payload = json_encode(['repository_root' => $repo_path]);

$ch = curl_init($pull_url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $pull_payload,
    CURLOPT_HTTPHEADER     => [
        'Authorization: cpanel ' . CPANEL_USER . ':' . CPANEL_TOKEN,
        'Content-Type: application/json',
    ],
    CURLOPT_SSL_VERIFYPEER => false,
]);
$pull_response = curl_exec($ch);
curl_close($ch);

sleep(2);

// Step 2 — Copy site/* to repo root (shell_exec disabled on shared hosting)
function copy_dir($src, $dst) {
    $copied = 0;
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($src, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    ) as $item) {
        $target = $dst . DIRECTORY_SEPARATOR . substr($item->getPathname(), strlen($src) + 1);
        if ($item->isDir()) {
            if (!is_dir($target)) mkdir($target, 0755, true);
        } else {
            copy($item->getPathname(), $target);
            $copied++;
        }
    }
    return $copied;
}

$copied = copy_dir("{$repo_path}/site", $repo_path);

echo json_encode([
    'pull'         => json_decode($pull_response),
    'files_copied' => $copied,
], JSON_PRETTY_PRINT);
