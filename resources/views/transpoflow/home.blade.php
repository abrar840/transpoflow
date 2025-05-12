<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>TranspoFlow</title>
  <meta name="title" content="TranspoFlow">
  <meta name="description" content="Website for transportcompanies">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favic on.svg" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap" rel="stylesheet">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  @vite('resources/css/style.css')

</head>

<body id="top">

  <!-- 
    - #PRELOADER
  -->

  <div class="preload" data-preaload>
    <div class="circle"></div>
    <p class="text">Transpoflow</p>
  </div>





  <!-- 
    - #TOP BAR
  -->

 





  <!-- 
    - #HEADER
  -->


  <x-header />




  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero text-center" aria-label="home" id="home">

        @php
        $services = [
            [
                'image' => 'images/hero-slider-1.jpg',
                'tagline' => 'Seamless Transport',
                'title' => 'Simplify your <br> Transport Business',
                'description' => 'Your Road to Effortless Management Begins Here!',
            ],
            [
                'image' => 'images/hero-slider-2.jpg',
                'tagline' => 'Effortless Management',
                'title' => 'Create. Manage.<br> Scale.',
                'description' => 'Your Road to Effortless Management Begins Here!',
            ],
            [
                'image' => 'images/hero-slider-3.jpg',
                'tagline' => 'Manage Smarter',
                'title' => 'Empowering Business to<br> Move Smarter!',
                'description' => 'Your Road to Effortless Management Begins Here!',
            ],
        ];
    @endphp
    
    <ul class="hero-slider" data-hero-slider>
        @foreach ($services as $index => $service)
            <li class="slider-item {{ $loop->first ? 'active' : '' }}" data-hero-slider-item>
    
                <div class="slider-bg">
                    <img src="{{ asset($service['image']) }}" width="1880" height="950" alt="" class="img-cover">
                </div>
    
                <p class="label-2 section-subtitle slider-reveal">{{ $service['tagline'] }}</p>
    
                <h1 class="display-1 hero-title slider-reveal">
                    {!! $service['title'] !!}
                </h1>
    
                <p class="body-2 hero-text slider-reveal">
                    {{ $service['description'] }}
                </p>
    
                @guest
                <a href="/login" class="btn btn-primary slider-reveal">
                    <span class="text text-1" aria-hidden="true">Create Website</span>
                </a>
                @endguest
    
                @auth
                @if(auth()->user()->company)
                    <a href="/admin" class="btn btn-primary slider-reveal">
                        <span class="text text-1" aria-hidden="true">view : {{ auth()->user()->company->name }}</span>
                    </a>
                @else
                    <a href="/p" class="btn btn-primary slider-reveal">
                        <span class="text text-1" aria-hidden="true">Create-One</span>
                    </a>
                @endif
                @endauth
    
            </li>
        @endforeach
    </ul>
    
        <button class="slider-btn prev" aria-label="slide to previous" data-prev-btn>
          <ion-icon name="chevron-back"></ion-icon>
        </button>

        <button class="slider-btn next" aria-label="slide to next" data-next-btn>
          <ion-icon name="chevron-forward"></ion-icon>
        </button>


        @auth
        @if(auth()->user()->company)

        <a href="/admin" class="hero-btn has-after">
          <img src="images/hero-icon.png" width="48" height="48" alt="booking icon">

          <span class="label-2 text-center span">{{auth()->user()->company->name}}</span>
        </a>
        @else
        <a href="/p" class="hero-btn has-after">
          <img src="images/hero-icon.png" width="48" height="48" alt="booking icon">

          <span class="label-2 text-center span">Create Now</span>
        </a>
        @endif

        @endauth

        @guest
        <p class="hero-btn has-after">
          <img src="images/hero-icon.png" width="48" height="48" alt="booking icon">

          <span class="label-2 text-center span">login or register to start</span>
        </p>
        @endguest




      </section>





      <!-- 
        - #SERVICE
      -->

      <section class="section service bg-black-10 text-center" aria-label="service">
        <div class="container">

          <p class="section-subtitle label-2">Efficient Logistics</p>

          <h2 class="headline-1 section-title">Our Top Services</h2>

          <p class="section-text">
          
          </p>

          <ul class="grid-list">

            <li>
              <div class="service-card">

                <a href="#" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="images/fms.jpg" width="285" height="336" loading="lazy" alt="Breakfast" class="img-cover">
                  </figure>
                </a>

                <div class="card-content">




                  @auth

                  @if (auth()->user()->company)
                  <h3 class="title-4 card-title">Let's Start
                    {{-- <a href="/admin">{{ auth()->user()->company->name }}</a> --}}
                  </h3>
                  <a href="/admin" class="btn-text hover-underline label-2" wire:navigate>admin panel</a>
                  @else
                  <h3 class="title-4 card-title">
                    <a href="/p">Create One</a>
                  </h3>
                  <a href="/p" class="btn-text hover-underline label-2" wire:navigate>click to continue</a>
                  @endif
                  @endauth

                  @guest
                  <h3 class="title-4 card-title">
                    <a href="{{ route('login') }}"></a>
                  </h3>
                  <a href="{{ route('login') }}" class="btn-text hover-underline label-2" wire:navigate>login to
                    continue</a>
                  @endguest







                </div>

              </div>
            </li>

            <li>
              <div class="service-card">

                <a href="{{route('demo.admin')}}" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="images/service-2.jpg" width="285" height="336" loading="lazy" alt="Appetizers"
                      class="img-cover">
                  </figure>
                </a>

                <div class="card-content">

                  <h3 class="title-4 card-title">
                    <a href="{{route('demo.admin')}}">Admin Dashboard</a>
                  </h3>

                  <a href="{{route('demo.admin')}}" class="btn-text hover-underline label-2">View demo</a>

                </div>

              </div>
            </li>

            <li>
              <div class="service-card">

                <a href="#" class="has-before hover:shine">
                  <figure class="card-banner img-holder" style="--width: 285; --height: 336;">
                    <img src="images/cms.jpg" width="285" height="336" loading="lazy" alt="Drinks" class="img-cover">
                  </figure>
                </a>

                <div class="card-content">

                  <h3 class="title-4 card-title">
                    <a href="#">Our Services</a>
                  </h3>

                  <a href="/services" class="btn-text hover-underline label-2">View services</a>

                </div>

              </div>
            </li>

          </ul>

         
        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      <section class="section about text-center" aria-labelledby="about-label" id="about">
        <div class="container">

          <div class="about-content">

            <p class="label-2 section-subtitle" id="about-label">Our Story</p>

            <h2 class="headline-1 section-title">Our Journey Towards Revolutionizing Transport Management</h2>

            <p class="section-text">
            At TranspoFlow, we started with a simple goal: to make transport management easier, smarter, and more efficient.
            By using modern technology, we help businesses improve their daily operations, offer better services to customers, and grow faster.
            Our focus on quality and innovation is helping shape the future of transport management, one company at a time.
            </p>

            <a href="aboutus.html" class="btn btn-primary">
              <span class="text text-1">Read More</span>

              <span class="text text-2" aria-hidden="true">Read More</span>
            </a>

          </div>

          <figure class="about-banner">

            <img src="images/about-banner.png" width="570" height="570" loading="lazy" alt="about banner" class="w-100"
              data-parallax-item data-parallax-speed="1">

            <div class="abs-img abs-img-1 has-before" data-parallax-item data-parallax-speed="1.75">
              <img src="images/about-abs-image.jpg" width="285" height="285" loading="lazy" alt="" class="w-100">
            </div>



          </figure>

          

        </div>
      </section>




      <!-- 
        - #services
      -->

      <section class="section services" aria-label="services-label" id="services">
        <div class="container">

          <p class="section-subtitle text-center label-2">Special Selection</p>

          <h2 class="headline-1 section-title text-center">Our services</h2>

          <ul class="grid-list">

            <li>
              <div class="services-card hover:card">


              <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
  <img src="images/service-2.png" width="100" height="100" loading="lazy" alt="admin-dashboard"
    class="img-cover">
</figure>


                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Admin Dashboard</a>
                    </h3>

                    <span class="badge label-1">HOT</span>


                  </div>

                  <p class="card-text label-1">
                    Effortlessly oversee your business detailed reports, and company information management.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="services-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="images/service-3.jpg" width="100" height="100" loading="lazy" alt="tms"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Ticket Management System</a>
                    </h3>

                  </div>

                  <p class="card-text label-1">
                    Simplify ticket pricing, bookings, and cancellations to provide a seamless experience for your
                    passengers
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="services-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="images/service-4.png" width="100" height="100" loading="lazy" alt="cms"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Cargo Managment System</a>
                    </h3>

                  </div>

                  <p class="card-text label-1">
                    Streamline cargo bookings, handle efficiently, and optimize pricing managment.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="services-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="images/service-5.jpg" width="100" height="100" loading="lazy" alt="fms"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Fleet Management System</a>
                    </h3>

                    <span class="badge label-1">HOT</span>

                  </div>

                  <p class="card-text label-1">
                    Manage vehicle details, create schedules, and oversee drivers to keep your operations running
                    smoothly.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="services-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <img src="images/service-6.png" width="100" height="100" loading="lazy" alt="csm"
                    class="img-cover">
                </figure>

                <div>

                  <div class="title-wrapper">
                    <h3 class="title-3">
                      <a href="#" class="card-title">Customer Support Managment</a>
                    </h3>

                  </div>

                  <p class="card-text label-1">
                    Enhance customer satisfaction with instant chat support, a feedback system, and responsive
                    communication tools.
                  </p>

                </div>

              </div>
            </li>



          </ul>



          <a href="#" class="btn btn-primary">
            <span class="text text-1">View All services</span>

            <span class="text text-2" aria-hidden="true">View All services</span>
          </a>

          

        </div>
      </section>




      <!-- 
        - #FEATURES
      -->

      <section class="section features text-center" aria-label="features">
        <div class="container">

          <p class="section-subtitle label-2">Why Choose Us</p>

          <h2 class="headline-1 section-title">Our Strength</h2>

          <ul class="grid-list">

            <li class="feature-item">
              <div class="feature-card">

                <div class="card-icon">
                  <img src="images/features-icon-1.png" width="100" height="80" loading="lazy" alt="icon">
                </div>

                <h3 class="title-2 card-title">Customizable Solutions</h3>

                <p class="label-1 card-text">Tailored services to fit your needs.</p>

              </div>
            </li>

            <li class="feature-item">
              <div class="feature-card">

                <div class="card-icon">
                  <img src="images/features-icon-2.png" width="100" height="80" loading="lazy" alt="icon">
                </div>

                <h3 class="title-2 card-title">User-Friendly Interface</h3>

                <p class="label-1 card-text">Easy-to-navigate dashboards and features.</p>

              </div>
            </li>

            <li class="feature-item">
              <div class="feature-card">

                <div class="card-icon">
                  <img src="images/features-icon-3.png" width="100" height="80" loading="lazy" alt="icon">
                </div>

                <h3 class="title-2 card-title">Comprehensive Management</h3>

                <p class="label-1 card-text">All-in-one platform for transport businesses.</p>

              </div>
            </li>

            <li class="feature-item">
              <div class="feature-card">

                <div class="card-icon">
                  <img src="images/features-icon-4.png" width="100" height="80" loading="lazy" alt="icon">
                </div>

                <h3 class="title-2 card-title">Reliable Support</h3>

                <p class="label-1 card-text">24/7 assistance to keep you moving.</p>

              </div>
            </li>

          </ul>

         

        </div>
      </section>


    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer section has-bg-image text-center" style="background-color: black;">
    <div class="container">

      <div class="footer-top grid-list">

        <div class="footer-brand has-before has-after">

          <a href="#" class="logo">
            <img src="images/logo.svg" width="160" height="50" loading="lazy" alt="transpo-flow">
          </a>

          <address class="body-4">
            xyz, Lahore City, Pakistan
          </address>

          <a href="mailto:mail@transpoflow.com" class="body-4 contact-link">mail@transpoflow.com</a>

          <a href="tel:+920000000000" class="body-4 contact-link">Booking Request : +92-000-000-0000</a>

          <div class="wrapper">
            <div class="separator"></div>
            <div class="separator"></div>
            <div class="separator"></div>
          </div>

          <p class="title-1">Get Updates</p>


          <form action="" class="input-wrapper">
            <div class="icon-wrapper">
              <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>

              <input type="email" name="email_address" placeholder="Your email" autocomplete="off" class="input-field">
            </div>

            <button type="submit" class="btn btn-secondary">
              <span class="text text-1">Subscribe</span>

              <span class="text text-2" aria-hidden="true">Subscribe</span>
            </button>
          </form>

        </div>

        <ul class="footer-list">

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Home</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Services</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">About Us</a>
          </li>


          <li>
            <a href="#" class="label-2 footer-link hover-underline">Contact</a>
          </li>

        </ul>

        <ul class="footer-list">

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Facebook</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Instagram</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Twitter</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Youtube</a>
          </li>

          <li>
            <a href="#" class="label-2 footer-link hover-underline">Google Map</a>
          </li>

        </ul>

      </div>

      <div class="footer-bottom">

        <p class="copyright">
          &copy; 2024 TranspoFlow. All Rights Reserved | Crafted by <a href="https://github.com/codewithsadee"
            target="_blank" class="link">TranspoFlow</a>
        </p>

      </div>

    </div>
  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>
  @vite('resources/js/script.js')

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>