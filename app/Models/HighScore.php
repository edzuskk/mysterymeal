<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'score',
        'items_caught',
        'survival_time',
        'level',
        'played_at',
    ];

    protected $casts = [
        'score' => 'integer',
        'items_caught' => 'integer',
        'survival_time' => 'integer',
        'level' => 'integer',
        'played_at' => 'datetime',
    ];

    /**
     * Get top scores
     */
    public static function getTopScores(int $limit = 10)
    {
        return self::orderBy('score', 'desc')
            ->orderBy('items_caught', 'desc')
            ->orderBy('survival_time', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get top scores for current session
     */
    public static function getSessionScores(string $sessionId, int $limit = 5)
    {
        return self::where('session_id', $sessionId)
            ->orderBy('score', 'desc')
            ->orderBy('items_caught', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get personal best score
     */
    public static function getPersonalBest(string $sessionId)
    {
        return self::where('session_id', $sessionId)
            ->orderBy('score', 'desc')
            ->orderBy('items_caught', 'desc')
            ->first();
    }
}
