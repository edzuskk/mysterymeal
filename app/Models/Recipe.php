<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = ['name', 'external_id', 'description', 'instructions', 'metadata'];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recipe_product')
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}
