@extends('layouts.app')

@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="imagem-produto-1 mb-2">
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div><img class="img-fluid mx-auto" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                </div>

                <div class="imagem-produto-2">
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                    <div class="px-2"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Imagen do produto"></div>
                </div>
            </div>

            <div class="col-12 col-md-7 produto-detalhe">
                <div class="titulo px-3">
                    <h1>Produto Teste</h1>
                    <p>pequena descrição Teste.</p>
                    <div class="preco"><span>R$ 2700,00</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Descrição do produto --}}
    <hr />
    <section>

    </section>

    {{-- Outros produtos --}}
    <section class="container my-5">
        <div class="row">
            <div class="col-12 col-md-3 d-flex flex-column produto-info-2">
                <div class="mx-auto"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
            </div>

            <div class="col-12 col-md-3 d-flex flex-column produto-info-2">
                <div class="mx-auto"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
            </div>

            <div class="col-12 col-md-3 d-flex flex-column produto-info-2">
                <div class="mx-auto"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
            </div>

            <div class="col-12 col-md-3 d-flex flex-column produto-info-2">
                <div class="mx-auto"><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
            </div>
        </div>
    </section>
@endsection