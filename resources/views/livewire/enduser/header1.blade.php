<!-- filepath: resources/views/livewire/enduser/header1.blade.php -->
<header class="header">
    @aware(['company'])

    @vite("resources/css/enduser/theme1/header.css")
    <div class="logo flex items-center space-x-3">
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo">




        <p class="text-2xl font-extrabold uppercase" style="color: var(--brand);">{{$company->name}}</p>
    </div>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="{{ route('user-home', ['company' => $company->name]) }}" >Home</a></li>
            @foreach($serviceNames as $service)
                <li>
                    <a href="{{ route('service-page', ['company' => $company->name, 'service' => $service]) }}" >
                        {{ str_replace('FleetBooking',' ',str_replace('Management','Booking',$service))}}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
    <div class="sign-in flex items-center space-x-4">
       
        {{-- @guest('end_user')
          
            <a href="{{ route('end-user-login', ['company' => $company->name]) }}" class="sign-in-btn" style="text-decoration: none;">Sign In/Sign Up</a>
            <a href="{{ route('end-user-register', ['company' => $company->name]) }}" class="sign-in-btn ml-2" style="text-decoration: none;">Register</a>
         
            @endguest --}}

             @if(!$isauth)
            <a href="{{ route('end-user-login', ['company' => $company->name]) }}" class="sign-in-btn" style="text-decoration: none;">Sign In/Sign Up</a>
            {{-- <a href="{{ route('end-user-register', ['company' => $company->name]) }}" class="sign-in-btn ml-2" style="text-decoration: none;">Register</a> --}}
         @endif

        @auth('end_user')
        @if($isauth)
        <div x-data="{ open: true }" class="relative">
            <button @click="open = true" class="flex items-center space-x-2 text-white px-4 py-2 rounded-full focus:outline-none" style="background: var(--brand);">
                <span>Profile</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" x-cloak @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg z-50">
                <!-- Profile dropdown content here -->
            </div>
        </div>

        <form method="POST" action="{{ route('Ulogout',[$company->name]) }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-yellow-100">Logout</button>
        </form>
        @endif
        @endauth
    </div>
</header>