<!-- resources/views/layouts/user.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'User Page' }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/css/enduser/homepage.css', 'resources/js/app.js'])
    @vite('resources/css/enduser/signin_signup.css')
 
    @livewireStyles
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
</head>
<body class="">

    <main class="">
        
        <div class="">
          {{ $slot }}
        </div>
      </main>

      @livewireScripts
  
    </body>
 
</html>
