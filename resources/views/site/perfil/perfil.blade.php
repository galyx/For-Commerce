@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5 justify-content-center">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{session()->get('success')}}
                    </div>
                @endif

                @if (session()->has('destroy'))
                    <div class="alert alert-danger text-center">
                        {{session()->get('destroy')}}
                    </div>
                @endif
            </div>

            <div class="col-12 col-md-8 col-lg-4">
                <h3 class="mb-3">Dados Pessoais</h3>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nome: {{auth()->user()->name}}</li>
                    <li class="list-group-item">Email: {{auth()->user()->email}}</li>
                    <li class="list-group-item">CPF: {{auth()->user()->cpf}}</li>
                    <li class="list-group-item">Data de Nascimento: {{date("d/m/Y", strtotime(str_replace('-','/', auth()->user()->birth)))}}</li>
                    <li class="list-group-item">Telefone Fixo: {{auth()->user()->fone}}</li>
                    <li class="list-group-item">Celular: {{auth()->user()->cel}}</li>
                    <li class="list-group-item">
                        <a href="{{url('perfil/showPerfil')}}" class="btn btn-block btn-primary"><i class="fa fa-user-cog"></i> Alterar Dados</a> 
                        <a href="{{url('perfil/showPerfilReset')}}" class="btn btn-block btn-warning"><i class="fa fa-user-lock"></i> Alterar Senha</a>
                    </li>
                </ul>
            </div>

            @foreach ($adresses as $address)
                <div class="col-12 col-md-8 col-lg-4">
                    <h3 class="mb-3">Endereço</h3>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cep: {{$address->cep}}</li>
                        <li class="list-group-item">Cidade: {{$address->cidade}} - UF: {{$address->uf}}</li>
                        <li class="list-group-item">Bairro: {{$address->bairro}}</li>
                        <li class="list-group-item">{{$address->rua}} - Nº {{$address->numero}}</li>
                        <li class="list-group-item">Complemento: {{$address->complemento}}</li>
                        <li class="list-group-item">
                            <a href="{{url('perfil/showAddress/'.$address->id)}}" class="btn btn-block btn-primary"><i class="fa fa-user-cog"></i> Alterar Endereço</a> 
                            <a href="{{url('perfil/destroyAddress/'.$address->id)}}" class="btn btn-block btn-danger"><i class="fa fa-user-lock"></i> Apagar Endereço</a>
                        </li>
                    </ul>
                </div>
            @endforeach

            @if ($adresses->count() <= 1)
                <div class="col-12 col-md-8 col-lg-4"><a href="{{url('perfil/showAddress')}}" class="btn btn-block btn-primary"><i class="fa fa-map-marker-alt"></i> Adicionar Novo Endereço</a></div>
            @endif
        </div>
    </div>
@endsection