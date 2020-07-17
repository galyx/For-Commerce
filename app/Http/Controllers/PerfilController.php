<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    // Perfil
    // Visualizar
    public function showPerfil()
    {
        return view('site.perfil.showPerfil');
    }

    public function showPerfilReset()
    {
        return view('site.perfil.showPerfilReset');
    }

    // Salvar Alterações
    public function editPerfil(Request $request)
    {
        if(auth()->user()->email == $request->email){
            $request->validate([
                'name'  => 'required',
                'email' => 'required',
                'cpf'   => 'required|cpf',
                'birth' => 'required',
                'cel'   => 'required',
            ]);
        }else{
            $request->validate([
                'name'  => 'required',
                'email' => 'required|unique:users',
                'cpf'   => 'required|cpf',
                'birth' => 'required',
                'cel'   => 'required',
            ]);
        }

        User::find(auth()->user()->id)->update([
            'name'  => $request->name,
            'email' => $request->email,
            'cpf'   => $request->cpf,
            'birth' => $request->birth,
            'fone'  => $request->fone,
            'cel'   => $request->cel,
        ]);

        return redirect('perfil')->with('success', 'Seus dados foram atualizados com successo!');
    }

    public function editPerfilReset(Request $request)
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            $auth = User::find(auth()->user()->id);
        
            return $auth && Hash::check($value, $auth->password);
        });

        $request->validate([
            'current_password' => ['required', 'string', 'min:8', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $auth = User::find(auth()->user()->id);

        $auth->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('perfil')->with('success', 'Senha alterada com sucesso!');
    }

    // Endereço
    // Visualizar
    public function showAddress($id = null)
    {
        $url = $id ? 'editAddress/'.$id : 'createAddress';
        $address = $id ? Address::find($id) : null;

        return view('site.perfil.showAddress', compact('id', 'url', 'address'));
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'cep'           => 'required',
            'uf'            => 'required',
            'cidade'        => 'required',
            'bairro'        => 'required',
            'rua'           => 'required',
            'numero'        => 'required',
        ]);

        Address::create([
            'user_id'       => auth()->user()->id,
            'cep'           => $request->cep,
            'uf'            => $request->uf,
            'cidade'        => $request->cidade,
            'bairro'        => $request->bairro,
            'rua'           => $request->rua,
            'numero'        => $request->numero,
            'complemento'   => $request->complemento,
        ]);

        return redirect('perfil')->with('success', 'Endereço Salvo!');
    }

    public function editAddress(Request $request, $id)
    {
        $address = Address::find($id);

        $request->validate([
            'cep'           => 'required',
            'uf'            => 'required',
            'cidade'        => 'required',
            'bairro'        => 'required',
            'rua'           => 'required',
            'numero'        => 'required',
        ]);

        $address->update([
            'cep'           => $request->cep,
            'uf'            => $request->uf,
            'cidade'        => $request->cidade,
            'bairro'        => $request->bairro,
            'rua'           => $request->rua,
            'numero'        => $request->numero,
            'complemento'   => $request->complemento,
        ]);

        return redirect('perfil')->with('success', 'Endereço Atualizado!');
    }

    public function destroyAddress($id)
    {
        $address = Address::find($id);

        $address->delete();

        return redirect('perfil')->with('destroy', 'Endereço Excluido!');
    }
}
