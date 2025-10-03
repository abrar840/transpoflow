<?php
 

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{   public ?\App\Models\Company $company = null;
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
            'password' => 'required|min:6|same:password_confirmation',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'company_id' => $this->company?->id, // associate user with company
        ]);

        $user->assignRole('user');

        Auth::guard('end_user')->login($user);
        
        session(['company_name' => $this->company->name]); // or company_id
        

        return redirect()->route('user-Home', ['company' => $this->company->name]);
    }
};
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up - TranspoFlow </title>
    <link rel="stylesheet" href="signin_signup.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <main>
      <div class="signup-form-container">
        <div class="signup-form-wrapper">
          <div class="signup-form-content">
            <h1 class="signup-title">Create Your Account</h1>
            <form wire:submit.prevent="register" id="signup-form">
              <div class="input-group">
                <input
                  type="text"
                  placeholder="Full Name"
                  class="input-field"
                  wire:model.defer="name"
                  required
                />
                @error('name') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input
                  type="email"
                  placeholder="Email Address"
                  class="input-field"
                  wire:model.defer="email"
                  required
                />
                @error('email') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input
                  type="password"
                  placeholder="Password"
                  class="input-field"
                  wire:model.defer="password"
                  required
                />
                @error('password') <span class="error">{{ $message }}</span> @enderror
              </div>
              <div class="input-group">
                <input
                  type="password"
                  placeholder="Confirm Password"
                  class="input-field"
                  wire:model.defer="password_confirmation"
                  required
                />
              </div>
              <div class="terms">
                <input
                  type="checkbox"
                  id="terms-checkbox"
                  wire:model.defer="terms"
                  required
                />
                <label for="terms-checkbox"
                  >I agree to the <a href="#">Terms & Conditions</a></label
                >
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

    <footer class="footer">
      <div class="footer-content">
          <div class="footer-section">
              <h3>About Us</h3>
              <p>We are a company dedicated to innovation and modern design.</p>
          </div>
          <div class="footer-section">
              <h3>Quick Links</h3>
              <ul>
                  <li><a href="homepage.html">Home</a></li>
                  <li><a href="aboutus.html">About Us</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
              </ul>
          </div>
          <div class="footer-section">
              <h3>Contact Info</h3>
              <p>Email: transpoflow2@example.com</p>
              <p>Phone: 92 3325302258</p>
          </div>
      </div>
      <div class="footer-bottom">
          <p>&copy; 2025 Modern Transport Company. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>