@extends('layouts.app')

@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="col-3">
                <div class="list-group">
                    <a href="{{url('categoria/categoria')}}" class="list-group-item list-group-item-action">Teste 01</a>
                    <a href="{{url('categoria/categoria')}}" class="list-group-item list-group-item-action">Teste 02</a>
                    <a href="{{url('categoria/categoria')}}" class="list-group-item list-group-item-action">Teste 03</a>
                    <a href="{{url('categoria/categoria')}}" class="list-group-item list-group-item-action">Teste 04</a>
                    <a href="{{url('categoria/categoria')}}" class="list-group-item list-group-item-action">Todos os Produtos</a>
                </div>
            </div>
            <div class="col-9">
                <div class="row">
                    <h2 class="col-12 py-3"><strong>Categoria</strong></h2>
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