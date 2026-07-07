<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Transpoflow') }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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
  @vite('resources/css/VehicleRegistration.css')
  @vite('resources/css/admin.css')
  @livewireStyles
  @stack('styles')
  <style>
    :root {
      --admin-sidebar-w: 280px;
      /* Violet accent system */
      --admin-accent: #7c3aed;        /* violet-600 */
      --admin-accent-hover: #6d28d9;  /* violet-700 */
      --admin-accent-light: #8b5cf6;  /* violet-500 */
      --admin-accent-soft: #f3f0ff;   /* violet-50  */
      --admin-accent-soft2: #e9e2ff;  /* violet-100 */
    }
    .admin-main { position: relative; min-height: 100vh; }

    /* Single source of truth for the sidebar offset: the wrapper owns it.
       Everything inside `.admin-content` flows in normal document width. */
    .admin-content {
      margin-left: var(--admin-sidebar-w);
      padding: 20px 24px 24px;
      transition: margin-left 0.3s ease;
    }
    /* Neutralize the legacy `.content` self-offset so it does NOT double up
       with the wrapper margin above. */
    .admin-content .content {
      position: static !important;
      width: 100% !important;
      left: 0 !important;
    }

    /* Collapsed sidebar */
    body.sidebar-collapsed { --admin-sidebar-w: 60px; }
    body.sidebar-collapsed .sidebar { width: 60px; }
    body.sidebar-collapsed .sidebar .logo .text,
    body.sidebar-collapsed .sidebar .side-menu li a .text,
    body.sidebar-collapsed .sidebar .sidebar-header .text,
    body.sidebar-collapsed .sidebar .sidebar-footer .text,
    body.sidebar-collapsed .sidebar .side-menu li a span { display: none; }
    body.sidebar-collapsed .sidebar .sidebar-header .logo { justify-content: center; }

    /* In-sidebar collapse toggle */
    .sidebar .sidebar-header {
      display: flex; align-items: center; justify-content: space-between;
      gap: 6px; padding: 10px 12px;
    }
    .sidebar .sidebar-header .logo { flex: 1; min-width: 0; height: auto; overflow: hidden; }
    .sidebar-collapse-btn {
      flex-shrink: 0; width: 34px; height: 34px; border: none; border-radius: 8px;
      background: var(--admin-accent-soft); color: var(--admin-accent); cursor: pointer;
      display: inline-flex; align-items: center; justify-content: center; font-size: .95rem;
      transition: background .15s;
    }
    .sidebar-collapse-btn:hover { background: var(--admin-accent-soft2); }
    /* When collapsed, hide the logo entirely and center the toggle so nothing overlaps */
    body.sidebar-collapsed .sidebar .sidebar-header { justify-content: center; padding: 10px 0; }
    body.sidebar-collapsed .sidebar .sidebar-header .logo { display: none; }

    @media (max-width: 1000px) {
      .admin-content { margin-left: 0; }
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
    <main class="admin-main">
      @livewire('side-bar')
      <div class="admin-content">
        {{ $slot }}
      </div>
    </main>
  </div>

  @livewireScripts
  @stack('scripts')
</body>

</html>