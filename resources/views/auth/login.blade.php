@extends('layouts.app')

@section('content')
    <div class="section-login bg-secondary">
        <div class="container d-flex h-100 justify-content-center">
            <div class="row justify-content-center align-self-center ">
                <div class="col-md-7">

                    <div class="card">
                        <div class="card-header bg-dark"> <a class="navbar-brand text-white font-weight-bold"
                                href="{{ route('home') }} ">
                                {{ __('BURGERAN') }}
                                <span> <i class="fas fa-hamburger brand-icons text-warning"></i> </span>
                            </a></div>

                        <div class="card-body bg-light">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-7">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-7">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-7 offset-md-4">
                                        <button type="submit" class="btn btn-warning btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .row {
        width: 100%;
    }

    .login-col {
        width: 100%;
    }

</style>
