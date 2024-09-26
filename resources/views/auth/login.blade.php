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
    <style>
        body {
            background-image: url('{{ asset('images/background_image.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            position: relative; /* To ensure the overlay is correctly positioned */
        }

        /* Overlay using pseudo-element */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent overlay with 60% opacity */
            z-index: 1; /* Positioned behind the content */
        }

        .container {
            position: relative; /* Ensure the content is on top of the overlay */
            z-index: 2; /* On top of the overlay */
        }

        .login-wrap {
            background-color: rgba(255, 255, 255, 0.6); /* Slight transparency */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
	<body>
        <x-page.loader></x-page.loader>
    <section class="main">
       @livewire('auth.user-login')
    </section>
    @livewireScripts
    <script src="{{ asset('js/jquery-3.min.js') }}"></script>
	</body>
</html>
