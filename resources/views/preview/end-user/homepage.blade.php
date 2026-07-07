<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TranspoFlow - To every direction</title>

  <link rel="shortcut icon" href="{{ Vite::asset('resources/images/favicon.svg') }}" type="image/svg+xml">

  @php
    $cssPath = 'resources/css/enduser/theme1/homepage.css';
    $imagePath = 'resources/images/';
    $brand = ($color ?? null) && preg_match('/^#[A-Fa-f0-9]{6}$/', $color) ? $color : '#f39c12';
  @endphp

  <link rel="stylesheet" href="{{ Vite::asset($cssPath) }}">

  {{-- Live brand color for the preview --}}
  <style>
    :root {
      --brand: {{ $brand }};
      --brand-dark: color-mix(in srgb, {{ $brand }} 82%, black);
      --brand-soft: color-mix(in srgb, {{ $brand }} 12%, white);
    }
  </style>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

<header class="header">
  <div class="logo">
    <img src="{{ Vite::asset($imagePath . 'logo.png') }}" alt="Company Logo">
  </div>
  <nav class="navbar">
    <ul class="nav-links">
      <li><a href="{{ route('home.preview', ['theme' => $theme, 'color' => $color ?? '#f39c12']) }}">Home</a></li>
      <li><a href="{{ route('aboutus.preview', ['theme' => $theme, 'color' => $color ?? '#f39c12']) }}">About Us</a></li>
      <li><a href="{{ route('ticketbooking.preview', ['theme' => $theme, 'color' => $color ?? '#f39c12']) }} ">Ticket Booking</a></li>
      <li><a href="{{ route('cargobooking.preview', ['theme' => $theme, 'color' => $color ?? '#f39c12']) }}">Cargo Booking</a></li>
      <li><a href="{{ route('contactus.preview', ['theme' => $theme, 'color' => $color ?? '#f39c12']) }}">Contact Us</a></li>
  </ul>
  </nav>
  <div class="sign-in">
    <a href="signin.html" class="sign-in-btn" style="text-decoration: none;">Sign In/Sign Up</a>
  </div>
</header>

<main>
  <article>

    <section class="section hero" aria-label="home" id="home"
      style="background-image: url('{{ Vite::asset($imagePath . 'peakpx.jpg') }}')">
      
      <div class="container">
        <div class="hero-content">

          <h2 class="h1 hero-title">
            <span class="span">To Every</span> Direction
          </h2>

          <p class="hero-text">Reliable Transport & Cargo Solutions – On Time, Every Time!</p>

          <a href="#" class="btn-outline">View Services</a>

          <img src="{{ Vite::asset($imagePath . 'hero-shape.png') }}" width="116" height="116" loading="lazy" class="hero-shape shape-1">
          <img src="{{ Vite::asset($imagePath . 'hero-shape.png') }}" width="116" height="116" loading="lazy" class="hero-shape shape-2">

        </div>
      </div>
    </section>

    <section class="section about" id="about" aria-label="about">
      <div class="container">

        <figure class="about-banner img-holder" style="--width: 400; --height: 720;">
          <img src="{{ Vite::asset($imagePath . 'about-banner.jpg') }}" width="400" height="720" loading="lazy" alt="" class="img-cover">
          <img src="{{ Vite::asset($imagePath . 'about-shape-1.png') }}" width="260" height="170" loading="lazy" alt="" class="abs-img abs-img-1">
          <img src="{{ Vite::asset($imagePath . 'about-shape-2.png') }}" width="500" height="500" loading="lazy" alt="" class="abs-img abs-img-2">
        </figure>

        <div class="about-content">
          <p class="section-subtitle">Why Choose Us</p>
          <h2 class="h2 section-title">Your Trusted Partner in Transport & Cargo Services</h2>
          <p class="section-text">
            We are a professional logistics and cargo service provider, committed to delivering efficiency, reliability, and excellence in every move we make.
          </p>

          <ul class="about-list">
            @foreach([
              'Beyond Logistics, Beyond Limits',
              'Innovation, Dedication, and Technology',
              'Safety, Quality & Professionalism',
              'Passion-Driven Service',
              'Quality never goes out of style. Safety, quality, professionalism.',
              'The quality shows in every move we make where business lives.'
            ] as $text)
              <li class="about-item">
                <div class="about-icon">
                  <ion-icon name="chevron-forward"></ion-icon>
                </div>
                <p class="about-text">{{ $text }}</p>
              </li>
            @endforeach
          </ul>

          <a href="#" class="btn">Learn More</a>
        </div>

      </div>
    </section>

    <section class="section service" id="service" aria-label="service">
      <div class="container">
        <p class="section-subtitle">All Services</p>
        <h2 class="h2 section-title">Trusted For Our Services</h2>
        <p class="section-text">Travel with ease and reliability through our well-maintained and professional transport services.</p>

        <ul class="service-list grid-list">
          @foreach([
            ['Ticket Booking', 'service-icon-1.png', 'Our aim is to enhance and streamline your travel experience, ensuring a smooth, comfortable, and hassle-free journey every time'],
            ['Cargo Booking', 'service-icon-2.png', 'Our goal is to simplify and improve cargo transportation, ensuring secure, efficient, and on-time deliveries for your business.'],
            ['Customer Support', 'service-icon-3.png', 'Our goal is to provide exceptional customer support, ensuring quick responses, and a hassle-free experience every step of the way.'],
          ] as $index => [$title, $icon, $desc])
            <li>
              <div class="service-card">
                <div class="card-icon">
                  <img src="{{ Vite::asset($imagePath . $icon) }}" width="80" height="60" loading="lazy" alt="Icon">
                </div>
                <h3 class="h3 card-title"><span class="span">0{{ $index + 1 }}</span> {{ $title }}</h3>
                <p class="card-text">{{ $desc }}</p>
                <a href="#" class="btn-link">
                  <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>
                  <span class="span">View Detail</span>
                </a>
              </div>
            </li>
          @endforeach
        </ul>

      </div>
    </section>

    <section class="section feature" aria-label="feature">
      <div class="container">

        <div class="title-wrapper">
          <div>
            <p class="section-subtitle">Reliable Transport</p>
            <h2 class="h2 section-title">Seamless Travel & Transport Solutions</h2>
            <p class="section-text">
              Experience safe, efficient, and comfortable travel with our professional transport services. We ensure a hassle-free journey for every passenger.
            </p>
          </div>
          <a href="#" class="btn">Read More</a>
        </div>

        <ul class="feature-list grid-list">
          @foreach([
            ['Comfortable & Safe Rides', 'feature-icon-1.png', 'Our modern fleet ensures a smooth, secure, and enjoyable journey for every passenger.'],
            ['Multiple Pickup & Drop Locations', 'feature-icon-2.png', 'Convenient pickup and drop-off points tailored for your travel needs.'],
          ] as $i => [$title, $icon, $desc])
            <li>
              <div class="feature-card" style="--card-number: '0{{ $i+1 }}'">
                <div class="card-icon">
                  <img src="{{ Vite::asset($imagePath . $icon) }}" width="72" height="91" alt="Feature Icon">
                </div>
                <h3 class="h3 card-title">{{ $title }}</h3>
                <p class="card-text">{{ $desc }}</p>
                <a href="#" class="card-btn" aria-label="Read more">
                  <ion-icon name="arrow-forward"></ion-icon>
                </a>
              </div>
            </li>
          @endforeach
        </ul>

      </div>
    </section>

  </article>
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
          <p>Phone: +92 3325302258</p>
      </div>
  </div>
  <div class="footer-bottom">
      <p>&copy; 2025 Modern Transport Company. All rights reserved.</p>
  </div>
</footer>
<script type="module" src="{{ Vite::asset('resources/js/main.js') }}"></script>
</body>
</html>
