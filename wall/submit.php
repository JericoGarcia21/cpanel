<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="theme-color" content="#d9fa5d">
<title>Send a message</title>
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
    a:focus-visible, button:focus-visible, textarea:focus-visible, input:focus-visible { outline: 3px solid var(--blue); outline-offset: 3px; }
    .site-header { align-items: center; display: flex; justify-content: space-between; margin: 0 auto; max-width: 1240px; min-height: 78px; padding: 0 40px; }
    .brand { align-items: center; display: inline-flex; font-family: 'Space Grotesk', sans-serif; font-size: 16px; font-weight: 700; gap: 10px; text-decoration: none; }
    .brand-mark { align-items: center; background: var(--ink); border-radius: 50%; color: var(--lime); display: inline-flex; height: 34px; justify-content: center; width: 34px; }
    .header-link { font-size: 14px; font-weight: 700; text-underline-offset: 5px; }
    .message-layout { align-items: center; display: grid; gap: clamp(36px, 7vw, 88px); grid-template-columns: minmax(0, 0.9fr) minmax(360px, 1fr); margin: 0 auto; max-width: 1160px; min-height: calc(100vh - 78px); padding: 34px 40px 64px; }
    .eyebrow { align-items: center; display: inline-flex; font-size: 11px; font-weight: 700; gap: 9px; text-transform: uppercase; }
    .color-dot { background: var(--violet); border-radius: 50%; height: 9px; width: 9px; }
    h1 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(48px, 5vw, 68px); line-height: 0.98; margin: 24px 0 20px; }
    .intro { font-size: 18px; line-height: 1.6; margin: 0; max-width: 450px; }
    .public-note { border-left: 4px solid var(--teal); font-size: 15px; line-height: 1.6; margin-top: 30px; max-width: 420px; padding: 2px 0 2px 16px; }
    .public-note strong { display: block; font-family: 'Space Grotesk', sans-serif; font-size: 16px; margin-bottom: 3px; }
    .form-panel { background: white; border: 1px solid rgba(23, 25, 27, 0.18); border-top: 5px solid var(--violet); padding: 28px; }
    .form-kicker { color: var(--violet); font-size: 11px; font-weight: 700; margin: 0 0 8px; text-transform: uppercase; }
    .form-heading { font-family: 'Space Grotesk', sans-serif; font-size: 27px; margin: 0 0 22px; }
    .field-label { display: block; font-size: 12px; font-weight: 700; margin-bottom: 8px; text-transform: uppercase; }
    .message-input { background: #fff; border: 1px solid #9da29a; border-radius: 3px; display: block; font: inherit; font-size: 16px; line-height: 1.5; min-height: 150px; padding: 14px; resize: vertical; width: 100%; }
    .message-input:focus { border-color: var(--blue); outline: 2px solid var(--blue); outline-offset: 1px; }
    .message-input:disabled { background: #f0f1ed; color: #454943; }
    .char-row { color: #454943; display: flex; font-size: 13px; justify-content: space-between; margin: 8px 0 20px; }
    .consent-label { align-items: flex-start; color: #252825; display: flex; font-size: 16px; gap: 11px; line-height: 1.5; margin-bottom: 11px; }
    .consent-label input { accent-color: var(--violet); flex: 0 0 20px; height: 20px; margin: 3px 0 0; width: 20px; }
    .privacy-copy { color: #454943; font-size: 15px; line-height: 1.55; margin: 0 0 20px 31px; }
    .send-button { background: var(--ink); border: 1px solid var(--ink); border-radius: 3px; color: white; cursor: pointer; font: inherit; font-size: 15px; font-weight: 700; min-height: 52px; padding: 12px 18px; transition: background-color 150ms ease; width: 100%; }
    .send-button:hover:not(:disabled) { background: var(--blue); }
    .send-button:disabled { cursor: wait; opacity: 0.65; }
    .undo-panel { align-items: center; background: #eef0eb; border-left: 4px solid var(--coral); display: flex; gap: 12px; justify-content: space-between; margin-top: 14px; padding: 12px 14px; }
    .undo-panel[hidden] { display: none !important; }
    .undo-copy { font-size: 14px; font-weight: 600; }
    .undo-button { background: transparent; border: 0; color: var(--blue); cursor: pointer; font: inherit; font-size: 14px; font-weight: 700; padding: 8px 4px; text-decoration: underline; text-underline-offset: 3px; }
    .status { color: #454943; font-size: 14px; line-height: 1.5; margin: 14px 0 0; min-height: 1.5em; }
    .status-success { color: var(--teal); font-weight: 700; }
    .status-error { color: var(--red); font-weight: 700; }
    .status-cancelled { color: #454943; }
    @media (max-width: 760px) {
        .site-header { min-height: 68px; padding: 0 22px; }
        .message-layout { gap: 32px; grid-template-columns: minmax(0, 1fr); margin: 0 auto; max-width: 620px; min-height: auto; padding: 36px 22px 52px; }
        h1 { font-size: 54px; }
        .intro { font-size: 16px; }
        .form-panel { padding: 22px; }
    }
    @media (max-width: 380px) {
        .site-header { padding: 0 16px; }
        .brand > span:last-child { display: none; }
        .message-layout { padding: 28px 16px 42px; }
        h1 { font-size: 46px; }
        .form-panel { padding: 18px; }
        .privacy-copy { margin-left: 0; }
    }
</style>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="../" aria-label="Message Wall home">
            <span class="brand-mark" aria-hidden="true">W</span>
            <span>MESSAGE WALL</span>
        </a>
        <a class="header-link" href="./">Back to the QR page <span aria-hidden="true">↗</span></a>
    </header>

    <main class="message-layout">
        <section class="message-copy">
            <p class="eyebrow"><span class="color-dot" aria-hidden="true"></span> Your space on the wall</p>
            <h1>Say what's<br>on your mind.</h1>
            <p class="intro">Leave a thought, a small win, or something you need to get off your chest. No name is shown with your message.</p>
            <p class="public-note"><strong>Public, not private</strong>Your message may appear on the shared screen. Please leave out names and personal details.</p>
        </section>

        <section class="form-panel" aria-labelledby="form-heading">
            <p class="form-kicker">A note for everyone</p>
            <h2 class="form-heading" id="form-heading">Write your message</h2>
            <form id="messageForm">
                <label class="field-label" for="message">Your message</label>
                <textarea id="message" class="message-input" maxlength="<?= WALL_MESSAGE_MAX_LENGTH ?>" rows="4" required placeholder="What's on your mind?"></textarea>

                <div class="char-row">
                    <span>Keep it kind</span>
                    <span><span id="charCount">0</span>/<?= WALL_MESSAGE_MAX_LENGTH ?></span>
                </div>

                <label for="publicConsent" class="consent-label">
                    <input id="publicConsent" type="checkbox" required>
                    <span>I understand this message will be shown publicly without my name.</span>
                </label>
                <p class="privacy-copy">After pressing Post, you have 3 seconds to undo before it is sent.</p>

                <button id="sendBtn" class="send-button" type="submit">Post anonymously</button>

                <div id="undoPanel" class="undo-panel" hidden>
                    <span class="undo-copy">Posting in <span id="countdown">3</span> seconds</span>
                    <button id="undoBtn" class="undo-button" type="button">Undo</button>
                </div>

                <p id="status" class="status" role="status" aria-live="polite"></p>
            </form>
        </section>
    </main>

<script>
const form = document.getElementById('messageForm');
const textarea = document.getElementById('message');
const charCount = document.getElementById('charCount');
const consentCheckbox = document.getElementById('publicConsent');
const sendBtn = document.getElementById('sendBtn');
const undoPanel = document.getElementById('undoPanel');
const countdownEl = document.getElementById('countdown');
const undoBtn = document.getElementById('undoBtn');
const status = document.getElementById('status');
let countdownTimer = null;
let pendingMessage = '';

textarea.addEventListener('input', () => {
    charCount.textContent = textarea.value.length;
});

function restoreForm() {
    textarea.disabled = false;
    consentCheckbox.disabled = false;
    sendBtn.disabled = false;
    sendBtn.hidden = false;
    sendBtn.textContent = 'Post anonymously';
}

async function sendMessage(message) {
    undoPanel.hidden = true;
    status.textContent = 'Sending your message...';
    status.className = 'status';

    try {
        const res = await fetch('api/send.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message, publicConsent: consentCheckbox.checked }),
        });
        const data = await res.json();

        if (res.ok) {
            status.textContent = 'Posted. Your message may now appear on the public wall.';
            status.classList.add('status-success');
            textarea.value = '';
            charCount.textContent = '0';
            consentCheckbox.checked = false;
        } else {
            status.textContent = data.error || 'Something went wrong.';
            status.classList.add('status-error');
        }
    } catch (e) {
        status.textContent = 'Network error, try again.';
        status.classList.add('status-error');
    } finally {
        restoreForm();
    }
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    if (countdownTimer !== null || !form.reportValidity()) return;

    pendingMessage = textarea.value.trim();
    if (!pendingMessage) return;

    textarea.disabled = true;
    consentCheckbox.disabled = true;
    sendBtn.disabled = true;
    sendBtn.textContent = 'Waiting to post...';
    undoPanel.hidden = false;
    status.className = 'status';
    status.textContent = 'Your message is not public yet. Select Undo within 3 seconds to cancel.';

    let secondsLeft = 3;
    countdownEl.textContent = String(secondsLeft);
    countdownTimer = window.setInterval(() => {
        secondsLeft -= 1;
        countdownEl.textContent = String(secondsLeft);

        if (secondsLeft <= 0) {
            window.clearInterval(countdownTimer);
            countdownTimer = null;
            sendMessage(pendingMessage);
            pendingMessage = '';
        }
    }, 1000);
});

undoBtn.addEventListener('click', () => {
    if (countdownTimer === null) return;

    window.clearInterval(countdownTimer);
    countdownTimer = null;
    pendingMessage = '';
    undoPanel.hidden = true;
    restoreForm();
    status.textContent = 'Posting cancelled. Your message is still here.';
    status.className = 'status status-cancelled';
    textarea.focus();
});
</script>
</body>
</html>
