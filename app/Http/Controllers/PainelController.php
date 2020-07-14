<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'admin.status']);
    }

    // Inicio
    public function index()
    {
        return view('painel.index');
    }

    // Vendedor
    public function categorias()
    {
        return view('painel.catalogos.categorias');
    }

    // Administrador
    public function perfil()
    {
        return view('painel.perfil');
    }

    public function admins()
    {
        return view('painel.admins');
    }

    public function imagens()
    {
        return view('painel.imagens');
    }
}
