<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Privacy Policy for the Message Wall website.">
    <title>Privacy Policy | Message Wall</title>
    <style>
        :root {
            --ink: #17191b;
            --paper: #f7f8f4;
            --lime: #d9fa5d;
            --blue: #3459d1;
            --teal: #0f766e;
            --violet: #7c3aed;
            --red: #b91c1c;
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
            <a href="wall/">Join</a>
            <a href="wall/display.php">Live Wall</a>
        </nav>
    </header>

    <main class="container">
        <article class="page-card">
            <p class="eyebrow">Privacy</p>
            <h1>Privacy Policy</h1>

            <p>Last Updated: October 3, 2026</p>

            <p><strong>Disclaimer:</strong> This website is for demonstration and academic purposes only as part of an SIA subject project. It does not represent a real company, official service, or legal business entity. No real commercial operations or claims are made.</p>

            <p>This website allows users to submit messages that may be displayed publicly. We respect your privacy and are committed to handling personal information responsibly.</p>

            <p><strong>1. Information we collect</strong><br>
            We may collect the following information when you use the website:</p>
            <ul>
                <li>Messages submitted by users</li>
                <li>Date and time of each message</li>
                <li>IP address, browser information, and device information for security and moderation</li>
                <li>Server logs and error records</li>
                <li>Any information you provide when contacting us</li>
            </ul>

            <p><strong>2. How we use the information</strong><br>
            We use the information to operate and improve the website, detect spam or harmful content, maintain security, and comply with legal requirements.</p>

            <p><strong>3. Public messages</strong><br>
            This website is a public message wall. Messages may appear publicly and may be stored on our server. Please do not submit names, contact details, addresses, phone numbers, or other sensitive personal information.</p>

            <p><strong>4. Data retention</strong><br>
            We may keep messages, logs, and related records for as long as necessary to operate the website, protect users, and comply with legal obligations. We may remove content that is harmful, unlawful, or inappropriate.</p>

            <p><strong>5. Security</strong><br>
            We take reasonable steps to protect information from unauthorized access, misuse, or loss. However, no internet service is completely secure, and we cannot guarantee absolute security.</p>

            <p><strong>6. Third-party services</strong><br>
            We may use hosting, analytics, or other third-party services to support the website. These services may process personal information according to their own privacy policies.</p>

            <p><strong>7. Cookies</strong><br>
            We may use cookies or similar technologies to improve website performance, support functionality, and understand traffic patterns. You may disable cookies in your browser settings, but some features may not work properly.</p>

            <p><strong>8. Your rights</strong><br>
            Depending on your location, you may have the right to request access to, correction of, or deletion of your personal data. If you want a message removed or have a privacy question, contact us using the details below.</p>

            <p><strong>9. Changes to this policy</strong><br>
            We may update this policy from time to time. Any changes will be posted on this page with a new date.</p>

            <p><strong>10. Contact</strong><br>
            If you have questions about this Privacy Policy, contact:<br>
            Message Wall Project<br>
            Email: garciaj@udd.edu.ph<br>
            Website: [your website URL]</p>
        </article>
    </main>

    <footer class="site-footer">
        <div class="links">
            <a href="./">Home</a>
            <a href="terms-and-conditions.php">Terms</a>
            <a href="moderation-policy.php">Moderation</a>
            <a href="copyright-policy.php">Copyright</a>
        </div>
        <span>© 2026 Message Wall</span>
    </footer>
</body>
</html>
