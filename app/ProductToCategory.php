<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model
{
  protected $fillable = [
    'categorie_id',
    'product_id',
  ];
  

  public function products()
  {
    return $this->belongsToMany(Product::class);
  }
}
