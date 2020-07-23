<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ita Grill</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.site.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.menu.site.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            {{-- Topo --}}
            <section class="container mt-3">
                <div class="row">
                    {{-- Logo --}}
                    <div class="col-12 col-lg-3 text-center"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('img/logo2.png')}}" alt="Logo da itaGrill"></a></div>
                    {{-- Links e Pesquisa --}}
                    <div class="col-12 col-lg-9 my-auto">
                        <div class="row">
                            {{-- Primario --}}
                            <div class="col-12 top-nav-links">
                                <nav class="nav justify-content-center justify-content-lg-between">
                                    <p class="nav-item nav-link">Bem Vindo(a), 
                                        @if (auth()->guard('web')->check())
                                            <a href="{{url('perfil')}}">{{auth()->user()->name}}</a>
                                        @else
                                            <a href="{{route('login')}}"><i class="fa fa-sign-in-alt"></i> Identifique-se para fazer pedidos</a>
                                        @endif
                                    </p>

                                    @if (auth()->guard('web')->check())
                                        <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> Sair</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <a class="nav-item nav-link" href="{{route('register')}}"><i class="fa fa-user-plus"></i> Cadastre-se</a>
                                    @endif

                                    <a class="nav-item nav-link" href="#"><i class="fa fa-align-justify"></i> Meus Pedidos</a>

                                    <p class="nav-item nav-link"><i class="fa fa-phone"></i> (41) 3039-2993</p>
                                  </nav>
                            </div>
                            {{-- Secundario --}}
                            <div class="col-12 col-md-8 my-1 my-md-0 top-nav-search">
                                <form action="#" method="post">
                                    <div class="input-group ">
                                        <input type="text" class="form-control form-control-lg" placeholder="O que você deseja?">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-4 my-1 my-md-0 top-nav-cart">
                                <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="open_cart"><i class="fa fa-shopping-cart"></i> 0 <span>Minha Sacola</span> <span>R$ 00,00</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-fluid mt-3 text-center menu">
                <div class="container">
                    <button type="button" class="btn btn-default text-white d-md-none" id="open_menu"><i class="fa fa-bars"></i></button>

                    <div id="main-nav" class="d-none d-md-block">
                        <ul id="main-menu" class="sm sm-read-simple">
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
                        </ul>
                    </div>
                </div>

                <div id="menu_slider" class="close-menu">
                    <div class="menu-box">
                        <button type="button" class="m-2 close close-menu">X</button>

                        <div class="menu-content">
                            <div class="container my-5">
                                <ul id="sub-main-menu" class="sm sm-sub-read-simple">
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
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>

        {{-- Carrinho --}}
        <section id="cart_shop" class="close-cart">
            <div class="cart-box">
                <div class="cart-content">
                    <a href="#" class="m-2 cart-produto-apagar"><i class="fa fa-trash"></i> Limpar Carrinho</a>

                    <button type="button" class="m-3 close close-cart">X</button>

                    <div class="container my-5">
                        <div class="cart-produto">
                            <div class="cart-image"><img src="{{asset('img/produto.jpg')}}" alt=""></div>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="cart-produto-nome">Modelo 01</p>
                                <p class="cart-produto-valor">1 x R$ 2700,00</p>
                            </div>
                            <div class="d-flex flex-column justify-content-center"><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></div>
                        </div>

                        <div class="cart-button">
                            <div><a href="#" class="btn btn-default">Finalizar</a></div>
                            <div><a href="#" class="btn btn-default">Carrinho</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main>
            @yield('content')
        </main>

        <footer class="footer">
            {{-- footer pre-bottom --}}
            <div class="container-fluid footer-pre-bottom">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 col-lg-2 mb-3">
                            <h4><strong>Sobre Nós</strong></h4>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{url('sobre/sobre_etna')}}">Sobre a Etna</a></li>
                                <li class="nav-item"><a href="{{url('sobre/nossas_lojas')}}">Nossas lojas</a></li>
                                <li class="nav-item"><a href="{{url('sobre/drive_thru')}}">Drive Thru</a></li>
                                <li class="nav-item"><a href="{{url('sobre/trabalhe_conosco')}}">Trabalhe conosco</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <h4><strong>Sobre Central de Atendimento</strong></h4>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a href="{{url('contato/central_atendimento')}}">Central de atendimento</a></li>
                                <li class="nav-item"><a href="{{url('contato/fale_conosco')}}">Fale Conosco</a></li>
                                <li class="nav-item"><a href="{{url('contato/principais_duvidas')}}">Pincipais Dúvidas</a></li>
                                <li class="nav-item"><a href="#">Acompanhe seu pedido</a></li>
                                <li class="nav-item"><a href="{{url('contato/troca_devolucao')}}">Troca e Devolução</a></li>
                                <li class="nav-item"><a href="{{url('contato/politica_privacidade')}}">Politica e Privacidade</a></li>
                                <li class="nav-item"><a href="{{url('contato/regulamento_campanhas')}}">Regulamento de Campanhas</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 col-lg-2 mb-3">
                            <h4><strong>Contato</strong></h4>
                            <ul class="nav flex-column">
                                <li class="nav-item">Telefone <p>(41) 3347.6996</p></li>
                                <li class="nav-item">Email: <p>vmcia@yahoo.com.br</p></li>
                                <li class="nav-item">Endereço: <p>Rua Rio Negro 1048 <br /> Weissopolis <br /> Pinhais - PR</p></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <h4><strong>Siga a itagrill no Facebook</strong></h4>
                            <div id="fb-root"></div>
							<div class="fb-page" data-href="https://facebook.com/facebook/" data-tabs="timeline" data-width="" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                        </div>
                        <div class="col-12 col-md-10 col-lg-12"><img class="img-fluid" src="{{asset('img/payments.png')}}" alt="Opções de pagamentos"></div>
                    </div>
                </div>
            </div>
            {{-- footer bottom --}}
            <div class="container-fluid footer-bottom">
                <div class="container">
                    Itagrill &COPY; {{date("Y")}} - Desenvolvido por Agência Web7
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=673969480102752&autoLogAppEvents=1" nonce="ltnmgcLl"></script>
    <script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <script src="{{ asset('js/custom.site.js') }}"></script>
</body>
</html>
