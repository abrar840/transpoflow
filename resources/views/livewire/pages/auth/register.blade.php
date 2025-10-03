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
<section class="signup-section">
    <div class="signup-container">
      <div class="signup-form">
        <h3>Create an Account</h3>
        <form wire:submit.prevent="register">
          <!-- Username -->
          <div class="input-container">
            <input type="text" wire:model="name" class="input-field" placeholder="Username" required autofocus autocomplete="name" />
            @error('name') <span class="text-red-500 text-lg">{{ $message }}</span> @enderror
          </div>

          <!-- Email Address -->
          <div class="input-container">
            <input type="email" wire:model="email" class="input-field" placeholder="Email Address" required autocomplete="username" />
            @error('email') <span class="text-red-500 text-lg">{{ $message }}</span> @enderror
          </div>

          <!-- Password -->
          <div class="input-container password-container">
            <input type="password" wire:model="password" class="input-field" id="signupPassword" placeholder="Password" required autocomplete="new-password" />
            <span class="password-toggle" id="toggleSignupPassword">
              <i class="fa fa-eye"></i>
            </span>
            @error('password') <span class="text-red-500 text-lg">{{ $message }}</span> @enderror
          </div>

          <!-- Confirm Password -->
          <div class="input-container password-container">
            <input type="password" wire:model="password_confirmation" class="input-field" id="confirmPassword" placeholder="Confirm Password" required autocomplete="new-password" />
            <span class="password-toggle" id="toggleConfirmPassword">
              <i class="fa fa-eye"></i>
            </span>
            @error('password_confirmation') <span class="text-red-500 text-lg">{{ $message }}</span> @enderror
          </div>

          <!-- Terms & Conditions -->
          <div class="input-container">
            <label>
              <input type="checkbox" required> <a href="#">I agree Terms & Conditions</a>
            </label>
          </div>

          <button type="submit" class="btn-submit">Sign Up</button>
        </form>
        <p class="signin-link">
          Already have an account? <a href="{{ route('login') }}" class="signin-link-text">Sign In</a>
        </p>
      </div>
    </div>
</section>

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