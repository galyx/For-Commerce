<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagensController extends Controller
{
    public function index()
    {
        $images = [];
        foreach(Image::all() as $image){
            $images[] = [
                'image_name' => $image->image_name,
                'path' => asset('storage/'.$image->path),
                'wxh' => getimagesize(asset('storage/'.$image->path)),
                'size' => Storage::disk('public')->size($image->path),
                'extension' => pathinfo($image->path, PATHINFO_EXTENSION),
            ];
        }

        return response()->json($images);
    }

    public function store(Request $request)
    {
        $image = $request->file('file')->store('BIMG', 'public');

        Image::create([
            'image_name' => pathinfo($request->filename, PATHINFO_FILENAME),
            'path' => $image,
        ]);

        return response()->json(200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        // return response()->json(dd($request->all()));
    }
}
