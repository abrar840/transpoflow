<!-- resources/views/layouts/user.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'User Page' }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    
   
    @stack('styles')
  
    
    
    

    @livewireStyles
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
</head>
<body class="">
  @php
  $hideHeaderRoutes = ['end-user-login', 'end-user-register'];
@endphp

@if (!in_array(Route::currentRouteName(), $hideHeaderRoutes))
  @livewire('enduser.header1', ['company' => $company])
@endif

    <main class="">
        
        <div class="">
          {{ $slot }}
        </div>
      </main>

      @livewireScripts
      @stack('scripts')
  
    </body>
 
</html>
