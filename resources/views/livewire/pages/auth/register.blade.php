<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        $user->assignRole('admin');
        

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Create an account</h1>
        <p class="mt-1.5 text-sm text-slate-600">Start taking bookings on your own branded site in minutes.</p>
    </div>

    <form wire:submit.prevent="register" class="space-y-5">
        {{-- Username --}}
        <div>
            <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Username</label>
            <input type="text" wire:model="name" id="name" placeholder="Your name" required autofocus autocomplete="name"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('name') border-red-400 @enderror" />
            @error('name') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
            <input type="email" wire:model="email" id="email" placeholder="you@example.com" required autocomplete="username"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('email') border-red-400 @enderror" />
            @error('email') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="signupPassword" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <div class="relative">
                <input type="password" wire:model="password" id="signupPassword" placeholder="••••••••" required autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pr-11 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('password') border-red-400 @enderror" />
                <button type="button" id="toggleSignupPassword"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
            @error('password') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="confirmPassword" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm password</label>
            <div class="relative">
                <input type="password" wire:model="password_confirmation" id="confirmPassword" placeholder="••••••••" required autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pr-11 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('password_confirmation') border-red-400 @enderror" />
                <button type="button" id="toggleConfirmPassword"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Terms --}}
        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
            <input type="checkbox" required class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
            I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-700">Terms &amp; Conditions</a>
        </label>

        <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            Create account
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Sign in</a>
    </p>
</div>

<!-- Password toggle script (unchanged) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleSignupPassword = document.getElementById('toggleSignupPassword');
    const signupPasswordField = document.getElementById('signupPassword');
    toggleSignupPassword.addEventListener('click', function () {
      const type = signupPasswordField.type === 'password' ? 'text' : 'password';
      signupPasswordField.type = type;
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordField = document.getElementById('confirmPassword');
    toggleConfirmPassword.addEventListener('click', function () {
      const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
      confirmPasswordField.type = type;
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  });
</script>