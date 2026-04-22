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
