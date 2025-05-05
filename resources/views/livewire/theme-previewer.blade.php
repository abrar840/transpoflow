<div class="max-w-7xl mx-auto py-10 px-6">
    <!-- Sleek Header with Back/Exit Button -->
    <div class="flex items-center justify-between mb-8">
        <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold shadow transition">
            <i class="fa fa-arrow-left"></i>
            <span>Exit</span>
        </a>
        <span class="text-2xl font-bold tracking-tight text-gray-800">Theme Previewer</span>
        <span></span> <!-- Spacer for symmetry -->
    </div>
   
    <h2 class="text-3xl font-bold mb-6 text-center">🌗 Theme Previewer</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Theme Cards -->
        @foreach (['light' => 'Light Theme', 'dark' => 'Dark Theme'] as $key => $label)
            <div 
                wire:click="setTheme('{{ $key }}')" 
                class="cursor-pointer border rounded-2xl p-6 shadow-md transition hover:shadow-lg {{ $theme === $key ? 'ring-4 ring-blue-500' : '' }}"
            >
                <img 
                    src="{{ Vite::asset('resources/images/enduser/' . $key . '-preview.png') }}" 
                    alt="{{ $label }} Preview" 
                    class="w-full h-150 object-cover rounded-lg mb-4"
                >
                <h3 class="text-xl font-semibold">{{ $label }}</h3>
                <p class="text-gray-600 mt-2">
                    {{ $key === 'light' ? 'Bright and clean look for daytime users.' : 'Elegant dark tones perfect for low-light environments.' }}
                </p>
            </div>
        @endforeach
    </div>

    <!-- Open in New Window Button -->
    <div class="flex justify-center mt-6">
        <a 
            href="{{ route('home.preview', ['theme' => $theme]) }}" 
            target="_blank"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition"
        >
            <i class="fa fa-external-link-alt mr-2"></i> Open in New Window
        </a>
    </div>


    <!-- Continue Button for Livewire Form Component -->
<div class="flex justify-center mt-8">
    <a
        href="{{ route('companyform', ['theme' => $theme]) }}"
        class="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-semibold text-lg gap-2"
       
    >
        <i class="fa fa-arrow-right"></i>
        Continue
    </a>
</div>

    <!-- Iframe Preview -->
    <div class="mt-10 border rounded-xl overflow-hidden shadow-lg">
        <div class="bg-gray-100 px-4 py-2 text-gray-700 font-semibold">
            Previewing: <span class="capitalize">{{ $theme }} Theme</span>
        </div>
        <iframe 
            src="{{ route('home.preview', ['theme' => $theme]) }}" 
            class="w-full h-[600px] border-0"
        ></iframe>
    </div>
</div>