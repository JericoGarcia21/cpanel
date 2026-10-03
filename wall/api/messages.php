<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

$lastId = isset($_GET['last_id']) ? (int) $_GET['last_id'] : 0;

$sql = 'SELECT id, text, count, updated_at FROM wall_messages';
$params = [];

if ($lastId > 0) {
    $sql .= ' WHERE id > :last_id';
    $params['last_id'] = $lastId;
}

$sql .= ' ORDER BY id DESC';

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

wall_json_response(['messages' => $rows]);
