@extends('layouts.app')

@section('content')
    {{-- Contato --}}
    <section class="contato">
        <div class="container">
            <div class="row my-5">
                <div class="col-12 col-lg-5">
                    <h4><strong>Contato</strong></h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">Telefone <p>(41) 3347.6996</p></li>
                        <li class="nav-item">Email: <p>vmcia@yahoo.com.br</p></li>
                        <li class="nav-item">Endereço: <p>Rua Rio Negro 1048 <br /> Weissopolis - Pinhais - PR</p></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-7">
                    <form action="{{url('faleConosco')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12"><h2><strong>Fale Conosco</strong></h2></div>
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
                                <textarea type="text" class="form-control form-control-lg" name="menssagem" placeholder="Mensagem"></textarea>
                            </div>
                            <div class="form-group col-12"><button type="submit" class="btn btn-default">Enviar</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection