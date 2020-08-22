<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductToCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id = null)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $save = Product::create([
            'codigo' => $request->codigo,
            'product_name' => $request->product_name,
            'short_description' => $request->short_description,
            'colors' => $request->colors,
            'group' => $request->group,
            'type_sale' => $request->type_sale,
            'price' => $request->price,
            'width' => $request->width,
            'height' => $request->height,
            'diameter' => $request->diameter,
            'weight' => $request->weight,
            'free_shipping' => $request->free_shipping,
            'description' => $request->description,
            'status' => $request->status,
            'mainCategories' => $request->mainCategories,
            'weight' => $request->weight,
            'categories' => $request->categories,
            'images' => $request->images,
            'disabled' => $request->disabled,
             
        ]);

        // $categories = ProductToCategory::create([
        //     'categorie_id' => $request->categorie_id,
        //     'product_id' => $save->id,
        // ]);

        return $save;
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
