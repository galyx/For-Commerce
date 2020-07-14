<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    // Administradores
    public function index()
    {
        return response()->json(['auth' => auth()->guard('admin')->user(), 'adminPage' => Admin::paginate(10), 'adminTotal' => Admin::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['status' => 200]);
    }
   
    public function destroy($id)
    {
        $admin = Admin::find($id);

        $admin->delete();

        return response()->json(['status' => 200]);
    }

    public function password(Request $request)
    {
        $admin = Admin::find($request->id);
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
        ]);

        $admin->update(['password' => Hash::make($request->password)]);

        return response()->json(['status' => 200]);
    }

    public function update(Request $request)
    {
        $admin = Admin::find($request->id);

        if($admin->email == $request->email){
            $request->validate([
                'name'  => ['required', 'string', 'max:255'],
            ]);

            $admin->update([
                'name'   => $request->name,
                'status' => $request->status,
            ]);
        }else{
            $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            ]);
    
            $admin->update([
                'name'   => $request->name,
                'email'  => $request->email,
                'status' => $request->status,
            ]);
        }

        return response()->json(['status' => 200]);
    }

    // Perfils do admin
    public function perfilUpdate(Request $request)
    {
        $admin = Admin::find($request->id);

        if($request->name){
            $admin->update([
                'name' => $request->name,
            ]);

            return response()->json(['status' => 200]);
        }

        if($request->email){
            if($admin->email !== $request->email){
                $request->validate([
                    'email'    => ['required', 'string', 'email', 'max:255', 'unique:admins'],
                ]);
            }

            $admin->update([
                'email' => $request->email,
            ]);

            return response()->json(['status' => 200]);
        }

        if($request->current_password){
            $current_password = Hash::check($request->current_password, $admin->password);
            if($current_password){
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                $admin->update([
                    'password' => Hash::make($request->password),
                ]);

                return response()->json(['status' => 200],200);
            }

            return response()->json(['status' => 500],200);
        }
    }

}