<?php

namespace App\Helpers;

use App\Categorie;

class HelperClass
{
    public static function categories()
    {
        return Categorie::whereNull('categorie_id')->with('childrenCategories')->get();
    }

    public static function categorie($response)
    {
        return Categorie::where($response)->first();
    }
}

// if(! function_exists('oi')){
//     function oi()
//     {
//         return 'oi';
//     }
// }