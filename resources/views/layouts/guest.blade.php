<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @vite('resources/css/style.css')
        @vite('resources/css/signin_signup.css')
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <div class="logo flex items-center space-x-3">
                    <img src="{{ Vite::asset('resources/images/bus.svg') }}" alt="Company Logo" class="w-10 h-10">
                    <p class="text-2xl font-extrabold text-yellow-500 uppercase">Transpo FLOW</p>
                </div>
            </div>

            <div class="w-full">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
