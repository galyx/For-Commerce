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
                'id' => $image->id,
                'image_name' => $image->image_name,
                'path' => asset('storage/'.$image->path),
                'wxh' => getimagesize(asset('storage/'.$image->path)),
                'size' => ImagensController::bytesToHuman(Storage::disk('public')->size($image->path)),
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

    public function destroy($id)
    {
        $image = Image::find($id);

        Storage::disk('public')->delete($image->path);

        $image->delete();

        return response()->json(['status' => 200], 200);
    }

    // Função bytes
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
