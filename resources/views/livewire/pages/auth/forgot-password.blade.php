<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">Forgot password?</h1>
        <p class="mt-1.5 text-sm text-slate-600">
            {{ __('Enter your email and we\'ll send you a link to reset your password.') }}
        </p>
    </div>

    {{-- Status --}}
    @if (session('status'))
        <div class="mb-5 flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
            <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
    @endif

    <form wire:submit="sendPasswordResetLink" class="space-y-5">
        {{-- Email --}}
        <div>
            <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
            <input type="email" wire:model="email" id="email" name="email" placeholder="you@example.com" required autofocus
                class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200 @error('email') border-red-400 @enderror" />
            @error('email') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-colors hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
            {{ __('Email password reset link') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">← Back to sign in</a>
    </p>
</div>
