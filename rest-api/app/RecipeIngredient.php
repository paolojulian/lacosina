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
        'measurement',
        'optional_name',
        'description',
        'image'
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo('App\Recipe');
    }
}
