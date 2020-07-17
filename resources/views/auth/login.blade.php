@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 mt-5 pt-5 mb-2">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>

                    {{-- <div class="col-md-8 d-flex justify-content-center">- OU -</div> --}}

                    {{-- <div class="col-md-8 d-flex justify-content-center">
                        <a href="{{url('/login/facebook')}}" class="btn btn-primary" id="btn_login_facebook">
                            <i class="fa fa-facebook mr-2"></i>Entre usando o Facebook
                        </a>
                    </div> --}}
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-4 mb-5 pb-5 d-flex justify-content-between">
            <a class="btn btn-link" href="{{route('register')}}">Registrar</a>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
