<div>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Rubik:wght@400;500;600;700&display=swap"
    rel="stylesheet">

@php
    if ($theme->theme === 'light'){
      $cssPath='resources/css/enduser/theme1/homepage.css';
    }
    
      
    
elseif($theme->theme === 'dark'){
  $cssPath='resources/css/enduser/theme2/homepage.css';
}
    


@endphp

@push('styles')

@vite($cssPath)
@endpush


  <body id="top">

 
 

    <main>
      <article>

        <section class="section hero" aria-label="home" id="home" style="background-image:  url('{{ Vite::asset('resources/images/peakpx.jpg') }}')">
          <div class="container">

            <div class="hero-content">

              <h2 class="h1 hero-title">
                <span class="span">To Every</span> Direction

              </h2>

              <p class="hero-text">
              Reliable Services – Always Timely and Efficient!
              </p>

              <a href="#" class="btn-outline">View Services</a>

              <img src="{{ Vite::asset('resources/images/hero-shape.png') }}" width="116" height="116" loading="lazy"
                class="hero-shape shape-1">

              <img src="{{ Vite::asset('resources/images/hero-shape.png') }}" width="116" height="116" loading="lazy"
                class="hero-shape shape-2">

            </div>

          </div>
        </section>



        <section class="section about" id="about" aria-label="about">
          <div class="container">

            <figure class="about-banner img-holder" style="--width: 400; --height: 720;">
              <img src="{{ Vite::asset('resources/images/about-banner.jpg') }}" width="400" height="720" loading="lazy"
                alt="" class="img-cover">

              <img src="{{ Vite::asset('resources/images/about-shape-1.png') }}" width="260" height="170" loading="lazy"
                alt="" class="abs-img abs-img-1">

              <img src="{{ Vite::asset('resources/images/about-shape-2.png') }}" width="500" height="500" loading="lazy"
                alt="" class="abs-img abs-img-2">
            </figure>

            <div class="about-content">

              <p class="section-subtitle">Why Choose Us</p>

              <h2 class="h2 section-title">Your Trusted Partner in Seamless Mobility Solutions</h2>

              <p class="section-text">
              We are a professional service provider committed to delivering reliability, efficiency, and excellence across all areas of transport.
              Whether it's booking, scheduling, or managing fleets, our solutions are designed to support smooth operations and customer satisfaction.
              </p>

              <ul class="about-list">

                <li class="about-item">
                  <div class="about-icon">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>

                  <p class="about-text">
                  Driven by Passion
                  </p>
                </li>

                <li class="about-item">
                  <div class="about-icon">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>

                  <p class="about-text">
                  Defined by Quality
                  </p>
                </li>

                <li class="about-item">
                  <div class="about-icon">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>

                  <p class="about-text">
                  Focused on You
                  </p>
                </li>

                <li class="about-item">
                  <div class="about-icon">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>

                  <p class="about-text">
                    Passion-Driven Service
                  </p>
                </li>

                

                <li class="about-item">
                  <div class="about-icon">
                    <ion-icon name="chevron-forward"></ion-icon>
                  </div>

                  <p class="about-text">
                    The quality shows in every move we make where business lives.
                  </p>
                </li>

              </ul>

              <a href="#" class="btn">Learn More</a>

            </div>

          </div>
        </section>
        <!-- 
        - #SERVICE
      -->

        <section class="section service" id="service" aria-label="service">
          <div class="container">

            <p class="section-subtitle">All Services</p>

            <h2 class="h2 section-title">Trusted For Our Services</h2>

           
            <ul class="service-list grid-list">

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/service-icon-1.png') }}" width="80" height="60"
                      loading="lazy" alt="Truck">
                  </div>

                  <h3 class="h3 card-title">
                    <span class="span">01</span> Trusted Mobility
                  </h3>

                  <p class="card-text">
                  We provide reliable services to ensure the smooth and timely movement of people and goods,
                  with a focus on care and accuracy, 
                  </p>

                  <a href="#" class="btn-link">
                    <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

                    <span class="span">View Detail</span>
                  </a>

                </div>
              </li>

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/service-icon-2.png') }}" width="74" height="60"
                      loading="lazy" alt="Ship">
                  </div>

                  <h3 class="h3 card-title">
                    <span class="span">02</span> Smooth Solutions
                  </h3>

                  <p class="card-text">
                  We streamline the movement of goods and individuals, delivering secure,
                  timely, and efficient experiences tailored to your needs
                  </p>

                  <a href="#" class="btn-link">
                    <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

                    <span class="span">View Detail</span>
                  </a>

                </div>
              </li>

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/service-icon-3.png') }}" width="60" height="60"
                      loading="lazy" alt="Airplane">
                  </div>

                  <h3 class="h3 card-title">
                    <span class="span">03</span> Customer Support
                  </h3>

                  <p class="card-text">
                    Our goal is to provide exceptional customer support, ensuring quick responses, and a hassle-free
                    experience every step of the way.
                  </p>

                  <a href="#" class="btn-link">
                    <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>

                    <span class="span">View Detail</span>
                  </a>

                </div>
              </li>

            </ul>

          </div>
        </section>

        <section class="section feature" aria-label="feature">
          <div class="container">

            <div class="title-wrapper">

              <div>
                <p class="section-subtitle">Reliable Service</p>

                <h2 class="h2 section-title">Seamless Mobility Solutions</h2>

                <p class="section-text">
                Experience reliability, efficiency, and comfort with our professional services. 
                We prioritize a smooth and stress-free experience for every customer.
                </p>
              </div>

              <a href="#" class="btn">Read More</a>

            </div>

            <ul class="feature-list grid-list">

              <li>
                <div class="feature-card" style="--card-number: '01'">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/feature-icon-1.png') }}" width="72" height="91" alt="">
                  </div>

                  <h3 class="h3 card-title">Reliable & Secure Journeys</h3>

                  <p class="card-text">
                  Our well-maintained services provide a smooth, safe, and pleasant experience for every customer.
                  </p>

                  <a href="#" class="card-btn" aria-label="Read more">
                    <ion-icon name="arrow-forward"></ion-icon>
                  </a>

                </div>
              </li>

              <li>
                <div class="feature-card" style="--card-number: '02'">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/feature-icon-2.png') }}" width="94" height="94" alt="">
                  </div>

                  <h3 class="h3 card-title">Easy Access Points</h3>

                  <p class="card-text">
                  Our service provides a variety of convenient locations, ensuring a seamless and stress-free experience every time
                  </p>

                  <a href="#" class="card-btn" aria-label="Read more">
                    <ion-icon name="arrow-forward"></ion-icon>
                  </a>

                </div>
              </li>

              <li>
                <div class="feature-card" style="--card-number: '03'">

                  <div class="card-icon">
                    <img src="{{ Vite::asset('resources/images/feature-icon-3.png') }}" width="93" height="93" alt="">
                  </div>

                  <h3 class="h3 card-title">Punctual & Reliable Service</h3>

                  <p class="card-text">
                    We value your time! Our services are always on schedule to ensure a hassle-free trip.
                  </p>

                  <a href="#" class="card-btn" aria-label="Read more">
                    <ion-icon name="arrow-forward"></ion-icon>
                  </a>

                </div>
              </li>
            </ul>

          </div>
        </section>
        <!-- 
        - #NEWSLETTER
      -->

        <section class="section newsletter" aria-label="newsletter">
          <div class="container">

            <figure class="newsletter-banner img-holder">
              <img src="{{ Vite::asset('resources/images/newsletter-banner.png') }}" width="303" height="381"
                alt="newsletter banner" class="w-100">
            </figure>

            <div class="newsletter-content">

              <h2 class="h2 section-title">Subscribe for offers and news</h2>

              <form action="" class="newsletter-form">
                <input type="email" name="email_address" placeholder="Enter Your Email" aria-label="email"
                  class="email-field">

                <button type="submit" class="newsletter-btn">Subscribe Now</button>
              </form>

            </div>

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


  </body>
</div>