<?php

namespace App;

use App\Image;
use App\Categorie;
use App\ProductToImage;
use App\ProductToCategory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'codigo', 'product_name', 'short_description', 'colors', 'family', 'type_sale', 'price', 'brand', 'width', 'height', 'diameter', 'weight', 'free_shipping', 'description', 'status',
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

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, ProductToCategory::class, 'product_id', 'categorie_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, ProductToImage::class, 'product_id', 'image_id');
    }
}
