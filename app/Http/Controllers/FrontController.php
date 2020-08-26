<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function products()
    {
        $products = $this->product->with(['categories', 'images'])->get()->random(6);
        return response()->json($products);
    }
    public function products2()
    {
        $products = $this->product->with(['categories', 'images'])->get()->random(2);
        return response()->json($products);
    }
}
