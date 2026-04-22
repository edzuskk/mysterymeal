<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raining Food - Minigame - Mystery Meal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2416 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .game-container {
            max-width: 800px;
            width: 100%;
        }

        .game-header {
            text-align: center;
            color: white;
            margin-bottom: 20px;
        }

        .game-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #ff6b35;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .game-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            color: #00d084;
            font-size: 1.2em;
            font-weight: bold;
        }

        #gameCanvas {
            display: block;
            background: linear-gradient(to bottom, #87CEEB 0%, #E0F6FF 100%);
            border: 4px solid #ff6b35;
            border-radius: 15px;
            width: 100%;
            height: 600px;
            cursor: pointer;
            box-shadow: 0 15px 40px rgba(255, 107, 53, 0.3);
            margin-bottom: 20px;
        }

        .game-info {
            background: linear-gradient(135deg, #2a2420 0%, #3a3430 100%);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            border-top: 3px solid #ff6b35;
        }

        .instructions {
            color: #ccc;
            font-size: 14px;
            line-height: 1.6;
        }

        .instructions h3 {
            color: #ff6b35;
            margin-bottom: 10px;
        }

        .controls {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }

        button {
            padding: 12px 24px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
        }

        button:hover {
            transform: scale(1.08);
        }

        nav {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        nav a {
            padding: 10px 20px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        #gameOverScreen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .game-over-content {
            background: linear-gradient(135deg, #2a2420 0%, #3a3430 100%);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #ff6b35;
        }

        .game-over-content h2 {
            color: #ff6b35;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .game-over-stats {
            margin: 20px 0;
            font-size: 1.2em;
            color: #ccc;
        }

        .game-over-stats div {
            margin: 10px 0;
        }

        .final-score {
            color: #00d084;
            font-size: 1.5em;
            font-weight: bold;
            margin: 15px 0;
        }

        @media (max-width: 768px) {
            .game-header h1 {
                font-size: 1.8em;
            }

            #gameCanvas {
                height: 400px;
            }

            .game-stats {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="game-container">
        <nav>
            <a href="/">Home</a>
            <a href="/recipes">Find Recipes</a>
        </nav>

        <div class="game-header">
            <h1>🌧️ Raining Food</h1>
            <div class="game-stats">
                <div>Score: <span id="score">0</span></div>
                <div>Caught: <span id="caught">0</span></div>
                <div>Lives: <span id="lives">3</span></div>
            </div>
        </div>

        <canvas id="gameCanvas"></canvas>

        <div class="game-info">
            <div class="instructions">
                <h3>How to Play</h3>
                <p>🍎 Catch only FOOD items (fruits, vegetables, dishes)</p>
                <p>⚠️ Avoid catching foreign objects (rocks, bombs, trash)</p>
                <p>👆 Click on items to catch them</p>
                <p>💥 Catch one foreign object and the game is over!</p>
            </div>
            <div class="controls">
                <button onclick="location.href='/'">Back Home</button>
            </div>
        </div>
    </div>

    <div id="gameOverScreen">
        <div class="game-over-content">
            <h2>Game Over!</h2>
            <div class="game-over-stats">
                <div class="final-score">Score: <span id="finalScore">0</span></div>
                <div>Items Caught: <span id="finalCaught">0</span></div>
                <div>Foreign Objects Hit: <span id="foreignHit">1</span></div>
            </div>
            <div class="controls">
                <button onclick="location.reload()">Play Again</button>
                <button onclick="location.href='/'">Back Home</button>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        // Game variables
        let score = 0;
        let caught = 0;
        let lives = 3;
        let gameOver = false;
        let items = [];
        let gameConfig = {};
        let foodItems = [];
        let foreignItems = [];

        // Resize canvas
        function resizeCanvas() {
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
        }

        // Initialize game
        async function init() {
            resizeCanvas();
            
            try {
                const response = await fetch('/api/minigame/data');
                const data = await response.json();
                
                gameConfig = data.gameConfig;
                foodItems = data.foodItems;
                foreignItems = data.foreignItems;

                gameLoop();
            } catch (error) {
                console.error('Error loading game data:', error);
                alert('Error loading game data');
            }
        }

        class FallingItem {
            constructor() {
                const isForeign = Math.random() < 0.25; // 25% chance of foreign object
                const itemList = isForeign ? foreignItems : foodItems;
                const item = itemList[Math.floor(Math.random() * itemList.length)];

                this.id = item.id;
                this.name = item.name;
                this.emoji = item.emoji;
                this.type = item.type;
                this.x = Math.random() * (canvas.width - 60);
                this.y = -60;
                this.size = gameConfig.itemSize;
                this.vy = gameConfig.gravity;
            }

            update() {
                this.y += this.vy;
            }

            draw() {
                ctx.font = `${this.size}px Arial`;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(this.emoji, this.x + this.size / 2, this.y + this.size / 2);
            }

            isClicked(mx, my) {
                return mx > this.x && mx < this.x + this.size &&
                       my > this.y && my < this.y + this.size;
            }

            isOutOfBounds() {
                return this.y > canvas.height;
            }
        }

        function gameLoop() {
            if (gameOver) return;

            // Clear canvas
            ctx.fillStyle = 'rgba(135, 206, 235, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Spawn new items
            if (Math.random() < 0.05) {
                items.push(new FallingItem());
            }

            // Update and draw items
            for (let i = items.length - 1; i >= 0; i--) {
                items[i].update();
                items[i].draw();

                // Remove items that fell off screen
                if (items[i].isOutOfBounds()) {
                    items.splice(i, 1);
                }
            }

            requestAnimationFrame(gameLoop);
        }

        canvas.addEventListener('click', (e) => {
            if (gameOver) return;

            const rect = canvas.getBoundingClientRect();
            const mx = e.clientX - rect.left;
            const my = e.clientY - rect.top;

            for (let i = items.length - 1; i >= 0; i--) {
                if (items[i].isClicked(mx, my)) {
                    if (items[i].type === 'food') {
                        score += 10;
                        caught++;
                    } else {
                        lives--;
                        if (lives <= 0) {
                            endGame();
                        }
                    }
                    items.splice(i, 1);
                    updateUI();
                    break;
                }
            }
        });

        function updateUI() {
            document.getElementById('score').textContent = score;
            document.getElementById('caught').textContent = caught;
            document.getElementById('lives').textContent = lives;
        }

        function endGame() {
            gameOver = true;
            document.getElementById('finalScore').textContent = score;
            document.getElementById('finalCaught').textContent = caught;
            document.getElementById('gameOverScreen').style.display = 'flex';

            // Save score
            fetch('/api/minigame/score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ score, items_caught: caught })
            }).catch(console.error);
        }

        // Initialize on load
        window.addEventListener('load', init);
        window.addEventListener('resize', resizeCanvas);
    </script>
</body>
</html>
