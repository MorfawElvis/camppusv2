<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - {{ __('Login') }}</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
	<body>
    <div class="loader">
        <div></div>
        <img src="{{ asset('images/camppus-logo.svg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <section class="ftco-section camppus-wrapper">
       @livewire('auth.user-login')
    </section>
    @livewireScripts
    <script src="{{ asset('js/jquery-3.min.js') }}"></script>
    <script src="{{asset('js/app.js')}}"></script>
	</body>
</html>
