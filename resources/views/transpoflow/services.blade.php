<x-marketing-layout title="Services">

    {{-- ============================= PAGE HEADER ============================= --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white">
        <div class="mx-auto max-w-7xl px-6 py-20 text-center lg:px-8 lg:py-24">
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Our services</p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                Everything to run your transport business
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg text-slate-600">
                Turn any of these on with a click when you create your site. Mix and match the services your company
                needs — no code, no setup.
            </p>
        </div>
    </section>

    {{-- ============================= SERVICES GRID ============================= --}}
    <section class="bg-slate-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $services = [
                        ['icon' => 'fa-gauge-high', 'title' => 'Admin Dashboard', 'text' => 'Oversee your entire business — detailed reports, company information, and one-click data export — from a single control panel.'],
                        ['icon' => 'fa-ticket', 'title' => 'Ticket Booking', 'text' => 'Let passengers browse schedules, choose seats, and pay online. Manage pricing, bookings and cancellations effortlessly.'],
                        ['icon' => 'fa-box', 'title' => 'Cargo Booking', 'text' => 'Streamline cargo bookings with flexible weight and volume pricing tiers, handled efficiently in one place.'],
                        ['icon' => 'fa-bus', 'title' => 'Fleet Management', 'text' => 'Register vehicles, build schedules, and oversee drivers so your operations keep running smoothly.'],
                        ['icon' => 'fa-headset', 'title' => 'Customer Support', 'text' => 'Boost satisfaction with built-in messaging, a feedback system, and responsive communication tools.'],
                        ['icon' => 'fa-palette', 'title' => 'Branded Themes', 'text' => 'Choose a professional theme that matches your brand and gives your customers a polished experience.'],
                    ];
                @endphp
                @foreach ($services as $service)
                    <div class="group flex flex-col rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition-all hover:-translate-y-1 hover:border-indigo-200 hover:shadow-lg">
                        <div
                            class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600 transition-colors group-hover:bg-indigo-600 group-hover:text-white">
                            <i class="fa-solid {{ $service['icon'] }}"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                        <a href="{{ route('form') }}"
                            class="mt-6 inline-flex items-center justify-center gap-1.5 rounded-lg bg-indigo-50 px-4 py-2.5 text-sm font-semibold text-indigo-600 transition-colors group-hover:bg-indigo-600 group-hover:text-white">
                            Create Your Site <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= CTA BAND ============================= --}}
    <x-marketing-cta heading="Pick your services and go live" />

</x-marketing-layout>
