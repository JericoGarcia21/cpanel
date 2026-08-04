<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    wall_json_response(['error' => 'Method not allowed.'], 405);
}

session_start();
$now = microtime(true);
$lastSubmit = $_SESSION['wall_last_submit'] ?? 0;
if ($now - $lastSubmit < 2) {
    wall_json_response(['error' => 'Slow down a little and try again.'], 429);
}

$body = json_decode(file_get_contents('php://input') ?: '', true);
$text = trim((string)($body['message'] ?? ''));

if ($text === '') {
    wall_json_response(['error' => 'Message cannot be empty.'], 400);
}

if (mb_strlen($text) > WALL_MESSAGE_MAX_LENGTH) {
    wall_json_response(['error' => 'Message is too long (max ' . WALL_MESSAGE_MAX_LENGTH . ' characters).'], 400);
}

if (wall_is_profane($text)) {
    wall_json_response(['error' => "Let's keep it classroom-friendly 🙂"], 400);
}

$normalized = wall_normalize($text);
if ($normalized === '') {
    wall_json_response(['error' => 'Message cannot be empty.'], 400);
}

$stmt = $conn->prepare(
    'INSERT INTO wall_messages (text, normalized_text, count)
     VALUES (:text, :normalized, 1)
     ON DUPLICATE KEY UPDATE count = count + 1, updated_at = CURRENT_TIMESTAMP'
);
$stmt->execute(['text' => $text, 'normalized' => $normalized]);

$_SESSION['wall_last_submit'] = $now;

wall_json_response(['ok' => true]);
