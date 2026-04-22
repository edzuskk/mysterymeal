<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Find recipes based on provided products
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

        // Get all products, comparing case-insensitively
        $productModels = Product::get()
            ->filter(function ($product) use ($searchProducts) {
                return in_array(strtolower(trim($product->name)), $searchProducts);
            });

        $productIds = $productModels->pluck('id')->toArray();

        if (empty($productIds)) {
            return response()->json([
                'success' => false,
                'recipes' => [],
                'message' => 'No recipes found with these products',
            ]);
        }

        // Find ALL recipes that contain ANY of the provided products
        $recipes = Recipe::with('products')
            ->whereHas('products', function ($query) use ($productIds) {
                $query->whereIn('product_id', $productIds);
            })
            ->get()
            ->map(function ($recipe) use ($productIds) {
                $recipeProductIds = $recipe->products->pluck('id')->toArray();
                $matchCount = count(array_intersect($recipeProductIds, $productIds));
                $totalRecipeProducts = count($recipeProductIds);
                
                // Match percentage: (matched products / recipe's products) * 100
                $recipe->match_percentage = $totalRecipeProducts > 0 
                    ? (int) (($matchCount / $totalRecipeProducts) * 100)
                    : 0;
                
                // Add image from metadata
                $recipe->image = $recipe->metadata['image_url'] ?? null;
                
                return $recipe;
            })
            ->sortByDesc('match_percentage')
            ->values();

        return response()->json([
            'success' => true,
            'recipes' => $recipes,
            'message' => $recipes->isEmpty() ? 'No recipes found with these products' : 'Recipes found',
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
