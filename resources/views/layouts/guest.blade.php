<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TranspoFlow') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-700 antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center bg-slate-50 px-4 py-10">

        {{-- Brand --}}
        <a href="{{ route('home') }}"
            class="mb-8 inline-flex items-center gap-2 text-2xl font-extrabold text-slate-900">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                <i class="fa-solid fa-route text-base"></i>
            </span>
            Transpo<span class="text-indigo-600">Flow</span>
        </a>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
