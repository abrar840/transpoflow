<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        $user = Auth()->user();

 
// Check if user has 'end-user' role
if ($user->hasRole('admin')) {
    
    Session::regenerate();
    
  
$this->redirectIntended(default: route('home', absolute: false), navigate: true);
    return;
} else {
    Auth::guard('web')->logout();
    $this->addError('form.email', 'The provided credentials do not match our records.');
}



        

        
     

    }
}; ?>
<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Welcome back</h1>
        <p class="mt-1.5 text-sm text-slate-600">Sign in to manage your TranspoFlow account.</p>
    </div>

    {{-- Status --}}
    @if (session('status'))
        <div class="mb-5 flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
            <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="login" class="space-y-5">
        {{-- Email --}}
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
            <input type="email" wire:model="form.email" id="email" name="email" placeholder="you@example.com"
                required autofocus autocomplete="username"
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('form.email') border-red-400 @enderror" />
            @error('form.email') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
            <div class="relative">
                <input type="password" wire:model="form.password" id="password" name="password" placeholder="••••••••"
                    required autocomplete="current-password"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5 pr-11 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('form.password') border-red-400 @enderror" />
                <button type="button" id="togglePassword"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
            @error('form.password') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center gap-2 text-sm text-slate-600">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                {{ __('Remember me') }}
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-indigo-600 transition-colors hover:text-indigo-700">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            Sign in
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Create one</a>
    </p>
    <p class="mt-2 text-center">
        <a href="{{ url('/') }}" class="text-sm text-slate-400 hover:text-slate-600">← Back to home</a>
    </p>
</div>

<!-- Password toggle script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    togglePassword.addEventListener('click', function () {
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  });
</script>