<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    private const FAVORITES_SESSION_KEY = 'favorite_recipe_ids';

    private function favoriteIds(Request $request): array
    {
        $favorites = $request->session()->get(self::FAVORITES_SESSION_KEY, []);

        return collect(is_array($favorites) ? $favorites : [])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    private function normalizeTerms(array $values): array
    {
        return collect($values)
            ->flatten()
            ->map(fn ($value) => trim((string) $value))
            ->filter()
            ->map(fn ($value) => Str::lower($value))
            ->unique()
            ->values()
            ->all();
    }

    private function normalizeImageUrl(?string $image): ?string
    {
        $image = trim((string) $image);

        if ($image === '') {
            return null;
        }

        if (Str::startsWith($image, ['http://', 'https://', '//'])) {
            return $image;
        }

        if (Str::startsWith($image, '/')) {
            return asset(ltrim($image, '/'));
        }

        return asset('images/' . ltrim($image, '/'));
    }

    private function recipeImage(Recipe $recipe): string
    {
        $metadata = $recipe->metadata ?? [];
        $image = $metadata['image_url'] ?? $metadata['image'] ?? null;

        // Try to get the image URL
        $normalizedImage = $this->normalizeImageUrl($image);
        
        // If we have a valid image URL, return it
        if ($normalizedImage) {
            return $normalizedImage;
        }

        // Fallback to placeholder
        return asset('images/recipe-placeholder.svg');
    }

    private function recipeCookingTime(Recipe $recipe): ?int
    {
        $metadata = $recipe->metadata ?? [];
        $time = $metadata['cooking_time'] ?? $metadata['time'] ?? null;

        return is_numeric($time) ? (int) $time : null;
    }

    private function recipeDifficulty(Recipe $recipe): ?string
    {
        $metadata = $recipe->metadata ?? [];

        return $metadata['difficulty'] ?? null;
    }

    private function recipeSource(Recipe $recipe): string
    {
        $metadata = $recipe->metadata ?? [];

        return $metadata['source'] ?? 'seeded';
    }

    private function baseRecipeData(Recipe $recipe, array $favoriteIds = []): array
    {
        $ingredients = $recipe->products->pluck('name')->values()->all();

        return [
            'id' => $recipe->id,
            'name' => $recipe->name,
            'description' => $recipe->description,
            'instructions' => $recipe->instructions,
            'image' => $this->recipeImage($recipe),
            'cooking_time' => $this->recipeCookingTime($recipe),
            'difficulty' => $this->recipeDifficulty($recipe),
            'source' => $this->recipeSource($recipe),
            'ingredients' => $ingredients,
            'ingredient_count' => count($ingredients),
            'is_favorite' => in_array($recipe->id, $favoriteIds, true),
            'metadata' => $recipe->metadata ?? [],
            'created_at' => optional($recipe->created_at)->toIso8601String(),
            'updated_at' => optional($recipe->updated_at)->toIso8601String(),
        ];
    }

    private function ingredientMatches(string $needle, string $haystack): bool
    {
        $needle = Str::lower(trim($needle));
        $haystack = Str::lower(trim($haystack));

        if ($needle === '' || $haystack === '') {
            return false;
        }

        // Exact match
        if ($needle === $haystack) {
            return true;
        }

        // Contains match (one contains the other)
        if (Str::contains($haystack, $needle) || Str::contains($needle, $haystack)) {
            return true;
        }

        // Word-based matching for multi-word ingredients
        $needleWords = explode(' ', $needle);
        $haystackWords = explode(' ', $haystack);

        // Check if any word matches
        foreach ($needleWords as $needleWord) {
            foreach ($haystackWords as $haystackWord) {
                if ($needleWord === $haystackWord || Str::contains($haystackWord, $needleWord) || Str::contains($needleWord, $haystackWord)) {
                    return true;
                }
            }
        }

        // Fuzzy matching using levenshtein distance
        $maxLength = max(strlen($needle), strlen($haystack));

        if ($maxLength === 0) {
            return false;
        }

        $similarity = (($maxLength - levenshtein($needle, $haystack)) / $maxLength) * 100;

        return $similarity >= 65; // Slightly lower threshold for more matches
    }

    private function analyzeRecipe(Recipe $recipe, array $searchTerms): array
    {
        $ingredients = $recipe->products->pluck('name')->values()->all();

        if (count($ingredients) === 0) {
            return [
                'match_percentage' => 0,
                'found_ingredients' => [],
                'missing_ingredients' => [],
            ];
        }

        $found = [];
        $missing = [];

        foreach ($ingredients as $ingredient) {
            $matched = false;

            foreach ($searchTerms as $term) {
                if ($this->ingredientMatches($term, $ingredient)) {
                    $found[] = $ingredient;
                    $matched = true;
                    break;
                }
            }

            if (! $matched) {
                $missing[] = $ingredient;
            }
        }

        $matchPercentage = (int) round((count($found) / max(count($ingredients), 1)) * 100);

        return [
            'match_percentage' => $matchPercentage,
            'found_ingredients' => array_values(array_unique($found)),
            'missing_ingredients' => array_values(array_unique($missing)),
        ];
    }

    private function outputRecipe(Recipe $recipe, array $favoriteIds = [], array $analysis = []): array
    {
        return array_merge(
            $this->baseRecipeData($recipe, $favoriteIds),
            $analysis
        );
    }

    private function recipeQuery()
    {
        return Recipe::with('products')->latest();
    }

    /**
     * Search recipes based on provided fridge products.
     */
    public function findRecipes(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'products' => ['required', 'array', 'min:1'],
            'products.*' => ['string', 'max:255'],
            'cooking_time_max' => ['nullable', 'integer', 'min:1', 'max:1440'],
        ]);

        $searchTerms = $this->normalizeTerms($validated['products']);
        $favoriteIds = $this->favoriteIds($request);
        $maxCookingTime = $validated['cooking_time_max'] ?? null;

        $rankedRecipes = $this->recipeQuery()
            ->get()
            ->map(function (Recipe $recipe) use ($searchTerms, $favoriteIds, $maxCookingTime) {
                $analysis = $this->analyzeRecipe($recipe, $searchTerms);
                $payload = $this->outputRecipe($recipe, $favoriteIds, $analysis);

                $payload['matched_ingredients_count'] = count($analysis['found_ingredients'] ?? []);
                $payload['missing_ingredients_count'] = count($analysis['missing_ingredients'] ?? []);
                $payload['meets_time_filter'] = $maxCookingTime === null || $payload['cooking_time'] === null
                    ? true
                    : $payload['cooking_time'] <= $maxCookingTime;

                return $payload;
            })
            ->filter(function (array $recipe) {
                return $recipe['meets_time_filter'] ?? true;
            })
            ->sortByDesc('match_percentage')
            ->sortByDesc('matched_ingredients_count')
            ->values();

        $strongMatches = $rankedRecipes
            ->filter(function (array $recipe) {
                return ($recipe['match_percentage'] ?? 0) >= 20 || ($recipe['matched_ingredients_count'] ?? 0) >= 1;
            })
            ->values();

        $recipes = $strongMatches->isNotEmpty()
            ? $strongMatches->values() // Show all strong matches
            : $rankedRecipes->filter(function (array $recipe) {
                return ($recipe['matched_ingredients_count'] ?? 0) >= 1; // At least one ingredient match
            })->values();

        $suggestions = $rankedRecipes->filter(function (array $recipe) {
            return ($recipe['matched_ingredients_count'] ?? 0) >= 1; // Only show recipes with at least one match
        })->values();
        $bestMatch = $rankedRecipes->first();

        return response()->json([
            'success' => true,
            'message' => $strongMatches->isNotEmpty()
                ? 'Recipes found'
                : 'No strong matches yet. Showing the closest recipes instead.',
            'match_mode' => $strongMatches->isNotEmpty() ? 'strong' : 'closest',
            'recipes' => $recipes,
            'best_match' => $bestMatch,
            'suggestions' => $suggestions,
        ]);
    }

    /**
     * Store a custom recipe and attach/create ingredients.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'instructions' => ['required', 'string', 'max:10000'],
            'cooking_time' => ['required', 'integer', 'min:1', 'max:1440'],
            'difficulty' => ['nullable', 'string', 'max:100'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'ingredients' => ['required', 'array', 'min:1'],
            'ingredients.*' => ['string', 'max:255'],
        ]);

        $ingredients = $this->normalizeTerms($validated['ingredients']);

        $recipe = DB::transaction(function () use ($validated, $ingredients) {
            $recipe = Recipe::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'instructions' => $validated['instructions'],
                'metadata' => [
                    'image_url' => $validated['image_url'] ?? null,
                    'cooking_time' => (int) $validated['cooking_time'],
                    'difficulty' => $validated['difficulty'] ?? 'Custom',
                    'source' => 'custom',
                ],
            ]);

            $productIds = [];

            foreach ($ingredients as $ingredient) {
                $product = Product::firstOrCreate(
                    ['name' => Str::title($ingredient)],
                    [
                        'slug' => Str::slug($ingredient) . '-' . Str::lower(Str::random(5)),
                        'category' => 'custom',
                        'description' => 'Custom ingredient added by the user.',
                    ]
                );

                $productIds[] = $product->id;
            }

            $recipe->products()->syncWithoutDetaching($productIds);

            return $recipe->load('products');
        });

        return response()->json([
            'success' => true,
            'message' => 'Your recipe was added successfully.',
            'recipe' => $this->baseRecipeData($recipe, $this->favoriteIds($request)),
        ], 201);
    }

    /**
     * Toggle a recipe in the current browser session favorites.
     */
    public function toggleFavorite(Request $request, Recipe $recipe): JsonResponse
    {
        $favoriteIds = $this->favoriteIds($request);

        if (in_array($recipe->id, $favoriteIds, true)) {
            $favoriteIds = array_values(array_filter(
                $favoriteIds,
                fn ($id) => $id !== $recipe->id
            ));

            $isFavorite = false;
        } else {
            $favoriteIds[] = $recipe->id;
            $favoriteIds = array_values(array_unique(array_map('intval', $favoriteIds)));
            $isFavorite = true;
        }

        $request->session()->put(self::FAVORITES_SESSION_KEY, $favoriteIds);

        return response()->json([
            'success' => true,
            'is_favorite' => $isFavorite,
            'favorite_ids' => $favoriteIds,
        ]);
    }

    /**
     * List all recipes in a format that the UI can consume.
     */
    public function index(Request $request): JsonResponse
    {
        $favoriteIds = $this->favoriteIds($request);

        $recipes = $this->recipeQuery()
            ->get()
            ->map(fn (Recipe $recipe) => $this->baseRecipeData($recipe, $favoriteIds))
            ->values();

        $customRecipes = $recipes->where('source', 'custom')->values();
        $favoriteRecipes = $recipes->where('is_favorite', true)->values();

        $averageCookingTime = $recipes
            ->pluck('cooking_time')
            ->filter(fn ($value) => is_numeric($value))
            ->avg();

        return response()->json([
            'success' => true,
            'recipes' => $recipes,
            'favorites' => $favoriteRecipes,
            'custom_recipes' => $customRecipes,
            'favorite_ids' => $favoriteIds,
            'stats' => [
                'recipe_count' => $recipes->count(),
                'favorite_count' => $favoriteRecipes->count(),
                'custom_count' => $customRecipes->count(),
                'average_cooking_time' => $averageCookingTime ? round($averageCookingTime, 1) : null,
            ],
        ]);
    }

    /**
     * Get a single recipe.
     */
    public function show(Request $request, Recipe $recipe): JsonResponse
    {
        return response()->json([
            'success' => true,
            'recipe' => $this->baseRecipeData($recipe->load('products'), $this->favoriteIds($request)),
        ]);
    }

    /**
     * Return only the favorite recipes for the current session.
     */
    public function favorites(Request $request): JsonResponse
    {
        $favoriteIds = $this->favoriteIds($request);

        $favorites = Recipe::with('products')
            ->whereIn('id', $favoriteIds)
            ->get()
            ->map(fn (Recipe $recipe) => $this->baseRecipeData($recipe, $favoriteIds))
            ->values();

        return response()->json([
            'success' => true,
            'recipes' => $favorites,
            'favorite_ids' => $favoriteIds,
        ]);
    }

    /**
     * Show individual recipe page with full details.
     */
    public function showPage(Request $request, Recipe $recipe)
    {
        $favoriteIds = $this->favoriteIds($request);
        $recipeData = $this->baseRecipeData($recipe->load('products'), $favoriteIds);
        
        return view('recipes.show', [
            'recipe' => $recipeData,
            'isFavorite' => in_array($recipe->id, $favoriteIds, true),
        ]);
    }
}
