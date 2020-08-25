<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use App\Brand;
use App\Family;

class TagsController extends Controller
{
    // Catalogo de cores
    public function colorIndex()
    {
        return response()->json(['colorPage' => Color::paginate(10), 'colorTotal' => Color::all()]);
    }

    public function colorStore(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'catalogs'    => ['required'],
        ]);

        $colors = Color::create([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
            'catalog' => $request->catalogs
        ]);

        return response()->json(['status' => 'ok'],200);
    }

    public function colorDestroy($id)
    {
        $catalog = Color::find($id);

        $catalog->delete();

        return response()->json(['status' => 'ok'], 200);
    }

    public function colorUpdate(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'catalogs'    => ['required'],
        ]);

        $colors = Color::find($request->id);

        $colors->update([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
            'catalog' => $request->catalogs
        ]);

        return response()->json(['status' => 'ok'],200);
    }

    // Marcas dos produtos
    public function brandIndex()
    {
        return response()->json(['brandPage' => Brand::paginate(10), 'brandTotal' => Brand::all()]);
    }

    public function brandStore(Request $request)
    {
        $brand = Brand::create([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
        ]);

        return response()->json(['status' => 200],200);
    }

    public function brandDestroy($id)
    {
        $brand = Brand::find($id);

        $brand->delete();

        return response()->json(['status' => 200], 200);
    }

    public function brandUpdate(Request $request)
    {
        $brands = Brand::find($request->id);

        $brands->update([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
        ]);

        return response()->json(['status' => 200],200);
    }

    // Familia dos produtos
    public function familyIndex()
    {
        return response()->json(['familyPage' => Family::paginate(10), 'familyTotal' => Family::all()]);
    }

    public function familyStore(Request $request)
    {
        $family = Family::create([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
        ]);

        return response()->json(['status' => 200],200);
    }

    public function familyDestroy($id)
    {
        $family = Family::find($id);

        $family->delete();

        return response()->json(['status' => 200], 200);
    }

    public function familyUpdate(Request $request)
    {
        $family = Family::find($request->id);

        $family->update([
            'name' => mb_convert_case($request->name, MB_CASE_TITLE),
        ]);

        return response()->json(['status' => 200],200);
    }
}