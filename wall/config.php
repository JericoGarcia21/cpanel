<?php
declare(strict_types=1);

require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/badwords.php';

const WALL_MESSAGE_MAX_LENGTH = 150;

function wall_normalize(string $text): string
{
    $text = trim(preg_replace('/\s+/', ' ', $text) ?? '');
    return mb_strtolower($text);
}

function wall_json_response(array $data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
