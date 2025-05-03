<div>

    @livewire('enduser.header1', ['company' => $company])

    @push('styles')
     
    @vite("resources/css/enduser/theme1/contact.css")

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
</div>
