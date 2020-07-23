<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FaleConosco;
use App\Mails;
use App\Address;
use Canducci\Cep\Cep;

use HelperClass;

class SiteController extends Controller
{
    // Home
    public function index()
    {
        return view('site.index');
    }

    // Produtos
    public function produto($slug)
    {
        return view('site.produto');
    }

    // Categorias
    public function categoria($slug)
    {
        $categorie_show = HelperClass::categorie(['slug' => $slug]);

        return view('site.categoria', compact('categorie_show'));
    }

    // Pages
    public function sobre($page)
    {
        return view('site.sobrenos.'.$page);
    }

    public function contato($page)
    {
        return view('site.contato.'.$page);
    }
    // End

    // Perfil
    public function perfil()
    {
        $auth = auth()->user();
        if($auth->cpf == null & $auth->birth == null & $auth->cel == null){
            return redirect('perfil/showPerfil')->with('warning', 'Precisa completar seu dados para que possa acessar outras areas.');
        }

        $adresses = Address::where('user_id', $auth->id)->get();

        return view('site.perfil.perfil', compact('adresses'));
    }

    // Funções
    // Enviar email de contato pelo site
    public function faleConosco(Request $request)
    {
        $mails = new Mails();
        $mails['name'] = $request->name;
        $mails['email'] = $request->email;
        $mails['telefone'] = $request->telefone;
        $mails['assunto'] = $request->assunto;
        $mails['mensagem'] = $request->mensagem;
        Mail::to('zednetinformatica@gmail.com')->send(new FaleConosco($mails));

        return redirect()->back()->with('success', 'mensagem Enviada com sucesso!!');
    }

    // Pesquisar cep para endereço
    public function cepConsulta(Cep $cepSearch, $cep = null)
    {
        $cepResponse = $cepSearch->find($cep);
        $data = $cepResponse->getCepModel();
        return response()->json($data);
    }
}
