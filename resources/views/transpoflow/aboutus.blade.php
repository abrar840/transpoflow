<x-marketing-layout title="About Us">

    {{-- ============================= PAGE HEADER ============================= --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center lg:py-24">
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">About us</p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                Making transport management effortless
            </h1>
            <p class="mt-5 text-lg leading-relaxed text-slate-600">
                TranspoFlow started with a simple idea: launching a transport business online shouldn't require a
                development team. We combine everything an operator needs — ticketing, cargo, and fleet — into one
                platform any company can set up on their own.
            </p>
        </div>
    </section>

    {{-- ============================= MISSION / VISION / VALUES ============================= --}}
    <section class="bg-slate-50 py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                @php
                    $pillars = [
                        ['icon' => 'fa-bullseye', 'title' => 'Our Mission', 'text' => 'To simplify transportation management and make every journey — for passengers and cargo alike — smarter and more efficient.'],
                        ['icon' => 'fa-eye', 'title' => 'Our Vision', 'text' => 'A future where any transport business, of any size, can run a fully optimized online operation with ease.'],
                        ['icon' => 'fa-heart', 'title' => 'Our Values', 'text' => 'Integrity, innovation, and customer satisfaction guide everything we build — dependable tools designed around real operators.'],
                    ];
                @endphp
                @foreach ($pillars as $pillar)
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                        <div
                            class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
                            <i class="fa-solid {{ $pillar['icon'] }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $pillar['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $pillar['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= WHO IT'S FOR ============================= --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Who it's for</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Built for transport operators
                </h2>
                <p class="mt-4 text-lg text-slate-600">
                    Whether you run buses, coaches, or cargo routes, TranspoFlow gives you the tools to sell and manage
                    online — without the technical overhead.
                </p>
            </div>

            <div class="mx-auto mt-14 grid max-w-4xl gap-6 sm:grid-cols-3">
                @php
                    $audience = [
                        ['icon' => 'fa-bus', 'title' => 'Bus & coach lines', 'text' => 'Sell tickets and manage seats and schedules online.'],
                        ['icon' => 'fa-truck-fast', 'title' => 'Cargo & courier', 'text' => 'Take cargo bookings with clear weight and volume pricing.'],
                        ['icon' => 'fa-warehouse', 'title' => 'Fleet operators', 'text' => 'Keep vehicles, drivers, and routes organised in one place.'],
                    ];
                @endphp
                @foreach ($audience as $item)
                    <div class="text-center">
                        <div
                            class="mx-auto mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-indigo-600 text-xl text-white">
                            <i class="fa-solid {{ $item['icon'] }}"></i>
                        </div>
                        <h3 class="font-bold text-slate-900">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================= CTA BAND ============================= --}}
    <x-marketing-cta heading="Join operators moving smarter" />

</x-marketing-layout>
