<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'name' => 'Classic Spaghetti Carbonara',
                'description' => 'Creamy Italian pasta with bacon and parmesan',
                'image' => 'https://www.themealdb.com/images/media/meals/llcqg51578844508.jpg',
                'ingredients' => ['Pasta', 'Eggs', 'Cheese', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Grilled Chicken Salad',
                'description' => 'Healthy salad with grilled chicken and fresh greens',
                'image' => 'https://www.themealdb.com/images/media/meals/uwxqyy1487327331.jpg',
                'ingredients' => ['Chicken', 'Lettuce', 'Tomato', 'Onion', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Tomato Pasta',
                'description' => 'Simple and delicious Italian tomato sauce pasta',
                'image' => 'https://www.themealdb.com/images/media/meals/y6yvce1699013028.jpg',
                'ingredients' => ['Pasta', 'Tomato', 'Garlic', 'Olive Oil', 'Salt', 'Basil'],
            ],
            [
                'name' => 'Vegetable Stir Fry',
                'description' => 'Quick and healthy vegetable stir fry',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Broccoli', 'Bell Pepper', 'Carrot', 'Onion', 'Garlic', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Chicken Fried Rice',
                'description' => 'Asian-inspired chicken fried rice',
                'image' => 'https://www.themealdb.com/images/media/meals/utxtqw1511639027.jpg',
                'ingredients' => ['Rice', 'Chicken', 'Eggs', 'Onion', 'Garlic', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Simple Egg Omelette',
                'description' => 'Quick breakfast omelette with cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/58oia61593350969.jpg',
                'ingredients' => ['Eggs', 'Cheese', 'Butter', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Beef Tacos',
                'description' => 'Delicious beef tacos with fresh vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Beef', 'Tomato', 'Lettuce', 'Cheese', 'Onion'],
            ],
            [
                'name' => 'Lemon Garlic Salmon',
                'description' => 'Pan-seared salmon with lemon and garlic',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Salmon', 'Lemon', 'Garlic', 'Olive Oil', 'Salt', 'Thyme'],
            ],
            [
                'name' => 'Creamy Pasta',
                'description' => 'Rich and creamy pasta with milk and cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Pasta', 'Milk', 'Cheese', 'Butter', 'Garlic', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Cheese Omelette',
                'description' => 'Simple omelette with melted cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/58oia61593350969.jpg',
                'ingredients' => ['Eggs', 'Cheese', 'Milk', 'Butter'],
            ],
            [
                'name' => 'Garlic Butter Pasta',
                'description' => 'Simple pasta with garlic, butter and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Pasta', 'Garlic', 'Butter', 'Salt', 'Thyme'],
            ],
            [
                'name' => 'Tomato Chicken Pasta',
                'description' => 'Chicken and tomato sauce over pasta',
                'image' => 'https://www.themealdb.com/images/media/meals/y6yvce1699013028.jpg',
                'ingredients' => ['Pasta', 'Chicken', 'Tomato', 'Garlic', 'Olive Oil', 'Basil'],
            ],
            [
                'name' => 'Carrot Stir Fry',
                'description' => 'Simple stir-fried carrots with garlic',
                'image' => 'https://www.themealdb.com/images/media/meals/vwuprt1487341251.jpg',
                'ingredients' => ['Carrot', 'Garlic', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Egg Fried Rice',
                'description' => 'Simple fried rice with eggs',
                'image' => 'https://www.themealdb.com/images/media/meals/utxtqw1511639027.jpg',
                'ingredients' => ['Rice', 'Eggs', 'Onion', 'Garlic'],
            ],
        ];

        foreach ($recipes as $recipeData) {
            $ingredients = $recipeData['ingredients'];
            $image = $recipeData['image'];
            unset($recipeData['ingredients']);
            unset($recipeData['image']);

            $recipe = Recipe::firstOrCreate(
                ['name' => $recipeData['name']],
                array_merge($recipeData, ['metadata' => ['image_url' => $image]])
            );

            // Attach products to recipe
            foreach ($ingredients as $ingredientName) {
                $product = Product::where('name', $ingredientName)->first();
                if ($product && !$recipe->products()->where('product_id', $product->id)->exists()) {
                    $recipe->products()->attach($product->id);
                }
            }
        }
    }
}
