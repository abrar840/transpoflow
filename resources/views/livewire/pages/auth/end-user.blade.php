<?php

use App\Models\User;
use  Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.user')] class extends Component

/** @var Company $company */
{
  
public ?Company $company = null;
    

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;
 
public function register()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->where(function ($query) {
                return $query->where('company_id', $this->company->id);
            }),
        ],
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        'terms' => 'accepted',
    ]);

    // Check if this email is already used by an admin in any company
    $adminExists =User::where('email', $this->email)
        ->whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })
        ->exists();

    if ($adminExists) {
        $this->addError('email', 'This email is already registered as an admin and cannot be used as an end user.');
        return;
    }

    $user = User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'company_id' => $this->company->id,
    ]);

    $user->assignRole(Role::findByName('end_user','end_user'));

    Auth::guard('end_user')->login($user);
    session(['company_name' => $this->company->name]);
    return redirect()->route('user-home', ['company' => $this->company->name]);
}
};
?>

<div>
   
 

  <body>
   
    <main>

      @push('styles')
      @vite('resources/css/enduser/signin_signup.css')
      @endpush
     
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
                <a style="color: lightseagreen" href="{{ route('end-user-login', ['company' => $company->name]) }}">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

  
  </body>

  </html>
</div>