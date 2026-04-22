<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mystery Meal - Reduce Food Waste, Find Recipes, Play!</title>
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
            color: #ccc;
        }

        header {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 5px 30px rgba(255, 107, 53, 0.3);
        }

        header h1 {
            font-size: 2.5em;
            color: white;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        header p {
            color: #fff;
            font-size: 1.1em;
            opacity: 0.95;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .hero-section {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }

        .hero-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #ff6b35;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .hero-section p {
            font-size: 1.2em;
            margin-bottom: 10px;
            opacity: 0.95;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .feature-card {
            background: linear-gradient(135deg, #2a2420 0%, #3a3430 100%);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 5px solid #ff6b35;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(255, 107, 53, 0.2);
        }

        .feature-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .feature-card h3 {
            color: #ff6b35;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        .feature-card p {
            color: #bbb;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 40px;
            font-size: 1.1em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            font-weight: bold;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .btn-primary:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 30px rgba(255, 107, 53, 0.5);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #00d084 0%, #00a86b 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(0, 208, 132, 0.3);
        }

        .btn-secondary:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 30px rgba(0, 208, 132, 0.5);
        }

        .goals-section {
            background: linear-gradient(135deg, #2a2420 0%, #3a3430 100%);
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            border-top: 5px solid #ff6b35;
        }

        .goals-section h2 {
            color: #ff6b35;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2em;
        }

        .goals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .goal-item {
            padding: 20px;
            background: rgba(255, 107, 53, 0.1);
            border-left: 4px solid #ff6b35;
            border-radius: 8px;
        }

        .goal-item h3 {
            color: #00d084;
            margin-bottom: 10px;
        }

        .goal-item p {
            color: #aaa;
            line-height: 1.6;
        }

        footer {
            background: rgba(0, 0, 0, 0.3);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            border-top: 2px solid #ff6b35;
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8em;
            }

            .hero-section h2 {
                font-size: 1.4em;
            }

            .hero-section p {
                font-size: 1em;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .goals-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>🍽️ Mystery Meal</h1>
        <p>Reduce Food Waste, Find Recipes, Have Fun!</p>
    </header>

    <div class="container">
        <div class="hero-section">
            <h2>Welcome to Mystery Meal</h2>
            <p>Tired of food waste? Can't decide what to cook?</p>
            <p>Mystery Meal helps you find delicious recipes using the ingredients you have!</p>
        </div>

        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">🥘</div>
                <h3>Recipe Finder</h3>
                <p>Enter the products in your fridge and get instant recipe suggestions that match your available ingredients!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🌧️</div>
                <h3>Raining Food Minigame</h3>
                <p>Play a fun interactive game where you catch falling food items while avoiding foreign objects!</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🌍</div>
                <h3>Reduce Waste</h3>
                <p>Smart recipe recommendations help you use your ingredients before they expire, reducing food waste.</p>
            </div>
        </div>

        <div class="goals-section">
            <h2>Project Goals</h2>
            <div class="goals-grid">
                <div class="goal-item">
                    <h3>🎯 Reduce Food Waste</h3>
                    <p>Help users utilize ingredients they already have at home, minimizing unnecessary food waste.</p>
                </div>
                <div class="goal-item">
                    <h3>⚡ Quick Recipe Finding</h3>
                    <p>Get instant recipe recommendations based on available products in seconds.</p>
                </div>
                <div class="goal-item">
                    <h3>🎮 Entertainment</h3>
                    <p>Enjoy a fun minigame while preparing your meal to pass the time and have fun.</p>
                </div>
                <div class="goal-item">
                    <h3>💻 Full-Stack App</h3>
                    <p>A complete web application with frontend UI, backend API, and interactive minigame.</p>
                </div>
            </div>
        </div>

        <div style="text-align: center;">
            <h2 style="color: white; margin-bottom: 30px;">Get Started Now!</h2>
            <div class="cta-buttons">
                <a href="/recipes" class="btn btn-primary">🥗 Find Recipes</a>
                <a href="/minigame" class="btn btn-secondary">🌧️ Play Minigame</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Mystery Meal. Reduce waste, eat smart!</p>
    </footer>
</body>
</html>
