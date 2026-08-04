<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Send a message</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', system-ui, sans-serif; }
    textarea:focus { outline: none; }
    /* use the real visible viewport height on mobile browsers (avoids address-bar jump) */
    .min-h-dvh { min-height: 100vh; min-height: 100dvh; }
</style>
</head>
<body class="min-h-dvh bg-white flex items-center justify-center p-4 sm:p-6" style="padding-bottom: max(1rem, env(safe-area-inset-bottom));">
    <div class="w-full max-w-md border border-slate-200 rounded-2xl p-5 sm:p-7">
        <h1 class="text-xl font-bold text-slate-900 mb-1">Say something</h1>
        <p class="text-slate-500 text-sm mb-6">Anonymous. Shows up on the big screen. Keep it fun!</p>

        <textarea id="message" maxlength="<?= WALL_MESSAGE_MAX_LENGTH ?>" rows="4"
            placeholder="Type your message..."
            class="w-full rounded-xl border border-slate-300 focus:border-slate-500 p-4 text-base resize-none transition"
            style="font-size: 16px;"></textarea>

        <div class="text-right text-xs text-slate-400 mt-1 mb-5">
            <span id="charCount">0</span>/<?= WALL_MESSAGE_MAX_LENGTH ?>
        </div>

        <button id="sendBtn"
            class="w-full bg-slate-900 hover:bg-slate-700 active:bg-slate-700 text-white font-semibold py-4 rounded-xl transition disabled:opacity-50 disabled:cursor-not-allowed touch-manipulation">
            Send
        </button>

        <p id="status" class="text-center text-sm mt-4 min-h-[1.2em]"></p>
    </div>

<script>
const textarea = document.getElementById('message');
const charCount = document.getElementById('charCount');
const sendBtn = document.getElementById('sendBtn');
const status = document.getElementById('status');

textarea.addEventListener('input', () => {
    charCount.textContent = textarea.value.length;
});

sendBtn.addEventListener('click', async () => {
    const message = textarea.value.trim();
    if (!message) return;

    sendBtn.disabled = true;
    status.textContent = '';
    status.className = 'text-center text-sm mt-4 min-h-[1.2em]';

    try {
        const res = await fetch('api/send.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message }),
        });
        const data = await res.json();

        if (res.ok) {
            status.textContent = 'Sent! Check the screen.';
            status.classList.add('text-emerald-600', 'font-medium');
            textarea.value = '';
            charCount.textContent = '0';
        } else {
            status.textContent = data.error || 'Something went wrong.';
            status.classList.add('text-rose-600', 'font-medium');
        }
    } catch (e) {
        status.textContent = 'Network error, try again.';
        status.classList.add('text-rose-600', 'font-medium');
    } finally {
        sendBtn.disabled = false;
    }
});
</script>
</body>
</html>
