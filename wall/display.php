<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Message Wall</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700;800&display=swap" rel="stylesheet">
<style>
    html, body { font-family: 'Inter', system-ui, sans-serif; margin: 0; height: 100%; overflow: hidden; }
    .bubble {
        transition: font-size 0.6s ease, opacity 0.6s ease;
        white-space: nowrap;
    }
    #popup {
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.35s ease;
    }
    #popup.show { opacity: 1; }
    #popup span {
        transform: scale(0.85);
        transition: transform 0.35s cubic-bezier(.34,1.56,.64,1);
    }
    #popup.show span { transform: scale(1); }
</style>
</head>
<body class="bg-white relative w-full h-full">
    <div id="cloud" class="absolute inset-0 flex flex-wrap content-center justify-center items-center gap-5 p-10 overflow-hidden"></div>

    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-white z-10 p-10 text-center border-t-4 border-slate-900">
        <span id="popupText" class="text-slate-900 font-extrabold text-[clamp(2rem,8vw,6rem)]"></span>
    </div>

    <div class="fixed bottom-3 right-4 text-slate-300 text-xs">press R to reset</div>

<script>
const COLORS = ['#0f172a', '#334155', '#1d4ed8', '#0f766e', '#7c3aed', '#b91c1c'];
const cloudEl = document.getElementById('cloud');
const popupEl = document.getElementById('popup');
const popupTextEl = document.getElementById('popupText');

let known = new Map(); // id -> count
let popupQueue = [];
let popupBusy = false;
let firstLoad = true;

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
    const maxCount = Math.max(1, ...messages.map(m => m.count));
    cloudEl.innerHTML = '';
    messages.forEach(m => {
        const ratio = m.count / maxCount;
        const size = 1.1 + ratio * 4.5; // rem
        const bubble = document.createElement('div');
        bubble.className = 'bubble font-bold';
        bubble.style.fontSize = size + 'rem';
        bubble.style.color = colorFor(m.id);
        bubble.textContent = m.text + (m.count > 1 ? ' ×' + m.count : '');
        cloudEl.appendChild(bubble);
    });
}

async function poll() {
    try {
        const res = await fetch('api/messages.php');
        const data = await res.json();
        const messages = data.messages || [];

        if (!firstLoad) {
            for (const m of messages) {
                const prevCount = known.get(m.id);
                if (prevCount === undefined || m.count > prevCount) {
                    showPopup(m.text);
                }
            }
        }

        known = new Map(messages.map(m => [m.id, m.count]));
        renderCloud(messages);
        firstLoad = false;
    } catch (e) {
        // ignore transient network errors, next poll will retry
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

poll();
setInterval(poll, 1500);
</script>
</body>
</html>
