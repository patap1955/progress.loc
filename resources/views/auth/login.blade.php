@extends('layouts.app')

@section('content')

    <div class="auth">
        <div class="auth__icon">
            <img class="auth__icon-img" src="/assets/images/template/favicon.png">
        </div>
        <div class="auth__wrapper">
            <div class="auth__wrapper-container">
                <h1 class="auth__wrapper-title">Добро пожаловать! 🐻</h1>
                <form class="auth__wrapper-form">
                    <div class="auth__wrapper-form-grid">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Пароль</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="auth__wrapper-form-flex">
                        <div class="auth__wrapper-form-link"><a href="#">Забыли пароль?</a></div>
                        <div class="auth__wrapper-form-button">
                            <button class="button" type="submit">Войти</button>
                        </div>
                    </div>
                </form>
                <div class="auth__wrapper-info">
                    <p class="auth__wrapper-info-text">
                        Еще не зарегистрированы?
                        <a class="auth__wrapper-info-text-link" href="/">Регистрация</a>
                    </p>
                    <div class="auth__wrapper-info-warning">
                        <p>&#10004; Данный сервис используется исключительно в демонстрационных целях.</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="auth__images">
            <div class="auth__images-rel">
                <img src="/assets/images/template/favicon.png">
            </div>
            <div class="auth__images-abs">
                <img src="/assets/images/template/favicon.png">
            </div>
        </div>
    </div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
