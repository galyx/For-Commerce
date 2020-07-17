@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5 py-5">
            <div class="col-12 col-md-4">
                <form action="{{url('perfil/'.$url)}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control cep @error('cep') is-invalid @enderror" name="cep" value="{{old('cep') ? old('cep') : ''}}{{$id ? $address->cep : ''}}" placeholder="Cep" autocomplete="cep" autofocus>

                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary cepConsulta"><i class="fa fa-search"></i> Pesquisar</button>
                            </div>

                            @error('cep')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control uf @error('uf') is-invalid @enderror" name="uf" value="{{old('uf') ? old('uf') : ''}}{{$id ? $address->uf : ''}}" placeholder="Estado" autocomplete="uf">

                        @error('uf')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control cidade @error('cidade') is-invalid @enderror" name="cidade" value="{{old('cidade') ? old('cidade') : ''}}{{$id ? $address->cidade : ''}}" placeholder="Cidade" autocomplete="cidade">

                        @error('cidade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control bairro @error('bairro') is-invalid @enderror" name="bairro" value="{{old('bairro') ? old('bairro') : ''}}{{$id ? $address->bairro : ''}}" placeholder="Bairro" autocomplete="bairro">

                        @error('bairro')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rua @error('rua') is-invalid @enderror" name="rua" value="{{old('rua') ? old('rua') : ''}}{{$id ? $address->rua : ''}}" placeholder="Rua" autocomplete="rua">

                        @error('rua')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{old('numero') ? old('numero') : ''}}{{$id ? $address->numero : ''}}" placeholder="Numero" autocomplete="numero">

                        @error('numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="complemento" value="{{old('complemento') ? old('complemento') : ''}}{{$id ? $address->complemento : ''}}" placeholder="Complemento" autocomplete="complemento">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-save"></i>
                            @if ($id)
                                Salvar Alterações
                            @else
                                Salvar Novo Endereço
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection