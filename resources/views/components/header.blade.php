
@vite(['resources/css/app.css', 'resources/js/app.js'])
@vite("resources/css/style.css")
<header class="header" data-header>
    <div class="container">
        <a href="#" class="logo">
            <img src="{{ asset('images/logo.svg') }}" width="160" height="50" alt="logo">
        </a>

        <nav class="navbar" data-navbar>
            <button class="close-btn" aria-label="close services" data-nav-toggler>
                <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
            </button>

            <a href="#" class="logo">
                <img src="{{ asset('images/logo.svg') }}" width="160" height="50" alt="transpoflow-logo">
            </a>

            <ul class="navbar-list">
                <li class="navbar-item">
                    <a href="{{ route('home') }}" class="navbar-link hover-underline {{ request()->routeIs('home') ? 'active' : '' }}" wire:navigate.hover>
                       
                        <div class="separator"></div>
                        <span class="span">Home</span>
                    </a>
                </li>

                <li class="navbar-item">
                    <a href="{{ route('services') }}" class="navbar-link hover-underline {{ request()->routeIs('services') ? 'active' : '' }}" wire:navigate.hover>
                        <div class="separator"></div>
                        <span class="span">Services</span>
                    </a>
                </li>

                <li class="navbar-item">
                    <a href="{{ route('aboutus') }}" class="navbar-link hover-underline {{ request()->routeIs('aboutus') ? 'active' : '' }}" wire:navigate.hover>
                        <div class="separator"></div>
                        <span class="span">About Us</span>
                    </a>
                </li>

                <li class="navbar-item">
                    <a href="{{ route('contact') }}" class="navbar-link hover-underline {{ request()->routeIs('contact') ? 'active' : '' }}" wire:navigate>
                        <div class="separator"></div>
                        <span class="span">Contact</span>
                    </a>
                </li>
            </ul>
        </nav>




      

        @guest
    <a href="{{ route('login') }}" class="btn btn-secondary inline-block">
        <span class="text text-1">Sign In</span>
    </a>
@endguest





    <!-- User Menu - Only show when authenticated -->
    @auth
    <div class="flex items-center space-x-4">

       
        
        <!-- Livewire Logout Button -->
        {{-- <button 
            wire:click.prevent="logout"
            class="text-white hover:text-gray-300"
        >
            Logout
        </button> --}}
        
        <!-- OR Traditional Form (if you prefer) -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white hover:text-gray-300">Logout</button>
        </form>
    </div>
@endauth
        

        <button class="nav-open-btn" aria-label="open services" data-nav-toggler>
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
        </button>

        <div class="overlay" data-nav-toggler data-overlay></div>
    </div>
</header>
@auth
 
 @endauth