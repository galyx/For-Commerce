<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToImage extends Model
{
    protected $fillable = [
        'image_id',
        'product_id',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
