<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Milk', 'category' => 'dairy', 'description' => 'Fresh milk'],
            ['name' => 'Cheese', 'category' => 'dairy', 'description' => 'Cheddar cheese'],
            ['name' => 'Butter', 'category' => 'dairy', 'description' => 'Salted butter'],
            ['name' => 'Eggs', 'category' => 'protein', 'description' => 'Chicken eggs'],
            ['name' => 'Chicken', 'category' => 'protein', 'description' => 'Chicken breast'],
            ['name' => 'Beef', 'category' => 'protein', 'description' => 'Ground beef'],
            ['name' => 'Salmon', 'category' => 'protein', 'description' => 'Fresh salmon'],
            ['name' => 'Pasta', 'category' => 'grain', 'description' => 'Spaghetti pasta'],
            ['name' => 'Rice', 'category' => 'grain', 'description' => 'White rice'],
            ['name' => 'Bread', 'category' => 'grain', 'description' => 'Whole wheat bread'],
            ['name' => 'Tomato', 'category' => 'vegetable', 'description' => 'Fresh tomato'],
            ['name' => 'Onion', 'category' => 'vegetable', 'description' => 'Yellow onion'],
            ['name' => 'Garlic', 'category' => 'vegetable', 'description' => 'Garlic cloves'],
            ['name' => 'Carrot', 'category' => 'vegetable', 'description' => 'Orange carrot'],
            ['name' => 'Broccoli', 'category' => 'vegetable', 'description' => 'Fresh broccoli'],
            ['name' => 'Lettuce', 'category' => 'vegetable', 'description' => 'Green lettuce'],
            ['name' => 'Bell Pepper', 'category' => 'vegetable', 'description' => 'Red bell pepper'],
            ['name' => 'Spinach', 'category' => 'vegetable', 'description' => 'Fresh spinach'],
            ['name' => 'Apple', 'category' => 'fruit', 'description' => 'Red apple'],
            ['name' => 'Banana', 'category' => 'fruit', 'description' => 'Yellow banana'],
            ['name' => 'Lemon', 'category' => 'fruit', 'description' => 'Fresh lemon'],
            ['name' => 'Olive Oil', 'category' => 'oil', 'description' => 'Extra virgin olive oil'],
            ['name' => 'Salt', 'category' => 'seasoning', 'description' => 'Sea salt'],
            ['name' => 'Pepper', 'category' => 'seasoning', 'description' => 'Black pepper'],
            ['name' => 'Basil', 'category' => 'herbs', 'description' => 'Fresh basil'],
            ['name' => 'Thyme', 'category' => 'herbs', 'description' => 'Fresh thyme'],
            // NEW INGREDIENTS ADDED
            ['name' => 'Flour', 'category' => 'grain', 'description' => 'All-purpose flour'],
            ['name' => 'Celery', 'category' => 'vegetable', 'description' => 'Fresh celery stalks'],
            ['name' => 'Mushroom', 'category' => 'vegetable', 'description' => 'Fresh mushrooms'],
            ['name' => 'Zucchini', 'category' => 'vegetable', 'description' => 'Fresh zucchini'],
            ['name' => 'Eggplant', 'category' => 'vegetable', 'description' => 'Fresh eggplant'],
            ['name' => 'Potato', 'category' => 'vegetable', 'description' => 'Russet potato'],
            ['name' => 'Orange', 'category' => 'fruit', 'description' => 'Fresh orange'],
            ['name' => 'Strawberry', 'category' => 'fruit', 'description' => 'Fresh strawberries'],
            ['name' => 'Blueberry', 'category' => 'fruit', 'description' => 'Fresh blueberries'],
            ['name' => 'Cream', 'category' => 'dairy', 'description' => 'Heavy cream'],
            ['name' => 'Parmesan', 'category' => 'dairy', 'description' => 'Parmesan cheese'],
            ['name' => 'Mozzarella', 'category' => 'dairy', 'description' => 'Fresh mozzarella'],
            ['name' => 'Feta', 'category' => 'dairy', 'description' => 'Feta cheese'],
            ['name' => 'Shrimp', 'category' => 'protein', 'description' => 'Fresh shrimp'],
            ['name' => 'Fish', 'category' => 'protein', 'description' => 'White fish fillet'],
            ['name' => 'Tuna', 'category' => 'protein', 'description' => 'Canned tuna'],
            ['name' => 'Tortilla', 'category' => 'grain', 'description' => 'Flour tortillas'],
            ['name' => 'Sugar', 'category' => 'seasoning', 'description' => 'White sugar'],
            ['name' => 'Honey', 'category' => 'seasoning', 'description' => 'Natural honey'],
            ['name' => 'Vanilla', 'category' => 'seasoning', 'description' => 'Vanilla extract'],
            ['name' => 'Cinnamon', 'category' => 'seasoning', 'description' => 'Ground cinnamon'],
            ['name' => 'Parsley', 'category' => 'herbs', 'description' => 'Fresh parsley'],
            ['name' => 'Soy Sauce', 'category' => 'seasoning', 'description' => 'Soy sauce'],
            ['name' => 'Hot Sauce', 'category' => 'seasoning', 'description' => 'Hot sauce'],
            ['name' => 'Curry Powder', 'category' => 'seasoning', 'description' => 'Curry powder'],
            ['name' => 'Coconut Milk', 'category' => 'dairy', 'description' => 'Coconut milk'],
            ['name' => 'Lentils', 'category' => 'protein', 'description' => 'Brown lentils'],
            ['name' => 'Mayonnaise', 'category' => 'dairy', 'description' => 'Mayonnaise'],
            ['name' => 'Chocolate Chips', 'category' => 'seasoning', 'description' => 'Chocolate chips'],
            ['name' => 'Oil', 'category' => 'oil', 'description' => 'Vegetable oil'],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'slug' => Str::slug($product['name']),
                    'category' => $product['category'],
                    'description' => $product['description'],
                ]
            );
        }
    }
}
