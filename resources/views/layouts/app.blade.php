<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts  -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts  -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/company_logo.js'])
</head>
<body>

@include('layouts.navbar')

<div class="container mt-4">

    {{--    session success messages--}}
    @if (session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif

    {{--    here comes the page content--}}
    @yield('content')
</div>

{{--footer--}}
<footer class="text-center mt-4">
    <p>&copy; 2024 - Ladányi Anna</p>
    <small>{{ __("All rights reserved") }}</small>
</footer>

</body>
</html>
