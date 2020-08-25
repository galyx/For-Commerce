<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $casts = [
        'catalog' => 'array',
    ];

    protected $fillable = [
        'name', 'catalog',
    ];
}
