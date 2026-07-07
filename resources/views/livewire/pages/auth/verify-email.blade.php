<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('home', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6 text-center">
        <span class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
            <i class="fa-solid fa-envelope-open-text text-lg"></i>
        </span>
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Verify your email</h1>
        <p class="mt-1.5 text-sm text-slate-600">
            {{ __('Thanks for signing up! Please verify your email by clicking the link we just sent you. Didn\'t get it? We\'ll gladly send another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
            <i class="fa-solid fa-circle-check"></i>
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <button wire:click="sendVerification" type="button"
        class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
        {{ __('Resend verification email') }}
    </button>

    <p class="mt-6 text-center">
        <button wire:click="logout" type="button" class="text-sm font-medium text-slate-500 hover:text-slate-700">
            {{ __('Log out') }}
        </button>
    </p>
</div>
