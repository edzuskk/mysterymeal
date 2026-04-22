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
Route::get('/api/recipes/{id}', [RecipeController::class, 'show']);

// Minigame endpoints
Route::get('/api/minigame/data', [MinigameController::class, 'getGameData']);
Route::post('/api/minigame/score', [MinigameController::class, 'saveScore']);

// Views
Route::get('/recipes', function () {
    return view('recipes.finder');
})->name('recipes');

Route::get('/minigame', function () {
    return view('minigame.play');
})->name('minigame');
