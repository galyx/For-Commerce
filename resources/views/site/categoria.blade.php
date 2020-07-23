@extends('layouts.app')

@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="col-3">
                <div>
                    <ul id="lateral-main-menu" class="sm sm-sub-read-simple">
                        <li>
                            <a class="nav-link {{ request()->is('/') ? 'active-menu' : '' }}" href="{{url('/')}}">HOME</a>
                        </li>

                        @foreach (HelperClass::categories() as $categorie)
                            <li>
                                <a class="nav-link {{ request()->is('categoria/'.$categorie->slug) ? 'active-menu' : '' }}" href="{{url('categoria/'.$categorie->slug)}}">{{$categorie->name}}</a>

                                @if ($categorie->childrenCategories->count() >= 1)
                                    <ul>
                                        @foreach ($categorie->childrenCategories as $childCategorie)
                                            @include('helpers.helper_child_categorie', ['child_categorie' => $childCategorie])
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                        <li>
                            <a href="{{url('categoria/categoria')}}" class="nav-link">Todos os Produtos</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <h2 class="col-12 py-3"><strong>{{mb_convert_case($categorie_show->name, MB_CASE_UPPER)}}</strong></h2>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
        
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
        
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-4 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection