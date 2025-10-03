<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TranspoFlow Ticket Booking </title>
    <link rel="stylesheet" href="ticketbooking.css">
 
    
  @php
  if($theme === 'light') {
    $cssPath = 'resources/css/enduser/theme1/ticketbooking.css';
    $imagePath = 'resources/images/';
   
  } else {
    
    $cssPath = 'resources/css/enduser/theme1/ticketbooking2.css';
    $imagePath = 'resources/images/enduser/images/';
  }
@endphp
 
@vite($cssPath);
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
          <img src="{{ Vite::asset($imagePath . 'logo.png') }}" alt="Company Logo">
        </div>
        <nav class="navbar">
          <ul class="nav-links">
            <li><a href="{{ route('home.preview', ['theme' => $theme]) }}" wire:navigate>Home</a></li>
            <li><a href="{{ route('aboutus.preview', ['theme' => $theme]) }}" wire:navigate>About Us</a></li>
            <li><a href="{{ route('ticketbooking.preview', ['theme' => $theme]) }} " wire:navigate>Ticket Booking</a></li>
            <li><a href="{{ route('cargobooking.preview', ['theme' => $theme]) }}" wire:navigate>Cargo Booking</a></li>
            <li><a href="{{ route('contactus.preview', ['theme' => $theme]) }}" wire:navigate>Contact Us</a></li>
        </ul>
        </nav>
        <div class="sign-in">
          <a href="signin.html" class="sign-in-btn" style="text-decoration: none;">Sign In/Sign Up</a>
        </div>
      </header>

    <section class="hero-section"    style="background: url('{{ Vite::asset($imagePath.'ticket.jpg') }}') no-repeat center center/cover; min-height: 400px;">
        <div class="content-wrapper" style="display: flex; justify-content: space-between;">
            <!-- Left: Booking Form -->
            <div id="dynamicContent">
                <div class="booking-form">
                    <h2>Book Your Ticket</h2>
                    <label for="from">From</label>

                    
                    <select name="from" id="from">
                        <option value="">--Select City--</option>
                        <option value="Karachi">Karachi</option>
                        <option value="Lahore">Lahore</option>
                        <option value="Islamabad">Islamabad</option>
                    </select>

                    <label for="to">To</label>
                    <select name="to" id="to">
                        <option value="">--Select City--</option>
                        <option value="Lahore">Lahore</option>
                        <option value="Islamabad">Islamabad</option>
                        <option value="Karachi">Karachi</option>
                    </select>


                    <label for="date">Date</label>
                    <input type="date" id="date" />
                    <button id="searchButton">Find Your Bus</button>
                </div>
            </div>
    
            <!-- Right: Hero Text / Bus Info -->
            <div class="hero-text" id="heroText" style="width: 50%;">
                <div id="heroContent">
                    <h1>Book Your Ticket Now</h1>
                    <p>
                        We ensure the ticket booking is accessible to passengers at transparent
                        prices with no booking charges. Passengers can get the most accurate real-time
                        data of bus seat availability from among the list of operators.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Bus Data Storage (Hidden Section) -->

    
    
    

    <!-- Fare Calculator Section -->
    <section class="fare-section">
        <div class="fare-calculator">
            <h2>Fare Calculator</h2>
            <label for="fare-from">From</label>
            <select name="fare-from" id="fare-from">
                <option value="">--Select City--</option>
                <option value="Karachi">Karachi</option>
                <option value="Lahore">Lahore</option>
                <option value="Islamabad">Islamabad</option>
            </select>
            <label for="fare-to">To</label>
            <select name="fare-to" id="fare-to">
                <option value="">--Select City--</option>
                <option value="Kashmir">Kashmir</option>
                <option value="Narowal">Narowal</option>
                <option value="Sahiwal">Sahiwal</option>
            </select>
            <label for="fare-seats">Number of Seats</label>
            <input type="number" id="fare-seats" min="1" />
            <label for="passenger">Passenger Type</label>
            <select id="passenger">
                <option value="adult">Adult</option>
                <option value="child">Child</option>
                <option value="senior">Senior</option>
            </select>
            <button id="calculateFareButton">Calculate Fare</button>
            <div class="fare-display">
                <p><strong>Total Fare:</strong> <span id="totalFare">--</span></p>
            </div>
        </div>
        <div class="hero-text" id="heroText" style="width: 50%;">
            <div id="heroContent">
                <h1>Calculate Your Fare Instantly</h1>
                <p>
                    Easily estimate your bus fare with our transparent and accurate fare calculator. Get real-time pricing details with no hidden charges, ensuring a hassle-free travel experience. Our system provides the most up-to-date fare estimates based on your route, operator, and seat availability.
                </p>
            </div>
        </div>
    </section>



    <!-- Footer -->
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



    <!-- Login Form -->
<div class="login-form-container" id="login-form-container">
    <div class="login-form-wrapper">
        <div class="login-form-content">
            <h1 class="login-title">Login to your Account</h1>
            <form action="#" id="form">
                <div class="input-group">
                    <input type="email" placeholder="User email" id="email" class="input-field" />
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" id="password" class="input-field" />
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="checkbox" name="checkbox" />
                    <label for="checkbox">Remember Me</label>
                </div>
                <div class="submit-button">
                    <button id="submit" type="submit">Login</button>
                    <br />
                    <span>Don't have an account?</span>
                    <a href="signup.html">Register</a>
                </div>
            </form>
            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>
