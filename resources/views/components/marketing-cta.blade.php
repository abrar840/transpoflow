@props(['heading' => 'Ready to put your transport business online?', 'sub' => 'Create your branded site in minutes — pick your services, choose a theme, and start taking bookings today.'])

<section class="bg-white py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-indigo-600 px-8 py-16 text-center shadow-xl sm:px-16">
            <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-indigo-500/40 blur-3xl"></div>
            <div class="absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-indigo-700/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    {{ $heading }}
                </h2>
                <p class="mt-4 text-lg text-indigo-100">
                    {{ $sub }}
                </p>
                <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="{{ route('theme-preview') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-7 py-3.5 text-base font-semibold text-indigo-600 shadow-sm transition-all hover:bg-indigo-50 hover:shadow-lg">
                        Create Your Site — Free <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ route('demo.admin') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-indigo-400 px-7 py-3.5 text-base font-semibold text-white transition-colors hover:bg-indigo-500">
                        <i class="fa-solid fa-circle-play text-sm"></i> See a demo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
