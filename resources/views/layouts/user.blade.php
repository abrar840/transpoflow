<!-- resources/views/layouts/user.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'User Page' }} - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    
   
    @stack('styles')
  
      <title>{{ config('app.name', 'Transpoflow') }}</title>

    
    

    @livewireStyles
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    {{-- Per-company brand color. One theme, many color schemes: enduser CSS uses
         var(--brand) / var(--brand-dark) so each company site is tinted by its
         chosen color. --}}
    @php
        $brand = optional(optional($company ?? null)->theme)->brand_color ?: '#f39c12';
    @endphp
    <style>
        :root {
            --brand: {{ $brand }};
            --brand-dark: color-mix(in srgb, {{ $brand }} 82%, black);
            --brand-soft: color-mix(in srgb, {{ $brand }} 12%, white);
            --dark-orange: {{ $brand }};
        }
    </style>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/enduser/brand-accents.css') }}">
</head>
<body class="">
  @php
  $hideHeaderRoutes = ['end-user-login', 'end-user-register','form','companyform','admin-panel-preview','theme-preview'];
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
