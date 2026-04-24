<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $recipe['name'] }} - Mystery Meal</title>
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

        .instruction-step {
            counter-increment: step;
            position: relative;
            padding-left: 3rem;
        }

        .instruction-step::before {
            content: counter(step);
            position: absolute;
            left: 0;
            top: 0;
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fb7185 100%);
            color: #0f172a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.875rem;
        }

        ol.instruction-steps {
            counter-reset: step;
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body class="px-4 py-6 md:px-8 md:py-8">
    <div class="mx-auto max-w-7xl space-y-6">
        <!-- Header -->
        <header class="glass rounded-[2rem] px-6 py-5 md:px-8 md:py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('recipes') }}" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                        ← Back to Recipes
                    </a>
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-400/15 text-2xl">
                            🥘
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-slate-400">Mystery Meal</p>
                            <h1 class="text-2xl font-black text-white md:text-3xl">Recipe Details</h1>
                        </div>
                    </div>
                </div>
                <div class="text-3xl">🍽️</div>
            </div>
        </header>

        <!-- Recipe Content -->
        <main class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <!-- Left Column - Main Recipe Info -->
            <section class="space-y-6">
                <!-- Recipe Header -->
                <div class="glass rounded-[2rem] overflow-hidden">
                    <div class="relative">
                        @php
    $recipeName = strtolower($recipe['name']);
    $imageCategory = 'default';
    
    // Determine image category based on recipe name
    if (str_contains($recipeName, 'chicken') || str_contains($recipeName, 'wings') || str_contains($recipeName, 'beef') || str_contains($recipeName, 'steak') || str_contains($recipeName, 'pork') || str_contains($recipeName, 'meat') || str_contains($recipeName, 'burger')) {
        $imageCategory = 'meat';
    } elseif (str_contains($recipeName, 'fish') || str_contains($recipeName, 'salmon') || str_contains($recipeName, 'shrimp') || str_contains($recipeName, 'seafood')) {
        $imageCategory = 'seafood';
    } elseif (str_contains($recipeName, 'salad') || str_contains($recipeName, 'vegetable') || str_contains($recipeName, 'veggie') || str_contains($recipeName, 'curry') || str_contains($recipeName, 'soup')) {
        $imageCategory = 'veggie';
    } elseif (str_contains($recipeName, 'pasta') || str_contains($recipeName, 'pizza') || str_contains($recipeName, 'italian')) {
        $imageCategory = 'italian';
    } elseif (str_contains($recipeName, 'asian') || str_contains($recipeName, 'stir') || str_contains($recipeName, 'rice')) {
        $imageCategory = 'asian';
    } elseif (str_contains($recipeName, 'egg') || str_contains($recipeName, 'omelette') || str_contains($recipeName, 'breakfast') || str_contains($recipeName, 'sandwich')) {
        $imageCategory = 'breakfast';
    } elseif (str_contains($recipeName, 'cake') || str_contains($recipeName, 'cookie') || str_contains($recipeName, 'dessert') || str_contains($recipeName, 'sweet')) {
        $imageCategory = 'dessert';
    }
    
    // Define image arrays
    $meatImages = [
        'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1565958011703-0581971369a2?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1563379252884-f33bd8a5afa0?w=900&auto=format&fit=crop',
    ];
    $seafoodImages = [
        'https://images.unsplash.com/photo-1519708227418-a8f173f0b533?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop',
    ];
    $veggieImages = [
        'https://images.unsplash.com/photo-1512052628642-9c8ee3a2fda1?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1569718212165-3a8278d5cc74?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1540189549336-e6e01c8f9f82?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=900&auto=format&fit=crop',
    ];
    $italianImages = [
        'https://images.unsplash.com/photo-1534422298398-e4358d197d37?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1525351326379-fad028c401c5?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=900&auto=format&fit=crop',
    ];
    $asianImages = [
        'https://images.unsplash.com/photo-1606137222468-63019f6bb9e2?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop',
    ];
    $breakfastImages = [
        'https://images.unsplash.com/photo-1547592180-85f173990554?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&auto=format&fit=crop',
    ];
    $dessertImages = [
        'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=900&auto=format&fit=crop',
    ];
    $defaultImages = [
        'https://images.unsplash.com/photo-1547592180-85f173990554?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=900&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=900&auto=format&fit=crop',
    ];
    
    // Select appropriate image array
    $selectedImages = match($imageCategory) {
        'meat' => $meatImages,
        'seafood' => $seafoodImages,
        'veggie' => $veggieImages,
        'italian' => $italianImages,
        'asian' => $asianImages,
        'breakfast' => $breakfastImages,
        'dessert' => $dessertImages,
        default => $defaultImages,
    };
    
    // Select image based on recipe ID
    $imageIndex = $recipe['id'] % count($selectedImages);
    $selectedImage = $selectedImages[$imageIndex];
@endphp

                        <img
                            class="recipe-image"
                            src="{{ $selectedImage }}"
                            alt="{{ $recipe['name'] }}"
                            loading="lazy"
                            decoding="async"
                            onerror="this.onerror=null;this.src='/images/recipe-placeholder.svg';"
                        >
                        <div class="absolute right-3 top-3 rounded-full border px-3 py-1 text-xs font-semibold 
                            {{ ($recipe['source'] == 'custom') ? 'bg-emerald-400/15 text-emerald-300 border-emerald-400/30' :
                               ($recipe['is_favorite'] ? 'bg-amber-400/15 text-amber-300 border-amber-400/30' :
                               'bg-indigo-400/15 text-indigo-300 border-indigo-400/30') }}">
                            {{ $recipe['is_favorite'] ? '❤️ Favorite' : ($recipe['source'] == 'custom' ? '👨‍🍳 Custom' : '📚 Seeded') }}
                        </div>
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/90 to-transparent p-4">
                            <div class="flex items-center gap-4">
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-300">
                                    ⏱️ {{ $recipe['cooking_time'] ? $recipe['cooking_time'] . ' min' : 'Flexible' }}
                                </p>
                                <p class="text-xs uppercase tracking-[0.24em] text-slate-300">
                                    🥘 {{ count($recipe['ingredients']) }} ingredients
                                </p>
                                @if($recipe['difficulty'])
                                    <p class="text-xs uppercase tracking-[0.24em] text-slate-300">
                                        📊 {{ $recipe['difficulty'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $recipe['name'] }}</h2>
                        <p class="text-slate-300 leading-6 mb-6">
                            {{ $recipe['description'] ?: 'A delicious recipe perfect for any occasion.' }}
                        </p>

                        <div class="flex flex-wrap gap-3">
                            <button id="favoriteBtn" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100">
                                {{ $isFavorite ? '❤️ Remove from Favorites' : '🤍 Add to Favorites' }}
                            </button>
                            <a href="{{ route('recipes') }}" class="primary-btn rounded-2xl px-5 py-3 text-sm font-semibold">
                                Find Similar Recipes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-emerald-300">Instructions</p>
                            <h3 class="mt-2 text-2xl font-bold text-white">How to Cook</h3>
                        </div>
                        <div class="text-3xl">👨‍🍳</div>
                    </div>

                    @if($recipe['instructions'])
                        <ol class="instruction-steps space-y-4">
                            @php
                                $steps = preg_split('/\d+\.\s*/', $recipe['instructions'], -1, PREG_SPLIT_NO_EMPTY);
                                $steps = array_filter($steps, function($step) { return trim($step) !== ''; });
                            @endphp
                            @if(count($steps) > 0)
                                @foreach($steps as $step)
                                    <li class="instruction-step text-slate-300 leading-6">
                                        {{ trim($step) }}
                                    </li>
                                @endforeach
                            @else
                                <li class="instruction-step text-slate-300 leading-6">
                                    {{ $recipe['instructions'] }}
                                </li>
                            @endif
                        </ol>
                    @else
                        <div class="text-center py-8">
                            <div class="text-4xl mb-4">📝</div>
                            <p class="text-slate-400">Instructions not available for this recipe.</p>
                            <p class="text-slate-500 text-sm mt-2">Try searching online for "{{ $recipe['name'] }}" recipe instructions.</p>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Right Column - Ingredients & Info -->
            <section class="space-y-6">
                <!-- Ingredients -->
                <div class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-amber-300">Ingredients</p>
                            <h3 class="mt-2 text-2xl font-bold text-white">What You Need</h3>
                        </div>
                        <div class="text-3xl">🥗</div>
                    </div>

                    <div class="space-y-2">
                        @foreach($recipe['ingredients'] as $ingredient)
                            <div class="chip flex items-center gap-3 rounded-2xl px-4 py-3 text-slate-200">
                                <span class="text-emerald-300">✓</span>
                                <span>{{ $ingredient }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 p-4 rounded-2xl bg-amber-400/10 border border-amber-400/20">
                        <p class="text-sm text-amber-100">
                            💡 <strong>Tip:</strong> Check your fridge for these ingredients before shopping!
                        </p>
                    </div>
                </div>

                <!-- Recipe Info -->
                <div class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-sky-300">Details</p>
                            <h3 class="mt-2 text-2xl font-bold text-white">Recipe Info</h3>
                        </div>
                        <div class="text-3xl">📊</div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-white/10">
                            <span class="text-slate-400">Cooking Time</span>
                            <span class="text-white font-semibold">{{ $recipe['cooking_time'] ? $recipe['cooking_time'] . ' minutes' : 'Flexible' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/10">
                            <span class="text-slate-400">Difficulty</span>
                            <span class="text-white font-semibold">{{ $recipe['difficulty'] ?: 'Not specified' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/10">
                            <span class="text-slate-400">Total Ingredients</span>
                            <span class="text-white font-semibold">{{ count($recipe['ingredients']) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-white/10">
                            <span class="text-slate-400">Source</span>
                            <span class="text-white font-semibold">{{ ucfirst($recipe['source']) }}</span>
                        </div>
                        @if($recipe['created_at'])
                            <div class="flex justify-between items-center py-2">
                                <span class="text-slate-400">Added</span>
                                <span class="text-white font-semibold">{{ \Carbon\Carbon::parse($recipe['created_at'])->format('M j, Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="glass rounded-[2rem] p-6 md:p-8">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-rose-300">Quick Actions</p>
                            <h3 class="mt-2 text-2xl font-bold text-white">What's Next?</h3>
                        </div>
                        <div class="text-3xl">🚀</div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('recipes') }}" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100 w-full text-center block">
                            🔍 Find Similar Recipes
                        </a>
                        <button onclick="window.print()" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100 w-full text-center block">
                            🖨️ Print Recipe
                        </button>
                        <button onclick="shareRecipe()" class="secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100 w-full text-center block">
                            📤 Share Recipe
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        const recipeId = {{ $recipe['id'] }};
        const favoriteBtn = document.getElementById('favoriteBtn');
        let isFavorite = {{ $isFavorite ? 'true' : 'false' }};

        async function toggleFavorite() {
            try {
                const response = await fetch(`/api/recipes/${recipeId}/favorite`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();
                
                if (response.ok && data.success) {
                    isFavorite = data.is_favorite;
                    favoriteBtn.innerHTML = isFavorite ? '❤️ Remove from Favorites' : '🤍 Add to Favorites';
                    favoriteBtn.className = isFavorite ? 
                        'primary-btn rounded-2xl px-5 py-3 text-sm font-semibold' : 
                        'secondary-btn rounded-2xl px-5 py-3 text-sm font-semibold text-slate-100';
                }
            } catch (error) {
                console.error('Error toggling favorite:', error);
            }
        }

        function shareRecipe() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $recipe['name'] }} - Mystery Meal',
                    text: '{{ $recipe['description'] }}',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Recipe link copied to clipboard!');
            }
        }

        favoriteBtn.addEventListener('click', toggleFavorite);
        
        // Update button style based on initial state
        if (isFavorite) {
            favoriteBtn.className = 'primary-btn rounded-2xl px-5 py-3 text-sm font-semibold';
        }
    </script>
</body>
</html>
