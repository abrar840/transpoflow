<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 
  @php
    if($theme === 'light') {
      $cssPath = 'resources/css/enduser/theme1/contact.css';
      $imagePath = 'resources/images/';
    } else {
      $cssPath = 'resources/css/enduser/theme2/contact.css';
      $imagePath = 'resources/images/enduser/images/';
    }
  @endphp
   <link rel="stylesheet" href="{{ Vite::asset($cssPath) }}">
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
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

    <!-- Main Content -->
    <main>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-container">
                <h2 class="contact-title">Contact Us</h2>
                <p class="contact-subtitle">
                    Got a technical issue? Want to send feedback about a beta feature?
                    Need details about our Business plan? Let us know.
                </p>
                <form action="./messageSent.html" class="contact-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-input"
                            placeholder="Anishhhhhh"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="email">Your email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="name@flowbite.com"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            class="form-input"
                            placeholder="Let us know how we can help you"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="message">Your message</label>
                        <textarea
                            id="message"
                            rows="6"
                            name="message"
                            class="form-textarea"
                            placeholder="Leave a comment..."
                        ></textarea>
                    </div>
                    <button type="submit" class="submit-button">Send message</button>
                </form>
            </div>
        </section>
    </main>

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
                <p>Phone: +92 3325302258</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Modern Transport Company. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>