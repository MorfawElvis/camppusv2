<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - {{ __('Recover Password') }}</title>
        <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
	<body class="hold-transition login-page">
    <div class="loader">
        <div></div>
        <img src="{{asset('storage/logo/camppus-logo.svg')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="login-box camppus-wrapper">
        <div class="card shadow">
            <div class="card-header bg-primary text-center">
                <a href="{{ route('login') }}" class="h4 text-decoration-none"><b>Camppus</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">{{ __('You are only one step a way from your new password, recover your password now.') }}</p>
                <form method="POST" action="{{ route('password.email') }}">
                    <div class="form-floating mb-3">
                        <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" id="floatingInput" placeholder="Password"
                               name="password" required autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <label for="floatingInput">{{ __('Password') }}</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="password-field-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" id="floatingInput" placeholder="Password confirmation"
                               name="password-confirm" required autofocus>
                        @error('password-confirm')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <span toggle="#password-field-confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        <label for="floatingInput">{{ __('Confirm Password') }}</label>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Change Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-3.min.js')}}"></script>
	</body>
</html>
