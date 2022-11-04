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
    @vite(['resources/css/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
	<body>
        <x-page.loader></x-page.loader>
    <section class="main">
       @livewire('auth.user-login')
    </section>
    @livewireScripts
    <script src="{{ asset('js/jquery-3.min.js') }}"></script>
    <script src="{{asset('js/app.js')}}"></script>
	</body>
</html>
