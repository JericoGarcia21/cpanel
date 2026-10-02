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
<meta name="theme-color" content="#d9fa5d">
<title>Scan to join the wall</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --ink: #17191b;
        --paper: #f7f8f4;
        --lime: #d9fa5d;
        --coral: #fa6248;
        --blue: #3459d1;
        --teal: #0f766e;
        --violet: #7c3aed;
        --red: #b91c1c;
        color: var(--ink);
        background: var(--paper);
        font-family: 'DM Sans', sans-serif;
    }
    * { box-sizing: border-box; }
    body { margin: 0; min-height: 100vh; }
    a { color: inherit; }
    a:focus-visible { outline: 3px solid var(--blue); outline-offset: 4px; }
    .site-header {
        align-items: center;
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        max-width: 1240px;
        min-height: 78px;
        padding: 0 40px;
    }
    .brand {
        align-items: center;
        display: inline-flex;
        font-family: 'Space Grotesk', sans-serif;
        font-size: 16px;
        font-weight: 700;
        gap: 10px;
        text-decoration: none;
    }
    .brand-mark {
        align-items: center;
        background: var(--ink);
        border-radius: 50%;
        color: var(--lime);
        display: inline-flex;
        height: 34px;
        justify-content: center;
        width: 34px;
    }
    .header-link, .text-link { font-size: 14px; font-weight: 700; text-underline-offset: 5px; }
    .join-layout {
        align-items: center;
        display: grid;
        gap: clamp(36px, 7vw, 96px);
        grid-template-columns: minmax(0, 1fr) minmax(320px, 430px);
        margin: 0 auto;
        max-width: 1160px;
        min-height: calc(100vh - 78px);
        padding: 34px 40px 64px;
    }
    .eyebrow { align-items: center; display: inline-flex; font-size: 11px; font-weight: 700; gap: 9px; text-transform: uppercase; }
    .live-dot { background: var(--coral); border-radius: 50%; height: 9px; width: 9px; }
    h1 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(48px, 6vw, 76px); line-height: 0.98; margin: 24px 0 20px; }
    .intro { font-size: 18px; line-height: 1.6; margin: 0; max-width: 500px; }
    .button {
        align-items: center;
        background: var(--ink);
        border: 1px solid var(--ink);
        border-radius: 4px;
        color: white;
        display: inline-flex;
        font-size: 14px;
        font-weight: 700;
        justify-content: center;
        margin-top: 25px;
        min-height: 50px;
        padding: 0 20px;
        text-decoration: none;
        transition: background-color 150ms ease, transform 150ms ease;
    }
    .button:hover { background: var(--blue); transform: translateY(-2px); }
    .privacy-note { border-left: 3px solid var(--red); color: #454943; font-size: 14px; line-height: 1.55; margin: 34px 0 0; max-width: 420px; padding-left: 14px; }
    .qr-panel { background: var(--ink); color: var(--paper); padding: 22px; }
    .qr-label { align-items: center; color: var(--lime); display: flex; font-size: 11px; font-weight: 700; justify-content: space-between; letter-spacing: 0.08em; margin: 0 0 16px; text-transform: uppercase; }
    .qr-frame { background: white; border-top: 4px solid var(--teal); padding: 14px; }
    .qr-frame img { aspect-ratio: 1; display: block; height: auto; image-rendering: pixelated; width: 100%; }
    .qr-caption { font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 600; margin: 18px 0 8px; }
    .direct-link { color: var(--lime); display: inline-block; font-size: 13px; line-height: 1.5; overflow-wrap: anywhere; text-underline-offset: 4px; }
    .direct-label { color: #c8ccc4; font-size: 12px; margin: 0 0 4px; }
    .color-rule { background: linear-gradient(90deg, var(--blue) 0 17%, var(--teal) 17% 34%, var(--violet) 34% 51%, var(--red) 51% 68%, var(--coral) 68% 85%, var(--lime) 85%); height: 5px; }
    @media (max-width: 760px) {
        .site-header { min-height: 68px; padding: 0 22px; }
        .join-layout { gap: 34px; grid-template-columns: minmax(0, 1fr); margin: 0 auto; max-width: 560px; min-height: auto; padding: 38px 22px 56px; }
        h1 { font-size: 58px; }
        .intro { font-size: 16px; }
        .qr-panel { margin: 0 auto; max-width: 430px; width: 100%; }
    }
    @media (max-width: 380px) {
        .site-header { padding: 0 16px; }
        .brand > span:last-child { display: none; }
        .join-layout { padding: 30px 16px 42px; }
        h1 { font-size: 48px; }
        .qr-panel { padding: 16px; }
    }
</style>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="../" aria-label="Message Wall home">
            <span class="brand-mark" aria-hidden="true">W</span>
            <span>MESSAGE WALL</span>
        </a>
        <a class="header-link" href="display.php">Open the big screen <span aria-hidden="true">↗</span></a>
    </header>

    <main class="join-layout">
        <section>
            <p class="eyebrow"><span class="live-dot" aria-hidden="true"></span> A note for the wall</p>
            <h1>Got something<br>to say?</h1>
            <p class="intro">Scan the code and leave a thought. Your message will join the shared wall without your name.</p>
            <a class="button" href="<?= htmlspecialchars($submitUrl, ENT_QUOTES, 'UTF-8') ?>">Write a message instead <span aria-hidden="true">&nbsp;↗</span></a>
            <p class="privacy-note">This is a public wall, not a private chat. Please leave out names and personal details.</p>
        </section>

        <section class="qr-panel" aria-label="Scan to open the message form">
            <p class="qr-label"><span>Scan to join</span><span aria-hidden="true">01 / 01</span></p>
            <div class="qr-frame">
                <img src="<?= htmlspecialchars($qrSrc, ENT_QUOTES, 'UTF-8') ?>" alt="Scan this QR code to open the anonymous message form">
            </div>
            <p class="qr-caption">Point your camera here.</p>
            <p class="direct-label">Or open this link</p>
            <a class="direct-link" href="<?= htmlspecialchars($submitUrl, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($submitUrl, ENT_QUOTES, 'UTF-8') ?>
            </a>
        </section>
    </main>
    <div class="color-rule" aria-hidden="true"></div>
</body>
</html>
