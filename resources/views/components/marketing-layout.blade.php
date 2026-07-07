@props(['title' => null])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ? $title . ' — TranspoFlow' : 'TranspoFlow — Launch your transport business online' }}</title>
    <meta name="description"
        content="TranspoFlow is the no-code platform for transport companies. Sign up, pick your services, and launch a branded site where your customers book tickets and cargo.">

    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white font-sans text-slate-700 antialiased">

    {{-- ============================= NAV ============================= --}}
    <header x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 8)"
        class="sticky top-0 z-50 border-b border-transparent transition-all duration-300"
        :class="scrolled ? 'bg-white/90 backdrop-blur border-slate-200 shadow-sm' : 'bg-white'">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8" aria-label="Global">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-extrabold text-slate-900">
                <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">
                    <i class="fa-solid fa-route text-sm"></i>
                </span>
                Transpo<span class="text-indigo-600">Flow</span>
            </a>

            {{-- Desktop links --}}
            <div class="hidden items-center gap-8 lg:flex">
                @php
                    $links = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'Services', 'route' => 'services'],
                        ['label' => 'About', 'route' => 'aboutus'],
                        ['label' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                        class="text-sm font-semibold transition-colors hover:text-indigo-600 {{ request()->routeIs($link['route']) ? 'text-indigo-600' : 'text-slate-700' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Desktop CTAs --}}
            <div class="hidden items-center gap-3 lg:flex">
                @guest
                    <a href="{{ route('login') }}"
                        class="rounded-lg px-4 py-2 text-sm font-semibold text-slate-700 transition-colors hover:text-indigo-600">
                        Sign In
                    </a>
                    <a href="{{ route('theme-preview') }}"
                        class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 hover:shadow">
                        Create Your Site
                    </a>
                @endguest
                @auth
                    <a href="/admin"
                        class="rounded-lg px-4 py-2 text-sm font-semibold text-slate-700 transition-colors hover:text-indigo-600">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-slate-700">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button @click="open = !open"
                class="inline-flex items-center justify-center rounded-lg p-2 text-slate-700 lg:hidden"
                aria-label="Toggle menu">
                <i class="fa-solid fa-bars text-lg" x-show="!open"></i>
                <i class="fa-solid fa-xmark text-lg" x-show="open" x-cloak></i>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak x-transition
            class="border-t border-slate-200 bg-white px-6 py-4 lg:hidden">
            <div class="flex flex-col gap-1">
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                        class="rounded-lg px-3 py-2 text-base font-semibold {{ request()->routeIs($link['route']) ? 'bg-indigo-50 text-indigo-600' : 'text-slate-700 hover:bg-slate-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <div class="mt-3 flex flex-col gap-2 border-t border-slate-200 pt-4">
                    @guest
                        <a href="{{ route('login') }}"
                            class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700">Sign
                            In</a>
                        <a href="{{ route('theme-preview') }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white">Create
                            Your Site</a>
                    @endguest
                    @auth
                        <a href="/admin"
                            class="rounded-lg border border-slate-300 px-4 py-2 text-center text-sm font-semibold text-slate-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- ============================= PAGE ============================= --}}
    <main>
        {{ $slot }}
    </main>

    {{-- ============================= FOOTER ============================= --}}
    <footer class="border-t border-slate-200 bg-slate-900 text-slate-300">
        <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-xl font-extrabold text-white">
                        <span
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                            <i class="fa-solid fa-route text-sm"></i>
                        </span>
                        Transpo<span class="text-indigo-400">Flow</span>
                    </a>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">
                        The no-code platform for transport companies. Launch a branded site where your customers book
                        tickets and cargo — while you manage your fleet from one dashboard.
                    </p>
                    <a href="{{ route('theme-preview') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-indigo-500">
                        Create Your Site <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                {{-- Links --}}
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Explore</h3>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white">Services</a></li>
                        <li><a href="{{ route('aboutus') }}" class="hover:text-white">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Get in touch</h3>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li>
                            <a href="mailto:hello@transpoflow.com" class="hover:text-white">
                                <i class="fa-solid fa-envelope mr-2 text-indigo-400"></i>hello@transpoflow.com
                            </a>
                        </li>
                        <li>
                            <span><i class="fa-solid fa-location-dot mr-2 text-indigo-400"></i>Lahore, Pakistan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-slate-800 pt-8 text-sm text-slate-400 sm:flex-row">
                <p>&copy; {{ date('Y') }} TranspoFlow. All rights reserved.</p>
                <a href="{{ route('theme-preview') }}" class="font-semibold text-white hover:text-indigo-400">Get started
                    free →</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
