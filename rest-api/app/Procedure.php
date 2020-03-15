<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    /**
     * @Override
     * @inheritDoc
     */
    public $fillable = [
        'name',
        'description',
        'duration_from_minute',
        'duration_to_minute',
    ];
}
