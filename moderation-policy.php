<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Moderation and removal policy for the Message Wall website.">
    <title>Moderation Policy | Message Wall</title>
    <style>
        :root {
            --ink: #17191b;
            --paper: #f7f8f4;
            --lime: #d9fa5d;
            --blue: #3459d1;
            --teal: #0f766e;
            --violet: #7c3aed;
            --line: rgba(23, 25, 27, 0.12);
            --muted: #4f564f;
            font-family: Arial, sans-serif;
            color: var(--ink);
            background: var(--paper);
        }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); }
        a { color: inherit; }
        .topbar {
            border-bottom: 1px solid var(--line);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 32px;
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(6px);
        }
        .brand { font-weight: 800; text-decoration: none; letter-spacing: 0.04em; }
        .brand-mark {
            display: inline-flex; align-items: center; justify-content: center;
            width: 28px; height: 28px; border-radius: 50%; background: var(--ink); color: var(--lime);
            margin-right: 8px; font-size: 14px;
        }
        .nav { display: flex; gap: 16px; flex-wrap: wrap; }
        .nav a { text-decoration: none; font-size: 14px; font-weight: 700; }
        .container {
            max-width: 900px; margin: 0 auto; padding: 48px 20px 64px;
        }
        .page-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 32px 28px;
            box-shadow: 0 12px 28px rgba(17,24,39,0.04);
        }
        .eyebrow {
            display: inline-block; font-size: 11px; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--teal); margin: 0 0 14px;
        }
        h1 { margin: 0 0 20px; font-size: clamp(30px, 4vw, 46px); }
        p, li { font-size: 16px; line-height: 1.7; color: #252b2a; }
        ul { padding-left: 20px; }
        .site-footer {
            border-top: 1px solid var(--line); padding: 20px; text-align: center; color: var(--muted);
            font-size: 14px;
        }
        .site-footer .links { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; margin-bottom: 10px; }
        .site-footer a { text-decoration: none; font-weight: 700; }
        @media (max-width: 620px) {
            .topbar { padding: 16px 20px; flex-direction: column; gap: 10px; }
            .page-card { padding: 22px 18px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="./"><span class="brand-mark">W</span>MESSAGE WALL</a>
        <nav class="nav" aria-label="Main navigation">
            <a href="./">Home</a>
            <a href="privacy-policy.php">Privacy</a>
            <a href="terms-and-conditions.php">Terms</a>
        </nav>
    </header>

    <main class="container">
        <article class="page-card">
            <p class="eyebrow">Moderation</p>
            <h1>Moderation and Removal Policy</h1>

            <p>Last Updated: October 3, 2026</p>

            <p><strong>Disclaimer:</strong> This website is for demonstration and academic purposes only as part of an SIA subject project. It is not a real business platform or official service.</p>

            <p>We aim to keep this website safe, respectful, and useful for everyone. This policy explains how we review content and how users can report problems.</p>

            <p><strong>1. Content that is not allowed</strong><br>
            We may remove or moderate content that includes:</p>
            <ul>
                <li>Threats, harassment, or abusive language</li>
                <li>Hate speech or discriminatory statements</li>
                <li>Defamation or false accusations</li>
                <li>Spam or repeated junk content</li>
                <li>Illegal activity or instructions</li>
                <li>Personal information about other people</li>
                <li>Copyrighted or other third-party material without permission</li>
            </ul>

            <p><strong>2. How content is reviewed</strong><br>
            We may review messages when they are submitted and after they have been posted. Content may be removed if it appears harmful, offensive, unlawful, or otherwise unsuitable for the platform.</p>

            <p><strong>3. Reporting content</strong><br>
            If you see content that you believe violates this policy, please contact us at [your email address]. Include the message, the reason for the report, and any relevant details.</p>

            <p><strong>4. Removal requests</strong><br>
            We may remove content in response to a valid complaint, legal notice, or direct request when appropriate. We may also remove content to protect users or maintain the integrity of the website.</p>

            <p><strong>5. Repeat violations</strong><br>
            Users who repeatedly post harmful or inappropriate content may be blocked from submitting further messages.</p>

            <p><strong>6. No guarantee of publication</strong><br>
            We are not required to publish or keep any message on the website. We may remove any message at any time, with or without notice, depending on the situation.</p>

            <p><strong>7. User responsibility</strong><br>
            Users are expected to avoid posting personal data or content that could hurt, embarrass, or identify others. We encourage respectful, lawful communication.</p>

            <p><strong>8. Contact</strong><br>
            For moderation or removal requests, contact:<br>
            Message Wall Project<br>
            Email: garciaj@udd.edu.ph</p>
        </article>
    </main>

    <footer class="site-footer">
        <div class="links">
            <a href="./">Home</a>
            <a href="privacy-policy.php">Privacy</a>
            <a href="terms-and-conditions.php">Terms</a>
            <a href="copyright-policy.php">Copyright</a>
        </div>
        <span>© 2026 Message Wall</span>
    </footer>
</body>
</html>
