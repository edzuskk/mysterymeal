<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mystery Meal | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            color-scheme: dark;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(245, 158, 11, 0.18), transparent 34%),
                radial-gradient(circle at top right, rgba(99, 102, 241, 0.16), transparent 28%),
                linear-gradient(135deg, #020617 0%, #0f172a 40%, #111827 100%);
            color: #e2e8f0;
        }

        .glass {
            background: rgba(15, 23, 42, 0.62);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 24px 80px rgba(2, 6, 23, 0.38);
        }

        .glass-soft {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .hero-grid {
            background:
                linear-gradient(135deg, rgba(251, 191, 36, 0.12), transparent 30%),
                linear-gradient(225deg, rgba(99, 102, 241, 0.10), transparent 28%);
        }

        .section-title {
            letter-spacing: 0.02em;
        }

        .gradient-text {
            background: linear-gradient(90deg, #fde68a 0%, #f59e0b 32%, #fb7185 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .chip {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .recipe-card {
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .recipe-card:hover {
            transform: translateY(-4px);
            border-color: rgba(251, 191, 36, 0.35);
            box-shadow: 0 18px 50px rgba(2, 6, 23, 0.35);
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .input-dark,
        .textarea-dark,
        .select-dark {
            background: rgba(15, 23, 42, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #e2e8f0;
        }

        .input-dark:focus,
        .textarea-dark:focus,
        .select-dark:focus {
            outline: none;
            border-color: rgba(251, 191, 36, 0.45);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.12);
        }

        .primary-btn {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 55%, #fb7185 100%);
            color: #0f172a;
            box-shadow: 0 18px 36px rgba(245, 158, 11, 0.22);
            transition: transform 160ms ease, filter 160ms ease;
        }

        .primary-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.03);
        }

        .secondary-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform 160ms ease, border-color 160ms ease;
        }

        .secondary-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(255, 255, 255, 0.16);
        }
    </style>
</head>
<body class="px-4 py-6 md:px-8 md:py-8">
    <div class="mx-auto max-w-7xl space-y-6">
        <header class="glass rounded-[2rem] px-6 py-5 md:px-8 md:py-6 hero-grid">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-400/15 text-2xl">
                            🍲
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Mystery Meal</p>
                            <h1 class="text-3xl font-black md:text-5xl gradient-text">Cook smart. Waste less.</h1>
                        </div>
                    </div>
                    <p class="max-w-2xl text-sm leading-6 text-slate-300 md:text-base">
                        Enter fridge ingredients, discover matching recipes, save favorites, add your own creations,
                        and take a quick break with the Raining Food minigame.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/recipes" class="primary-btn rounded-2xl px-5 py-3 text-sm font-semibold">
                            Find recipes
                        </a>
                        <a href="/minigame" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                            Play the minigame
                        </a>
                        <button id="refreshDashboard" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                            Refresh data
                        </button>
                    </div>
                </div>

                <div class="grid w-full gap-3 sm:grid-cols-3 lg:max-w-xl">
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Recipes</p>
                        <p id="statRecipes" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">available now</p>
                    </div>
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Favorites</p>
                        <p id="statFavorites" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">saved recipes</p>
                    </div>
                    <div class="glass-soft rounded-3xl p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Custom</p>
                        <p id="statCustom" class="mt-2 text-3xl font-bold text-white">0</p>
                        <p class="mt-1 text-xs text-slate-400">user recipes</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
            <main class="space-y-6">
                <section class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="section-title text-xs uppercase tracking-[0.28em] text-amber-300">AI fridge assistant</p>
                            <h2 class="mt-2 text-2xl font-bold text-white md:text-3xl">Recipes from what you already have</h2>
                            <p class="mt-2 max-w-2xl text-sm text-slate-400">
                                Jump into the finder, add ingredients from your fridge, and filter by cooking time to discover
                                the best possible match.
                            </p>
                        </div>
                        <a href="/recipes" class="secondary-btn rounded-2xl px-4 py-2 text-sm font-semibold text-slate-100">
                            Open recipe finder →
                        </a>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3" id="recipeGrid">
                        <div class="glass-soft rounded-[1.5rem] p-5">
                            <div class="h-40 animate-pulse rounded-2xl bg-white/5"></div>
                            <div class="mt-4 space-y-2">
                                <div class="h-4 w-3/5 rounded bg-white/8"></div>
                                <div class="h-3 w-full rounded bg-white/6"></div>
                                <div class="h-3 w-5/6 rounded bg-white/6"></div>
                            </div>
                        </div>
                        <div class="glass-soft rounded-[1.5rem] p-5">
                            <div class="h-40 animate-pulse rounded-2xl bg-white/5"></div>
                            <div class="mt-4 space-y-2">
                                <div class="h-4 w-3/5 rounded bg-white/8"></div>
                                <div class="h-3 w-full rounded bg-white/6"></div>
                                <div class="h-3 w-5/6 rounded bg-white/6"></div>
                            </div>
                        </div>
                        <div class="glass-soft rounded-[1.5rem] p-5">
                            <div class="h-40 animate-pulse rounded-2xl bg-white/5"></div>
                            <div class="mt-4 space-y-2">
                                <div class="h-4 w-3/5 rounded bg-white/8"></div>
                                <div class="h-3 w-full rounded bg-white/6"></div>
                                <div class="h-3 w-5/6 rounded bg-white/6"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="section-title text-xs uppercase tracking-[0.28em] text-amber-300">Create your own</p>
                            <h2 class="mt-2 text-2xl font-bold text-white">Add a custom recipe</h2>
                            <p class="mt-2 text-sm text-slate-400">
                                Save your own creations in the browser session-backed recipe list and make them part of your kitchen flow.
                            </p>
                        </div>
                        <div id="formStatus" class="text-sm text-slate-400"></div>
                    </div>

                    <form id="customRecipeForm" class="mt-6 grid gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Recipe name</label>
                            <input name="name" required class="input-dark w-full rounded-2xl px-4 py-3" placeholder="Grandma's Cozy Soup">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Cooking time</label>
                            <input name="cooking_time" type="number" min="1" required class="input-dark w-full rounded-2xl px-4 py-3" placeholder="25">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Description</label>
                            <input name="description" class="input-dark w-full rounded-2xl px-4 py-3" placeholder="A comforting meal made from leftover ingredients">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Difficulty</label>
                            <select name="difficulty" class="select-dark w-full rounded-2xl px-4 py-3">
                                <option value="Easy">Easy</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard">Hard</option>
                                <option value="Custom">Custom</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Image URL</label>
                            <input name="image_url" type="url" class="input-dark w-full rounded-2xl px-4 py-3" placeholder="https://example.com/photo.jpg">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Ingredients</label>
                            <input name="ingredients" required class="input-dark w-full rounded-2xl px-4 py-3" placeholder="milk, cheese, pasta, butter">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-xs uppercase tracking-[0.2em] text-slate-400">Instructions</label>
                            <textarea name="instructions" required rows="5" class="textarea-dark w-full rounded-3xl px-4 py-3" placeholder="Describe the steps clearly..."></textarea>
                        </div>

                        <div class="md:col-span-2 flex flex-wrap gap-3">
                            <button type="submit" class="primary-btn rounded-2xl px-6 py-3 text-sm font-semibold">
                                Save recipe
                            </button>
                            <button type="reset" class="secondary-btn rounded-2xl px-6 py-3 text-sm font-semibold text-slate-100">
                                Clear form
                            </button>
                        </div>
                    </form>
                </section>
            </main>

            <aside class="space-y-6">
                <section class="glass rounded-[2rem] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="section-title text-xs uppercase tracking-[0.28em] text-amber-300">Favorites</p>
                            <h2 class="mt-2 text-xl font-bold text-white">Your saved recipes</h2>
                        </div>
                        <span id="favoriteCountBadge" class="chip rounded-full px-3 py-1 text-xs text-slate-300">0 saved</span>
                    </div>
                    <div id="favoritesList" class="mt-5 space-y-3">
                        <div class="glass-soft rounded-2xl p-4 text-sm text-slate-400">
                            Loading favorites...
                        </div>
                    </div>
                </section>

                <section class="glass rounded-[2rem] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="section-title text-xs uppercase tracking-[0.28em] text-indigo-300">Minigame</p>
                            <h2 class="mt-2 text-xl font-bold text-white">Raining Food</h2>
                        </div>
                        <div class="text-2xl">🌧️</div>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-slate-400">
                        Catch food, dodge trash, and keep the streak alive while your recipe ideas load in the background.
                    </p>
                    <div class="mt-5 flex gap-3">
                        <a href="/minigame" class="primary-btn rounded-2xl px-4 py-3 text-sm font-semibold">
                            Play now
                        </a>
                        <a href="/recipes" class="secondary-btn rounded-2xl px-4 py-3 text-sm font-semibold text-slate-100">
                            Find recipes
                        </a>
                    </div>
                </section>

                <section class="glass rounded-[2rem] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="section-title text-xs uppercase tracking-[0.28em] text-emerald-300">Custom recipes</p>
                            <h2 class="mt-2 text-xl font-bold text-white">Your creations</h2>
                        </div>
                        <span id="customCountBadge" class="chip rounded-full px-3 py-1 text-xs text-slate-300">0 recipes</span>
                    </div>
                    <div id="customRecipesList" class="mt-5 space-y-3">
                        <div class="glass-soft rounded-2xl p-4 text-sm text-slate-400">
                            No custom recipes yet.
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>

    <template id="recipeCardTemplate">
        <article class="recipe-card glass-soft rounded-[1.75rem] p-5">
            <div class="relative overflow-hidden rounded-3xl bg-slate-900/70">
                <div class="recipe-image h-44 w-full bg-cover bg-center"></div>
                <div class="recipe-badge absolute right-3 top-3 rounded-full px-3 py-1 text-xs font-semibold"></div>
            </div>
            <div class="mt-4 flex items-start justify-between gap-3">
                <div>
                    <h3 class="recipe-name text-lg font-bold text-white"></h3>
                    <p class="recipe-description mt-1 text-sm leading-6 text-slate-400"></p>
                </div>
                <button class="favorite-btn secondary-btn rounded-full px-3 py-2 text-xs font-semibold text-slate-100" type="button">
                    ☆
                </button>
            </div>
            <div class="recipe-meta mt-4 flex flex-wrap gap-2 text-xs text-slate-300"></div>
            <div class="recipe-missing mt-4 rounded-2xl bg-black/20 px-4 py-3 text-sm text-slate-300"></div>
        </article>
    </template>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const appState = {
            recipes: [],
            favorites: [],
            customRecipes: [],
            stats: {
                recipe_count: 0,
                favorite_count: 0,
                custom_count: 0,
                average_cooking_time: null,
            },
            favoriteIds: [],
        };
        
        // Flag to prevent multiple simultaneous API calls
        let isTogglingFavorite = false;

        const placeholders = [
            'https://images.unsplash.com/photo-1547592180-85f173990554?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1565958011703-0581971369a2?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1563379252884-f33bd8a5afa0?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1512052628642-9c8ee3a2fda1?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1569718212165-3a8278d5cc74?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1540189549336-e6e01c8f9f82?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1534422298398-e4358d197d37?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1525351326379-fad028c401c5?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1606137222468-63019f6bb9e2?w=900&auto=format&fit=crop'
        ];

        function escapeHtml(value) {
            return String(value ?? '')
                .replaceAll('&', '&')
                .replaceAll('<', '<')
                .replaceAll('>', '>')
                .replaceAll('"', '"')
                .replaceAll("'", '&#039;');
        }

        function recipeBadge(recipe) {
            if (recipe.is_favorite) {
                return '<span class="rounded-full bg-amber-400/15 px-3 py-1 text-amber-300">Favorite</span>';
            }

            if (recipe.source === 'custom') {
                return '<span class="rounded-full bg-emerald-400/15 px-3 py-1 text-emerald-300">Custom</span>';
            }

            return '<span class="rounded-full bg-indigo-400/15 px-3 py-1 text-indigo-300">Seeded</span>';
        }

        function recipeImage(recipe, index) {
            // Create themed image mapping based on recipe types
            const recipeName = (recipe.name || '').toLowerCase();
            
            // Meat dishes
            const meatImages = [
                'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=900&auto=format&fit=crop', // Chicken
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=900&auto=format&fit=crop', // Steak
                'https://images.unsplash.com/photo-1565958011703-0581971369a2?w=900&auto=format&fit=crop', // Pork
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop', // Meat
                'https://images.unsplash.com/photo-1563379252884-f33bd8a5afa0?w=900&auto=format&fit=crop', // Burger
            ];
            
            // Seafood
            const seafoodImages = [
                'https://images.unsplash.com/photo-1519708227418-a8f173f0b533?w=900&auto=format&fit=crop', // Fish
                'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=900&auto=format&fit=crop', // Salmon
                'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop', // Shrimp
            ];
            
            // Vegetarian/Healthy
            const veggieImages = [
                'https://images.unsplash.com/photo-1512052628642-9c8ee3a2fda1?w=900&auto=format&fit=crop', // Salad
                'https://images.unsplash.com/photo-1569718212165-3a8278d5cc74?w=900&auto=format&fit=crop', // Vegetables
                'https://images.unsplash.com/photo-1540189549336-e6e01c8f9f82?w=900&auto=format&fit=crop', // Healthy
                'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=900&auto=format&fit=crop', // Bowl
            ];
            
            // Italian/Pasta
            const italianImages = [
                'https://images.unsplash.com/photo-1534422298398-e4358d197d37?w=900&auto=format&fit=crop', // Pasta
                'https://images.unsplash.com/photo-1525351326379-fad028c401c5?w=900&auto=format&fit=crop', // Pizza
                'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&auto=format&fit=crop', // Italian
            ];
            
            // Asian
            const asianImages = [
                'https://images.unsplash.com/photo-1606137222468-63019f6bb9e2?w=900&auto=format&fit=crop', // Asian
                'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop', // Stir-fry
            ];
            
            // Breakfast/Eggs
            const breakfastImages = [
                'https://images.unsplash.com/photo-1547592180-85f173990554?w=900&auto=format&fit=crop', // Breakfast
                'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&auto=format&fit=crop', // Eggs
            ];
            
            // Desserts
            const dessertImages = [
                'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=900&auto=format&fit=crop', // Dessert
                'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=900&auto=format&fit=crop', // Sweet
            ];
            
            // Default food images
            const defaultImages = [
                'https://images.unsplash.com/photo-1547592180-85f173990554?w=900&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=900&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=900&auto=format&fit=crop',
            ];
            
            let selectedImages = defaultImages;
            
            // Determine image category based on recipe name
            if (recipeName.includes('chicken') || recipeName.includes('wings') || recipeName.includes('beef') || recipeName.includes('steak') || recipeName.includes('pork') || recipeName.includes('meat') || recipeName.includes('burger')) {
                selectedImages = meatImages;
            } else if (recipeName.includes('fish') || recipeName.includes('salmon') || recipeName.includes('shrimp') || recipeName.includes('seafood')) {
                selectedImages = seafoodImages;
            } else if (recipeName.includes('salad') || recipeName.includes('vegetable') || recipeName.includes('veggie') || recipeName.includes('curry') || recipeName.includes('soup')) {
                selectedImages = veggieImages;
            } else if (recipeName.includes('pasta') || recipeName.includes('pizza') || recipeName.includes('italian')) {
                selectedImages = italianImages;
            } else if (recipeName.includes('asian') || recipeName.includes('stir') || recipeName.includes('rice')) {
                selectedImages = asianImages;
            } else if (recipeName.includes('egg') || recipeName.includes('omelette') || recipeName.includes('breakfast') || recipeName.includes('sandwich')) {
                selectedImages = breakfastImages;
            } else if (recipeName.includes('cake') || recipeName.includes('cookie') || recipeName.includes('dessert') || recipeName.includes('sweet')) {
                selectedImages = dessertImages;
            }
            
            // Select image based on recipe ID for consistency
            const imageIndex = recipe.id ? (recipe.id % selectedImages.length) : (index % selectedImages.length);
            const image = selectedImages[imageIndex];
            
            // Safety check - ensure we always have a valid image URL
            if (!image || !image.startsWith('http')) {
                console.warn('Invalid image detected, using fallback');
                return placeholders[index % placeholders.length];
            }
            
            console.log('=== RECIPE IMAGE DEBUG ===');
            console.log('Recipe:', recipe.name);
            console.log('Recipe ID:', recipe.id);
            console.log('Recipe name (lowercase):', recipeName);
            console.log('Category detected:', selectedImages === meatImages ? 'Meat' : 
                                       selectedImages === seafoodImages ? 'Seafood' :
                                       selectedImages === veggieImages ? 'Vegetarian' :
                                       selectedImages === italianImages ? 'Italian' :
                                       selectedImages === asianImages ? 'Asian' :
                                       selectedImages === breakfastImages ? 'Breakfast' :
                                       selectedImages === dessertImages ? 'Dessert' : 'Default');
            console.log('Selected images array length:', selectedImages.length);
            console.log('Image index:', imageIndex);
            console.log('Selected image:', image);
            console.log('Image URL valid?:', image && image.startsWith('http'));
            return image;
        }

        function formatTime(recipe) {
            return recipe.cooking_time ? `${recipe.cooking_time} min` : 'Flexible time';
        }

        function renderStats() {
            document.getElementById('statRecipes').textContent = appState.stats.recipe_count ?? appState.recipes.length;
            document.getElementById('statFavorites').textContent = appState.favoriteIds.length || appState.stats.favorite_count || 0;
            document.getElementById('statCustom').textContent = appState.stats.custom_count || appState.customRecipes.length || 0;
            document.getElementById('favoriteCountBadge').textContent = `${appState.favoriteIds.length || 0} saved`;
            document.getElementById('customCountBadge').textContent = `${appState.customRecipes.length || 0} recipes`;
        }

        function renderRecipeGrid() {
            const grid = document.getElementById('recipeGrid');
            const featured = appState.recipes.slice(0, 6);

            if (!featured.length) {
                grid.innerHTML = `
                    <div class="glass-soft rounded-[1.5rem] p-6 text-slate-300 md:col-span-2 xl:col-span-3">
                        No recipes loaded yet. Seed the database, then refresh the dashboard.
                    </div>
                `;
                return;
            }

            grid.innerHTML = featured.map((recipe, index) => {
                const ingredients = recipe.ingredients?.slice(0, 4)?.join(' • ') || 'No ingredients listed yet';
                const missing = recipe.is_favorite ? 'Saved for quick access' : `${recipe.ingredient_count || recipe.ingredients?.length || 0} ingredients`;
                const cardImage = recipeImage(recipe, index);

                console.log('=== HTML DEBUG ===');
                console.log('Generating HTML for recipe:', recipe.name);
                console.log('Card image URL:', cardImage);
                console.log('HTML snippet:', `<div class="h-44 w-full bg-cover bg-center" style="background-image:url('${cardImage}')"></div>`);

                return `
                    <article class="recipe-card glass-soft group cursor-pointer rounded-[1.75rem] p-5 hover:border-white/10 transition-all duration-200" onclick="window.location.href='/recipe/${recipe.id}'">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="${cardImage}" alt="${escapeHtml(recipe.name)}" class="h-44 w-full object-cover" loading="lazy" onerror="this.onerror=null;this.src='/images/recipe-placeholder.svg';">
                            <div class="absolute right-3 top-3 rounded-full bg-slate-950/60 px-3 py-1 text-xs font-semibold text-white backdrop-blur-sm">
                                ${escapeHtml(formatTime(recipe))}
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                        </div>
                        <div class="mt-4 flex items-start justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <h3 class="text-lg font-bold text-white truncate group-hover:text-amber-300 transition-colors">${escapeHtml(recipe.name)}</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-400 line-clamp-2">${escapeHtml(recipe.description || 'A delicious recipe ready to be cooked.')}</p>
                                <p class="mt-2 text-xs text-slate-500">${escapeHtml(ingredients)}</p>
                            </div>
                            <button class="favorite-btn ${recipe.is_favorite ? 'primary-btn' : 'secondary-btn rounded-full px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-rose-400/20 hover:text-rose-300 transition-colors flex-shrink-0'}" data-id="${recipe.id}" type="button" onclick="event.stopPropagation(); handleFavoriteToggle.call(this, event);">
                                ${recipe.is_favorite ? '❤️' : '🤍'}
                            </button>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-300">
                            ${recipeBadge(recipe)}
                            <span class="chip rounded-full px-3 py-1">${escapeHtml(recipe.difficulty || 'Balanced')}</span>
                        </div>
                        <div class="mt-4 rounded-2xl bg-black/20 px-4 py-3 text-sm text-slate-300">
                            <span class="font-semibold text-amber-300">Ingredients:</span> ${escapeHtml(ingredients)}
                        </div>
                        <p class="mt-3 text-xs uppercase tracking-[0.24em] text-slate-500">${escapeHtml(missing)}</p>
                    </article>
                `;
            }).join('');

            grid.querySelectorAll('.favorite-btn[data-id]').forEach((button) => {
                button.removeEventListener('click', handleFavoriteToggle);
                button.addEventListener('click', handleFavoriteToggle);
            });
        }

        function renderFavorites() {
            const list = document.getElementById('favoritesList');
            if (!appState.favorites.length) {
                list.innerHTML = `
                    <div class="glass-soft rounded-2xl p-6 text-center">
                        <div class="text-3xl mb-3">🤍</div>
                        <p class="text-sm text-slate-400">No favorites yet. Tap the star on any recipe to save it here.</p>
                    </div>
                `;
                return;
            }

            list.innerHTML = appState.favorites.map((recipe, index) => {
                const image = recipeImage(recipe, index);
                const ingredients = recipe.ingredients?.slice(0, 3)?.join(', ') || 'No ingredients listed';
                const ingredientCount = recipe.ingredient_count || recipe.ingredients?.length || 0;
                
                return `
                    <div class="glass-soft group cursor-pointer rounded-2xl overflow-hidden hover:border-white/10 transition-all duration-200" onclick="window.location.href='/recipe/${recipe.id}'">
                        <div class="flex gap-4 p-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-900">
                                    <img src="${escapeHtml(image)}" alt="${escapeHtml(recipe.name)}" class="w-full h-full object-cover" loading="lazy" onerror="this.onerror=null;this.src='/images/recipe-placeholder.svg';">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-sm font-semibold text-white truncate group-hover:text-amber-300 transition-colors">${escapeHtml(recipe.name)}</h3>
                                        <p class="text-xs text-slate-400 mt-1">${escapeHtml(formatTime(recipe))} • ${ingredientCount} ingredients</p>
                                        <p class="text-xs text-slate-500 mt-1 truncate">${escapeHtml(ingredients)}${ingredientCount > 3 ? ` +${ingredientCount - 3} more` : ''}</p>
                                    </div>
                                    <button class="favorite-btn primary-btn rounded-full px-3 py-2 text-xs font-semibold hover:bg-rose-400/20 hover:text-rose-300 transition-colors" data-id="${recipe.id}" type="button" onclick="event.stopPropagation(); handleFavoriteToggle.call(this, event);">
                                        ❤️ Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            // Remove existing listeners before re-attaching to prevent duplicates
            list.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.removeEventListener('click', handleFavoriteToggle);
                btn.addEventListener('click', handleFavoriteToggle);
            });
        }

        function renderCustomRecipes() {
            const list = document.getElementById('customRecipesList');
            if (!appState.customRecipes.length) {
                list.innerHTML = `
                    <div class="glass-soft rounded-2xl p-6 text-center">
                        <div class="text-3xl mb-3">👨‍🍳</div>
                        <p class="text-sm text-slate-400">No custom recipes yet. Create your own recipes below!</p>
                    </div>
                `;
                return;
            }

            list.innerHTML = appState.customRecipes.map((recipe, index) => {
                const image = recipeImage(recipe, index);
                const ingredients = recipe.ingredients?.slice(0, 3)?.join(', ') || 'No ingredients listed';
                const ingredientCount = recipe.ingredient_count || recipe.ingredients?.length || 0;
                
                return `
                    <div class="glass-soft group cursor-pointer rounded-2xl overflow-hidden hover:border-white/10 transition-all duration-200" onclick="window.location.href='/recipe/${recipe.id}'">
                        <div class="flex gap-4 p-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-900">
                                    <img src="${escapeHtml(image)}" alt="${escapeHtml(recipe.name)}" class="w-full h-full object-cover" loading="lazy" onerror="this.onerror=null;this.src='/images/recipe-placeholder.svg';">
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-sm font-semibold text-white truncate group-hover:text-emerald-300 transition-colors">${escapeHtml(recipe.name)}</h3>
                                        <p class="text-xs text-slate-400 mt-1">${escapeHtml(formatTime(recipe))} • ${ingredientCount} ingredients</p>
                                        <p class="text-xs text-slate-500 mt-1 truncate">${escapeHtml(recipe.description || 'Your own recipe')}</p>
                                        <p class="text-xs text-slate-500 mt-1 truncate">${escapeHtml(ingredients)}${ingredientCount > 3 ? ` +${ingredientCount - 3} more` : ''}</p>
                                    </div>
                                    <span class="rounded-full bg-emerald-400/15 border border-emerald-400/30 px-3 py-1 text-xs text-emerald-300 flex-shrink-0">👨‍🍳</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function syncStateFromApi(payload) {
            appState.recipes = Array.isArray(payload.recipes) ? payload.recipes : [];
            appState.favorites = Array.isArray(payload.favorites) ? payload.favorites : [];
            appState.customRecipes = Array.isArray(payload.custom_recipes) ? payload.custom_recipes : [];
            appState.favoriteIds = Array.isArray(payload.favorite_ids)
                ? payload.favorite_ids.map((id) => Number(id))
                : appState.favorites.map((recipe) => Number(recipe.id));
            appState.stats = payload.stats || appState.stats;
        }

        async function loadDashboard() {
            const refreshButton = document.getElementById('refreshDashboard');
            refreshButton.disabled = true;
            refreshButton.textContent = 'Loading...';

            try {
                const response = await fetch('/api/recipes', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const payload = await response.json();
                console.log('=== DASHBOARD LOAD DEBUG ===');
                console.log('API Response:', payload);
                console.log('Recipes count:', payload.recipes?.length || 0);
                console.log('First recipe:', payload.recipes?.[0]);
                if (payload.recipes?.length > 0) {
                    console.log('First recipe image URL:', payload.recipes[0].image);
                }
                
                syncStateFromApi(payload);

                renderStats();
                renderRecipeGrid();
                renderFavorites();
                renderCustomRecipes();
            } catch (error) {
                console.error('Dashboard load failed:', error);
                document.getElementById('recipeGrid').innerHTML = `
                    <div class="glass-soft rounded-[1.5rem] p-6 text-slate-300 md:col-span-2 xl:col-span-3">
                        Failed to load recipes. Check the backend seed data and refresh the page.
                    </div>
                `;
            } finally {
                refreshButton.disabled = false;
                refreshButton.textContent = 'Refresh data';
            }
        }

        function handleFavoriteToggle(event) {
            event.preventDefault();
            event.stopPropagation();
            
            // Prevent multiple simultaneous calls
            if (isTogglingFavorite) {
                console.log('Already toggling favorite, ignoring click');
                return;
            }
            
            const button = event.target.closest('button'); // Find the closest button element
            const recipeId = button ? button.dataset.id : null;
            console.log('=== FAVORITE TOGGLE DEBUG ===');
            console.log('handleFavoriteToggle called - button:', button, 'recipeId:', recipeId);
            console.log('Button innerHTML:', button ? button.innerHTML : 'undefined');
            console.log('Button dataset:', button ? button.dataset : 'undefined');
            console.log('isTogglingFavorite:', isTogglingFavorite);
            
            if (!button || !recipeId) {
                console.error('Could not find button or recipe ID');
                return;
            }
            
            toggleFavorite(recipeId, button);
        }

        async function toggleFavorite(id, button) {
            if (!button) {
                console.error('Button element is undefined!');
                return;
            }
            
            if (isTogglingFavorite) {
                console.log('Already toggling, returning');
                return;
            }
            
            isTogglingFavorite = true;
            console.log('Set isTogglingFavorite to true');
            
            try {
                console.log('=== TOGGLE FAVORITE API CALL ===');
                console.log('Making API call for recipe ID:', id);
                
                const response = await fetch(`/api/recipes/${id}/favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                });

                console.log('API Response status:', response.status);
                console.log('API Response ok:', response.ok);

                const data = await response.json();
                console.log('API Response data:', data);
                
                if (response.ok && data.success) {
                    console.log('SUCCESS - is_favorite:', data.is_favorite);
                    
                    // Update button text and style
                    const isFavorite = data.is_favorite;
                    
                    // Handle different button types (featured vs favorites section)
                    if (button.innerHTML.includes('Remove')) {
                        // This is a favorites section button
                        console.log('Updating favorites section button');
                        button.innerHTML = isFavorite ? '❤️ Remove' : '🤍 Add';
                    } else {
                        // This is a featured recipe button
                        console.log('Updating featured recipe button');
                        button.innerHTML = isFavorite ? '❤️' : '🤍';
                    }
                    
                    button.className = isFavorite ? 
                        'primary-btn rounded-full px-3 py-2 text-xs font-semibold' : 
                        'secondary-btn rounded-full px-3 py-2 text-xs font-semibold text-slate-100 hover:bg-rose-400/20 hover:text-rose-300 transition-colors flex-shrink-0';
                    
                    console.log('About to update sections manually');
                    // Update specific sections instead of full dashboard reload
                    if (!isFavorite) {
                        // Recipe was removed from favorites - remove from favorites section
                        const favoritesList = document.getElementById('favoritesList');
                        const recipeToRemove = favoritesList.querySelector(`[data-id="${id}"]`);
                        if (recipeToRemove) {
                            recipeToRemove.closest('.glass-soft').remove();
                        }
                        // Update stats
                        document.getElementById('statFavorites').textContent = appState.favoriteIds.length - 1;
                        document.getElementById('favoriteCountBadge').textContent = `${appState.favoriteIds.length - 1} saved`;
                    } else {
                        // Recipe was added to favorites - add to favorites section
                        await loadDashboard();
                    }
                    console.log('Sections updated');
                } else {
                    console.error('FAILED - Response not OK or success false');
                    console.error('Response data:', data);
                }
            } catch (error) {
                console.error('=== TOGGLE FAVORITE ERROR ===');
                console.error('Error:', error);
                // Only show alert for actual errors, not for expected failures
                if (!error.message.includes('404') && !error.message.includes('500')) {
                    alert('Could not update favorites right now.');
                }
            } finally {
                isTogglingFavorite = false;
                console.log('Reset isTogglingFavorite to false');
            }
        }

        function formValuesToPayload(form) {
            const formData = new FormData(form);
            const ingredients = String(formData.get('ingredients') || '')
                .split(',')
                .map((item) => item.trim())
                .filter(Boolean);

            return {
                name: String(formData.get('name') || '').trim(),
                description: String(formData.get('description') || '').trim(),
                instructions: String(formData.get('instructions') || '').trim(),
                cooking_time: Number(formData.get('cooking_time') || 0),
                difficulty: String(formData.get('difficulty') || 'Custom').trim(),
                image_url: String(formData.get('image_url') || '').trim() || null,
                ingredients
            };
        }

        async function submitCustomRecipe(event) {
            event.preventDefault();

            const form = event.currentTarget;
            const status = document.getElementById('formStatus');
            const payload = formValuesToPayload(form);

            if (!payload.name || !payload.instructions || !payload.cooking_time || !payload.ingredients.length) {
                status.textContent = 'Please fill out the required fields.';
                status.className = 'text-sm text-red-300';
                return;
            }

            status.textContent = 'Saving recipe...';
            status.className = 'text-sm text-amber-300';

            try {
                const response = await fetch('/api/recipes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Recipe could not be saved');
                }

                form.reset();
                status.textContent = 'Recipe saved successfully.';
                status.className = 'text-sm text-emerald-300';

                await loadDashboard();
            } catch (error) {
                console.error('Recipe save failed:', error);
                status.textContent = error.message || 'Could not save the recipe.';
                status.className = 'text-sm text-red-300';
            }
        }

        document.getElementById('refreshDashboard').addEventListener('click', loadDashboard);
        document.getElementById('customRecipeForm').addEventListener('submit', submitCustomRecipe);

        loadDashboard();
    </script>
</body>
</html>
