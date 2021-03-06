<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductToCategory;
use App\ProductToImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'codigo'            => ['required'],
            'product_name'      => ['required', 'string'],
            'short_description' => ['required', 'string'],
            'family'            => ['required'],
            'type_sale'         => ['required'],
            'price'             => ['required'],
            'brand'             => ['required'],
            'width'             => ['required'],
            'height'            => ['required'],
            'diameter'          => ['required'],
            'weight'            => ['required'],
            'mainCategories'    => ['required'],
            'mainImages'        => ['required'],
        ]);

        $product = Product::create([
            'codigo' => $request->codigo,
            'product_name' => $request->product_name,
            'short_description' => $request->short_description,
            'colors' => $request->colors,
            'family' => $request->family['id'],
            'type_sale' => $request->type_sale,
            'price' => str_replace(',','.',$request->price),
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
    public function update(Request $request)
    {
        $product = Product::find($request->id_product);

        $request->validate([
            'codigo'            => ['required'],
            'product_name'      => ['required', 'string'],
            'short_description' => ['required', 'string'],
            'family'            => ['required'],
            'type_sale'         => ['required'],
            'price'             => ['required'],
            'brand'             => ['required'],
            'width'             => ['required'],
            'height'            => ['required'],
            'diameter'          => ['required'],
            'weight'            => ['required'],
            'mainCategories'    => ['required'],
            'mainImages'        => ['required'],
        ]);

        $product->update([
            'codigo' => $request->codigo,
            'product_name' => $request->product_name,
            'short_description' => $request->short_description,
            'colors' => $request->colors,
            'family' => $request->family['id'],
            'type_sale' => $request->type_sale,
            'price' => str_replace(',','.',$request->price),
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
            ProductToCategory::where('product_id', $request->id_product)->delete();
            ProductToImage::where('product_id', $request->id_product)->delete();

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product_to_categorie = ProductToCategory::where('product_id',$id);
        $product_to_image = ProductToImage::where('product_id',$id);

        $product->delete();
        $product_to_categorie->delete();
        $product_to_image->delete();

        return response()->json(['status', 200],200);
    }
}
