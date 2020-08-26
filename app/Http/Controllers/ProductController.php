<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductToCategory;
use App\ProductToImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
     
        $products = $this->product->with(['categories', 'images'])->paginate(5);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'codigo' => $request->codigo,
            'product_name' => $request->product_name,
            'short_description' => $request->short_description,
            'colors' => $request->colors,
            'family' => $request->family['id'],
            'type_sale' => $request->type_sale,
            'price' => $request->price,
            'brand' => $request->brand['id'],
            'width' => $request->width,
            'height' => $request->height,
            'diameter' => $request->diameter,
            'weight' => $request->weight,
            'free_shipping' => $request->free_shipping ? $request->free_shipping : 0,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if($product){
            foreach($request->mainCategories as $categories){
                ProductToCategory::create([
                    'categorie_id' => $categories['id'],
                    'product_id' => $product->id,
                ]);
            }

            foreach($request->mainImages as $images){
                ProductToImage::create([
                    'image_id' => $images['id'],
                    'product_id' => $product->id,
                ]);
            }
        }

        return response()->json(['status' => 200], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
