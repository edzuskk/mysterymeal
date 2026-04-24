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
            // NEW RECIPES ADDED
            [
                'name' => 'Margherita Pizza',
                'description' => 'Classic Italian pizza with tomato, mozzarella, and basil',
                'image' => 'https://www.themealdb.com/images/media/meals/160jzs5u4j6f82.jpg',
                'ingredients' => ['Flour', 'Tomato', 'Cheese', 'Basil', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Chicken Noodle Soup',
                'description' => 'Comforting homemade chicken soup with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Chicken', 'Carrot', 'Celery', 'Onion', 'Egg', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Greek Salad',
                'description' => 'Fresh Mediterranean salad with feta cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/qyytrm1520045991.jpg',
                'ingredients' => ['Tomato', 'Onion', 'Cheese', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Beef Stir Fry',
                'description' => 'Quick and flavorful beef stir fry with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Beef', 'Broccoli', 'Bell Pepper', 'Onion', 'Garlic', 'Soy Sauce'],
            ],
            [
                'name' => 'Spinach Salad',
                'description' => 'Healthy spinach salad with fresh vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/vetplod1511550505.jpg',
                'ingredients' => ['Spinach', 'Tomato', 'Onion', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Garlic Bread',
                'description' => 'Crispy bread with garlic butter and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/xxrxsd1509775627.jpg',
                'ingredients' => ['Bread', 'Garlic', 'Butter', 'Salt', 'Parsley'],
            ],
            [
                'name' => 'Baked Potato',
                'description' => 'Simple baked potato with butter and cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/sldkdh1520034433.jpg',
                'ingredients' => ['Potato', 'Butter', 'Cheese', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Tomato Soup',
                'description' => 'Creamy and comforting tomato soup',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Tomato', 'Onion', 'Garlic', 'Olive Oil', 'Salt', 'Basil'],
            ],
            [
                'name' => 'Grilled Cheese Sandwich',
                'description' => 'Classic grilled cheese sandwich',
                'image' => 'https://www.themealdb.com/images/media/meals/1547544486.jpg',
                'ingredients' => ['Bread', 'Cheese', 'Butter'],
            ],
            [
                'name' => 'Mushroom Pasta',
                'description' => 'Creamy pasta with mushrooms and garlic',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Pasta', 'Mushroom', 'Garlic', 'Cream', 'Butter', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Shrimp Scampi',
                'description' => 'Garlic shrimp with pasta and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Shrimp', 'Garlic', 'Pasta', 'Olive Oil', 'Butter', 'Lemon', 'Parsley'],
            ],
            [
                'name' => 'Vegetable Soup',
                'description' => 'Hearty vegetable soup with fresh vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/1547544486.jpg',
                'ingredients' => ['Carrot', 'Celery', 'Onion', 'Tomato', 'Garlic', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Cheese Pizza',
                'description' => 'Simple cheese pizza with tomato sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/160jzs5u4j6f82.jpg',
                'ingredients' => ['Flour', 'Tomato', 'Cheese', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Pancakes',
                'description' => 'Fluffy breakfast pancakes with maple syrup',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Eggs', 'Milk', 'Butter', 'Sugar', 'Salt'],
            ],
            [
                'name' => 'Fruit Salad',
                'description' => 'Fresh mixed fruit salad',
                'image' => 'https://www.themealdb.com/images/media/meals/1547544486.jpg',
                'ingredients' => ['Apple', 'Banana', 'Orange', 'Strawberry', 'Lemon'],
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Classic Caesar salad with croutons and parmesan',
                'image' => 'https://www.themealdb.com/images/media/meals/qyytrm1520045991.jpg',
                'ingredients' => ['Lettuce', 'Cheese', 'Bread', 'Garlic', 'Olive Oil', 'Lemon'],
            ],
            [
                'name' => 'Beef Burger',
                'description' => 'Classic beef burger with cheese and vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Beef', 'Bread', 'Cheese', 'Lettuce', 'Tomato', 'Onion'],
            ],
            [
                'name' => 'Fish and Chips',
                'description' => 'Crispy fried fish with potato fries',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Fish', 'Potato', 'Flour', 'Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Mac and Cheese',
                'description' => 'Creamy macaroni and cheese casserole',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Pasta', 'Cheese', 'Milk', 'Butter', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Chicken Wings',
                'description' => 'Crispy chicken wings with sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Chicken', 'Butter', 'Hot Sauce', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Vegetable Curry',
                'description' => 'Spicy vegetable curry with rice',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Carrot', 'Broccoli', 'Onion', 'Garlic', 'Coconut Milk', 'Curry Powder', 'Rice'],
            ],
            [
                'name' => 'Tomato Bruschetta',
                'description' => 'Italian appetizer with tomatoes on toasted bread',
                'image' => 'https://www.themealdb.com/images/media/meals/xxrxsd1509775627.jpg',
                'ingredients' => ['Bread', 'Tomato', 'Garlic', 'Basil', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Egg Salad Sandwich',
                'description' => 'Simple egg salad sandwich',
                'image' => 'https://www.themealdb.com/images/media/meals/1547544486.jpg',
                'ingredients' => ['Eggs', 'Bread', 'Mayonnaise', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Mushroom Omelette',
                'description' => 'Fluffy omelette with mushrooms and cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/58oia61593350969.jpg',
                'ingredients' => ['Eggs', 'Mushroom', 'Cheese', 'Butter', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Grilled Vegetables',
                'description' => 'Mixed grilled vegetables with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Bell Pepper', 'Zucchini', 'Eggplant', 'Olive Oil', 'Garlic', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Chicken Quesadilla',
                'description' => 'Mexican-style chicken quesadilla with cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Chicken', 'Cheese', 'Tortilla', 'Onion', 'Bell Pepper', 'Olive Oil'],
            ],
            [
                'name' => 'Lentil Soup',
                'description' => 'Hearty lentil soup with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Lentils', 'Carrot', 'Celery', 'Onion', 'Garlic', 'Olive Oil', 'Salt'],
            ],
            [
                'name' => 'Stuffed Bell Peppers',
                'description' => 'Bell peppers stuffed with rice and vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Bell Pepper', 'Rice', 'Tomato', 'Onion', 'Garlic', 'Cheese', 'Olive Oil'],
            ],
            [
                'name' => 'Apple Pie',
                'description' => 'Classic American apple pie with cinnamon',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Apple', 'Flour', 'Butter', 'Sugar', 'Cinnamon', 'Salt'],
            ],
            [
                'name' => 'Banana Smoothie',
                'description' => 'Healthy banana smoothie with milk',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Banana', 'Milk', 'Honey', 'Vanilla'],
            ],
            [
                'name' => 'Garlic Mashed Potatoes',
                'description' => 'Creamy mashed potatoes with garlic',
                'image' => 'https://www.themealdb.com/images/media/meals/sldkdh1520034433.jpg',
                'ingredients' => ['Potato', 'Butter', 'Milk', 'Garlic', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Caprese Salad',
                'description' => 'Italian salad with tomato, mozzarella, and basil',
                'image' => 'https://www.themealdb.com/images/media/meals/qyytrm1520045991.jpg',
                'ingredients' => ['Tomato', 'Cheese', 'Basil', 'Olive Oil', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Chicken Curry',
                'description' => 'Flavorful chicken curry with rice',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Chicken', 'Onion', 'Garlic', 'Coconut Milk', 'Curry Powder', 'Rice', 'Salt'],
            ],
            [
                'name' => 'Vegetable Pizza',
                'description' => 'Pizza loaded with fresh vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/160jzs5u4j6f82.jpg',
                'ingredients' => ['Flour', 'Tomato', 'Cheese', 'Bell Pepper', 'Mushroom', 'Onion', 'Olive Oil'],
            ],
            [
                'name' => 'Blueberry Muffins',
                'description' => 'Fresh blueberry muffins for breakfast',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Blueberry', 'Eggs', 'Milk', 'Butter', 'Sugar', 'Salt'],
            ],
            [
                'name' => 'Tuna Salad',
                'description' => 'Simple tuna salad with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/qyytrm1520045991.jpg',
                'ingredients' => ['Tuna', 'Lettuce', 'Tomato', 'Onion', 'Mayonnaise', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Roasted Chicken',
                'description' => 'Simple roasted chicken with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Chicken', 'Garlic', 'Butter', 'Thyme', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Zucchini Noodles',
                'description' => 'Healthy zucchini noodles with garlic and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/wvrtxh1511298908.jpg',
                'ingredients' => ['Zucchini', 'Garlic', 'Olive Oil', 'Salt', 'Pepper', 'Parmesan'],
            ],
            [
                'name' => 'Chocolate Chip Cookies',
                'description' => 'Classic homemade chocolate chip cookies',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Butter', 'Sugar', 'Eggs', 'Chocolate Chips', 'Salt'],
            ],
            // ADDITIONAL RECIPES - EXPANDED COLLECTION
            [
                'name' => 'Pad Thai',
                'description' => 'Traditional Thai stir-fried noodles with shrimp and peanuts',
                'image' => 'https://www.themealdb.com/images/media/meals/wvrtxh1511298908.jpg',
                'ingredients' => ['Rice Noodles', 'Shrimp', 'Eggs', 'Bean Sprouts', 'Peanuts', 'Lime', 'Fish Sauce'],
            ],
            [
                'name' => 'Chicken Tikka Masala',
                'description' => 'Creamy Indian curry with marinated chicken',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Chicken', 'Yogurt', 'Tomato', 'Cream', 'Onion', 'Garlic', 'Ginger', 'Garam Masala'],
            ],
            [
                'name' => 'Beef Stroganoff',
                'description' => 'Russian beef dish with creamy mushroom sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Beef', 'Mushroom', 'Onion', 'Sour Cream', 'Butter', 'Flour', 'Beef Broth'],
            ],
            [
                'name' => 'Ratatouille',
                'description' => 'French vegetable stew with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Eggplant', 'Zucchini', 'Bell Pepper', 'Tomato', 'Onion', 'Garlic', 'Herbs'],
            ],
            [
                'name' => 'Sushi Rolls',
                'description' => 'Japanese sushi with fish and vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/wvrtxh1511298908.jpg',
                'ingredients' => ['Rice', 'Nori', 'Fish', 'Cucumber', 'Avocado', 'Rice Vinegar', 'Soy Sauce'],
            ],
            [
                'name' => 'Paella',
                'description' => 'Spanish rice dish with seafood and saffron',
                'image' => 'https://www.themealdb.com/images/media/meals/160jzs5u4j6f82.jpg',
                'ingredients' => ['Rice', 'Shrimp', 'Mussels', 'Chicken', 'Saffron', 'Tomato', 'Bell Pepper'],
            ],
            [
                'name' => 'Fajitas',
                'description' => 'Mexican grilled meat with peppers and onions',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Beef', 'Bell Pepper', 'Onion', 'Tortilla', 'Lime', 'Cumin', 'Chili Powder'],
            ],
            [
                'name' => 'Moussaka',
                'description' => 'Greek layered dish with eggplant and meat sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/xxyupq1487344184.jpg',
                'ingredients' => ['Eggplant', 'Lamb', 'Tomato', 'Onion', 'Cheese', 'Bechamel Sauce'],
            ],
            [
                'name' => 'Pho',
                'description' => 'Vietnamese noodle soup with beef and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/vtqxtu1511784194.jpg',
                'ingredients' => ['Rice Noodles', 'Beef', 'Broth', 'Bean Sprouts', 'Basil', 'Lime', 'Star Anise'],
            ],
            [
                'name' => 'Goulash',
                'description' => 'Hungarian beef stew with paprika',
                'image' => 'https://www.themealdb.com/images/media/meals/wpputp1511813562.jpg',
                'ingredients' => ['Beef', 'Onion', 'Paprika', 'Potato', 'Carrot', 'Beef Broth', 'Sour Cream'],
            ],
            [
                'name' => 'Ceviche',
                'description' => 'Latin American citrus-marinated seafood',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Fish', 'Lime', 'Onion', 'Tomato', 'Cilantro', 'Avocado', 'Chili'],
            ],
            [
                'name' => 'Bibimbap',
                'description' => 'Korean mixed rice with vegetables and meat',
                'image' => 'https://www.themealdb.com/images/media/meals/wuxrtu1487327597.jpg',
                'ingredients' => ['Rice', 'Beef', 'Spinach', 'Carrot', 'Bean Sprouts', 'Egg', 'Gochujang'],
            ],
            [
                'name' => 'Coconut Curry',
                'description' => 'Thai coconut curry with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Coconut Milk', 'Curry Paste', 'Vegetables', 'Tofu', 'Basil', 'Lime', 'Fish Sauce'],
            ],
            [
                'name' => 'Shepherd\'s Pie',
                'description' => 'British meat pie with mashed potato topping',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Lamb', 'Potato', 'Carrot', 'Peas', 'Onion', 'Worcestershire Sauce', 'Butter'],
            ],
            [
                'name' => 'Ramen',
                'description' => 'Japanese noodle soup with pork and eggs',
                'image' => 'https://www.themealdb.com/images/media/meals/vtqxtu1511784194.jpg',
                'ingredients' => ['Ramen Noodles', 'Pork', 'Eggs', 'Green Onions', 'Bamboo Shoots', 'Broth', 'Soy Sauce'],
            ],
            [
                'name' => 'Tacos Al Pastor',
                'description' => 'Mexican pork tacos with pineapple',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Pork', 'Pineapple', 'Corn Tortillas', 'Onion', 'Cilantro', 'Lime', 'Chili Powder'],
            ],
            [
                'name' => 'Dumplings',
                'description' => 'Asian steamed dumplings with pork filling',
                'image' => 'https://www.themealdb.com/images/media/meals/wvrtxh1511298908.jpg',
                'ingredients' => ['Pork', 'Cabbage', 'Green Onions', 'Ginger', 'Soy Sauce', 'Dumpling Wrappers'],
            ],
            [
                'name' => 'Risotto',
                'description' => 'Italian creamy rice dish with mushrooms',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Rice', 'Mushroom', 'Onion', 'White Wine', 'Parmesan', 'Butter', 'Broth'],
            ],
            [
                'name' => 'Biryani',
                'description' => 'Indian fragrant rice with spiced meat',
                'image' => 'https://www.themealdb.com/images/media/meals/y4cqvn1558194062.jpg',
                'ingredients' => ['Rice', 'Chicken', 'Yogurt', 'Onion', 'Ginger', 'Garlic', 'Saffron', 'Spices'],
            ],
            [
                'name' => 'Enchiladas',
                'description' => 'Mexican rolled tortillas with cheese and sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Corn Tortillas', 'Cheese', 'Chicken', 'Enchilada Sauce', 'Onion', 'Sour Cream'],
            ],
            [
                'name' => 'Lobster Roll',
                'description' => 'New England lobster sandwich with butter',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Lobster', 'Bread', 'Butter', 'Lemon', 'Mayonnaise', 'Celery', 'Chives'],
            ],
            [
                'name' => 'Baba Ghanoush',
                'description' => 'Middle Eastern roasted eggplant dip',
                'image' => 'https://www.themealdb.com/images/media/meals/vetplod1511550505.jpg',
                'ingredients' => ['Eggplant', 'Tahini', 'Garlic', 'Lemon', 'Olive Oil', 'Parsley'],
            ],
            [
                'name' => 'Tom Yum Soup',
                'description' => 'Thai hot and sour soup with shrimp',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Shrimp', 'Mushroom', 'Lemongrass', 'Lime', 'Chili', 'Fish Sauce', 'Galangal'],
            ],
            [
                'name' => 'Croissants',
                'description' => 'French buttery pastries',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Butter', 'Yeast', 'Milk', 'Sugar', 'Salt'],
            ],
            [
                'name' => 'Spring Rolls',
                'description' => 'Asian fresh vegetable rolls',
                'image' => 'https://www.themealdb.com/images/media/meals/wvrtxh1511298908.jpg',
                'ingredients' => ['Rice Paper', 'Vegetables', 'Shrimp', 'Mint', 'Basil', 'Peanut Sauce'],
            ],
            [
                'name' => 'Gnocchi',
                'description' => 'Italian potato dumplings with sage butter',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Potato', 'Flour', 'Butter', 'Sage', 'Parmesan', 'Salt', 'Pepper'],
            ],
            [
                'name' => 'Kebabs',
                'description' => 'Grilled meat skewers with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Beef', 'Bell Pepper', 'Onion', 'Tomato', 'Yogurt', 'Spices', 'Lemon'],
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Italian coffee-flavored dessert',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Ladyfingers', 'Coffee', 'Mascarpone', 'Eggs', 'Sugar', 'Cocoa'],
            ],
            [
                'name' => 'Waffles',
                'description' => 'Belgian waffles with maple syrup',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Eggs', 'Milk', 'Butter', 'Sugar', 'Baking Powder'],
            ],
            [
                'name' => 'Falafel',
                'description' => 'Middle Eastern chickpea fritters',
                'image' => 'https://www.themealdb.com/images/media/meals/vetplod1511550505.jpg',
                'ingredients' => ['Chickpeas', 'Onion', 'Garlic', 'Parsley', 'Cumin', 'Flour', 'Oil'],
            ],
            [
                'name' => 'Quiche',
                'description' => 'French egg tart with vegetables and cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Eggs', 'Cream', 'Cheese', 'Pie Crust', 'Spinach', 'Onion', 'Salt'],
            ],
            [
                'name' => 'Kimchi Fried Rice',
                'description' => 'Korean spicy fried rice with kimchi',
                'image' => 'https://www.themealdb.com/images/media/meals/utxtqw1511639027.jpg',
                'ingredients' => ['Rice', 'Kimchi', 'Eggs', 'Bacon', 'Sesame Oil', 'Green Onions', 'Gochujang'],
            ],
            [
                'name' => 'Fish Tacos',
                'description' => 'Mexican tacos with grilled fish',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Fish', 'Corn Tortillas', 'Cabbage', 'Lime', 'Mayonnaise', 'Cilantro'],
            ],
            [
                'name' => 'Stuffed Cabbage Rolls',
                'description' => 'Eastern European cabbage rolls with meat',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Cabbage', 'Ground Beef', 'Rice', 'Tomato', 'Onion', 'Garlic', 'Paprika'],
            ],
            [
                'name' => 'Beef and Broccoli',
                'description' => 'Chinese stir-fried beef with broccoli',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Beef', 'Broccoli', 'Soy Sauce', 'Garlic', 'Ginger', 'Cornstarch', 'Oil'],
            ],
            [
                'name' => 'Eggplant Parmesan',
                'description' => 'Italian baked eggplant with cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Eggplant', 'Tomato Sauce', 'Mozzarella', 'Parmesan', 'Basil', 'Olive Oil'],
            ],
            [
                'name' => 'Chicken and Dumplings',
                'description' => 'Comforting chicken soup with dumplings',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Chicken', 'Flour', 'Milk', 'Carrot', 'Celery', 'Onion', 'Chicken Broth'],
            ],
            [
                'name' => 'Sweet and Sour Pork',
                'description' => 'Chinese pork with pineapple and peppers',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Pork', 'Pineapple', 'Bell Pepper', 'Vinegar', 'Sugar', 'Soy Sauce', 'Cornstarch'],
            ],
            [
                'name' => 'Spanakopita',
                'description' => 'Greek spinach and cheese pie',
                'image' => 'https://www.themealdb.com/images/media/meals/xxyupq1487344184.jpg',
                'ingredients' => ['Spinach', 'Feta Cheese', 'Phyllo Dough', 'Onion', 'Eggs', 'Olive Oil'],
            ],
            [
                'name' => 'Beef Wellington',
                'description' => 'British beef wrapped in pastry',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Beef', 'Puff Pastry', 'Mushroom', 'Prosciutto', 'Eggs', 'Mustard'],
            ],
            [
                'name' => 'Chow Mein',
                'description' => 'Chinese stir-fried noodles with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/utxtqw1511639027.jpg',
                'ingredients' => ['Noodles', 'Cabbage', 'Bean Sprouts', 'Soy Sauce', 'Garlic', 'Ginger', 'Oil'],
            ],
            [
                'name' => 'Lobster Bisque',
                'description' => 'French creamy lobster soup',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Lobster', 'Cream', 'Brandy', 'Tomato', 'Shallots', 'Tarragon', 'Butter'],
            ],
            [
                'name' => 'Pork Carnitas',
                'description' => 'Mexican slow-cooked pork',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Pork', 'Orange', 'Lime', 'Cumin', 'Oregano', 'Garlic', 'Bay Leaves'],
            ],
            [
                'name' => 'Vegetable Lo Mein',
                'description' => 'Chinese noodles with mixed vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/ysxwuq1487323065.jpg',
                'ingredients' => ['Noodles', 'Broccoli', 'Carrot', 'Bell Pepper', 'Soy Sauce', 'Garlic', 'Sesame Oil'],
            ],
            [
                'name' => 'Crème Brûlée',
                'description' => 'French custard dessert with caramelized sugar',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Cream', 'Eggs', 'Sugar', 'Vanilla', 'Salt'],
            ],
            [
                'name' => 'Chicken Shawarma',
                'description' => 'Middle Eastern spiced chicken wraps',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Chicken', 'Yogurt', 'Garlic', 'Lemon', 'Sumac', 'Pita', 'Tahini'],
            ],
            [
                'name' => 'Beef Pho',
                'description' => 'Vietnamese beef noodle soup',
                'image' => 'https://www.themealdb.com/images/media/meals/vtqxtu1511784194.jpg',
                'ingredients' => ['Beef', 'Rice Noodles', 'Broth', 'Bean Sprouts', 'Basil', 'Lime', 'Star Anise'],
            ],
            [
                'name' => 'Stuffed Mushrooms',
                'description' => 'Mushrooms stuffed with cheese and herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Mushroom', 'Cheese', 'Bread Crumbs', 'Garlic', 'Parsley', 'Butter'],
            ],
            [
                'name' => 'Thai Green Curry',
                'description' => 'Spicy Thai curry with coconut milk',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Coconut Milk', 'Green Curry Paste', 'Chicken', 'Thai Basil', 'Bamboo', 'Fish Sauce'],
            ],
            [
                'name' => 'Corn Chowder',
                'description' => 'Creamy corn soup with potatoes',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Corn', 'Potato', 'Cream', 'Onion', 'Butter', 'Chicken Broth', 'Bacon'],
            ],
            [
                'name' => 'Baked Ziti',
                'description' => 'Italian baked pasta with cheese',
                'image' => 'https://www.themealdb.com/images/media/meals/wrssvt1487341787.jpg',
                'ingredients' => ['Ziti', 'Ricotta', 'Mozzarella', 'Tomato Sauce', 'Parmesan', 'Basil', 'Garlic'],
            ],
            [
                'name' => 'Pork Chops',
                'description' => 'Grilled pork chops with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Pork Chops', 'Garlic', 'Thyme', 'Olive Oil', 'Salt', 'Pepper', 'Lemon'],
            ],
            [
                'name' => 'Shrimp Scampi',
                'description' => 'Garlic shrimp with pasta',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Shrimp', 'Garlic', 'Butter', 'White Wine', 'Parsley', 'Lemon', 'Pasta'],
            ],
            [
                'name' => 'French Onion Soup',
                'description' => 'Classic French soup with caramelized onions',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Onion', 'Beef Broth', 'Gruyere', 'Thyme', 'Butter', 'Wine', 'Bread'],
            ],
            [
                'name' => 'Chicken Pot Pie',
                'description' => 'Creamy chicken pie with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Chicken', 'Pie Crust', 'Carrots', 'Peas', 'Cream', 'Chicken Broth', 'Onion'],
            ],
            [
                'name' => 'Eggplant Lasagna',
                'description' => 'Vegetarian lasagna with eggplant',
                'image' => 'https://www.themealdb.com/images/media/meals/rvxvwrr1520073503.jpg',
                'ingredients' => ['Eggplant', 'Ricotta', 'Mozzarella', 'Tomato Sauce', 'Parmesan', 'Basil'],
            ],
            [
                'name' => 'Beef and Bean Chili',
                'description' => 'Hearty beef chili with beans',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Beef', 'Kidney Beans', 'Tomato', 'Onion', 'Chili Powder', 'Cumin', 'Garlic'],
            ],
            [
                'name' => 'Lemon Chicken',
                'description' => 'Pan-seared chicken with lemon butter sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Chicken', 'Lemon', 'Butter', 'Garlic', 'White Wine', 'Parsley', 'Salt'],
            ],
            [
                'name' => 'Vegetable Fried Rice',
                'description' => 'Asian fried rice with mixed vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/utxtqw1511639027.jpg',
                'ingredients' => ['Rice', 'Eggs', 'Carrots', 'Peas', 'Soy Sauce', 'Sesame Oil', 'Green Onions'],
            ],
            [
                'name' => 'Turkey Meatballs',
                'description' => 'Healthy turkey meatballs with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Turkey', 'Bread Crumbs', 'Parmesan', 'Eggs', 'Parsley', 'Garlic', 'Salt'],
            ],
            [
                'name' => 'Stuffed Bell Peppers',
                'description' => 'Bell peppers stuffed with rice and meat',
                'image' => 'https://www.themealdb.com/images/media/meals/sksgut1520034433.jpg',
                'ingredients' => ['Bell Peppers', 'Ground Beef', 'Rice', 'Tomato Sauce', 'Onion', 'Cheese'],
            ],
            [
                'name' => 'Clam Chowder',
                'description' => 'New England creamy clam soup',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Clams', 'Potato', 'Cream', 'Onion', 'Butter', 'Celery', 'Bacon'],
            ],
            [
                'name' => 'Pork Tenderloin',
                'description' => 'Roasted pork tenderloin with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Pork Tenderloin', 'Garlic', 'Rosemary', 'Olive Oil', 'Salt', 'Pepper', 'Thyme'],
            ],
            [
                'name' => 'Shrimp and Grits',
                'description' => 'Southern shrimp with creamy grits',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Shrimp', 'Grits', 'Cream', 'Cheddar', 'Bacon', 'Garlic', 'Green Onions'],
            ],
            [
                'name' => 'Beef Burrito',
                'description' => 'Mexican burrito with beef and beans',
                'image' => 'https://www.themealdb.com/images/media/meals/zhxqbx1583349079.jpg',
                'ingredients' => ['Beef', 'Tortilla', 'Beans', 'Rice', 'Cheese', 'Salsa', 'Sour Cream'],
            ],
            [
                'name' => 'Lemon Tart',
                'description' => 'French lemon tart with meringue',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Lemon', 'Sugar', 'Eggs', 'Butter', 'Flour', 'Cream', 'Meringue'],
            ],
            [
                'name' => 'Chicken Satay',
                'description' => 'Thai chicken skewers with peanut sauce',
                'image' => 'https://www.themealdb.com/images/media/meals/1550443524.jpg',
                'ingredients' => ['Chicken', 'Peanut Butter', 'Soy Sauce', 'Lime', 'Garlic', 'Ginger', 'Skewers'],
            ],
            [
                'name' => 'Vegetable Soup',
                'description' => 'Hearty vegetable soup with herbs',
                'image' => 'https://www.themealdb.com/images/media/meals/ldrsrh1520045501.jpg',
                'ingredients' => ['Carrots', 'Celery', 'Onion', 'Potato', 'Tomato', 'Vegetable Broth', 'Herbs'],
            ],
            [
                'name' => 'Beef Stew',
                'description' => 'Classic beef stew with vegetables',
                'image' => 'https://www.themealdb.com/images/media/meals/wpputp1511813562.jpg',
                'ingredients' => ['Beef', 'Potato', 'Carrot', 'Onion', 'Celery', 'Beef Broth', 'Thyme'],
            ],
            [
                'name' => 'Pancakes',
                'description' => 'Fluffy breakfast pancakes',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Flour', 'Eggs', 'Milk', 'Butter', 'Sugar', 'Baking Powder', 'Salt'],
            ],
            [
                'name' => 'French Toast',
                'description' => 'Classic French toast with maple syrup',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Bread', 'Eggs', 'Milk', 'Cinnamon', 'Vanilla', 'Butter', 'Maple Syrup'],
            ],
            [
                'name' => 'Banana Bread',
                'description' => 'Moist banana bread with walnuts',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Banana', 'Flour', 'Sugar', 'Eggs', 'Butter', 'Walnuts', 'Baking Soda'],
            ],
            [
                'name' => 'Brownies',
                'description' => 'Fudgy chocolate brownies',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Chocolate', 'Butter', 'Sugar', 'Eggs', 'Flour', 'Cocoa Powder', 'Salt'],
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'New York style cheesecake',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Cream Cheese', 'Sugar', 'Eggs', 'Vanilla', 'Graham Crackers', 'Butter'],
            ],
            [
                'name' => 'Carrot Cake',
                'description' => 'Moist carrot cake with cream cheese frosting',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Carrot', 'Flour', 'Sugar', 'Eggs', 'Oil', 'Cream Cheese', 'Walnuts'],
            ],
            [
                'name' => 'Apple Pie',
                'description' => 'Classic American apple pie',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Apple', 'Flour', 'Butter', 'Sugar', 'Cinnamon', 'Lemon', 'Pie Crust'],
            ],
            [
                'name' => 'Peach Cobbler',
                'description' => 'Southern peach dessert with biscuit topping',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Peach', 'Flour', 'Sugar', 'Butter', 'Cinnamon', 'Lemon', 'Baking Powder'],
            ],
            [
                'name' => 'Key Lime Pie',
                'description' => 'Florida key lime pie with meringue',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Lime', 'Sweetened Condensed Milk', 'Eggs', 'Graham Crackers', 'Butter', 'Meringue'],
            ],
            [
                'name' => 'Strawberry Shortcake',
                'description' => 'Classic strawberry dessert with biscuits',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Strawberry', 'Flour', 'Sugar', 'Cream', 'Butter', 'Baking Powder', 'Vanilla'],
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with frosting',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Chocolate', 'Flour', 'Sugar', 'Eggs', 'Butter', 'Cocoa Powder', 'Vanilla'],
            ],
            [
                'name' => 'Vanilla Ice Cream',
                'description' => 'Homemade vanilla ice cream',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Cream', 'Milk', 'Sugar', 'Vanilla', 'Egg Yolks', 'Salt'],
            ],
            [
                'name' => 'Fruit Smoothie',
                'description' => 'Healthy mixed fruit smoothie',
                'image' => 'https://www.themealdb.com/images/media/meals/1529445494.jpg',
                'ingredients' => ['Mixed Berries', 'Banana', 'Yogurt', 'Honey', 'Ice', 'Orange Juice'],
            ],
            [
                'name' => 'Trail Mix',
                'description' => 'Healthy snack mix with nuts and dried fruit',
                'image' => 'https://www.themealdb.com/images/media/meals/1550441882.jpg',
                'ingredients' => ['Almonds', 'Walnuts', 'Raisins', 'Dried Cranberries', 'Dark Chocolate', 'Seeds'],
            ],
        ];

        foreach ($recipes as $recipeData) {
            $ingredients = $recipeData['ingredients'];
            $image = $recipeData['image'];
            unset($recipeData['ingredients']);
            unset($recipeData['image']);

            // Generate basic instructions based on recipe type
            $instructions = $this->generateInstructions($recipeData['name'], $ingredients);

            // Find existing recipe to preserve metadata
            $existingRecipe = Recipe::where('name', $recipeData['name'])->first();
            
            $recipe = Recipe::updateOrCreate(
                ['name' => $recipeData['name']],
                array_merge($recipeData, [
                    'instructions' => $instructions,
                    'metadata' => array_merge(
                        $existingRecipe->metadata ?? [],
                        [
                            'image_url' => $image,
                            'cooking_time' => $this->estimateCookingTime($recipeData['name']),
                            'difficulty' => $this->estimateDifficulty($recipeData['name'])
                        ]
                    )
                ])
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

    private function generateInstructions(string $recipeName, array $ingredients): string
    {
        $name = strtolower($recipeName);
        
        // Asian cuisine instructions
        if (str_contains($name, 'pad thai') || str_contains($name, 'pho') || str_contains($name, 'ramen')) {
            return "1. Prepare noodles according to package instructions.\n2. Heat oil in a wok or large pan over high heat.\n3. Add aromatics (garlic, ginger) and stir-fry for 30 seconds.\n4. Add protein and vegetables, stir-fry for 3-5 minutes.\n5. Add sauce ingredients and noodles, toss to combine.\n6. Garnish with fresh herbs and serve immediately.";
        }
        
        if (str_contains($name, 'sushi') || str_contains($name, 'spring rolls')) {
            return "1. Prepare all ingredients by cutting into thin strips.\n2. Lay out wrapper or nori sheet.\n3. Add fillings in a neat line.\n4. Roll tightly, sealing edges with water.\n5. Cut into serving pieces.\n6. Serve with dipping sauce and garnish.";
        }
        
        if (str_contains($name, 'curry') || str_contains($name, 'tikka masala') || str_contains($name, 'biryani')) {
            return "1. Marinate protein in yogurt and spices for at least 30 minutes.\n2. Heat oil in a large pot and sauté onions until golden.\n3. Add ginger, garlic, and spices, cook for 1 minute.\n4. Add marinated protein and cook until done.\n5. Add sauce ingredients and simmer for 15-20 minutes.\n6. Garnish with fresh herbs and serve with rice or bread.";
        }
        
        // Italian cuisine instructions
        if (str_contains($name, 'pasta')) {
            return "1. Cook pasta according to package directions until al dente.\n2. In a large pan, heat olive oil and sauté garlic until fragrant.\n3. Add remaining ingredients and cook for 5-7 minutes.\n4. Drain pasta and add to the pan with sauce.\n5. Toss everything together and season with salt and pepper.\n6. Serve hot and enjoy!";
        }
        
        if (str_contains($name, 'pizza')) {
            return "1. Preheat oven to 475°F (245°C).\n2. Roll out pizza dough to desired thickness.\n3. Spread tomato sauce evenly over the dough.\n4. Add cheese and toppings.\n5. Bake for 12-15 minutes until crust is golden.\n6. Let cool for 2 minutes before slicing and serving.";
        }
        
        if (str_contains($name, 'risotto') || str_contains($name, 'gnocchi')) {
            return "1. Heat broth in a separate pot and keep warm.\n2. In a large pan, sauté aromatics until soft.\n3. Add rice and toast for 2 minutes.\n4. Add wine and cook until absorbed.\n5. Add broth one ladle at a time, stirring constantly.\n6. Finish with butter and cheese, serve immediately.";
        }
        
        // Mexican cuisine instructions
        if (str_contains($name, 'taco') || str_contains($name, 'fajita') || str_contains($name, 'quesadilla') || str_contains($name, 'burrito')) {
            return "1. Season meat with Mexican spices and marinate if time allows.\n2. Heat oil in a large pan over high heat.\n3. Cook meat until browned and cooked through.\n4. Warm tortillas according to package directions.\n5. Assemble with desired fillings and toppings.\n6. Serve with salsa, guacamole, and lime wedges.";
        }
        
        if (str_contains($name, 'enchilada')) {
            return "1. Preheat oven to 375°F (190°C).\n2. Cook filling ingredients and season well.\n3. Fill tortillas with mixture and roll up.\n4. Place in baking dish, seam side down.\n5. Cover with sauce and cheese.\n6. Bake for 20-25 minutes until bubbly and golden.";
        }
        
        // French cuisine instructions
        if (str_contains($name, 'creme') || str_contains($name, 'souffle') || str_contains($name, 'quiche')) {
            return "1. Preheat oven to specified temperature.\n2. Prepare custard base with eggs and cream.\n3. Add flavorings and mix until smooth.\n4. Pour into prepared dish or ramekins.\n5. Bake until set and golden.\n6. Cool slightly before serving.";
        }
        
        if (str_contains($name, 'croissant') || str_contains($name, 'tart')) {
            return "1. Prepare dough according to recipe.\n2. Roll and fold as specified.\n3. Shape into final form.\n4. Proof if required.\n5. Bake at specified temperature until golden.\n6. Cool before serving.";
        }
        
        // Middle Eastern cuisine instructions
        if (str_contains($name, 'falafel') || str_contains($name, 'hummus') || str_contains($name, 'shawarma')) {
            return "1. Prepare ingredients and season with Middle Eastern spices.\n2. Process or mix according to recipe.\n3. Shape or prepare as required.\n4. Cook using appropriate method (fry, grill, or bake).\n5. Prepare serving platter with accompaniments.\n6. Serve with pita bread and sauces.";
        }
        
        // Breakfast items
        if (str_contains($name, 'omelette') || str_contains($name, 'egg')) {
            return "1. Crack eggs into a bowl and whisk with salt and pepper.\n2. Heat butter in a non-stick pan over medium heat.\n3. Pour in eggs and cook until edges begin to set.\n4. Add fillings to one half of the omelette.\n5. Fold the other half over and cook for 1-2 more minutes.\n6. Slide onto a plate and serve immediately.";
        }
        
        if (str_contains($name, 'pancake') || str_contains($name, 'waffle') || str_contains($name, 'french toast')) {
            return "1. Mix dry ingredients in a large bowl.\n2. Whisk wet ingredients separately.\n3. Combine wet and dry ingredients until just mixed.\n4. Cook on griddle or waffle iron until golden.\n5. Serve hot with desired toppings.\n6. Enjoy immediately while warm.";
        }
        
        // Salads
        if (str_contains($name, 'salad')) {
            return "1. Wash and prepare all vegetables.\n2. Chop vegetables into bite-sized pieces.\n3. In a large bowl, combine all vegetables.\n4. Drizzle with olive oil and season with salt and pepper.\n5. Toss everything together well.\n6. Serve fresh and enjoy!";
        }
        
        // Soups
        if (str_contains($name, 'soup') || str_contains($name, 'chowder') || str_contains($name, 'bisque')) {
            return "1. Heat olive oil in a large pot over medium heat.\n2. Sauté onions and garlic until soft.\n3. Add remaining vegetables and cook for 5 minutes.\n4. Add broth or water and bring to a boil.\n5. Reduce heat and simmer for 15-20 minutes.\n6. Season with salt and pepper and serve hot.";
        }
        
        // Stir fry dishes
        if (str_contains($name, 'stir fry') || str_contains($name, 'chow mein') || str_contains($name, 'lo mein')) {
            return "1. Heat oil in a large wok or pan over high heat.\n2. Add garlic and stir-fry for 30 seconds.\n3. Add vegetables and stir-fry for 3-5 minutes.\n4. Add sauce ingredients and toss to combine.\n5. Cook for 2 more minutes until sauce thickens.\n6. Serve immediately over rice if desired.";
        }
        
        // Burgers and sandwiches
        if (str_contains($name, 'burger')) {
            return "1. Form ground beef into patties and season with salt and pepper.\n2. Heat a grill or pan over medium-high heat.\n3. Cook patties for 3-4 minutes per side.\n4. Add cheese in the last minute of cooking.\n5. Toast buns lightly.\n6. Assemble burgers with desired toppings and serve.";
        }
        
        // Smoothies and drinks
        if (str_contains($name, 'smoothie')) {
            return "1. Peel banana and add to blender.\n2. Add milk and honey to the blender.\n3. Add vanilla extract if using.\n4. Blend on high speed for 30-60 seconds until smooth.\n5. Add ice if desired and blend for another 10 seconds.\n6. Pour into a glass and serve immediately.";
        }
        
        // Desserts
        if (str_contains($name, 'cookies') || str_contains($name, 'cookie')) {
            return "1. Preheat oven to 375°F (190°C).\n2. Cream together butter and sugar until fluffy.\n3. Beat in eggs and vanilla extract.\n4. Mix in flour, chocolate chips, and salt.\n5. Drop spoonfuls onto baking sheet.\n6. Bake for 10-12 minutes until golden brown.";
        }
        
        if (str_contains($name, 'cake') || str_contains($name, 'cheesecake') || str_contains($name, 'pie')) {
            return "1. Preheat oven to specified temperature.\n2. Prepare crust or base as required.\n3. Mix filling ingredients until smooth.\n4. Pour into prepared pan.\n5. Bake until set and golden.\n6. Cool completely before serving.";
        }
        
        if (str_contains($name, 'ice cream')) {
            return "1. Heat cream and milk until warm.\n2. Whisk egg yolks and sugar until light.\n3. Temper eggs with warm milk mixture.\n4. Cook until thickened, then strain.\n5. Add vanilla and cool completely.\n6. Churn in ice cream maker according to instructions.";
        }
        
        // Roasted and baked dishes
        if (str_contains($name, 'roast') || str_contains($name, 'baked') || str_contains($name, 'wellington')) {
            return "1. Preheat oven to specified temperature.\n2. Season meat generously with salt and pepper.\n3. Sear on all sides in hot pan.\n4. Add aromatics and herbs.\n5. Roast until internal temperature is reached.\n6. Rest for 10-15 minutes before slicing.";
        }
        
        // Stews and casseroles
        if (str_contains($name, 'stew') || str_contains($name, 'chili') || str_contains($name, 'casserole')) {
            return "1. Heat oil in a large pot over medium heat.\n2. Brown meat in batches, remove and set aside.\n3. Sauté vegetables until soft.\n4. Return meat to pot and add liquids.\n5. Simmer for 1-2 hours until tender.\n6. Season and serve hot with accompaniments.";
        }
        
        // Default instructions
        return "1. Prepare all ingredients by washing and chopping as needed.\n2. Heat oil in a pan over medium heat.\n3. Cook ingredients according to recipe requirements.\n4. Season with salt and pepper to taste.\n5. Cook until everything is heated through and well combined.\n6. Serve hot and enjoy your meal!";
    }

    private function estimateCookingTime(string $recipeName): int
    {
        $name = strtolower($recipeName);
        
        if (str_contains($name, 'salad') || str_contains($name, 'sandwich')) {
            return 15;
        }
        if (str_contains($name, 'omelette') || str_contains($name, 'egg')) {
            return 10;
        }
        if (str_contains($name, 'pasta') || str_contains($name, 'noodles')) {
            return 25;
        }
        if (str_contains($name, 'soup') || str_contains($name, 'stew')) {
            return 30;
        }
        if (str_contains($name, 'pizza')) {
            return 20;
        }
        if (str_contains($name, 'roast') || str_contains($name, 'baked')) {
            return 45;
        }
        if (str_contains($name, 'stir fry')) {
            return 15;
        }
        if (str_contains($name, 'smoothie')) {
            return 5;
        }
        
        return 25; // Default cooking time
    }

    private function estimateDifficulty(string $recipeName): string
    {
        $name = strtolower($recipeName);
        
        if (str_contains($name, 'salad') || str_contains($name, 'sandwich') || str_contains($name, 'toast')) {
            return 'Easy';
        }
        if (str_contains($name, 'omelette') || str_contains($name, 'pasta') || str_contains($name, 'soup') || str_contains($name, 'smoothie')) {
            return 'Easy';
        }
        if (str_contains($name, 'stir fry') || str_contains($name, 'burger') || str_contains($name, 'pizza')) {
            return 'Medium';
        }
        if (str_contains($name, 'roast') || str_contains($name, 'baked') || str_contains($name, 'curry')) {
            return 'Medium';
        }
        if (str_contains($name, 'pie') || str_contains($name, 'cake') || str_contains($name, 'cookies')) {
            return 'Hard';
        }
        
        return 'Medium'; // Default difficulty
    }
}
