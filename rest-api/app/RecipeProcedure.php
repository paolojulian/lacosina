<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeProcedure extends Model
{
    /**
     * @Override
     * @inheritDoc
     */
    public $fillable = [
        'description',
        'duration_from_minute',
        'duration_to_minute',
        'image',
        'optional_name',
        'procedure_id',
        'recipe_id',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo('App\Recipe');
    }
}
