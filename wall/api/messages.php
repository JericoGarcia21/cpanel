<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

$stmt = $conn->query('SELECT id, text, count, updated_at FROM wall_messages ORDER BY updated_at DESC');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

wall_json_response(['messages' => $rows]);
