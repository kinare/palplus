<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Palplus') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}

{{--    <style>--}}
{{--        #app {--}}
{{--            font-family: "Karla", Helvetica, Arial, sans-serif;--}}
{{--            -webkit-font-smoothing: antialiased;--}}
{{--            -moz-osx-font-smoothing: grayscale;--}}
{{--            text-align: center;--}}
{{--            color: #2c3e50;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>
<div id="app">
    <router-view />
</div>
</body>
</html>
