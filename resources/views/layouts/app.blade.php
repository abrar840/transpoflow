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
  
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <!-- Additional CSS -->
  @vite('resources/css/VehicleRegistration.css')
  @vite('resources/css/admin.css')
  
  @livewireStyles

  <style>
    .page-header .header-options {
      display: flex;
      gap: 1rem;
      margin-top: 0;
    }

    .page-header button {
      padding: 0.5rem 1rem;
      border-radius: 4px;
      transition: background 0.3s ease;
    }

    .page-header button.active {
      background: #3498db;
      color: white;
    }

    /* Ensure icons are visible */
    .fas, .fab {
      font-style: normal;
      font-size: inherit;
    }
  </style>
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100" x-data="{ show: false }">
    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
    @endif

    <!-- Page Content -->
    <main class="flex">
      <button id="sidebar-toggle" class="sidebar-toggle-btn" style="display:none;">
        <i class="fas fa-bars"></i>
    </button>
      @livewire('side-bar')
      <div class="flex-1 p-4">
        {{ $slot }}
      </div>
    </main>
  </div>

  @livewireScripts
  @stack('scripts')
</body>

</html>