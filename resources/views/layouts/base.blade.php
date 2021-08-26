<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')

            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ url(mix('js/app.js')) }}" defer></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="bg-white">
        @yield('body')

        @livewireScripts
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
        <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ asset('js/sweetalert2.min.js')}}"></script>
        <x-livewire-alert::scripts />
        @yield('scripts')
    </body>
</html>
