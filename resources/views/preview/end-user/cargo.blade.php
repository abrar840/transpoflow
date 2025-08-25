<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TranspoFlow Cargo Booking</title>
    <link rel="stylesheet" href="cargo.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
   

    @php
    if($theme === 'light') {
      $cssPath = 'resources/css/enduser/theme1/cargo.css';
      $imagePath = 'resources/images/';
    } else {
      $cssPath = 'resources/css/enduser/theme2/cargo.css';
      $imagePath = 'resources/images/enduser/images/';
    }
    
  @endphp
  <link rel="stylesheet" href="{{ Vite::asset($cssPath) }}">
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
       

        <!-- Cargo Fare Calculator Form -->
        <section >
            
            <div class="cargo-booking-container">
                <h1 class="cargo-title">Cargo Booking</h1>
                <div class="cargo-form-container">
                    <form id="cargoBookingForm" class="modern-form">
                        <!-- Shipper Information -->
                        <section class="form-section">
                            <h3 class="section-title">Shipper Information</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Shipper City</label>
                                    <select id="shipperCity" class="form-select">
                                        <option value="Lahore">Lahore</option>
                                        <option value="Karachi">Karachi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Shipper Name</label>
                                    <input type="text" class="form-input" id="shipperName">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-input" id="shipperPhone">
                                </div>
                                <div class="form-group full-width">
                                    <label class="form-label">Shipper Address</label>
                                    <input type="text" class="form-input" id="shipperAddress">
                                </div>
                            </div>
                        </section>
            
                        <!-- Consignee Information -->
                        <section class="form-section">
                            <h3 class="section-title">Consignee Information</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Consignee City</label>
                                    <select id="consigneeCity" class="form-select">
                                        <option value="Lahore">Lahore</option>
                                        <option value="Karachi">Karachi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-input" id="consigneeName">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-input" id="consigneePhone">
                                </div>
                                <div class="form-group full-width">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-input" id="consigneeAddress">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-input" id="consigneeEmail">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Delivery Option</label>
                                    <select class="form-select" id="deliveryOption">
                                        <option>Company Office</option>
                                        <option>Home</option>
                                    </select>
                                </div>
                            </div>
                        </section>
            
                        <!-- Order Information -->
                        <section class="form-section">
                            <h3 class="section-title">Order Information</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Order ID</label>
                                    <input type="text" class="form-input" id="orderId" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Order Date</label>
                                    <input type="date" class="form-input" id="orderDate">
                                </div>
                                <div class="form-group full-width">
                                    <label class="form-label">Item Description</label>
                                    <textarea class="form-textarea" id="itemDescription"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Item Quantity</label>
                                    <input type="number" class="form-input" id="itemQuantity">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Insurance</label>
                                    <select class="form-select" id="insurance">
                                        <option>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </section>
            
                        <!-- Rate Calculation -->
                        <section class="form-section">
                            <h3 class="section-title">Rate Calculation</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Weight (kg)</label>
                                    <input type="number" class="form-input weight" id="weight">
                                </div>
                                <div class="dimension-group">
                                    <div class="form-group">
                                        <label class="form-label">Length (cm)</label>
                                        <input type="number" class="form-input" id="length">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Width (cm)</label>
                                        <input type="number" class="form-input" id="width">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Height (cm)</label>
                                        <input type="number" class="form-input" id="height">
                                    </div>
                                </div>
                                <div class="form-group full-width">
                                    <label class="form-label file-upload-label">
                                        <span>Upload Images</span>
                                        <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple >
                                        <div class="file-count" id="fileCount">No files selected</div>
                                    </label>
                                </div>
                            </div>
                        </section>
            
                        <div class="action-buttons">
                            <button type="button" class="btn calculate-btn" onclick="calculateCharges()">Calculate Charges</button>
                            <h3 class="total-charges">Total Charges: <span id="totalCharges">0 Rs</span></h3>
                        </div>
                    </form>
            
                    <div class="button-container">
                        <button class="btn print-btn" onclick="generatePDF()">Book & Print</button>
                    </div>
                   
                </div>
            </div>
        </section>
        <section>
            
            <div class="cargo-booking-container">
                
            
                <!-- Tracking Section -->
                <div class="cargo-form-container tracking-section">
                    <h1 class="cargo-title">Cargo Tracking System</h1>
                    <div class="modern-form">
                        <h3 class="section-title">Track Your Parcel Here</h3>
                        <div class="tracking-input form-group">
                            <input type="text" 
                                   id="trackingNumber" 
                                   class="form-input"
                                   placeholder="Enter tracking number">
                            <button class="btn calculate-btn" onclick="checkStatus()">Track</button>
                        </div>
                        
                        <div class="status-container" id="statusContainer">
                            <div class="progress-bar">
                                <div class="progress-line"></div>
                                <div class="progress-fill" id="progressFill"></div>
                                <div class="stage">
                                    <div class="stage-dot"></div>
                                    <span class="stage-label">Pending</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot"></div>
                                    <span class="stage-label">Dispatch</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot"></div>
                                    <span class="stage-label">In Transit</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot"></div>
                                    <span class="stage-label">Delivered</span>
                                </div>
                            </div>
                            <div class="status-message" id="statusMessage"></div>
                        </div>
                        <div class="error-message" id="errorMessage"></div>
                    </div>
                </div>
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>Email: info@example.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Modern Company. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Fare Calculation -->
    <script src="cargo.js">  </script>
</body>
</html>