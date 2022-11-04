<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <!-- Styles -->
    @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    @stack('page-css')
    @livewireStyles
</head>
    <body class="hold-transition sidebar-mini {{ $general_setting->collapsed_sidebar ?? 'collapsed_sidebar'}}">   
        <div class="wrapper" id="app">
            @include('layouts.header')
            @include('layouts.sidebar')
            <div class="content-wrapper">
                <div class="content">
                    <div class="container-fluid">
                        <div class="content-header">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        {{ $slot ?? '' }}
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
        <!-- Scripts -->
        <script src="{{asset('js/jquery-3.min.js')}}"></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
        <script src="{{ asset('js/custom/bootstrap-switch.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        @stack('page-scripts')
    @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <x-livewire-alert::scripts />
    </body>
</html>
