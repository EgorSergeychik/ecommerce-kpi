<?php

namespace Domain\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'translations',
        'slug',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'translations' => 'array',
            'price' => 'float',
        ];
    }
}
