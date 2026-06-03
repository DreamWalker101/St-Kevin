<?php
// Simple deploy trigger - keep this file private
// Delete after go-live or restrict access

$secret = 'stkevin'; // e.g. 'stkevins2026'

$provided = $_GET['secret'] ?? '';
if ($provided !== $secret) {
    http_response_code(403);
    die('Forbidden');
}

// Trigger cPanel Git pull + deploy via API
$cpanel_user = 'devon5io';
$cpanel_token = 'A7X6XBS8ADJSCQX4R4NU0VJ2J9M5YDSZ';
$repo_path = '/home/devon5io/public_html/st-kevins-plainpress';
$cpanel_host = 'dev.on5.io:2083';

$url = "https://{$cpanel_host}/execute/VersionControl/update";

$payload = json_encode([
    'repository_root' => $repo_path,
    'branch' => 'main'
]);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "Authorization: cpanel {$cpanel_user}:{$cpanel_token}",
        'Content-Type: application/json'
    ],
    CURLOPT_SSL_VERIFYPEER => false,
]);

$response = curl_exec($ch);
curl_close($ch);

echo "Deploy triggered: " . $response;
