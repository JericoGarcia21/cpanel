<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Terms and Conditions for the Message Wall website.">
    <title>Terms & Conditions | Message Wall</title>
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
            <a href="wall/">Join</a>
        </nav>
    </header>

    <main class="container">
        <article class="page-card">
            <p class="eyebrow">Terms</p>
            <h1>Terms & Conditions</h1>

            <p>Last Updated: October 3, 2026</p>

            <p><strong>Disclaimer:</strong> This website is created for demonstration and academic purposes only as part of an SIA subject project. It does not represent a real company, official service, or registered business.</p>

            <p>By using this website, you agree to these Terms and Conditions.</p>

            <p><strong>1. Acceptance of terms</strong><br>
            You agree to use this website only for lawful purposes and in a way that does not harm others or violate these rules.</p>

            <p><strong>2. Public content</strong><br>
            This website allows users to post public messages. These messages may be displayed to other users and stored on our servers. You are responsible for the content you post.</p>

            <p><strong>3. User responsibilities</strong><br>
            You agree not to post content that is:</p>
            <ul>
                <li>Defamatory, threatening, or abusive</li>
                <li>Hateful, discriminatory, or offensive</li>
                <li>False, misleading, or intentionally harmful</li>
                <li>Illegal or encouraging illegal activity</li>
                <li>Copyrighted or otherwise owned by someone else without permission</li>
                <li>Containing personal information or sensitive data about another person</li>
            </ul>

            <p><strong>4. Moderation rights</strong><br>
            We reserve the right to review, edit, remove, or reject any message that violates these terms or appears unsafe or inappropriate. We may also block users who repeatedly misuse the website.</p>

            <p><strong>5. No warranties</strong><br>
            This website is provided on an “as is” and “as available” basis. We do not guarantee uninterrupted, secure, or error-free access.</p>

            <p><strong>6. Limitation of liability</strong><br>
            We are not liable for damages, losses, or problems arising from the use of this website, including issues caused by user-generated content, downtime, or security events.</p>

            <p><strong>7. Third-party content</strong><br>
            We are not responsible for content posted by users or for third-party links or services that may appear on this website.</p>

            <p><strong>8. Changes to the website</strong><br>
            We may update, change, or remove features at any time without notice.</p>

            <p><strong>9. Termination</strong><br>
            We may stop access to the website or remove content if we believe a user has violated these Terms.</p>

            <p><strong>10. Governing law</strong><br>
            These Terms are governed by the laws of [your country/state], without regard to conflict of law principles.</p>

            <p><strong>11. Contact</strong><br>
            If you have questions about these Terms, contact:<br>
            Message Wall Project<br>
            Email: garciaj@udd.edu.ph</p>
        </article>
    </main>

    <footer class="site-footer">
        <div class="links">
            <a href="./">Home</a>
            <a href="privacy-policy.php">Privacy</a>
            <a href="moderation-policy.php">Moderation</a>
            <a href="copyright-policy.php">Copyright</a>
        </div>
        <span>© 2026 Message Wall</span>
    </footer>
</body>
</html>
