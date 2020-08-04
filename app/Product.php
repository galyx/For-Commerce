<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'codigo', 'product_name', 'short_description', 'group', 'type_sale', 'price', 'brand', 'width', 'height', 'diameter', 'weight', 'free_shipping', 'description', 'status',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('product_name')
            ->saveSlugsTo('slug');
    }
}
