<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.user')] class extends Component
{
    public LoginForm $form;


    public $company;

public function mount($company)
{
    $this->company = \App\Models\Company::where('name', $company)->firstOrFail();
}



    /**
     * Handle an incoming authentication request.
     */
     public function login(): void
{
    $this->validate();

    // Attempt login with end_user guard
    if (Auth::guard('end_user')->attempt([
        'email' => $this->form->email,
        'password' => $this->form->password,
        'company_id' => $this->company->id,
    ], $this->form->remember)) {
        $user = Auth::guard('end_user')->user();
           
        // Check if user has 'end-user' role
        if ($user->hasRole('end_user')) {
            session(['company_name' => $this->company->name]);
            session()->regenerate();
            
            $this->redirectIntended(route('user-home', ['company' => $this->company->name]), navigate: true);
            return;
        } else {
            Auth::guard('end_user')->logout();
            $this->addError('form.email', 'You do not have permission to log in as an end user.');
        }
    } else {
        $this->addError('form.email', 'The provided credentials do not match our records.');
    }
}



public function layoutData():array
    {
        return [
            'company' => $this->company,
        ];
    }




    }










        // $this->form->authenticate();

        // Session::regenerate();

        // $this->redirectIntended(default: route('home', absolute: false), navigate: true);
 ?>



<main>
  <header class="w-full bg-white/80 backdrop-blur-md border-b border-white/20 py-4 px-8 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-[#1c1c2b] uppercase tracking-wide">
        {{ $this->company?->name ?? 'Company' }}
    </h1>
</header>
  @vite('resources/css/enduser/signin_signup.css')
  <div class="login-form-container">
    <div class="login-form-wrapper">
      <div class="login-form-content">
        <h1 class="login-title">Login to your Account</h1>
        <form wire:submit.prevent="login" id="form">
          <div class="input-group">
            <input type="email" placeholder="User email" id="email" class="input-field" wire:model="form.email" required
              autocomplete="username" />
            @error('form.email') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="input-group">
            <input type="password" placeholder="Password" id="password" class="input-field" wire:model="form.password"
              required autocomplete="current-password" />
            @error('form.password') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="remember-me">
            <input type="checkbox" id="checkbox" name="checkbox" wire:model="form.remember" />
            <label for="checkbox">Remember Me</label>
          </div>
          <div class="submit-button">
            <button id="submit" type="submit">Login</button>
            <br />
            <span>Don't have an account?</span>
            <a style="color: lightseagreen"
              href="{{ route('end-user-register', ['company' => $company->name]) }}">Register</a>
          </div>
        </form>
        <div class="forgot-password">
          <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
</main>