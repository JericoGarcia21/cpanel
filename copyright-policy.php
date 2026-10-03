<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Copyright and DMCA notice for the Message Wall website.">
    <title>Copyright Policy | Message Wall</title>
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
            <p class="eyebrow">Copyright</p>
            <h1>Copyright and DMCA Notice</h1>

            <p>Last Updated: October 3, 2026</p>

            <p><strong>Disclaimer:</strong> This website is created for demonstration and academic purposes only as part of an SIA subject project. It does not represent a real company or commercial service.</p>

            <p>We respect the intellectual property rights of others. If you believe that content on this website infringes your copyright, please contact us.</p>

            <p><strong>1. Copyright policy</strong><br>
            Content posted on this website may be subject to copyright protection. We do not allow the posting of material that belongs to someone else without permission, unless the user has a lawful right to use it.</p>

            <p><strong>2. Reporting infringement</strong><br>
            If you believe your copyright has been infringed, send us a written notice that includes:</p>
            <ul>
                <li>Your full name and contact information</li>
                <li>A description of the work you believe has been infringed</li>
                <li>The URL or location of the allegedly infringing material</li>
                <li>A statement that you have a good-faith belief the use is unauthorized</li>
                <li>A statement that the information in the notice is accurate</li>
                <li>Your signature</li>
            </ul>

            <p><strong>3. Response</strong><br>
            We may review all notices and remove or disable access to material that appears to violate copyright law. We may also contact the user who posted the material.</p>

            <p><strong>4. Counter-notice</strong><br>
            If a user believes content was removed by mistake or misidentification, they may contact us with a counter-notice. We will review the counter-notice and may restore the content if appropriate.</p>

            <p><strong>5. Contact for copyright concerns</strong><br>
            Email: garciaj@udd.edu.ph<br>
            Business Name: Message Wall Project<br>
            Website: [your website URL]</p>
        </article>
    </main>

    <footer class="site-footer">
        <div class="links">
            <a href="./">Home</a>
            <a href="privacy-policy.php">Privacy</a>
            <a href="terms-and-conditions.php">Terms</a>
            <a href="moderation-policy.php">Moderation</a>
        </div>
        <span>© 2026 Message Wall</span>
    </footer>
</body>
</html>
