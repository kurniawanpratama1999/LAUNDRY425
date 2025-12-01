<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laundry')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('headscripts')
</head>

<body>
    @if (Auth::check())
        <x-header></x-header>
    @endif
    <x-main>
        @yield('content')
    </x-main>

    @stack('footerscripts')
</body>

</html>
