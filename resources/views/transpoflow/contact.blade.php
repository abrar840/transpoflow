<x-marketing-layout title="Contact">

    {{-- ============================= PAGE HEADER ============================= --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center lg:py-24">
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Get in touch</p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                We'd love to hear from you
            </h1>
            <p class="mt-5 text-lg text-slate-600">
                Questions about setting up your site, pricing, or a service? Reach out — we're happy to help.
            </p>
            <a href="mailto:hello@transpoflow.com"
                class="mt-8 inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-7 py-3.5 text-base font-semibold text-white shadow-sm transition-all hover:bg-indigo-700 hover:shadow-lg">
                <i class="fa-solid fa-envelope"></i> Email us — hello@transpoflow.com
            </a>
        </div>
    </section>

    {{-- ============================= CONTACT DETAILS ============================= --}}
    <section class="bg-slate-50 py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid gap-6 sm:grid-cols-3">
                @php
                    $cards = [
                        ['icon' => 'fa-envelope', 'title' => 'Email', 'value' => 'hello@transpoflow.com', 'href' => 'mailto:hello@transpoflow.com'],
                        ['icon' => 'fa-location-dot', 'title' => 'Office', 'value' => 'Lahore, Pakistan', 'href' => null],
                        ['icon' => 'fa-rocket', 'title' => 'Ready to start?', 'value' => 'Create your site', 'href' => route('theme-preview')],
                    ];
                @endphp
                @foreach ($cards as $card)
                    <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                        <div
                            class="mx-auto mb-5 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
                            <i class="fa-solid {{ $card['icon'] }}"></i>
                        </div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500">{{ $card['title'] }}</h3>
                        @if ($card['href'])
                            <a href="{{ $card['href'] }}"
                                class="mt-2 inline-block text-lg font-bold text-slate-900 hover:text-indigo-600">{{ $card['value'] }}</a>
                        @else
                            <p class="mt-2 text-lg font-bold text-slate-900">{{ $card['value'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Map --}}
            <div class="mt-12 overflow-hidden rounded-2xl border border-slate-200 shadow-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d717444.2623315892!2d74.2047463!3d31.549671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190474247b34bb%3A0x69b87c21f72bc4d5!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2sin!4v1615349247157!5m2!1sen!2sin"
                    width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="TranspoFlow location"></iframe>
            </div>
        </div>
    </section>

    {{-- ============================= CTA BAND ============================= --}}
    <x-marketing-cta />

</x-marketing-layout>
