<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;

class CategorieController extends Controller
{
    public function index($categorie_id = null)
    {
        if($categorie_id){
            return response()->json(['categories' => Categorie::where('categorie_id', $categorie_id)->with('childrenCategories')->get(), 'categorie' => Categorie::where('id', $categorie_id)->with('childrenCategories')->get()]);
        }else{
            return response()->json(['categories' => Categorie::whereNull('categorie_id')->with('childrenCategories')->get()]);
            // return response()->json(Categorie::whereNull('categorie_id')->with('childrenCategories')->get());
        }
    }

    public function store(Request $request)
    {
        if($request->categorie_id){
            if(Categorie::where('categorie_id', $request->categorie_id)->get()->count() < 10){
                Categorie::create(['name' => $request->categorie, 'categorie_id' => $request->categorie_id]);
    
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['status' => 201]);
            }
        }else{
            if(Categorie::whereNull('categorie_id')->get()->count() < 10){
                Categorie::create(['name' => $request->categorie]);
    
                return response()->json(['status' => 200]);
            }else{
                return response()->json(['status' => 201]);
            }
        }
    }

    public function update(Request $request)
    {
        $categorie = Categorie::find($request->id);

        $categorie->update(['name' => $request->categorie]);

        return response()->json(['status' => 200]);
    }

    public function destroy($id)
    {
        $categories = explode(",",$id);

        if(is_array($categories)){
            foreach($categories as $ids){
                $categorie = Categorie::find($ids);

                $categorie->delete();
            }
                
        }else{
            $categorie = Categorie::find($id);

            $categorie->delete();
    
            return response()->json(['status' => 200]);
        }
    }
}
