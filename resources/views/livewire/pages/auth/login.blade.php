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


<div class="signin-section">

    
    @if (session('status'))
    <div class="mb-4 text-green-600">
        {{ session('status') }}
    </div>

@endif

    <div class="signin-container">
        <div class="signin-form">
            <h3>Sign In</h3>
            <form wire:submit.prevent="login">
                <!-- Email Address -->
                <div class="input-container">
                    <input type="email" wire:model="form.email" id="email" name="email" class="input-field" placeholder="Email Address" required autofocus autocomplete="username" />
                    @error('form.email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <!-- Password -->
                <div class="input-container password-container">
                    <input type="password" wire:model="form.password" id="password" name="password" class="input-field" placeholder="Password" required autocomplete="current-password" />
                    <span class="password-toggle" id="togglePassword">
                        <i class="fa fa-eye"></i>
                    </span>
                    @error('form.password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <!-- Remember Me -->
                <div class="block mt-4 text-left ps-4">
  <label for="remember" class="inline-flex items-center text-lg">
    <input 
      wire:model="form.remember"
      id="remember" 
      type="checkbox"
      class="w-5 h-5 me-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
      name="remember">
    <span class="text-lg text-white">Remember me</span>
  </label>
</div>

                <!-- Session Status/Error -->
                @if (session('status'))
                    <div class="mb-4 text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->has('form.email'))
                    <div class="mb-2 text-red-500 text-xs">
                        {{ $errors->first('form.email') }}
                    </div>
                @endif
                <button type="submit" class="btn-submit mt-4">Sign In</button>
            </form>
            <p class="create-account mt-4">
                Don't have an account? <a href="{{ route('register') }}" class="create-account-link">Create one</a>
            </p>
            <a href="{{ url('/') }}" style="color: lightgray;">Go to Home</a>
        </div>
    </div>
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