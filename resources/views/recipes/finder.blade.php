<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recipe Finder - Mystery Meal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            color-scheme: dark;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(245, 158, 11, 0.14), transparent 28%),
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.12), transparent 26%),
                linear-gradient(180deg, #020617 0%, #0f172a 45%, #111827 100%);
            color: #e2e8f0;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .glass {
            background: rgba(15, 23, 42, 0.62);
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

        .chip {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .input-dark,
        .select-dark {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
        }

        .input-dark:focus,
        .select-dark:focus {
            outline: none;
            border-color: rgba(251, 191, 36, 0.45);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.12);
        }

        .recipe-card {
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
        }

        .recipe-card:hover {
            transform: translateY(-4px);
            border-color: rgba(251, 191, 36, 0.35);
            box-shadow: 0 20px 50px rgba(2, 6, 23, 0.34);
        }

        .tag-btn {
            transition: transform 160ms ease, background 160ms ease, border-color 160ms ease;
        }

        .tag-btn:hover {
            transform: translateY(-1px);
            background: rgba(248, 113, 113, 0.16);
            border-color: rgba(248, 113, 113, 0.4);
        }

        .status-pill {
            min-height: 1.75rem;
        }

        .empty-state {
            background:
                radial-gradient(circle at top, rgba(251, 191, 36, 0.08), transparent 35%),
                rgba(255, 255, 255, 0.03);
        }

        .recipe-image {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(30, 41, 59, 0.92));
        }

        .badge {
            box-shadow: 0 10px 24px rgba(2, 6, 23, 0.2);
        }
    </style>
</head>
<body class="px-4 py-6 md:px-8 md:py-8">
    <div class="mx-auto max-w-7xl space-y-6">
        <header class="glass rounded-[2rem] px-6 py-5 md:px-8 md:py-6 hero-accent">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-400/15 text-2xl">
                            🥘
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Mystery Meal</p>
                            <h1 class="text-3xl font-black text-white md:text-5xl">Recipe Finder</h1>
                        </div>
                    </div>
                    <p class="max-w-3xl text-sm leading-6 text-slate-300 md:text-base">
                        Add the ingredients from your fridge, filter by cooking time, and get recipe matches with
                        the missing items clearly shown so you know what to buy next.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">Home</a>
                        <a href="/minigame" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">Play minigame</a>
                        <button id="refreshButton" class="primary-btn rounded-2xl px-5 py-3 text-sm font-semibold">Search recipes</button>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-3 lg:min-w-[520px]">
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Products</p>
                        <p id="statProducts" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">in your fridge</p>
                    </div>
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Matches</p>
                        <p id="statMatches" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">recipes found</p>
                    </div>
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Suggestions</p>
                        <p id="statSuggestions" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">almost there</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="grid gap-6 xl:grid-cols-[0.95fr_1.35fr]">
            <section class="space-y-6">
                <section class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-amber-300">Fridge input</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">Enter products</h2>
                            <p class="mt-2 text-sm text-slate-400">Separate ingredients with commas or add them one by one.</p>
                        </div>
                        <div class="text-3xl">🧊</div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="grid gap-3 sm:grid-cols-[1fr_auto]">
                            <input
                                id="productInput"
                                type="text"
                                class="input-dark rounded-2xl px-4 py-3"
                                placeholder="milk, cheese, pasta..."
                                autocomplete="off"
                            >
                            <button id="addProductButton" type="button" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                                Add product
                            </button>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Cooking time max</label>
                                <input
                                    id="cookingTimeInput"
                                    type="number"
                                    min="1"
                                    max="1440"
                                    class="input-dark w-full rounded-2xl px-4 py-3"
                                    placeholder="30"
                                >
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Quick filter</label>
                                <select id="timePreset" class="select-dark w-full rounded-2xl px-4 py-3">
                                    <option value="">Any time</option>
                                    <option value="15">Up to 15 min</option>
                                    <option value="30">Up to 30 min</option>
                                    <option value="45">Up to 45 min</option>
                                    <option value="60">Up to 60 min</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2" id="productsList"></div>

                        <div class="flex flex-wrap gap-3">
                            <button id="clearButton" type="button" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                                Clear products
                            </button>
                            <button id="findButton" type="button" class="primary-btn rounded-2xl px-5 py-3 text-sm font-semibold">
                                Find recipes
                            </button>
                        </div>

                        <div id="message" class="status-pill text-sm"></div>
                    </div>
                </section>

                <section class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-sky-300">AI suggestions</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">What you are still missing</h2>
                        </div>
                        <div class="text-3xl">🧠</div>
                    </div>

                    <div id="suggestionsPanel" class="mt-6 space-y-4">
                        <div class="empty-state rounded-[1.5rem] p-5 text-sm text-slate-400">
                            Search recipes to see suggested ingredients and near-matches.
                        </div>
                    </div>
                </section>
            </section>

            <section class="glass rounded-[2rem] p-6 md:p-8">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.28em] text-emerald-300">Recipes</p>
                        <h2 class="mt-2 text-2xl font-bold text-white">Results</h2>
                    </div>
                    <div class="text-3xl">🍽️</div>
                </div>

                <div id="recipeResults" class="mt-6 grid gap-4 md:grid-cols-2">
                    <div class="empty-state rounded-[1.5rem] p-6 text-slate-300 md:col-span-2">
                        Add some products and search to discover matching recipes.
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const selectedProducts = [];

        const productInput = document.getElementById('productInput');
        const cookingTimeInput = document.getElementById('cookingTimeInput');
        const timePreset = document.getElementById('timePreset');
        const productsList = document.getElementById('productsList');
        const recipeResults = document.getElementById('recipeResults');
        const suggestionsPanel = document.getElementById('suggestionsPanel');
        const message = document.getElementById('message');
        const statProducts = document.getElementById('statProducts');
        const statMatches = document.getElementById('statMatches');
        const statSuggestions = document.getElementById('statSuggestions');

        const placeholderImages = [
            'https://images.unsplash.com/photo-1547592180-85f173990554?w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=1200&auto=format&fit=crop'
        ];

        function escapeHtml(value) {
            return String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function productExists(product) {
            const needle = product.trim().toLowerCase();
            return selectedProducts.some((item) => item.toLowerCase() === needle);
        }

        function addProduct() {
            const product = productInput.value.trim();

            if (!product) {
                showMessage('Add at least one product first.', 'error');
                return;
            }

            const terms = product
                .split(',')
                .map((item) => item.trim())
                .filter(Boolean);

            let added = 0;

            terms.forEach((term) => {
                if (!productExists(term)) {
                    selectedProducts.push(term);
                    added += 1;
                }
            });

            productInput.value = '';
            renderProducts();
            updateStats();

            if (added > 0) {
                showMessage(`${added} product${added === 1 ? '' : 's'} added.`, 'success');
            } else {
                showMessage('That product is already in the list.', 'error');
            }
        }

        function removeProduct(index) {
            selectedProducts.splice(index, 1);
            renderProducts();
            updateStats();
        }

        function clearProducts() {
            selectedProducts.length = 0;
            renderProducts();
            updateStats();
            showMessage('Product list cleared.', 'success');
        }

        function renderProducts() {
            if (!selectedProducts.length) {
                productsList.innerHTML = `
                    <div class="empty-state rounded-2xl px-4 py-3 text-sm text-slate-400">
                        No products added yet.
                    </div>
                `;
                return;
            }

            productsList.innerHTML = selectedProducts.map((product, index) => `
                <div class="chip flex items-center gap-2 rounded-full px-3 py-2 text-sm text-slate-200">
                    <span class="max-w-[180px] truncate">${escapeHtml(product)}</span>
                    <button
                        type="button"
                        class="tag-btn inline-flex h-6 w-6 items-center justify-center rounded-full border border-white/10 text-sm text-slate-300"
                        data-index="${index}"
                        aria-label="Remove ${escapeHtml(product)}"
                    >
                        ×
                    </button>
                </div>
            `).join('');
        }

        function recipeCard(recipe, index, isSuggestion = false) {
            const ingredients = Array.isArray(recipe.ingredients) ? recipe.ingredients : [];
            const missing = Array.isArray(recipe.missing_ingredients) ? recipe.missing_ingredients : [];
            const found = Array.isArray(recipe.found_ingredients) ? recipe.found_ingredients : [];
            
            // Better image handling with multiple fallbacks
            let image = recipe.image;
            const fallbackImage = placeholderImages[index % placeholderImages.length];
            
            // If no image or invalid image, use fallback
            if (!image || image === '' || image.includes('recipe-placeholder.svg')) {
                image = fallbackImage;
            }
            const matchPercentage = recipe.match_percentage ?? 0;
            const matchedCount = recipe.matched_ingredients_count ?? 0;
            const totalCount = recipe.ingredient_count ?? 0;
            const missingCount = recipe.missing_ingredients_count ?? 0;
            
            const badgeClass = recipe.is_favorite
                ? 'bg-amber-400/15 text-amber-300 border-amber-400/30'
                : recipe.source === 'custom'
                    ? 'bg-emerald-400/15 text-emerald-300 border-emerald-400/30'
                    : 'bg-indigo-400/15 text-indigo-300 border-indigo-400/30';

            const matchColor = matchPercentage >= 70 ? 'text-emerald-300 bg-emerald-400/15 border-emerald-400/30' :
                            matchPercentage >= 40 ? 'text-amber-300 bg-amber-400/15 border-amber-400/30' :
                            'text-rose-300 bg-rose-400/15 border-rose-400/30';

            return `
                <article class="recipe-card glass-soft rounded-[1.75rem] p-4 border border-white/5 hover:border-white/10 cursor-pointer" onclick="window.location.href='/recipe/${recipe.id}'">
                    <div class="relative overflow-hidden rounded-[1.5rem] bg-slate-900">
                        <img
                            class="recipe-image"
                            src="${escapeHtml(image)}"
                            alt="${escapeHtml(recipe.name)}"
                            loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='${escapeHtml(fallbackImage)}';"
                        >
                        <div class="absolute right-3 top-3 rounded-full border px-3 py-1 text-xs font-semibold ${badgeClass}">
                            ${recipe.is_favorite ? '❤️ Favorite' : recipe.source === 'custom' ? '👨‍🍳 Custom' : '📚 Seeded'}
                        </div>
                        <div class="absolute left-3 top-3 rounded-full border px-3 py-1 text-xs font-bold ${matchColor}">
                            ${matchPercentage}% Match
                        </div>
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 to-transparent p-4">
                            <div class="flex items-center gap-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-300">
                                    ⏱️ ${escapeHtml(recipe.cooking_time ? `${recipe.cooking_time} min` : 'Flexible')}
                                </p>
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-300">
                                    🥘 ${matchedCount}/${totalCount} ingredients
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="text-lg font-bold text-white mb-2">${escapeHtml(recipe.name)}</h3>
                        <p class="text-sm leading-6 text-slate-400 mb-3">
                            ${escapeHtml(recipe.description || 'A delicious recipe match based on your fridge ingredients.')}
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mb-3">
                            ${found.map(ingredient => `
                                <span class="inline-flex items-center rounded-full bg-emerald-400/10 px-2 py-1 text-xs text-emerald-300 border border-emerald-400/20">
                                    ✓ ${escapeHtml(ingredient)}
                                </span>
                            `).join('')}
                            ${missing.map(ingredient => `
                                <span class="inline-flex items-center rounded-full bg-rose-400/10 px-2 py-1 text-xs text-rose-300 border border-rose-400/20">
                                    + ${escapeHtml(ingredient)}
                                </span>
                            `).join('')}
                        </div>

                        <div class="flex items-center justify-between text-xs">
                            <div class="flex gap-3">
                                <span class="text-emerald-300">✓ ${matchedCount} found</span>
                                ${missingCount > 0 ? `<span class="text-rose-300">+ ${missingCount} needed</span>` : ''}
                            </div>
                            ${recipe.difficulty ? `
                                <span class="text-slate-400">📊 ${escapeHtml(recipe.difficulty)}</span>
                            ` : ''}
                        </div>
                    </div>

                    ${isSuggestion ? `
                        <div class="mt-4 rounded-2xl bg-amber-400/10 border border-amber-400/20 px-4 py-3 text-sm text-amber-100">
                            💡 Add a few more ingredients to unlock this recipe fully!
                        </div>
                    ` : ''}
                </article>
            `;
        }

        function renderResults(recipes, suggestions, matchMode = 'strong') {
            const recipeList = Array.isArray(recipes) ? recipes : [];
            const suggestionList = Array.isArray(suggestions) ? suggestions : [];
            const recipeIds = new Set(recipeList.map((recipe) => recipe.id));
            const uniqueSuggestions = suggestionList.filter((recipe) => !recipeIds.has(recipe.id));

            recipeResults.innerHTML = recipeList.length > 0
                ? recipeList.map((recipe, index) => recipeCard(recipe, index, false)).join('')
                : `
                    <div class="empty-state rounded-[1.5rem] p-8 text-center md:col-span-2">
                        <div class="text-4xl mb-4">${matchMode === 'closest' ? '🔍' : '🥘'}</div>
                        <h3 class="text-xl font-semibold text-white mb-2">
                            ${matchMode === 'closest' ? 'Getting closer!' : 'No recipes found'}
                        </h3>
                        <p class="text-slate-300">
                            ${matchMode === 'closest'
                                ? 'Add a few more ingredients to unlock perfect recipe matches!'
                                : 'Try adding different ingredients or check the suggestions panel.'}
                        </p>
                    </div>
                `;

            suggestionsPanel.innerHTML = uniqueSuggestions.length > 0
                ? uniqueSuggestions.map((recipe, index) => recipeCard(recipe, index, true)).join('')
                : `
                    <div class="empty-state rounded-[1.5rem] p-5 text-center text-sm text-slate-400">
                        <div class="text-2xl mb-2">🧠</div>
                        <p>
                            ${matchMode === 'closest'
                                ? 'The closest matches are already shown above. Add more ingredients for better suggestions!'
                                : 'No suggestions yet. Try adding more ingredients to unlock recipe ideas.'}
                        </p>
                    </div>
                `;
        }

        function updateStats(matches = 0, suggestions = 0) {
            statProducts.textContent = selectedProducts.length;
            statMatches.textContent = matches;
            statSuggestions.textContent = suggestions;
        }

        function showMessage(text, type) {
            if (!text) {
                message.textContent = '';
                message.className = 'status-pill text-sm';
                return;
            }

            message.textContent = text;
            message.className = `status-pill text-sm ${type === 'error'
                ? 'text-rose-300'
                : type === 'info'
                    ? 'text-sky-300'
                    : 'text-emerald-300'}`;
        }

        function getCookingTimeMax() {
            const preset = timePreset.value.trim();
            if (preset) {
                cookingTimeInput.value = preset;
                return Number(preset);
            }

            const value = cookingTimeInput.value.trim();
            return value ? Number(value) : null;
        }

        async function findRecipes() {
            if (!selectedProducts.length) {
                showMessage('🥕 Please add at least one ingredient to get started!', 'error');
                recipeResults.innerHTML = `
                    <div class="empty-state rounded-[1.5rem] p-8 text-center">
                        <div class="text-4xl mb-4">🥘</div>
                        <h3 class="text-xl font-semibold text-white mb-2">No ingredients yet</h3>
                        <p class="text-slate-300">Add items from your fridge to discover delicious recipes!</p>
                    </div>
                `;
                suggestionsPanel.innerHTML = `
                    <div class="empty-state rounded-[1.5rem] p-5 text-sm text-slate-400">
                        🧠 Recipe suggestions will appear here once you add ingredients.
                    </div>
                `;
                updateStats(0, 0);
                return;
            }

            showMessage('🔍 Searching for perfect recipes...', 'info');
            recipeResults.innerHTML = `
                <div class="empty-state rounded-[1.5rem] p-8 text-center">
                    <div class="text-4xl mb-4 animate-pulse">🔍</div>
                    <h3 class="text-xl font-semibold text-white mb-2">Finding recipes</h3>
                    <p class="text-slate-300">Analyzing your ingredients...</p>
                </div>
            `;

            try {
                const payload = {
                    products: selectedProducts,
                    cooking_time_max: getCookingTimeMax()
                };

                const response = await fetch('/api/recipes/find', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();
                const recipes = Array.isArray(data.recipes) ? data.recipes : [];
                const suggestions = Array.isArray(data.suggestions) ? data.suggestions : [];

                renderResults(recipes, suggestions, data.match_mode);
                updateStats(recipes.length, suggestions.length);

                if (response.ok && data.success) {
                    const messageType = data.match_mode === 'closest' ? 'info' : 'success';
                    const message = data.match_mode === 'closest' 
                        ? `🔍 Found ${recipes.length} close match${recipes.length === 1 ? '' : 's'}! Add more ingredients for better results.`
                        : recipes.length > 0 
                            ? `🎉 Found ${recipes.length} perfect recipe${recipes.length === 1 ? '' : 's'} for you!`
                            : '🥗 No perfect matches, but check suggestions for close options!';
                    showMessage(message, messageType);
                } else {
                    showMessage(data.message || '🤔 No recipe match yet. Check the suggestions below!', 'error');
                }
            } catch (error) {
                console.error(error);
                recipeResults.innerHTML = `
                    <div class="empty-state rounded-[1.5rem] p-8 text-center">
                        <div class="text-4xl mb-4">😅</div>
                        <h3 class="text-xl font-semibold text-rose-300 mb-2">Oops! Something went wrong</h3>
                        <p class="text-slate-300">Please try searching again.</p>
                    </div>
                `;
                showMessage('⚠️ Error searching recipes. Please try again.', 'error');
            }
        }

        function syncPresetAndTimeInput() {
            if (timePreset.value) {
                cookingTimeInput.value = timePreset.value;
            }
        }

        document.getElementById('addProductButton').addEventListener('click', addProduct);
        document.getElementById('clearButton').addEventListener('click', clearProducts);
        document.getElementById('findButton').addEventListener('click', findRecipes);
        document.getElementById('refreshButton').addEventListener('click', findRecipes);

        productsList.addEventListener('click', (event) => {
            const button = event.target.closest('button[data-index]');
            if (!button) {
                return;
            }

            removeProduct(Number(button.dataset.index));
        });

        productInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                addProduct();
            }
        });

        cookingTimeInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                findRecipes();
            }
        });

        timePreset.addEventListener('change', syncPresetAndTimeInput);

        renderProducts();
        updateStats();
    </script>
</body>
</html>
