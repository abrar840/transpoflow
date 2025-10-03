<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6">
    <!-- Sleek Header with Back/Exit Button -->
    <div class="flex items-center justify-between mb-8">
        <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium shadow-sm transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span>Exit</span>
        </a>
        <span class="text-2xl font-bold tracking-tight text-gray-800">Theme Previewer</span>
        <span></span> <!-- Spacer for symmetry -->
    </div>
   
    <h2 class="text-3xl font-bold mb-6 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
        Theme Previewer
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Theme Cards -->
        @foreach (['light' => 'Light Theme', 'dark' => 'Dark Theme'] as $key => $label)
            <div 
                wire:click="setTheme('{{ $key }}')" 
                class="cursor-pointer border rounded-2xl p-6 shadow-sm transition-all duration-300 hover:shadow-md {{ $theme === $key ? 'ring-2 ring-blue-500 bg-blue-50/20' : 'hover:border-gray-300' }}"
            >
                <img 
                    src="{{ Vite::asset('resources/images/enduser/' . $key . '-preview.png') }}" 
                    alt="{{ $label }} Preview" 
                    class="w-full h-150 object-cover rounded-lg mb-4 border"
                >
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-full {{ $key === 'light' ? 'bg-yellow-100 text-yellow-600' : 'bg-indigo-100 text-indigo-600' }}">
                        @if($key === 'light')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $label }}</h3>
                </div>
                <p class="text-gray-600 mt-2 ml-11">
                    {{ $key === 'light' ? 'Bright and clean look for daytime users.' : 'Elegant dark tones perfect for low-light environments.' }}
                </p>
            </div>
        @endforeach
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
        <!-- Open in New Window Button -->
        <a 
            href="{{ route('home.preview', ['theme' => $theme]) }}" 
            target="_blank"
            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            Open in New Window
        </a>

        <!-- Continue Button -->
        <a
            href="{{ route('companyform', ['theme' => $theme]) }}"
            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
            Continue
        </a>
    </div>

    <!-- Iframe Preview -->
    <div class="mt-10 border rounded-xl overflow-hidden shadow-lg">
        <div class="bg-gray-100 px-4 py-3 text-gray-700 font-medium flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Previewing: <span class="capitalize font-semibold">{{ $theme }} Theme</span>
        </div>
        <iframe 
            src="{{ route('home.preview', ['theme' => $theme]) }}" 
            class="w-full h-[600px] border-0"
        ></iframe>
    </div>
</div>