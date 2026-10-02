<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#d9fa5d">
	<meta name="description" content="A shared live message wall. Leave a note and see it join the big screen.">
	<title>Message Wall | Say it together</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<style>
		:root {
			color-scheme: light;
			--ink: #17191b;
			--paper: #f7f8f4;
			--lime: #d9fa5d;
			--coral: #fa6248;
			--blue: #3459d1;
			--wall-navy: #0f172a;
			--wall-slate: #334155;
			--wall-blue: #1d4ed8;
			--wall-teal: #0f766e;
			--wall-violet: #7c3aed;
			--wall-red: #b91c1c;
			--line: rgba(23, 25, 27, 0.2);
			font-family: 'DM Sans', sans-serif;
			color: var(--ink);
			background: var(--paper);
		}

		* { box-sizing: border-box; }
		body { margin: 0; }
		a { color: inherit; }
		a:focus-visible { outline: 3px solid var(--blue); outline-offset: 4px; }

		.topbar {
			align-items: center;
			display: flex;
			justify-content: space-between;
			margin: 0 auto;
			max-width: 1240px;
			min-height: 82px;
			padding: 0 40px;
		}

		.brand {
			align-items: center;
			display: inline-flex;
			font-family: 'Space Grotesk', sans-serif;
			font-size: 17px;
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

		.nav-links { display: flex; gap: 28px; }
		.nav-links a { font-size: 14px; font-weight: 600; text-decoration: none; }
		.nav-links a:hover { text-decoration: underline; text-underline-offset: 5px; }

		.hero {
			background: var(--lime);
			min-height: 620px;
			overflow: hidden;
			padding: 48px 40px 42px;
			position: relative;
		}

		.hero-layout {
			align-items: center;
			display: grid;
			gap: 30px;
			grid-template-columns: minmax(280px, 0.85fr) minmax(0, 1.15fr);
			margin: 0 auto;
			max-width: 1160px;
			min-height: 520px;
		}
		.hero-content { max-width: 500px; position: relative; z-index: 1; }
		.eyebrow {
			align-items: center;
			display: inline-flex;
			font-size: 12px;
			font-weight: 700;
			gap: 9px;
			text-transform: uppercase;
		}

		.live-dot { background: var(--coral); border-radius: 50%; height: 9px; width: 9px; }
		h1 {
			font-family: 'Space Grotesk', sans-serif;
			font-size: 76px;
			letter-spacing: 0;
			line-height: 0.98;
			margin: 22px 0 18px;
		}

		.intro { font-size: 19px; line-height: 1.55; margin: 0; max-width: 450px; }
		.actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }
		.button {
			align-items: center;
			border: 1px solid var(--ink);
			border-radius: 4px;
			display: inline-flex;
			font-size: 15px;
			font-weight: 700;
			justify-content: center;
			min-height: 50px;
			padding: 0 22px;
			text-decoration: none;
			transition: transform 150ms ease, background-color 150ms ease;
		}

		.button:hover { transform: translateY(-2px); }
		.button-primary { background: var(--ink); color: white; }
		.button-primary:hover { background: var(--blue); }
		.button-secondary { background: transparent; }
		.button-secondary:hover { background: rgba(255, 255, 255, 0.45); }

		.word-field {
			height: 400px;
			max-width: 610px;
			position: relative;
			width: 100%;
		}

		.word {
			position: absolute;
			font-family: 'Space Grotesk', sans-serif;
			font-weight: 700;
			line-height: 1;
			white-space: nowrap;
		}

		.word-one { color: var(--wall-blue); font-size: 49px; left: 7%; top: 5%; transform: rotate(-7deg); }
		.word-two { color: var(--wall-teal); font-size: 23px; left: 57%; top: 8%; transform: rotate(4deg); }
		.word-three { color: var(--wall-violet); font-size: 33px; left: 40%; top: 25%; transform: rotate(-3deg); }
		.word-four { color: var(--wall-slate); font-size: 34px; left: 3%; top: 38%; transform: rotate(4deg); }
		.word-five { color: var(--wall-red); font-size: 27px; left: 53%; top: 47%; transform: rotate(-5deg); }
		.word-six { color: var(--wall-teal); font-size: 25px; left: 10%; top: 70%; transform: rotate(-4deg); }
		.word-seven { color: var(--wall-navy); font-size: 38px; left: 48%; top: 76%; transform: rotate(3deg); }
		.word-eight { color: var(--wall-blue); font-size: 22px; left: 65%; top: 61%; transform: rotate(5deg); }

		.hero-display-link {
			bottom: 18px;
			color: var(--ink);
			font-size: 13px;
			font-weight: 700;
			position: absolute;
			right: 40px;
			text-decoration-thickness: 1px;
			text-underline-offset: 4px;
		}

		.note {
			align-items: center;
			border-top: 1px solid var(--line);
			display: flex;
			gap: 16px;
			justify-content: center;
			margin: 0 auto;
			max-width: 1240px;
			padding: 24px 40px 30px;
			text-align: center;
		}

		.note p { color: #505451; font-size: 13px; line-height: 1.5; margin: 0; }
		.note a { font-size: 13px; font-weight: 700; text-decoration-thickness: 1px; text-underline-offset: 4px; }

		@media (max-width: 640px) {
			.topbar { min-height: 68px; padding: 0 20px; }
			.nav-links { gap: 16px; }
			.nav-links a { font-size: 12px; }
			.hero { min-height: 760px; padding: 42px 20px 50px; }
			.hero-layout { gap: 8px; grid-template-columns: minmax(0, 1fr); min-height: 0; }
			.hero-content { margin: 0 auto; max-width: 460px; text-align: center; }
			h1 { font-size: 60px; margin-top: 20px; }
			.intro { font-size: 16px; margin: 0 auto; max-width: 380px; }
			.actions { gap: 10px; justify-content: center; margin-top: 24px; }
			.button { min-height: 48px; padding: 0 16px; }
			.word-field {
				display: grid;
				grid-template-columns: repeat(2, minmax(0, 1fr));
				height: auto;
				margin: 10px auto 0;
				max-width: 440px;
				padding: 12px 4px 8px;
				place-items: center;
				row-gap: 16px;
			}
			.word { justify-self: center; position: static; }
			.word-one { font-size: 38px; }
			.word-two { font-size: 19px; }
			.word-three { font-size: 26px; }
			.word-four { font-size: 27px; }
			.word-five { font-size: 22px; }
			.word-six { font-size: 20px; }
			.word-seven { font-size: 30px; }
			.word-eight { font-size: 18px; }
			.hero-display-link { bottom: 16px; left: 0; right: 0; text-align: center; }
			.note { align-items: flex-start; flex-direction: column; gap: 10px; padding: 20px; text-align: left; }
		}

		@media (max-width: 360px) {
			.topbar { padding: 0 16px; }
			.brand > span:last-child { display: none; }
			.nav-links { gap: 14px; }
			h1 { font-size: 38px; }
			.hero { min-height: 700px; }
			.word-field { grid-template-columns: minmax(0, 1fr); row-gap: 16px; }
			.word-one { font-size: 32px; }
			.word-three { font-size: 22px; }
			.word-four { font-size: 23px; }
			.word-seven { font-size: 26px; }
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after { scroll-behavior: auto !important; transition-duration: 0.01ms !important; }
		}
	</style>
</head>
<body>
	<header class="topbar">
		<a class="brand" href="./" aria-label="Message Wall home">
			<span class="brand-mark" aria-hidden="true">W</span>
			<span>MESSAGE WALL</span>
		</a>
		<nav class="nav-links" aria-label="Main navigation">
			<a href="wall/">Join in</a>
			<a href="wall/display.php">Big screen</a>
		</nav>
	</header>

	<main>
		<section class="hero" aria-labelledby="page-title">
			<div class="hero-layout">
				<div class="hero-content">
					<p class="eyebrow"><span class="live-dot" aria-hidden="true"></span> A live wall for everyone</p>
					<h1 id="page-title">Message<br>Wall</h1>
					<p class="intro">One room, many voices. Leave a note and watch it join the big screen.</p>
					<div class="actions">
						<a class="button button-primary" href="wall/">Leave a message <span aria-hidden="true">&nbsp;↗</span></a>
						<a class="button button-secondary" href="wall/display.php">Open the live wall</a>
					</div>
				</div>
				<div class="word-field" aria-label="Sample messages from the wall">
					<span class="word word-one">HELLO!</span>
					<span class="word word-two">WE'RE HERE</span>
					<span class="word word-three">TOGETHER</span>
					<span class="word word-four">NICE WORK</span>
					<span class="word word-five">LET'S GO</span>
					<span class="word word-six">CHEERS</span>
					<span class="word word-seven">YOU ROCK</span>
					<span class="word word-eight">THANK YOU</span>
				</div>
			</div>
			<a class="hero-display-link" href="wall/display.php">See the actual live wall <span aria-hidden="true">↗</span></a>
		</section>

		<aside class="note">
			<p>Messages are anonymous and may appear on a public screen. Keep it kind.</p>
			<a href="wall/">Join the wall <span aria-hidden="true">↗</span></a>
		</aside>
	</main>
</body>
</html>
