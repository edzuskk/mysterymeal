<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinigameController extends Controller
{
    /**
     * Get minigame configuration and food/foreign items
     */
    public function getGameData()
    {
        $foodItems = [
            ['id' => 1, 'name' => 'Apple', 'emoji' => '🍎', 'type' => 'food'],
            ['id' => 2, 'name' => 'Banana', 'emoji' => '🍌', 'type' => 'food'],
            ['id' => 3, 'name' => 'Orange', 'emoji' => '🍊', 'type' => 'food'],
            ['id' => 4, 'name' => 'Strawberry', 'emoji' => '🍓', 'type' => 'food'],
            ['id' => 5, 'name' => 'Bread', 'emoji' => '🍞', 'type' => 'food'],
            ['id' => 6, 'name' => 'Cheese', 'emoji' => '🧀', 'type' => 'food'],
            ['id' => 7, 'name' => 'Carrot', 'emoji' => '🥕', 'type' => 'food'],
            ['id' => 8, 'name' => 'Tomato', 'emoji' => '🍅', 'type' => 'food'],
            ['id' => 9, 'name' => 'Pizza', 'emoji' => '🍕', 'type' => 'food'],
            ['id' => 10, 'name' => 'Hamburger', 'emoji' => '🍔', 'type' => 'food'],
            ['id' => 11, 'name' => 'Taco', 'emoji' => '🌮', 'type' => 'food'],
            ['id' => 12, 'name' => 'Sushi', 'emoji' => '🍣', 'type' => 'food'],
        ];

        $foreignItems = [
            ['id' => 101, 'name' => 'Rock', 'emoji' => '🪨', 'type' => 'foreign'],
            ['id' => 102, 'name' => 'Bomb', 'emoji' => '💣', 'type' => 'foreign'],
            ['id' => 103, 'name' => 'Trash', 'emoji' => '🗑️', 'type' => 'foreign'],
            ['id' => 104, 'name' => 'Poison', 'emoji' => '☠️', 'type' => 'foreign'],
            ['id' => 105, 'name' => 'Sugar', 'emoji' => '🍬', 'type' => 'foreign'],
            ['id' => 106, 'name' => 'Fire', 'emoji' => '🔥', 'type' => 'foreign'],
        ];

        return response()->json([
            'success' => true,
            'foodItems' => $foodItems,
            'foreignItems' => $foreignItems,
            'gameConfig' => [
                'gameSpeed' => 2000, // milliseconds between spawning items
                'itemSize' => 50, // pixels
                'gravity' => 5, // pixels per frame
            ]
        ]);
    }

    /**
     * Save game score
     */
    public function saveScore(Request $request)
    {
        $score = $request->input('score');
        $itemsCaught = $request->input('items_caught', 0);

        // TODO: Save to database if needed
        
        return response()->json([
            'success' => true,
            'message' => 'Score saved',
            'score' => $score,
            'items_caught' => $itemsCaught,
        ]);
    }
}
