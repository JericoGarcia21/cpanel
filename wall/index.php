<?php
declare(strict_types=1);

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$base = $scheme . '://' . $host . dirname($_SERVER['SCRIPT_NAME']);
$submitUrl = rtrim($base, '/') . '/submit.php';
$qrSrc = 'https://api.qrserver.com/v1/create-qr-code/?size=320x320&data=' . urlencode($submitUrl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Scan to join the wall</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', system-ui, sans-serif; }
</style>
</head>
<body class="min-h-screen bg-white flex items-center justify-center p-6">
    <div class="w-full max-w-sm text-center">
        <p class="text-slate-400 font-medium tracking-widest text-xs uppercase mb-2">Live Message Wall</p>
        <h1 class="text-slate-900 text-2xl font-bold mb-8">Scan to drop a message</h1>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 inline-block">
            <img src="<?= htmlspecialchars($qrSrc, ENT_QUOTES, 'UTF-8') ?>" alt="QR code" class="rounded-lg w-full h-auto">
        </div>

        <p class="text-slate-400 text-sm mt-6 mb-1">or open this link</p>
        <a href="<?= htmlspecialchars($submitUrl, ENT_QUOTES, 'UTF-8') ?>"
           class="text-slate-700 font-medium break-all underline underline-offset-4 decoration-slate-300 hover:text-slate-900">
            <?= htmlspecialchars($submitUrl, ENT_QUOTES, 'UTF-8') ?>
        </a>

        <div class="mt-10">
            <a href="display.php"
               class="inline-flex items-center gap-2 border border-slate-300 hover:border-slate-400 text-slate-700 font-medium px-5 py-2.5 rounded-full transition">
                Open the big screen
            </a>
        </div>
        <div>Hello</div>
    </div>
</body>
</html>
