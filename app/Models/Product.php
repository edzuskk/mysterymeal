<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /** @use HasFactory */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'category'];

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_product')
            ->withPivot('quantity', 'unit')
            ->withTimestamps();
    }
}
