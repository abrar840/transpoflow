<x-marketing-layout>

    {{-- ============================= HERO ============================= --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-indigo-50 via-white to-white">
        <div class="mx-auto max-w-7xl px-6 py-20 lg:flex lg:items-center lg:gap-16 lg:px-8 lg:py-28">

            {{-- Copy --}}
            <div class="max-w-xl lg:flex-1">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                    <i class="fa-solid fa-bolt"></i> No-code · Live in minutes
                </span>

                <h1 class="mt-6 text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Launch your transport business <span class="text-indigo-600">online</span> — no code.
                </h1>

                <p class="mt-6 text-lg leading-relaxed text-slate-600">
                    Sign up, pick your services, and choose a theme. TranspoFlow gives you a branded website where your
                    customers book <strong class="text-slate-800">tickets</strong> and <strong
                        class="text-slate-800">cargo</strong> — while you manage your fleet from one simple dashboard.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('form') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-7 py-3.5 text-base font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 hover:shadow-lg">
                        Create Your Site — Free <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ route('demo.admin') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-7 py-3.5 text-base font-semibold text-slate-700 transition-colors hover:border-indigo-300 hover:text-indigo-600">
                        <i class="fa-solid fa-circle-play text-sm"></i> See a live demo
                    </a>
                </div>

                <p class="mt-5 text-sm text-slate-500">
                    <i class="fa-solid fa-check text-green-500"></i> No credit card required &nbsp;·&nbsp;
                    <i class="fa-solid fa-check text-green-500"></i> Your own branded URL
                </p>
            </div>

            {{-- Visual --}}
            <div class="mt-14 lg:mt-0 lg:flex-1">
                <div class="relative mx-auto max-w-md">
                    <div class="absolute -inset-4 rounded-3xl bg-indigo-200/40 blur-2xl"></div>
                    <div class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-xl">
                        <div class="flex items-center gap-1.5 border-b border-slate-100 pb-4">
                            <span class="h-3 w-3 rounded-full bg-red-400"></span>
                            <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
                            <span class="h-3 w-3 rounded-full bg-green-400"></span>
                            <span class="ml-3 text-xs text-slate-400">yourcompany.transpoflow.com</span>
                        </div>
                        <div class="space-y-4 pt-5">
                            <div class="flex items-center justify-between rounded-xl bg-indigo-50 p-4">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-ticket text-lg text-indigo-600"></i>
                                    <span class="text-sm font-semibold text-slate-700">Book a Ticket</span>
                                </div>
                                <span class="rounded-md bg-indigo-600 px-3 py-1 text-xs font-semibold text-white">Go</span>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 p-4">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-box text-lg text-slate-500"></i>
                                    <span class="text-sm font-semibold text-slate-700">Send Cargo</span>
                                </div>
                                <span class="rounded-md bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-600">Go</span>
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 p-4">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-bus text-lg text-slate-500"></i>
                                    <span class="text-sm font-semibold text-slate-700">Fleet Schedule</span>
                                </div>
                                <span class="rounded-md bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-600">Go</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================= TRUST STRIP ============================= --}}
    <section class="border-y border-slate-100 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
            <p class="text-center text-sm font-medium text-slate-500">
                Everything a transport company needs —
                <span class="font-semibold text-slate-700">Ticket booking</span> ·
                <span class="font-semibold text-slate-700">Cargo booking</span> ·
                <span class="font-semibold text-slate-700">Fleet management</span> — in one place.
            </p>
        </div>
    </section>

    {{-- ============================= HOW IT WORKS ============================= --}}
    <section class="bg-slate-50 py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">How it works</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Your site, live in three steps
                </h2>
                <p class="mt-4 text-lg text-slate-600">No developers, no setup headaches. If you can fill a form, you
                    can launch.</p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-3">
                @php
                    $steps = [
                        ['n' => '1', 'icon' => 'fa-clipboard-list', 'title' => 'Sign up & pick services', 'text' => 'Create your account and choose what you offer — ticket booking, cargo, fleet management, or all three.'],
                        ['n' => '2', 'icon' => 'fa-palette', 'title' => 'Choose a theme', 'text' => 'Select a visual theme that matches your brand. Preview it instantly before you go live.'],
                        ['n' => '3', 'icon' => 'fa-share-nodes', 'title' => 'Share your branded site', 'text' => 'Get your own URL and start taking bookings. Manage everything from your dashboard.'],
                    ];
                @endphp
                @foreach ($steps as $step)
                    <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md">
                        <span
                            class="absolute -top-4 left-8 inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-sm font-bold text-white">{{ $step['n'] }}</span>
                        <div
                            class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
                            <i class="fa-solid {{ $step['icon'] }}"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $step['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= SERVICES ============================= --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">What you can offer</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    One platform, every service
                </h2>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $services = [
                        ['icon' => 'fa-ticket', 'title' => 'Ticket Booking', 'text' => 'Let passengers browse schedules, pick seats, and pay online. Handle pricing, bookings and cancellations with ease.', 'route' => route('demo.ticket')],
                        ['icon' => 'fa-box', 'title' => 'Cargo Booking', 'text' => 'Streamline cargo bookings with flexible weight and volume pricing tiers, all managed from one place.', 'route' => route('demo.cargo')],
                        ['icon' => 'fa-bus', 'title' => 'Fleet Management', 'text' => 'Register vehicles, build schedules, and oversee drivers to keep your operations running smoothly.', 'route' => route('demo.fleet')],
                        ['icon' => 'fa-gauge-high', 'title' => 'Admin Dashboard', 'text' => 'Oversee your whole business — reports, company info, and data export — from a single admin panel.', 'route' => route('demo.admin')],
                        ['icon' => 'fa-headset', 'title' => 'Customer Support', 'text' => 'Built-in messaging and feedback tools so your customers can always reach you.', 'route' => route('services')],
                        ['icon' => 'fa-palette', 'title' => 'Branded Themes', 'text' => 'Pick a look that fits your company and give customers a polished, professional experience.', 'route' => route('services')],
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
                        <a href="{{ $service['route'] }}"
                            class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                            Learn more <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= WHY US ============================= --}}
    <section class="bg-slate-50 py-20 lg:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Why TranspoFlow</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Built for transport operators
                </h2>
            </div>

            <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $features = [
                        ['icon' => 'fa-sliders', 'title' => 'Customizable', 'text' => 'Tailor services and themes to fit exactly how your business works.'],
                        ['icon' => 'fa-wand-magic-sparkles', 'title' => 'No-code', 'text' => 'Launch without writing a single line of code or hiring a developer.'],
                        ['icon' => 'fa-layer-group', 'title' => 'All-in-one', 'text' => 'Tickets, cargo, and fleet — managed together, not across five tools.'],
                        ['icon' => 'fa-life-ring', 'title' => 'Reliable support', 'text' => 'Help when you need it, so your operations never stall.'],
                    ];
                @endphp
                @foreach ($features as $feature)
                    <div class="text-center sm:text-left">
                        <div
                            class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-xl text-white sm:mx-0">
                            <i class="fa-solid {{ $feature['icon'] }}"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $feature['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= CTA BAND ============================= --}}
    <x-marketing-cta />

</x-marketing-layout>
