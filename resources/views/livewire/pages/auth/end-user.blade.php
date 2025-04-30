<?php

use App\Models\User;

use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.user')] class extends Component
{
    public? Company $company = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;

    public function register()
    {   
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'company_id' => $this->company?->id,
           
        ]);

      
        // dd($this->company->id);
      
        $user->assignRole('user');
        Auth::guard('end_user')->login($user);

        return redirect()->route('user-Home', ['company' => $this->company->name]);
    }
};
?>

<div>
  
@vite('resources/css/enduser/signin_signup.css')
 

  <body>
    <header class="w-full bg-white/80 backdrop-blur-md border-b border-white/20 py-4 px-8 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-[#1c1c2b] uppercase tracking-wide">
          {{ $this->company?->name ?? 'Company' }}
      </h1>
  </header>
    <main>
    
      <div class="signup-form-container">
 
        <div class="signup-form-wrapper">
          <div class="signup-form-content">
            <h1 class="signup-title">Create Your Account</h1>
            <form wire:submit.prevent="register" id="signup-form">
              <div class="input-group">
                <input type="text" placeholder="Full Name" class="input-field" wire:model="name" required />
                @error('name') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input type="email" placeholder="Email Address" class="input-field" wire:model="email" required />
                @error('email') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input type="password" placeholder="Password" class="input-field" wire:model="password"
                  required />
                @error('password') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input type="password" placeholder="Confirm Password" class="input-field"
                  wire:model.defer="password_confirmation" required />
              </div>
              <div class="terms">
                <input type="checkbox" id="terms-checkbox" wire:model.defer="terms" required />
                <label for="terms-checkbox">I agree to the <a href="#">Terms & Conditions</a></label>
                @error('terms') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="submit-button">
                <button id="signup-submit" type="submit">Sign Up</button>
                <br />
                <span>Already have an account?</span>
                <a style="color: lightseagreen" href="signin.html">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  
  </body>

  </html>
</div>