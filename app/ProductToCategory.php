<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model
{
  protected $fillable = [

    'category_id',
    'product_id',

  ];
  
}
