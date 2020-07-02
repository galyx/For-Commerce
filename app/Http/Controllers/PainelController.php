<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin', 'admin.status']);
    }

    public function index()
    {
        return view('painel.index');
    }

    public function perfil()
    {
        return view('painel.perfil');
    }

    public function admins()
    {
        return view('painel.admins');
    }
}
