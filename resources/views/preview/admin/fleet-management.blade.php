<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
@vite("resources/css/admin.css")
 
@vite("resources/css/VehicleRegistration.css")
</head>
<body>
  <div class="content">
    <!-- Sidebar -->
    <section class="sidebar">
        <a href="{{ route('demo.admin') }}" class="logo">
          <i class="fab fa-slack"></i>
          <span class="text">Admin Panel</span>
        </a>
      
        <ul class="side-menu top">
          <li class="{{ Route::is('demo.admin') ? 'active' : '' }}">
            <a href="{{ route('demo.admin') }}" class="nav-link">
              <i class="fas fa-border-all"></i>
              <span class="text">Admin Dashboard</span>
            </a>
          </li>
          <li class="{{ Route::is('demo.fleet') ? 'active' : '' }}">
            <a href="{{ route('demo.fleet') }}" class="nav-link">
              <i class="fas fa-road"></i>
              <span class="text">Fleet Management</span>
            </a>
          </li>
          <li class="{{ Route::is('demo.ticket') ? 'active' : '' }}">
            <a href="{{ route('demo.ticket') }}" class="nav-link">
              <i class="fas fa-ticket"></i>
              <span class="text">Ticket Management</span>
            </a>
          </li>
          <li class="{{ Route::is('demo.cargo') ? 'active' : '' }}">
            <a href="{{ route('demo.cargo') }}" class="nav-link">
              <i class="fas fa-truck"></i>
              <span class="text">Cargo Management</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <i class="fas fa-people-group"></i>
              <span class="text">Customer Support</span>
            </a>
          </li>
        </ul>
      
        <ul class="side-menu">
          <li>
            <a href="#">
              <i class="fas fa-cog"></i>
              <span class="text">Settings</span>
            </a>
          </li>
          <li>
            <a href="#" class="logout">
              <i class="fas fa-right-from-bracket"></i>
              <span class="text">Logout</span>
            </a>
          </li>
        </ul>
      </section>
      

    <!-- Main Content -->
    <main>
      <header class="management-header">
        <h2 class="management-title">Vehicle Management System</h2>
        <div class="header-actions">
          <button id="toggleFormBtn" onclick="toggleForm()">Register New Vehicle</button>
        </div>
      </header>

      <div class="vehicle-box-info">
        <!-- Success Message (hidden by default) -->
        <div id="successMessage" class="alert alert-success" style="display: none;">
          <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <span id="messageText">Vehicle registered successfully!</span>
        </div>

        <!-- Vehicle Registration Form -->
        <div id="registrationForm" class="registration-card vehicle-management-container">
          <div class="card-header">
            <h3 class="card-title">Vehicle Registration Form</h3>
            <div class="card-actions">
              <button onclick="toggleForm()" class="close-btn">
                &times;
              </button>
            </div>
          </div>
          
          <form id="vehicleForm" class="registration-form" onsubmit="submitForm(event)">
            <div class="form-grid">
              <!-- Row 1 -->
              <div class="form-group">
                <label for="registration_number">Registration Number</label>
                <input type="text" id="registration_number" name="registration_number" 
                       class="form-input" placeholder="ABC-1234" required>
              </div>
              
              <div class="form-group">
                <label for="vehicle_type">Vehicle Type</label>
                <select id="vehicle_type" name="vehicle_type" class="form-input" required>
                  <option value="">Select Type</option>
                  <option value="Car">Car</option>
                  <option value="Bus">Bus</option>
                  <option value="Truck">Truck</option>
                  <option value="Motorbike">Motorbike</option>
                  <option value="Van">Van</option>
                  <option value="Bicycle">Bicycle</option>
                  <option value="Scooter">Scooter</option>
                  <option value="Trailer">Trailer</option>
                </select>
              </div>
              
              <!-- Row 2 -->
              <div class="form-group">
                <label for="seating_capacity">Seating Capacity</label>
                <input type="number" id="seating_capacity" name="seating_capacity" 
                       class="form-input" min="1" max="100" required>
              </div>
              
              <div class="form-group">
                <label for="year">Manufacture Year</label>
                <input type="number" id="year" name="year" 
                       class="form-input" min="1900" max="2025" required>
              </div>
              
              <!-- Row 3 -->
              <div class="form-group">
                <label for="make">Make/Manufacturer</label>
                <input type="text" id="make" name="make" 
                       class="form-input" placeholder="e.g., Toyota" required>
              </div>
              
              <div class="form-group">
                <label for="model">Model</label>
                <input type="text" id="model" name="model" 
                       class="form-input" placeholder="e.g., Hiace" required>
              </div>
              
              <!-- Row 4 -->
              <div class="form-group span-2">
                <label for="notes">Additional Notes</label>
                <textarea id="notes" name="notes" 
                          class="form-input" rows="3"></textarea>
              </div>
              
              <!-- Row 5 -->
              <div class="form-group">
                <label class="checkbox-label">
                  <input type="checkbox" id="is_active" name="is_active" class="checkbox-input" checked>
                  <span>Active Vehicle</span>
                </label>
              </div>
              
              <div class="form-group">
                <label class="checkbox-label">
                  <input type="checkbox" id="scheduled" name="scheduled" class="checkbox-input">
                  <span>Available for Scheduling</span>
                </label>
              </div>
            </div>
            
            <div class="form-actions">
              <button type="button" onclick="resetForm()" class="cancel-btn">
                Cancel
              </button>
              <button type="submit" class="submit-btn">
                <span id="submitBtnText">Register Vehicle</span>
              </button>
            </div>
          </form>
        </div>
        
        <!-- Vehicle List Section -->
        <div class="vehicle-list-section">
          <h3 class="section-title">Registered Vehicles</h3>
          <div class="list-actions">
            <div class="search-box">
              <input type="text" id="searchInput" placeholder="Search vehicles...">
              <svg class="search-icon" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 001.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 00-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 005.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
              </svg>
            </div>
            <div class="filter-options">
              <select id="statusFilter">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
          
          <div class="vehicle-table-container">
            <table class="vehicle-table">
              <thead>
                <tr>
                  <th>Registration Number</th>
                  <th>Vehicle Type</th>
                  <th>Make/Model</th>
                  <th>Year</th>
                  <th>Seating Capacity</th>
                  <th>Status</th>
                  <th>Schedule</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="vehicleTableBody">
                <!-- Dummy Data Rows -->
                <tr>
                  <td>ABC123</td>
                  <td>Luxury Bus</td>
                  <td>Volvo B9R</td>
                  <td>2020</td>
                  <td>45</td>
                  <td><span class="status-badge active">Active</span></td>
                  <td><span class="status-badge active">Scheduled</span></td>
                  <td class="action-buttons">
                    <button onclick="editVehicle('ABC123')" class="edit-btn">Edit</button>
                    <button onclick="deleteVehicle('ABC123')" class="delete-btn">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>XYZ789</td>
                  <td>Car</td>
                  <td>Toyota Hiace</td>
                  <td>2019</td>
                  <td>12</td>
                  <td><span class="status-badge active">Active</span></td>
                  <td><span class="status-badge inactive">Not Scheduled</span></td>
                  <td class="action-buttons">
                    <button onclick="editVehicle('XYZ789')" class="edit-btn">Edit</button>
                    <button onclick="deleteVehicle('XYZ789')" class="delete-btn">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>DEF456</td>
                  <td>Truck</td>
                  <td>Hino 500</td>
                  <td>2021</td>
                  <td>3</td>
                  <td><span class="status-badge inactive">Inactive</span></td>
                  <td><span class="status-badge inactive">Not Scheduled</span></td>
                  <td class="action-buttons">
                    <button onclick="editVehicle('DEF456')" class="edit-btn">Edit</button>
                    <button onclick="deleteVehicle('DEF456')" class="delete-btn">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>GHI789</td>
                  <td>Van</td>
                  <td>Mercedes Sprinter</td>
                  <td>2022</td>
                  <td>15</td>
                  <td><span class="status-badge active">Active</span></td>
                  <td><span class="status-badge active">Scheduled</span></td>
                  <td class="action-buttons">
                    <button onclick="editVehicle('GHI789')" class="edit-btn">Edit</button>
                    <button onclick="deleteVehicle('GHI789')" class="delete-btn">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Toggle form visibility
    function toggleForm() {
      const form = document.getElementById("registrationForm");
      const button = document.getElementById("toggleFormBtn");
      
      if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        button.textContent = "Hide Registration Form";
        resetForm();
      } else {
        form.style.display = "none";
        button.textContent = "Register New Vehicle";
      }
    }

    // Reset form
    function resetForm() {
      document.getElementById("vehicleForm").reset();
      document.getElementById("submitBtnText").textContent = "Register Vehicle";
      document.getElementById("registration_number").removeAttribute("disabled");
    }

    // Submit form
    function submitForm(event) {
      event.preventDefault();
      
      // Show success message
      const successMessage = document.getElementById("successMessage");
      successMessage.style.display = "flex";
      
      // Hide message after 3 seconds
      setTimeout(() => {
        successMessage.style.display = "none";
      }, 3000);
      
      // Hide form
      document.getElementById("registrationForm").style.display = "none";
      document.getElementById("toggleFormBtn").textContent = "Register New Vehicle";
      
      // Reset form
      resetForm();
    }

    // Edit vehicle
    function editVehicle(regNumber) {
      // In a real app, you would fetch vehicle data from your database
      // Here we're just simulating with dummy data
      const vehicles = {
        'ABC123': {
          registration_number: 'ABC123',
          vehicle_type: 'Luxury Bus',
          seating_capacity: 45,
          make: 'Volvo',
          model: 'B9R',
          year: 2020,
          is_active: true,
          scheduled: true,
          notes: 'Premium service vehicle'
        },
        'XYZ789': {
          registration_number: 'XYZ789',
          vehicle_type: 'Car',
          seating_capacity: 12,
          make: 'Toyota',
          model: 'Hiace',
          year: 2019,
          is_active: true,
          scheduled: false,
          notes: 'Standard shuttle'
        },
        'DEF456': {
          registration_number: 'DEF456',
          vehicle_type: 'Truck',
          seating_capacity: 3,
          make: 'Hino',
          model: '500',
          year: 2021,
          is_active: false,
          scheduled: false,
          notes: 'Cargo transport'
        },
        'GHI789': {
          registration_number: 'GHI789',
          vehicle_type: 'Van',
          seating_capacity: 15,
          make: 'Mercedes',
          model: 'Sprinter',
          year: 2022,
          is_active: true,
          scheduled: true,
          notes: 'VIP transport'
        }
      };

      const vehicle = vehicles[regNumber];
      
      if (vehicle) {
        // Fill form with vehicle data
        document.getElementById("registration_number").value = vehicle.registration_number;
        document.getElementById("vehicle_type").value = vehicle.vehicle_type;
        document.getElementById("seating_capacity").value = vehicle.seating_capacity;
        document.getElementById("make").value = vehicle.make;
        document.getElementById("model").value = vehicle.model;
        document.getElementById("year").value = vehicle.year;
        document.getElementById("is_active").checked = vehicle.is_active;
        document.getElementById("scheduled").checked = vehicle.scheduled;
        document.getElementById("notes").value = vehicle.notes || '';
        
        // Disable registration number field when editing
        document.getElementById("registration_number").setAttribute("disabled", "true");
        
        // Change submit button text
        document.getElementById("submitBtnText").textContent = "Update Vehicle";
        
        // Show form if hidden
        document.getElementById("registrationForm").style.display = "block";
        document.getElementById("toggleFormBtn").textContent = "Hide Registration Form";
        
        // Scroll to form
        document.getElementById("registrationForm").scrollIntoView({ behavior: 'smooth' });
      }
    }

    // Delete vehicle
    function deleteVehicle(regNumber) {
      if (confirm(`Are you sure you want to delete vehicle ${regNumber}?`)) {
        alert(`Vehicle ${regNumber} deleted successfully!`);
        // In a real app, you would make an AJAX call to delete from database
        // Then refresh the table
      }
    }

    // Search functionality
    document.getElementById("searchInput").addEventListener("input", function() {
      const searchTerm = this.value.toLowerCase();
      const rows = document.querySelectorAll("#vehicleTableBody tr");
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? "" : "none";
      });
    });

    // Filter by status
    document.getElementById("statusFilter").addEventListener("change", function() {
      const filterValue = this.value;
      const rows = document.querySelectorAll("#vehicleTableBody tr");
      
      rows.forEach(row => {
        if (filterValue === "") {
          row.style.display = "";
        } else {
          const status = row.querySelector("td:nth-child(6) span").textContent.toLowerCase();
          row.style.display = status === filterValue ? "" : "none";
        }
      });
    });
  </script>
</body>
</html>