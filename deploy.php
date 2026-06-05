<?php
$secret = 'YOUR_ACTUAL_SECRET_WORD';

$provided = $_GET['secret'] ?? '';
if ($provided !== $secret) {
    http_response_code(403);
    die('Forbidden');
}

$cpanel_user = 'devon5io';
$cpanel_token = 'YOUR_API_TOKEN';
$repo_path = '/home/devon5io/public_html/st-kevins-plainpress';
$cpanel_host = 'dev.on5.io:2083';

// Step 1 — Pull latest from GitHub
$pull_url = "https://{$cpanel_host}/execute/VersionControl/update";
$pull_payload = json_encode(['repository_root' => $repo_path]);

$ch = curl_init($pull_url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $pull_payload,
    CURLOPT_HTTPHEADER => [
        "Authorization: cpanel {$cpanel_user}:{$cpanel_token}",
        'Content-Type: application/json'
    ],
    CURLOPT_SSL_VERIFYPEER => false,
]);
$pull_response = curl_exec($ch);
curl_close($ch);

// Small pause to let pull complete
sleep(2);

// Step 2 — Deploy HEAD commit (runs .cpanel.yml tasks)
$deploy_url = "https://{$cpanel_host}/execute/VersionControl/deploy";
$deploy_payload = json_encode(['repository_root' => $repo_path]);

$ch = curl_init($deploy_url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $deploy_payload,
    CURLOPT_HTTPHEADER => [
        "Authorization: cpanel {$cpanel_user}:{$cpanel_token}",
        'Content-Type: application/json'
    ],
    CURLOPT_SSL_VERIFYPEER => false,
]);
$deploy_response = curl_exec($ch);
curl_close($ch);

echo json_encode([
    'pull' => json_decode($pull_response),
    'deploy' => json_decode($deploy_response)
], JSON_PRETTY_PRINT);
