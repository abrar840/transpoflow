<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6" style="--brand: {{ $color }};">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <a href="{{ url('/') }}"
            class="flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Exit
        </a>
        <div class="text-center">
            <h1 class="text-xl font-bold text-gray-900">Pick your brand color</h1>
            <p class="text-sm text-gray-500">See it applied to your site instantly</p>
        </div>
        <a href="{{ route('companyform', ['theme' => 'light']) }}?color={{ urlencode($color) }}"
            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white shadow-sm transition-all hover:shadow-md"
            style="background: var(--brand);">
            Continue
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    {{-- Color controls bar --}}
    <div class="flex flex-wrap items-center gap-4 rounded-xl border border-gray-200 bg-white px-5 py-4 shadow-sm mb-5">
        <div class="flex items-center gap-3">
            <input type="color" wire:model.live="color"
                class="h-10 w-12 cursor-pointer rounded-lg border border-gray-300 bg-white p-1">
            <input type="text" wire:model.live="color" placeholder="#f39c12"
                class="w-28 rounded-lg border border-gray-300 px-3 py-2 text-sm font-mono uppercase shadow-sm focus:border-gray-400 focus:ring-2 focus:ring-gray-200">
        </div>

        <div class="h-8 w-px bg-gray-200"></div>

        <div class="flex flex-wrap items-center gap-2">
            @foreach ($presets as $preset)
                <button type="button" wire:click="setColor('{{ $preset }}')"
                    class="h-8 w-8 rounded-full shadow ring-1 ring-gray-200 transition-transform hover:scale-110 {{ strtolower($color) === strtolower($preset) ? 'ring-2 ring-offset-2 ring-gray-800' : '' }}"
                    style="background: {{ $preset }};" title="{{ $preset }}"></button>
            @endforeach
        </div>
    </div>

    {{-- Real live preview (actual homepage in an iframe, tinted by the chosen color) --}}
    <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden shadow-lg">
        <div class="flex items-center gap-2 border-b border-gray-200 bg-gray-50 px-4 py-2.5">
            <span class="h-3 w-3 rounded-full bg-red-400"></span>
            <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
            <span class="h-3 w-3 rounded-full bg-green-400"></span>
            <span class="ml-3 text-xs text-gray-400">yourcompany.transpoflow.com</span>
            <span wire:loading wire:target="color" class="ml-auto text-xs text-gray-400">updating…</span>
        </div>

        <div class="relative bg-white" style="height: 620px;"
            x-data="{ last: @js($color) }"
            wire:ignore>
            {{-- wire:ignore keeps Livewire from re-rendering the iframe. The
                 watcher re-tints only on a REAL color change, and updates the
                 color param on the iframe's CURRENT page (so navigating inside
                 the preview isn't reset back to home). --}}
            <iframe x-ref="pv"
                x-init="$watch('$wire.color', c => {
                    if (!c || c === last) return;
                    last = c;
                    try {
                        const u = new URL($refs.pv.contentWindow.location.href);
                        u.searchParams.set('color', c);
                        $refs.pv.src = u.toString();
                    } catch (e) {
                        $refs.pv.src = @js(route('home.preview', ['theme' => 'light'])) + '?color=' + encodeURIComponent(c);
                    }
                })"
                src="{{ route('home.preview', ['theme' => 'light', 'color' => $color]) }}"
                class="absolute inset-0 h-full w-full border-0"
                title="Live site preview"></iframe>
        </div>
    </div>

</div>
