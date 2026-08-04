<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    wall_json_response(['error' => 'Method not allowed.'], 405);
}

$body = json_decode(file_get_contents('php://input') ?: '', true);
$code = (string)($body['code'] ?? '');

$expected = $_ENV['WALL_RESET_CODE'] ?? '';

if ($expected === '' || !hash_equals($expected, $code)) {
    wall_json_response(['error' => 'Invalid code.'], 403);
}

$conn->exec('TRUNCATE TABLE wall_messages');

wall_json_response(['ok' => true]);
