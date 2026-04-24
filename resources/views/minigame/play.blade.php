<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mystery Meal | Raining Food</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            color-scheme: dark;
        }

        html, body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(circle at top, rgba(56, 189, 248, 0.18), transparent 30%),
                radial-gradient(circle at 20% 20%, rgba(251, 191, 36, 0.14), transparent 22%),
                linear-gradient(180deg, #020617 0%, #0f172a 45%, #111827 100%);
            color: #e2e8f0;
        }

        .glass {
            background: rgba(15, 23, 42, 0.58);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 24px 80px rgba(2, 6, 23, 0.35);
        }

        .glass-soft {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .hero-accent {
            background:
                linear-gradient(135deg, rgba(251, 191, 36, 0.16), transparent 34%),
                linear-gradient(225deg, rgba(59, 130, 246, 0.12), transparent 30%);
        }

        .primary-btn {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fb7185 100%);
            color: #0f172a;
            box-shadow: 0 18px 40px rgba(245, 158, 11, 0.2);
            transition: transform 160ms ease, filter 160ms ease, box-shadow 160ms ease;
        }

        .primary-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
            box-shadow: 0 24px 50px rgba(245, 158, 11, 0.25);
        }

        .secondary-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform 160ms ease, border-color 160ms ease, background 160ms ease;
        }

        .secondary-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.08);
        }

        .stat-chip {
            border: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.04);
        }

        .canvas-wrap {
            position: relative;
        }

        #gameCanvas {
            display: block;
            width: 100%;
            height: min(68vh, 720px);
            min-height: 520px;
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 28px 70px rgba(2, 6, 23, 0.45);
            background:
                radial-gradient(circle at top, rgba(255, 255, 255, 0.06), transparent 34%),
                linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            cursor: crosshair;
        }

        .overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: linear-gradient(180deg, rgba(2, 6, 23, 0.18), rgba(2, 6, 23, 0.68));
            backdrop-filter: blur(10px);
        }

        .overlay-panel {
            width: min(100%, 520px);
        }

        .floating-score {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .toast {
            position: absolute;
            left: 50%;
            top: 1rem;
            transform: translateX(-50%);
            pointer-events: none;
            transition: opacity 180ms ease, transform 180ms ease;
        }

        .toast--hidden {
            opacity: 0;
            transform: translateX(-50%) translateY(-8px);
        }
    </style>
</head>
<body class="px-4 py-5 md:px-6 lg:px-8">
    <div class="mx-auto flex min-h-[calc(100vh-2.5rem)] max-w-7xl flex-col gap-5">
        <header class="glass hero-accent rounded-[2rem] px-5 py-5 md:px-7 md:py-6">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-400/15 text-2xl">
                            🌧️
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.32em] text-slate-400">Mystery Meal</p>
                            <h1 class="text-3xl font-black text-white md:text-5xl">Raining Food</h1>
                        </div>
                    </div>
                    <p class="max-w-2xl text-sm leading-6 text-slate-300 md:text-base">
                        Catch food, dodge foreign objects, and keep the streak alive while the recipe engine works in the background.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-3 lg:min-w-[520px]">
                    <div class="stat-chip rounded-3xl px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.28em] text-slate-400">Score</p>
                        <p id="scoreValue" class="mt-1 text-3xl font-black text-amber-300">0</p>
                    </div>
                    <div class="stat-chip rounded-3xl px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.28em] text-slate-400">Caught</p>
                        <p id="caughtValue" class="mt-1 text-3xl font-black text-emerald-300">0</p>
                    </div>
                    <div class="stat-chip rounded-3xl px-4 py-3">
                        <p class="text-[11px] uppercase tracking-[0.28em] text-slate-400">Lives</p>
                        <p id="livesValue" class="mt-1 text-3xl font-black text-rose-300">3</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="grid gap-5 xl:grid-cols-[1.5fr_0.95fr]">
            <section class="space-y-4">
                <div class="canvas-wrap">
                    <canvas id="gameCanvas" aria-label="Raining Food minigame"></canvas>

                    <div id="toast" class="toast glass-soft rounded-full px-4 py-2 text-sm text-slate-200 toast--hidden">
                        Loading game...
                    </div>

                    <div id="startOverlay" class="overlay">
                        <div class="overlay-panel glass rounded-[2rem] p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-400/15 text-3xl">
                                    🍓
                                </div>
                                <div class="space-y-3">
                                    <p class="text-xs uppercase tracking-[0.3em] text-amber-300">Mini-game</p>
                                    <h2 class="text-3xl font-black text-white">Catch the good stuff.</h2>
                                    <p class="text-sm leading-6 text-slate-300">
                                        Click only food items to score points. One wrong click on junk food or trash ends the game!
                                        The game speeds up as you survive longer.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 grid gap-3 sm:grid-cols-3">
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Food</p>
                                    <p class="mt-1 text-sm text-slate-300">Adds points and combo streaks.</p>
                                </div>
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Junk Food & Trash</p>
                                    <p class="mt-1 text-sm text-slate-300">One click ends the game!</p>
                                </div>
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Controls</p>
                                    <p class="mt-1 text-sm text-slate-300">Click, tap, or restart anytime.</p>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <button id="startButton" class="primary-btn rounded-2xl px-6 py-3 text-sm font-semibold">
                                    Start Game
                                </button>
                                <a href="/recipes" class="secondary-btn rounded-2xl px-6 py-3 text-sm font-semibold text-slate-100">
                                    Find recipes
                                </a>
                                <a href="/" class="secondary-btn rounded-2xl px-6 py-3 text-sm font-semibold text-slate-100">
                                    Back home
                                </a>
                            </div>
                        </div>
                    </div>

                    <div id="gameOverOverlay" class="overlay hidden">
                        <div class="overlay-panel glass rounded-[2rem] p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-rose-500/15 text-3xl">
                                    💥
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs uppercase tracking-[0.3em] text-rose-300">Game over</p>
                                    <h2 class="text-3xl font-black text-white">You clicked junk food!</h2>
                                    <p class="text-sm leading-6 text-slate-300">
                                        One wrong click ends the game. Your score has been saved. Try again to beat your best run!
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 grid gap-3 sm:grid-cols-3">
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Final score</p>
                                    <p id="finalScore" class="mt-1 text-3xl font-black text-amber-300">0</p>
                                </div>
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Caught</p>
                                    <p id="finalCaught" class="mt-1 text-3xl font-black text-emerald-300">0</p>
                                </div>
                                <div class="glass-soft rounded-2xl p-4">
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Foreign hits</p>
                                    <p id="finalForeign" class="mt-1 text-3xl font-black text-rose-300">1</p>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <button id="restartButton" class="primary-btn rounded-2xl px-6 py-3 text-sm font-semibold">
                                    Play again
                                </button>
                                <a href="/recipes" class="secondary-btn rounded-2xl px-6 py-3 text-sm font-semibold text-slate-100">
                                    Find recipes
                                </a>
                                <a href="/" class="secondary-btn rounded-2xl px-6 py-3 text-sm font-semibold text-slate-100">
                                    Back home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="space-y-5">
                <section class="glass rounded-[2rem] p-5 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-amber-300">Session</p>
                            <h2 class="mt-2 text-xl font-bold text-white">How it works</h2>
                        </div>
                        <span class="text-2xl">🎮</span>
                    </div>

                    <div class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <p>• Click only healthy food items to score points.</p>
                        <p>• Avoid junk food, sugar, and trash - one wrong click ends the game!</p>
                        <p>• Build combos by catching multiple foods in a row.</p>
                        <p>• The game speeds up as you survive longer.</p>
                    </div>
                </section>

                <section class="glass rounded-[2rem] p-5 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-indigo-300">Current streak</p>
                            <h2 class="mt-2 text-xl font-bold text-white">Boost your focus</h2>
                        </div>
                        <span class="text-2xl">✨</span>
                    </div>

                    <div class="mt-4 grid gap-3">
                        <div class="glass-soft rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Combo</p>
                            <p id="comboValue" class="mt-1 text-2xl font-bold text-white">0</p>
                        </div>
                        <div class="glass-soft rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Items spawned</p>
                            <p id="spawnedValue" class="mt-1 text-2xl font-bold text-white">0</p>
                        </div>
                        <div class="glass-soft rounded-2xl p-4">
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Foreign objects hit</p>
                            <p id="foreignValue" class="mt-1 text-2xl font-bold text-white">0</p>
                        </div>
                    </div>
                </section>
            </aside>
        </main>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const ui = {
            score: document.getElementById('scoreValue'),
            caught: document.getElementById('caughtValue'),
            lives: document.getElementById('livesValue'),
            combo: document.getElementById('comboValue'),
            spawned: document.getElementById('spawnedValue'),
            foreign: document.getElementById('foreignValue'),
            toast: document.getElementById('toast'),
            startOverlay: document.getElementById('startOverlay'),
            gameOverOverlay: document.getElementById('gameOverOverlay'),
            finalScore: document.getElementById('finalScore'),
            finalCaught: document.getElementById('finalCaught'),
            finalForeign: document.getElementById('finalForeign'),
        };

        const state = {
            started: false,
            running: false,
            gameOver: false,
            score: 0,
            caught: 0,
            lives: 3,
            combo: 0,
            foreignHits: 0,
            spawned: 0,
            time: 0,
            spawnAccumulator: 0,
            items: [],
            foodItems: [],
            foreignItems: [],
            config: {
                itemSize: 72,
                gravity: 210,
                spawnRate: 0.75,
                foreignChance: 0.24,
                maxLives: 3,
                scorePerFood: 10,
            }
        };

        const defaultFoodItems = [
            { name: 'Apple', emoji: '🍎', type: 'food' },
            { name: 'Banana', emoji: '🍌', type: 'food' },
            { name: 'Tomato', emoji: '🍅', type: 'food' },
            { name: 'Carrot', emoji: '🥕', type: 'food' },
            { name: 'Bread', emoji: '🍞', type: 'food' },
            { name: 'Cheese', emoji: '🧀', type: 'food' },
        ];

        const defaultForeignItems = [
            { name: 'Bottle', emoji: '🍾', type: 'foreign' },
            { name: 'Rock', emoji: '🪨', type: 'foreign' },
            { name: 'Trash', emoji: '🗑️', type: 'foreign' },
            { name: 'Bomb', emoji: '💣', type: 'foreign' },
        ];

        const clamp = (value, min, max) => Math.max(min, Math.min(max, value));
        const randomBetween = (min, max) => Math.random() * (max - min) + min;

        function resizeCanvas() {
            const rect = canvas.getBoundingClientRect();
            canvas.width = Math.max(1, Math.floor(rect.width));
            canvas.height = Math.max(1, Math.floor(rect.height));
        }

        function setToast(message, isError = false) {
            ui.toast.textContent = message;
            ui.toast.className = `toast glass-soft rounded-full px-4 py-2 text-sm ${isError ? 'text-rose-200' : 'text-slate-200'}`;
            ui.toast.classList.remove('toast--hidden');
            clearTimeout(setToast._timer);
            setToast._timer = setTimeout(() => {
                ui.toast.classList.add('toast--hidden');
            }, 2200);
        }

        function updateUI() {
            ui.score.textContent = state.score;
            ui.caught.textContent = state.caught;
            ui.lives.textContent = state.lives;
            ui.combo.textContent = state.combo;
            ui.spawned.textContent = state.spawned;
            ui.foreign.textContent = state.foreignHits;
        }

        function mergeConfig(payload) {
            const config = payload?.gameConfig || payload?.config || {};
            state.config = {
                itemSize: Number(config.itemSize || config.size || 72),
                gravity: Number(config.gravity || config.fallSpeed || 25), // Extremely fast falling
                spawnRate: Number(config.spawnRate || config.spawn_interval || 1.0), // Maximum frequency spawning
                foreignChance: Number(config.foreignChance || config.trashChance || 0.24),
                maxLives: Number(config.lives || config.maxLives || 1), // 1 life = immediate game over
                scorePerFood: Number(config.scorePerFood || 10),
                speedIncrease: Number(config.speedIncrease || 0.2), // Maximum acceleration
            };

            state.foodItems = Array.isArray(payload?.foodItems) && payload.foodItems.length ? payload.foodItems : defaultFoodItems;
            state.foreignItems = Array.isArray(payload?.foreignItems) && payload.foreignItems.length ? payload.foreignItems : defaultForeignItems;
            state.lives = state.config.maxLives;
        }

        function resetGameState() {
            state.started = true;
            state.running = true;
            state.gameOver = false;
            state.score = 0;
            state.caught = 0;
            state.combo = 0;
            state.foreignHits = 0;
            state.spawned = 0;
            state.time = 0;
            state.spawnAccumulator = 0;
            state.items = [];
            state.lives = state.config.maxLives;
            ui.gameOverOverlay.classList.add('hidden');
            ui.startOverlay.classList.add('hidden');
            updateUI();
            setToast('Game started. Catch the food!', false);
        }

        function showStartOverlay() {
            ui.startOverlay.classList.remove('hidden');
            ui.gameOverOverlay.classList.add('hidden');
        }

        function endGame() {
            if (state.gameOver) {
                return;
            }

            state.running = false;
            state.gameOver = true;
            ui.finalScore.textContent = state.score;
            ui.finalCaught.textContent = state.caught;
            ui.finalForeign.textContent = state.foreignHits;
            ui.gameOverOverlay.classList.remove('hidden');
            updateUI();
            saveScore().catch((error) => console.error('Score save failed:', error));
        }

        function chooseTemplate() {
            const isForeign = Math.random() < state.config.foreignChance;
            const list = isForeign ? state.foreignItems : state.foodItems;
            const fallback = isForeign ? defaultForeignItems : defaultFoodItems;
            const source = list.length ? list : fallback;
            const template = source[Math.floor(Math.random() * source.length)];

            return {
                ...template,
                type: isForeign ? 'foreign' : 'food',
            };
        }

        class FallingItem {
            constructor(template) {
                this.template = template;
                this.size = clamp(Number(template.size || state.config.itemSize), 56, 100);
                this.x = randomBetween(24, Math.max(24, canvas.width - this.size - 24));
                this.y = -this.size - randomBetween(0, 40);
                this.vy = state.config.gravity + randomBetween(-20, 65);
                this.spin = randomBetween(-1.4, 1.4);
                this.rotation = randomBetween(-0.2, 0.2);
                this.scale = 1;
                this.landed = false;
                this.id = `${Date.now()}-${Math.random().toString(16).slice(2)}`;
                this.points = template.type === 'food' ? state.config.scorePerFood : 0;
            }

            update(delta) {
                this.y += this.vy * delta;
                this.rotation += this.spin * delta * 0.01;
            }

            draw() {
                ctx.save();
                ctx.translate(this.x + this.size / 2, this.y + this.size / 2);
                ctx.rotate(this.rotation);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.font = `${Math.floor(this.size * 0.64)}px system-ui, Apple Color Emoji, Segoe UI Emoji`;

                const bg = this.template.type === 'food'
                    ? 'rgba(34, 197, 94, 0.12)'
                    : 'rgba(248, 113, 113, 0.15)';

                ctx.fillStyle = bg;
                roundRect(ctx, -this.size / 2, -this.size / 2, this.size, this.size, 20);
                ctx.fill();

                ctx.strokeStyle = this.template.type === 'food'
                    ? 'rgba(134, 239, 172, 0.45)'
                    : 'rgba(248, 113, 113, 0.45)';
                ctx.lineWidth = 2;
                ctx.stroke();

                ctx.fillText(this.template.emoji || (this.template.type === 'food' ? '🍏' : '🗑️'), 0, 0);
                ctx.restore();
            }

            contains(x, y) {
                return x >= this.x && x <= this.x + this.size && y >= this.y && y <= this.y + this.size;
            }

            isOffScreen() {
                return this.y > canvas.height + this.size;
            }
        }

        function roundRect(context, x, y, width, height, radius) {
            const r = Math.min(radius, width / 2, height / 2);
            context.beginPath();
            context.moveTo(x + r, y);
            context.arcTo(x + width, y, x + width, y + height, r);
            context.arcTo(x + width, y + height, x, y + height, r);
            context.arcTo(x, y + height, x, y, r);
            context.arcTo(x, y, x + width, y, r);
            context.closePath();
        }

        function spawnItem() {
            const template = chooseTemplate();
            state.items.push(new FallingItem(template));
            state.spawned += 1;
        }

        function drawBackground() {
            const width = canvas.width;
            const height = canvas.height;

            const gradient = ctx.createLinearGradient(0, 0, 0, height);
            gradient.addColorStop(0, '#1e293b');
            gradient.addColorStop(0.45, '#0f172a');
            gradient.addColorStop(1, '#020617');

            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, width, height);

            ctx.fillStyle = 'rgba(255, 255, 255, 0.05)';
            for (let i = 0; i < 14; i++) {
                const x = (i * 120 + (state.time * 10)) % (width + 160) - 80;
                const y = 40 + (i % 5) * 18;
                roundRect(ctx, x, y, 72, 22, 11);
                ctx.fill();
            }

            ctx.fillStyle = 'rgba(251, 191, 36, 0.08)';
            ctx.fillRect(0, height - 52, width, 52);

            ctx.fillStyle = 'rgba(148, 163, 184, 0.14)';
            ctx.fillRect(0, height - 80, width, 28);
        }

        function drawHud() {
            ctx.save();
            ctx.fillStyle = 'rgba(255, 255, 255, 0.06)';
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.12)';
            ctx.lineWidth = 1;

            roundRect(ctx, 20, 20, 220, 58, 18);
            ctx.fill();
            ctx.stroke();

            ctx.fillStyle = '#e2e8f0';
            ctx.font = '600 14px system-ui, sans-serif';
            ctx.fillText('Click only food — avoid junk food & trash!', 34, 44);
            ctx.font = '12px system-ui, sans-serif';
            ctx.fillStyle = '#94a3b8';
            ctx.fillText(`Spawn rate ${(state.config.spawnRate * 100).toFixed(0)}%`, 34, 63);
            ctx.restore();
        }

        function drawItems() {
            for (const item of state.items) {
                item.draw();
            }
        }

        function updateItems(delta) {
            const alive = [];

            for (const item of state.items) {
                item.update(delta);

                if (!item.isOffScreen()) {
                    alive.push(item);
                } else if (item.template.type === 'food') {
                    state.combo = 0;
                }
            }

            state.items = alive;
        }

        function drawFrame(timestamp) {
            if (!state.running) {
                drawBackground();
                drawHud();
                drawItems();
                return;
            }

            if (!state.lastFrame) {
                state.lastFrame = timestamp;
            }

            const delta = Math.min((timestamp - state.lastFrame) / 1000, 0.05);
            state.lastFrame = timestamp;
            state.time += delta;

            drawBackground();

            state.spawnAccumulator += delta;
            const spawnInterval = Math.max(0.01, 1 / Math.max(0.01, state.config.spawnRate)); // Virtually instant spawning
            while (state.spawnAccumulator >= spawnInterval) {
                spawnItem();
                state.spawnAccumulator -= spawnInterval;
            }

            updateItems(delta);
            drawItems();
            drawHud();

            requestAnimationFrame(drawFrame);
        }

        function handleCatch(item) {
            if (item.template.type === 'food') {
                state.score += item.points;
                state.caught += 1;
                state.combo += 1;

                if (state.combo > 0 && state.combo % 5 === 0) {
                    state.score += 15;
                    setToast(`Combo x${state.combo}! Bonus awarded.`);
                } else {
                    setToast(`Nice catch: ${item.template.name || 'Food'}!`);
                }
            } else {
                state.foreignHits += 1;
                state.combo = 0;
                setToast(`Game Over! You hit ${item.template.name || 'Trash'}!`, true);
                updateUI();
                endGame();
                return;
            }

            updateUI();
        }

        function handlePointerDown(event) {
            if (!state.started || state.gameOver) {
                return;
            }

            const rect = canvas.getBoundingClientRect();
            const x = (event.clientX - rect.left) * (canvas.width / rect.width);
            const y = (event.clientY - rect.top) * (canvas.height / rect.height);

            for (let i = state.items.length - 1; i >= 0; i--) {
                const item = state.items[i];
                if (item.contains(x, y)) {
                    state.items.splice(i, 1);
                    handleCatch(item);
                    break;
                }
            }
        }

        async function loadGameData() {
            try {
                const response = await fetch('/api/minigame/data', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const payload = await response.json();
                mergeConfig(payload);
                updateUI();
            } catch (error) {
                console.error('Failed to load minigame data:', error);
                mergeConfig({});
                updateUI();
                setToast('Using fallback game data.', true);
            }
        }

        async function saveScore() {
            const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
            const body = {
                score: state.score,
                items_caught: state.caught,
                foreign_hit: state.foreignHits,
                lives_remaining: state.lives,
                duration: Number(state.time.toFixed(2)),
            };

            try {
                const response = await fetch('/api/minigame/score', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(body)
                });

                if (!response.ok) {
                    console.warn('Score save returned non-OK status');
                }
            } catch (error) {
                console.error('Score save error:', error);
            }
        }

        async function startGame() {
            if (!state.foodItems.length || !state.foreignItems.length) {
                await loadGameData();
            }

            resizeCanvas();
            resetGameState();
            setToast('Good luck. Catch only food!', false);
            requestAnimationFrame(drawFrame);
        }

        function restartGame() {
            state.items = [];
            state.lastFrame = 0;
            startGame();
        }

        window.addEventListener('resize', () => {
            const wasRunning = state.running;
            resizeCanvas();
            if (!wasRunning) {
                drawBackground();
                drawHud();
            }
        });

        canvas.addEventListener('pointerdown', handlePointerDown);
        document.getElementById('startButton').addEventListener('click', startGame);
        document.getElementById('restartButton').addEventListener('click', restartGame);

        (async function bootstrap() {
            resizeCanvas();
            drawBackground();
            drawHud();
            await loadGameData();
            showStartOverlay();
            updateUI();
        })();
    </script>
</body>
</html>
