<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeIngredient extends Model
{
    /**
     * @Override
     * @inheritDoc
     */
    public $fillable = [
        'description',
        'image',
        'ingredient_id',
        'measurement',
        'optional_name',
        'recipe_id',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo('App\Recipe');
    }
}
