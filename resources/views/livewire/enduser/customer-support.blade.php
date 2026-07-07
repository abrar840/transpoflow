<div>
 

   
 @push('styles')
 @vite('resources/css/enduser/theme1/contact.css')
@endpush
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
            <form wire:submit.prevent="submit" class="contact-form">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input wire:model="name" type="text" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="email">Your email</label>
                    <input wire:model="email" type="email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input wire:model="subject" type="text" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="message">Your message</label>
                    <textarea wire:model="message" rows="6" class="form-textarea" required></textarea>
                </div>
                <button type="submit" class="submit-button">Send message</button>
            </form>
            
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
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
</div>
