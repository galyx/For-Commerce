@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5 py-5">
            <div class="col-12 col-md-4">
                <form action="{{url('perfil/editPerfil')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        @if (session()->has('warning'))
                            <div class="alert alert-warning">
                                {{session()->get('warning')}}
                            </div>
                        @endif
                    </div>

                    {{-- Nome --}}
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" placeholder="Nome" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" placeholder="Email" autocomplete="email">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control cpf @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') ? old('cpf') : auth()->user()->cpf}}" placeholder="CPF: 000.000.000-000" autocomplete="cpf" autofocus>

                        @error('cpf')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') ? old('birth') : auth()->user()->birth }}" autocomplete="birth" autofocus>

                        @error('birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control fone" name="fone" value="{{ old('fone') ? old('fone') : auth()->user()->fone }}" placeholder="Telefone: (00) 0000-0000" autocomplete="fone" autofocus>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control cel @error('cel') is-invalid @enderror" name="cel" value="{{ old('cel') ? old('cel') : auth()->user()->cel }}" placeholder="Celular: (00) 00000-0000" autocomplete="cel" autofocus>

                        @error('cel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection