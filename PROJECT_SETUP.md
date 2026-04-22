# Mystery Meal 🍽️

A full-stack web application designed to reduce food waste by helping users find recipes based on available ingredients and enjoy an interactive minigame.

## Project Overview

Mystery Meal consists of two main features:

1. **Recipe Finder**: Users enter available products from their fridge, and the system suggests recipes that can be made with those ingredients.
2. **Raining Food Minigame**: An interactive game where players catch falling food items while avoiding foreign objects.

## Project Goals

- **Reduce Food Waste**: Help users utilize ingredients they already have at home
- **Quick Recipe Finding**: Get instant recipe recommendations within seconds
- **Entertainment**: Provide a fun minigame experience
- **Full-Stack Solution**: Complete web application with frontend UI, backend API, and minigame

## Technology Stack

- **Backend**: Laravel (PHP)
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Database**: MySQL
- **Game**: Canvas API (Vanilla JavaScript)

## Project Structure

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── RecipeController.php      # Recipe finder logic
│   │       └── MinigameController.php    # Minigame API endpoints
│   └── Models/
│       ├── Recipe.php                    # Recipe model
│       ├── Product.php                   # Product model
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── ..._create_products_table.php
│   │   ├── ..._create_recipes_table.php
│   │   └── ..._create_recipe_product_table.php
│   └── seeders/
│       ├── ProductSeeder.php             # Sample products data
│       ├── RecipeSeeder.php              # Sample recipes data
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── welcome.blade.php             # Home page
│       ├── recipes/
│       │   └── finder.blade.php          # Recipe finder page
│       └── minigame/
│           └── play.blade.php            # Minigame page
├── routes/
│   └── web.php                           # Web routes and API endpoints
```

## Database Schema

### Products Table
- `id`: Primary key
- `name`: Product name (unique)
- `slug`: URL-friendly name
- `description`: Product description
- `category`: Category (dairy, protein, vegetable, fruit, etc.)

### Recipes Table
- `id`: Primary key
- `name`: Recipe name
- `external_id`: For API integration (nullable)
- `description`: Recipe description
- `instructions`: Cooking instructions
- `metadata`: JSON data for additional info

### Recipe-Product Junction Table
- `id`: Primary key
- `recipe_id`: Foreign key to recipes
- `product_id`: Foreign key to products
- `quantity`: Ingredient quantity (optional)
- `unit`: Measurement unit (optional)

## API Endpoints

### Recipe Endpoints

```
POST   /api/recipes/find       - Find recipes based on products
GET    /api/recipes             - Get all recipes (paginated)
GET    /api/recipes/{id}        - Get single recipe
```

### Minigame Endpoints

```
GET    /api/minigame/data       - Get game data (food items, foreign items, config)
POST   /api/minigame/score      - Save game score
```

### Web Routes

```
GET    /                        - Home page
GET    /recipes                 - Recipe finder page
GET    /minigame                - Minigame page
```

## Setup Instructions

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL 8.0+

### Installation

1. **Clone/Navigate to the project**
```bash
cd c:\laragon\www\MysteryMeal
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies** (if needed)
```bash
npm install
```

4. **Create environment file**
```bash
copy .env.example .env
```

5. **Generate application key**
```bash
php artisan key:generate
```

6. **Configure database** in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mystery_meal
DB_USERNAME=root
DB_PASSWORD=
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed the database** with sample data
```bash
php artisan db:seed
```

9. **Start the development server**
```bash
php artisan serve
```

10. **Open in browser**
```
http://localhost:8000
```

## Features

### Recipe Finder
- Enter multiple ingredients
- Search for matching recipes
- View recipe match percentages
- See required ingredients for each recipe
- Remove products easily

### Raining Food Minigame
- **Objective**: Catch falling food items only
- **Avoid**: Foreign objects (rocks, bombs, trash, poison, etc.)
- **Gameplay**: 
  - Click on items to catch them
  - Score increases for each food item caught (+10 points)
  - Game ends if you catch one foreign object
  - Continuous spawning of items
  - Lives system (3 lives)

## Game Configuration

Food items include: Apple, Banana, Orange, Strawberry, Bread, Cheese, Carrot, Tomato, Pizza, Hamburger, Taco, Sushi

Foreign objects include: Rock, Bomb, Trash, Poison, Sugar, Fire

## Sample Products

The seeder includes 26 sample products across categories:
- Dairy: Milk, Cheese, Butter
- Protein: Eggs, Chicken, Beef, Salmon
- Grains: Pasta, Rice, Bread
- Vegetables: Tomato, Onion, Garlic, Carrot, Broccoli, Lettuce, Bell Pepper, Spinach
- Fruits: Apple, Banana, Lemon
- Oils & Seasonings: Olive Oil, Salt, Pepper
- Herbs: Basil, Thyme

## Sample Recipes

The seeder includes 8 sample recipes:
1. Classic Spaghetti Carbonara
2. Grilled Chicken Salad
3. Tomato Pasta
4. Vegetable Stir Fry
5. Chicken Fried Rice
6. Simple Egg Omelette
7. Beef Tacos
8. Lemon Garlic Salmon

## Future Enhancements

- Integration with real recipe APIs (Spoonacular, Food2Fork, etc.)
- User authentication and recipe favorites
- Score leaderboard for minigame
- Mobile app version
- Recipe ratings and reviews
- Dietary preference filters
- Cooking time and difficulty level
- Video tutorials for recipes
- Social sharing features

## Testing Recipe Finder

1. Go to `http://localhost:8000/recipes`
2. Enter ingredients (e.g., "Chicken", "Tomato", "Olive Oil")
3. Click "Find Recipes"
4. View matching recipes with match percentages

## Testing Minigame

1. Go to `http://localhost:8000/minigame`
2. Click on falling items
3. Catch only food items (green items)
4. Avoid foreign objects (red items)
5. See your final score

## Troubleshooting

### Database connection error
- Check MySQL is running
- Verify DB credentials in `.env`
- Run `php artisan migrate:reset` to reset database

### Port already in use
- Change port: `php artisan serve --port=8001`

### CSS/JS not loading
- Run `npm run dev` for development
- Clear browser cache

## Contributing

Feel free to fork and contribute improvements to the project!

## License

This project is open source and available under the MIT License.

---

Made with ❤️ to reduce food waste and promote sustainable eating!
