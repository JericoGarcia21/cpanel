<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="theme-color" content="#f7f8f4">
<title>Message Wall</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<style>
    :root { color-scheme: light; --ink: #17191b; --paper: #f7f8f4; }
    html, body { background: var(--paper); color: var(--ink); font-family: 'DM Sans', sans-serif; margin: 0; height: 100%; overflow: hidden; }
    .bubble {
        font-family: 'Space Grotesk', sans-serif;
        transition: font-size 0.6s ease, opacity 0.6s ease;
        max-width: 92vw;
        text-align: center;
        word-break: break-word;
        overflow-wrap: break-word;
    }
    #moreCount { color: #334155; }
    #popup {
        background-color: var(--paper);
        border-top-color: var(--ink);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.35s ease;
    }
    #popup.show { opacity: 1; }
    #popup span {
        color: var(--ink);
        transform: scale(0.85);
        transition: transform 0.35s cubic-bezier(.34,1.56,.64,1);
    }
    #popup.show span { transform: scale(1); }
    .reset-hint { color: #60655e; }
</style>
</head>
<body class="relative w-full h-full">
    <div id="cloud" class="absolute inset-0 flex flex-col flex-wrap content-center justify-center items-center gap-3 sm:gap-4 p-4 sm:p-10 overflow-hidden"></div>
    <div id="moreCount" class="fixed top-2 right-3 sm:top-3 sm:right-4 text-slate-400 text-[10px] sm:text-xs hidden"></div>

    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-white z-10 p-6 sm:p-10 text-center border-t-4 border-slate-900">
        <span id="popupText" class="text-slate-900 font-extrabold text-[clamp(1.5rem,9vw,6rem)] max-w-[92vw] break-words"></span>
    </div>

    <div class="reset-hint fixed bottom-2 right-3 sm:bottom-3 sm:right-4 text-[10px] sm:text-xs">press R to reset</div>

<script>
const COLORS = ['#0f172a', '#334155', '#1d4ed8', '#0f766e', '#7c3aed', '#b91c1c'];
const cloudEl = document.getElementById('cloud');
const popupEl = document.getElementById('popup');
const popupTextEl = document.getElementById('popupText');
const moreCountEl = document.getElementById('moreCount');

const MAX_VISIBLE = 60;
let lastId = 0;
let known = new Map();
let popupQueue = [];
let popupBusy = false;
let lastMessages = [];

function colorFor(id) {
    return COLORS[id % COLORS.length];
}

function showPopup(text) {
    popupQueue.push(text);
    if (!popupBusy) drainPopupQueue();
}

function drainPopupQueue() {
    if (popupQueue.length === 0) {
        popupBusy = false;
        return;
    }
    popupBusy = true;
    const text = popupQueue.shift();
    popupTextEl.textContent = text;
    popupEl.classList.add('show');
    setTimeout(() => {
        popupEl.classList.remove('show');
        setTimeout(drainPopupQueue, 400);
    }, 2200);
}

function renderCloud(messages) {
    const sorted = [...messages].sort((a, b) =>
        b.count - a.count || new Date(b.updated_at) - new Date(a.updated_at)
    );
    const visible = sorted.slice(0, MAX_VISIBLE);
    const hiddenCount = sorted.length - visible.length;
    const density = Math.min(1, 24 / Math.max(1, visible.length));
    const maxCount = Math.max(1, ...visible.map(m => m.count));
    const viewportScale = Math.max(0.4, Math.min(1, window.innerWidth / 900));

    cloudEl.innerHTML = '';
    visible.forEach(m => {
        const ratio = m.count / maxCount;
        const size = Math.max(0.7, (1.1 + ratio * 4.5) * Math.max(0.45, density) * viewportScale);
        const bubble = document.createElement('div');
        bubble.className = 'bubble font-bold';
        bubble.style.fontSize = size + 'rem';
        bubble.style.color = colorFor(m.id);
        bubble.textContent = m.text;
        cloudEl.appendChild(bubble);
    });

    if (hiddenCount > 0) {
        moreCountEl.textContent = '+' + hiddenCount + ' more not shown';
        moreCountEl.classList.remove('hidden');
    } else {
        moreCountEl.classList.add('hidden');
    }
}

async function loadMessages() {
    try {
        const res = await fetch('api/messages.php?last_id=' + lastId);
        const data = await res.json();
        const messages = data.messages || [];

        if (!messages.length) {
            return;
        }

        const newestId = messages.reduce((max, msg) => Math.max(max, Number(msg.id || 0)), lastId);
        lastId = newestId;

        for (const msg of messages) {
            const prevCount = known.get(Number(msg.id));
            if (prevCount === undefined || Number(msg.count) > prevCount) {
                showPopup(msg.text);
            }
        }

        const merged = [...lastMessages, ...messages].reduce((map, msg) => {
            const key = Number(msg.id);
            const existing = map.get(key);
            if (!existing || Number(msg.count) > Number(existing.count)) {
                map.set(key, msg);
            }
            return map;
        }, new Map());

        const sorted = [...merged.values()].sort((a, b) => Number(b.id) - Number(a.id));
        known = new Map(sorted.map(m => [Number(m.id), Number(m.count)]));
        lastMessages = sorted;
        renderCloud(sorted);
    } catch (e) {
        // ignore transient network errors and retry on the next poll
    }
}

document.addEventListener('keydown', async (e) => {
    if (e.key.toLowerCase() !== 'r') return;
    const code = prompt('Enter reset code:');
    if (!code) return;
    try {
        const res = await fetch('api/reset.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ code }),
        });
        if (res.ok) {
            lastId = 0;
            lastMessages = [];
            known = new Map();
            cloudEl.innerHTML = '';
            alert('Wall reset.');
        } else {
            alert('Wrong code.');
        }
    } catch (e) {
        alert('Network error.');
    }
});

let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => renderCloud(lastMessages), 200);
});

(async function bootstrap() {
    try {
        const res = await fetch('api/messages.php');
        const data = await res.json();
        const initial = data.messages || [];
        if (initial.length) {
            lastMessages = [...initial].sort((a, b) => Number(b.id) - Number(a.id));
            lastId = Number(lastMessages[0].id);
            known = new Map(lastMessages.map(m => [Number(m.id), Number(m.count)]));
            renderCloud(lastMessages);
        }
    } catch (e) {
        // ignore initial load errors; poll() will retry
    }

    setInterval(loadMessages, 1500);
})();
</script>
</body>
</html>
