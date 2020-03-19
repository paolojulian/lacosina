<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    /**
     * @Override
     * @inheritDoc
     */
    public $fillable = [
        'name',
        'description',
        'image',
        'duration_from_minute',
        'duration_to_minute'
    ];

    public function ingredients(): HasMany
    {
        return $this->hasMany('App\RecipeIngredient');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany('App\RecipeProcedure');
    }
}
