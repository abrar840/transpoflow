<!-- filepath: c:\xampp\htdocs\fyp\resources\views\livewire\enduser\header1.blade.php -->
<header class="header">
    <div class="logo flex items-center space-x-3">
        <img src="{{ Vite::asset('resources/images/bus.svg') }}" alt="Company Logo" class="w-10 h-10">
        <p class="text-2xl font-extrabold text-yellow-500 uppercase">{{$company->name}}</p>
    </div>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="{{ route('user-Home', ['company' => $company->name]) }}">Home</a></li>
            {{-- <li><a href="{{ route('about-us', ['company' => $company->name]) }}">About Us</a></li>
             --}}
             @foreach($serviceNames as $service)
             <li>
                 <a href="{{ route('service-page', ['company' => $company->name, 'service' => Str::slug($service)]) }}">
                     {{ $service }}
                 </a>
             </li>
         @endforeach
         
            
            {{-- <li><a href="{{ route('contact-us', ['company' => $company->name]) }}">Contact Us</a></li> --}}
        </ul>
    </nav>
    <div class="sign-in">
        <a href="signin.html" class="sign-in-btn" style="text-decoration: none;">Sign In/Sign Up</a>
    </div>
</header>