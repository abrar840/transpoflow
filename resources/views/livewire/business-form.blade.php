<div class="min-h-screen bg-slate-50 py-10 font-sans text-slate-700">
    <div class="mx-auto max-w-3xl px-4 sm:px-6">

        {{-- Brand / heading --}}
        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xl font-extrabold text-slate-900">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                    <i class="fa-solid fa-route text-sm"></i>
                </span>
                Transpo<span class="text-indigo-600">Flow</span>
            </a>
            <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                Create your company site
            </h1>
            <p class="mx-auto mt-3 max-w-lg text-slate-600">
                Tell us about your business and pick your services. You'll be taking bookings on your own branded site in
                minutes.
            </p>
        </div>

        {{-- Success flash --}}
        @if (session()->has('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-6">

            {{-- ============ COMPANY DETAILS ============ --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="flex items-center gap-2 text-lg font-bold text-slate-900">
                        <i class="fa-solid fa-building text-indigo-600"></i> Company details
                    </h2>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                        <i class="fa-solid fa-palette"></i> Theme: {{ ucfirst($theme) }}
                    </span>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    {{-- Company name --}}
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Company name</label>
                        <input type="text" wire:model="name" placeholder="e.g. Skyline Transport"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('name') border-red-400 @enderror">
                        @error('name') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Company type --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Company type</label>
                        <select wire:model="type"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('type') border-red-400 @enderror">
                            <option value="">Select type…</option>
                            <option value="fleet">Fleet Company</option>
                            <option value="shuttle">Shuttle Company</option>
                            <option value="transport">Transport Company</option>
                        </select>
                        @error('type') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Employees --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Number of employees</label>
                        <select wire:model="num_employees"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('num_employees') border-red-400 @enderror">
                            <option value="">Select…</option>
                            <option value="<5">Less than 5</option>
                            <option value="5-20">5 to 20</option>
                            <option value="20-100">20 to 100</option>
                            <option value="100-250">100 to 250</option>
                            <option value=">250">More than 250</option>
                        </select>
                        @error('num_employees') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Address --}}
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Company address</label>
                        <input type="text" wire:model="address" placeholder="City, country"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('address') border-red-400 @enderror">
                        @error('address') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- ============ SERVICES ============ --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h2 class="mb-1 flex items-center gap-2 text-lg font-bold text-slate-900">
                    <i class="fa-solid fa-layer-group text-indigo-600"></i> Choose your services
                </h2>
                <p class="mb-5 text-sm text-slate-500">Select everything your company offers — you can adjust later.</p>

                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach ($availableSerivces as $service)
                        <label
                            class="flex cursor-pointer items-center gap-3 rounded-xl border p-4 transition-all has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 has-[:checked]:ring-1 has-[:checked]:ring-indigo-500 {{ 'border-slate-200 hover:border-indigo-300 hover:bg-slate-50' }}">
                            <input type="checkbox" wire:model="services" value="{{ $service->id }}"
                                class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm font-semibold text-slate-800">{{ $service->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('services') <p class="mt-3 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
            </div>

            {{-- ============ ADMIN & BRANDING ============ --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h2 class="mb-6 flex items-center gap-2 text-lg font-bold text-slate-900">
                    <i class="fa-solid fa-user-shield text-indigo-600"></i> Admin & branding
                </h2>

                <div class="grid gap-5 sm:grid-cols-2">
                    {{-- Admin username --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Admin username</label>
                        <input type="text" wire:model="admin_username" placeholder="e.g. skyline_admin"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('admin_username') border-red-400 @enderror">
                        @error('admin_username') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Company logo <span class="font-normal text-slate-400">(optional)</span>
                        </label>
                        <input type="file" wire:model="logo" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-600 hover:file:bg-indigo-100">
                        <div wire:loading wire:target="logo" class="mt-1.5 text-xs text-slate-400">Uploading…</div>
                        @error('logo') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    {{-- Brand color --}}
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Brand color
                            <span class="font-normal text-slate-400">— this tints your public site</span>
                        </label>
                        <div class="flex flex-wrap items-center gap-3">
                            <input type="color" wire:model.live="brand_color"
                                class="h-11 w-14 cursor-pointer rounded-lg border border-slate-300 bg-white p-1">
                            <input type="text" wire:model.live="brand_color" placeholder="#f39c12"
                                class="w-32 rounded-lg border border-slate-300 px-3 py-2.5 text-sm uppercase shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            {{-- Quick presets --}}
                            @foreach (['#f39c12','#7c3aed','#2563eb','#059669','#e11d48','#0891b2'] as $preset)
                                <button type="button" wire:click="$set('brand_color', '{{ $preset }}')"
                                    class="h-8 w-8 rounded-full border-2 border-white shadow ring-1 ring-slate-200"
                                    style="background: {{ $preset }};" title="{{ $preset }}"></button>
                            @endforeach
                            {{-- Live swatch --}}
                            <span class="ml-auto inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-white"
                                style="background: {{ preg_match('/^#[A-Fa-f0-9]{6}$/', $brand_color) ? $brand_color : '#f39c12' }};">
                                <i class="fa-solid fa-eye"></i> Preview
                            </span>
                        </div>
                        @error('brand_color') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- ============ SUBMIT ============ --}}
            <div class="flex flex-col items-center gap-3">
                <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-8 py-3.5 text-base font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 hover:shadow-lg disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto">
                    <span wire:loading.remove wire:target="submit">
                        <i class="fa-solid fa-rocket mr-1"></i> Start creating my website
                    </span>
                    <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch fa-spin"></i> Creating…
                    </span>
                </button>
                <p class="text-xs text-slate-400">
                    <i class="fa-solid fa-lock"></i> Your details are used only to set up your company site.
                </p>
            </div>
        </form>
    </div>
</div>
