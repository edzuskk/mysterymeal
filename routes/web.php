<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MinigameController;

Route::get('/', function () {
    return view('welcome');
});

 // Recipe endpoints
Route::post('/api/recipes/find', [RecipeController::class, 'findRecipes']);
Route::get('/api/recipes', [RecipeController::class, 'index']);
Route::post('/api/recipes', [RecipeController::class, 'store']);
Route::get('/api/recipes/favorites', [RecipeController::class, 'favorites']);
Route::get('/api/recipes/{recipe}', [RecipeController::class, 'show']);
Route::post('/api/recipes/{recipe}/favorite', [RecipeController::class, 'toggleFavorite']);

// Minigame endpoints
Route::get('/api/minigame/data', [MinigameController::class, 'getGameData']);
Route::post('/api/minigame/score', [MinigameController::class, 'saveScore']);
Route::get('/api/minigame/highscores', [MinigameController::class, 'getHighScores']);

// Views
Route::get('/recipes', function () {
    return view('recipes.finder');
})->name('recipes');

Route::get('/minigame', function () {
    return view('minigame.play');
})->name('minigame');

Route::get('/recipe/{recipe}', [RecipeController::class, 'showPage'])->name('recipe.show');
