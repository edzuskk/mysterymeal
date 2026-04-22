<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Calculate similarity between two strings using Levenshtein distance
     */
    private function calculateSimilarity($str1, $str2)
    {
        $str1 = strtolower(trim($str1));
        $str2 = strtolower(trim($str2));
        
        if ($str1 === $str2) return 100;
        
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        $maxLen = max($len1, $len2);
        
        if ($maxLen === 0) return 100;
        
        $distance = levenshtein($str1, $str2);
        $similarity = (($maxLen - $distance) / $maxLen) * 100;
        
        return max(0, $similarity);
    }

    /**
     * Find recipes based on provided products - searches with fuzzy matching
     */
    public function findRecipes(Request $request)
    {
        $products = $request->input('products', []);

        if (empty($products)) {
            return response()->json([
                'success' => false,
                'message' => 'No products provided',
            ], 400);
        }

        // Normalize search terms to lowercase for case-insensitive matching
        $searchProducts = array_map('strtolower', array_map('trim', $products));

        // Get all recipes with their products
        $allRecipes = Recipe::with('products')->get();

        // Score each recipe based on how well it matches the search products
        $recipes = $allRecipes
            ->map(function ($recipe) use ($searchProducts) {
                $recipeProductNames = $recipe->products->pluck('name')->toArray();
                
                $bestMatchPercentage = 0;
                
                // For each search product, find the best match in recipe's products
                foreach ($searchProducts as $searchProduct) {
                    foreach ($recipeProductNames as $recipeProduct) {
                        $similarity = $this->calculateSimilarity($searchProduct, $recipeProduct);
                        
                        // Consider it a match if similarity is > 60%
                        if ($similarity > 60) {
                            $bestMatchPercentage = max($bestMatchPercentage, (int)$similarity);
                        }
                    }
                }
                
                // Add image from metadata
                $recipe->image = $recipe->metadata['image_url'] ?? null;
                $recipe->match_percentage = $bestMatchPercentage;
                
                return $recipe;
            })
            ->filter(function ($recipe) {
                // Only show recipes with at least 60% match
                return $recipe->match_percentage >= 60;
            })
            ->sortByDesc('match_percentage')
            ->values();

        return response()->json([
            'success' => true,
            'recipes' => $recipes,
            'message' => $recipes->isEmpty() ? 'No recipes found with this ingredient' : 'Recipes found',
        ]);
    }

    /**
     * Get all recipes
     */
    public function index()
    {
        $recipes = Recipe::with('products')->paginate(10);
        return response()->json($recipes);
    }

    /**
     * Get single recipe
     */
    public function show($id)
    {
        $recipe = Recipe::with('products')->find($id);
        
        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        return response()->json($recipe);
    }
}
