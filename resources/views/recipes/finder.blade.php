<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Finder - Mystery Meal</title>
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
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: linear-gradient(135deg, #2a2420 0%, #3a3430 100%);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #ff6b35;
            margin-bottom: 30px;
            text-align: center;
        }

        .recipe-finder {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .input-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-section h3 {
            color: #00d084;
        }

        .product-input {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 2px solid #ff6b35;
            border-radius: 8px;
            background: #1a1a1a;
            color: white;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #00d084;
            box-shadow: 0 0 10px rgba(0, 208, 132, 0.3);
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
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .products-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .product-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: rgba(255, 107, 53, 0.2);
            border: 1px solid #ff6b35;
            border-radius: 20px;
            color: #ff6b35;
        }

        .product-tag button {
            background: none;
            border: none;
            cursor: pointer;
            color: #ff6b35;
            font-weight: bold;
        }

        .results-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .results-section h3 {
            color: #00d084;
        }

        .recipe-card {
            padding: 15px;
            border: 1px solid #ff6b35;
            border-radius: 8px;
            background: rgba(255, 107, 53, 0.05);
            transition: all 0.3s;
        }

        .recipe-card:hover {
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.2);
            transform: translateY(-2px);
        }

        .recipe-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .recipe-title {
            font-weight: bold;
            color: #ff6b35;
            margin-bottom: 5px;
        }

        .match-percentage {
            font-size: 12px;
            color: #00d084;
            font-weight: bold;
        }

        .recipe-description {
            font-size: 13px;
            color: #ccc;
            margin-top: 5px;
        }

        .no-recipes {
            text-align: center;
            color: #999;
            padding: 30px;
        }

        .error {
            background: rgba(231, 76, 60, 0.2);
            color: #ff6b35;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .success {
            background: rgba(0, 208, 132, 0.2);
            color: #00d084;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        nav {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }

        nav a {
            padding: 10px 20px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        nav a:hover {
            background: #764ba2;
        }

        @media (max-width: 768px) {
            .recipe-finder {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="/">Home</a>
            <a href="/minigame">Play Minigame</a>
        </nav>

        <h1>🍽️ Recipe Finder</h1>

        <div class="recipe-finder">
            <div class="input-section">
                <h3>Enter Your Products</h3>
                <div class="product-input">
                    <input 
                        type="text" 
                        id="productInput" 
                        placeholder="e.g., chicken, milk, pasta..."
                        autocomplete="off"
                    >
                    <button onclick="addProduct()">Add</button>
                </div>

                <div class="products-list" id="productsList"></div>

                <button onclick="findRecipes()" style="margin-top: 10px; width: 100%;">
                    🔍 Find Recipes
                </button>

                <div id="message"></div>
            </div>

            <div class="results-section">
                <h3>Recipes Found</h3>
                <div id="recipeResults">
                    <div class="no-recipes">
                        Add products and search to find recipes!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedProducts = [];

        function addProduct() {
            const input = document.getElementById('productInput');
            const product = input.value.trim();

            if (product && !selectedProducts.includes(product)) {
                selectedProducts.push(product);
                input.value = '';
                renderProducts();
                clearMessage();
            } else if (selectedProducts.includes(product)) {
                showMessage('Product already added', 'error');
            }
        }

        function removeProduct(product) {
            selectedProducts = selectedProducts.filter(p => p !== product);
            renderProducts();
        }

        function renderProducts() {
            const container = document.getElementById('productsList');
            container.innerHTML = selectedProducts
                .map(product => `
                    <div class="product-tag">
                        ${product}
                        <button onclick="removeProduct('${product}')">×</button>
                    </div>
                `)
                .join('');
        }

        async function findRecipes() {
            if (selectedProducts.length === 0) {
                showMessage('Please add at least one product', 'error');
                return;
            }

            showMessage('Searching recipes...', '');
            const resultsDiv = document.getElementById('recipeResults');
            resultsDiv.innerHTML = '<div class="loading">🔍 Searching...</div>';

            try {
                const response = await fetch('/api/recipes/find', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ products: selectedProducts })
                });

                const data = await response.json();

                if (data.success && data.recipes.length > 0) {
                    resultsDiv.innerHTML = data.recipes
                        .map(recipe => `
                            <div class="recipe-card">
                                ${recipe.image ? `<img src="${recipe.image}" alt="${recipe.name}" onerror="this.src='/placeholder.jpg'">` : ''}
                                <div class="recipe-title">${recipe.name}</div>
                                <div class="match-percentage">
                                    ✓ Match: ${recipe.match_percentage}%
                                </div>
                                ${recipe.description ? `<div class="recipe-description">${recipe.description}</div>` : ''}
                                <small style="color: #999;">Ingredients: ${recipe.products.map(p => p.name).join(', ')}</small>
                            </div>
                        `)
                        .join('');
                    showMessage(`Found ${data.recipes.length} recipes!`, 'success');
                } else {
                    resultsDiv.innerHTML = `<div class="no-recipes">${data.message}</div>`;
                    showMessage(data.message, 'error');
                }
            } catch (error) {
                resultsDiv.innerHTML = '<div class="no-recipes">Error searching recipes</div>';
                showMessage('Error: ' + error.message, 'error');
            }
        }

        function showMessage(text, type) {
            const messageDiv = document.getElementById('message');
            if (type) {
                messageDiv.className = type;
                messageDiv.textContent = text;
            } else {
                messageDiv.textContent = text;
                messageDiv.className = '';
            }
        }

        function clearMessage() {
            document.getElementById('message').textContent = '';
            document.getElementById('message').className = '';
        }

        // Allow Enter key to add product
        document.getElementById('productInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addProduct();
            }
        });
    </script>
</body>
</html>
