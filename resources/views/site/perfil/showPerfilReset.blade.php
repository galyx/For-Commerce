@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5 py-5">
            <div class="col-12 col-md-4">
                <form action="{{url('perfil/editPerfilReset')}}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Senha atual" autofocus>

                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nova senha">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar nova senha">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-save"></i> Salvar Nova Senha
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection