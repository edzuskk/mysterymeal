<?php

namespace App\Http\Controllers;

use App\Models\HighScore;
use Illuminate\Http\Request;

class MinigameController extends Controller
{
    /**
     * Get minigame configuration and food/foreign items
     */
    public function getGameData(Request $request)
    {
        $sessionId = $request->session()->getId();
        
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
            ['id' => 107, 'name' => 'Donut', 'emoji' => '🍩', 'type' => 'foreign'],
            ['id' => 108, 'name' => 'Candy', 'emoji' => '🍭', 'type' => 'foreign'],
            ['id' => 109, 'name' => 'Soda', 'emoji' => '🥤', 'type' => 'foreign'],
            ['id' => 110, 'name' => 'Chips', 'emoji' => '🥔', 'type' => 'foreign'],
            ['id' => 111, 'name' => 'Chocolate Bar', 'emoji' => '🍫', 'type' => 'foreign'],
            ['id' => 112, 'name' => 'Ice Cream', 'emoji' => '🍦', 'type' => 'foreign'],
        ];

        // Get high scores
        $topScores = HighScore::getTopScores(10);
        $sessionScores = HighScore::getSessionScores($sessionId, 5);
        $personalBest = HighScore::getPersonalBest($sessionId);

        return response()->json([
            'success' => true,
            'foodItems' => $foodItems,
            'foreignItems' => $foreignItems,
            'gameConfig' => [
                'gameSpeed' => 200, // milliseconds between spawning items (extremely fast)
                'itemSize' => 50, // pixels
                'gravity' => 25, // pixels per frame (extremely fast falling)
                'spawnRate' => 1.0, // initial spawn rate (maximum frequency)
                'speedIncrease' => 0.2, // how quickly speed increases (maximum acceleration)
            ],
            'highScores' => [
                'top' => $topScores,
                'session' => $sessionScores,
                'personalBest' => $personalBest,
            ]
        ]);
    }

    /**
     * Save game score
     */
    public function saveScore(Request $request)
    {
        $score = $request->input('score', 0);
        $itemsCaught = $request->input('items_caught', 0);
        $survivalTime = $request->input('survival_time', 0); // in seconds
        $level = $request->input('level', 1);
        
        $sessionId = $request->session()->getId();

        // Save to database
        $highScore = HighScore::create([
            'session_id' => $sessionId,
            'score' => $score,
            'items_caught' => $itemsCaught,
            'survival_time' => $survivalTime,
            'level' => $level,
        ]);

        // Get updated high scores
        $topScores = HighScore::getTopScores(10);
        $sessionScores = HighScore::getSessionScores($sessionId, 5);
        $personalBest = HighScore::getPersonalBest($sessionId);
        
        return response()->json([
            'success' => true,
            'message' => 'Score saved successfully!',
            'score' => $highScore,
            'highScores' => [
                'top' => $topScores,
                'session' => $sessionScores,
                'personalBest' => $personalBest,
            ],
            'isPersonalBest' => $personalBest && $personalBest->id === $highScore->id,
        ]);
    }

    /**
     * Get high scores leaderboard
     */
    public function getHighScores(Request $request)
    {
        $limit = $request->input('limit', 10);
        $sessionId = $request->session()->getId();

        $topScores = HighScore::getTopScores($limit);
        $sessionScores = HighScore::getSessionScores($sessionId, 5);
        $personalBest = HighScore::getPersonalBest($sessionId);

        return response()->json([
            'success' => true,
            'highScores' => [
                'top' => $topScores,
                'session' => $sessionScores,
                'personalBest' => $personalBest,
            ]
        ]);
    }
}
