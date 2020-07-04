<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'categorie_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Categorie::class)->with('categories');
    }
}
