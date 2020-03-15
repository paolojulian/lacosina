<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * @Override
     * @inheritDoc
     */
    public $fillable = [
        'name',
        'description',
        'category'
    ];
}
