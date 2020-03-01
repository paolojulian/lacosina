<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @Override
     * @inheritDoc
     */
    public $timestamps = true;
}
