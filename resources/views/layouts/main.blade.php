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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('third_party_stylesheets')
    @stack('page_css')
    @livewireStyles
</head>
    <body class="sidebar-mini">
            @include('layouts.sidebar')
            @include('layouts.header')
              <div class="wrapper">
                  <div class="camppus-body">
                      <div class="camppus-main">
                          @yield('content')
                      </div>
                  </div>
              </div>
            <footer class="main-footer">
                <div class="row">
                    <div class="col-sm text-sm-left">
                        Copyright &copy; @php
                            echo date('Y');
                        @endphp All rights reserved.
                    </div>
                    <div class="col-sm text-sm-right">
                        Powered by EzyLinx Technologies
                    </div>
                </div>
            </footer>
            <!-- Scripts -->
            <script src="{{ mix('js/app.js') }}" defer></script>
            <script src="{{asset('js/jquery-3.min.js')}}"></script>
            @yield('third_party_scripts')
            @stack('page_scripts')
    @livewireScripts
    </body>
</html>
