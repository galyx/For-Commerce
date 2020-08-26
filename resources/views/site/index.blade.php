@extends('layouts.app')

@section('content')
    {{-- Banner --}}
    <div id="banner_slider" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#banner_slider" data-slide-to="0" class="active"></li>
            <li data-target="#banner_slider" data-slide-to="1"></li>
            <li data-target="#banner_slider" data-slide-to="2"></li>
            <li data-target="#banner_slider" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('img/banner-01.jpg')}}" alt="Primeiro Slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/banner-02.jpg')}}" alt="Segundo Slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/banner-03.jpg')}}" alt="Terceiro Slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('img/banner-04.jpg')}}" alt="Quarto Slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>

    {{-- Corpo --}}
    <section class="container">
        {{-- Primeiro --}}
        <product-list></product-list>

        {{-- Segundo --}}
        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12"><img class="img-fluid" src="{{asset('img/logo3.png')}}" alt="Logo de produtos"></div>

                    <div class="col-4 d-flex flex-column produto-info-2">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>

                    <div class="col-4 d-flex flex-column produto-info-2">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>

                    <div class="col-4 d-flex flex-column produto-info-2">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 my-auto">
                <div class="row">
                    <div class="col-6 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-6 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- terceiro --}}
        <div class="row mt-5">
            <div class="col-12 col-lg-6 text-center my-auto">
                <img class="img-fluid mb-3" src="{{asset('img/produto.jpg')}}" alt="Imagens de produtos">
            </div>

            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-6 d-flex flex-column produto-info-1">
                        <div><img class="img-fluid" src="{{asset('img/produto.jpg')}}" alt="Produto"></div>
                        <div class="text-center my-2"><span class="texto">Modelo 01 - Pequena descrição do produto.</span></div>
                        <div class="text-center"><span class="preco">R$ 2700,00</span></div>
                        <div class="text-center my-2"><span class="texto">R$ 2700,00 a vista ou 10x de R$ 270,00</span></div>
                        <div class="mt-auto detalhe"><a class="btn btn-block btn-default mb-3" href="{{url('produto/produto')}}">VER PRODUTO</a></div>
                    </div>
                    <div class="col-6 d-flex flex-column produto-info-1">
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

    {{-- Contato --}}
    <section class="contato-home">
        <div class="container">
            <div class="col-12 col-lg-8">
                <form action="{{url('faleConosco')}}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-12"><h2 class="text-white"><strong>Fale Conosco</strong></h2></div>
                        <div class="form-group col-6">
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="Nome">
                        </div>
                        <div class="form-group col-6">
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="form-control form-control-lg" name="telefone" placeholder="Telefone">
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="form-control form-control-lg" name="assunto" placeholder="Assunto">
                        </div>
                        <div class="form-group col-12">
                            <textarea type="text" class="form-control form-control-lg" name="mensagem" placeholder="Mensagem"></textarea>
                        </div>
                        <div class="form-group col-12"><button type="submit" class="btn btn-default">Enviar</button></div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Icones de parceiros --}}
    <section class="my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-7 col-lg-2 my-3"><img class="img-fluid" src="{{asset('img/churrasqueiras.jpg')}}" alt="Churrasqueiras"></div>
                <div class="col-7 col-lg-2 my-3"><img class="img-fluid" src="{{asset('img/premium.jpg')}}" alt="Premium"></div>
                <div class="col-7 col-lg-2 my-3"><img class="img-fluid" src="{{asset('img/itasteel.jpg')}}" alt="Itasteel"></div>
                <div class="col-7 col-lg-2 my-3"><img class="img-fluid" src="{{asset('img/itaconfort.jpg')}}" alt="Itaconfort"></div>
                <div class="col-7 col-lg-2 my-3"><img class="img-fluid" src="{{asset('img/itaforno.jpg')}}" alt="Itaforno"></div>
            </div>
        </div>
    </section>
@endsection