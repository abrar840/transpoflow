<div>
  <section class="content">
    <main>
      <!-- Vehicle Registration Form -->
     

      <!-- Ticket Fare Configuration Form -->
      <div class="box-info">
        <h1>Ticket Fare Configuration Form</h1>
        <form id="adminConfigForm">
          <h3>Routes & Pricing Management</h3>
          <div class="cargo-container">
            <div>
              <input type="text" name="Departure_city" class="editable" placeholder="Departure City" required>
              <input type="text" name="Arrival_City" class="editable" placeholder="Arrival City" required>
              <input type="number" name="bus_fare" class="editable" step="0.01" placeholder="Fare Per Seat" required>
              <br>
              <input type="text" name="Vehicle_Type" class="editable" placeholder="Vehicle Type" required>
              <br>
              {{-- <input type="number" name="bus_bo" class="editable" step="0.01" placeholder="Vehicle No" required> --}}
              {{-- <input type="number" name="bus_capacity" class="editable" step="0.01" placeholder="Vehicle Capacity" required> --}}
            </div>
          </div>
          <div class="button-container">
            <button type="button" class="save-btn" onclick="addCityRateField()">Save</button>
          </div>
        </form>
      </div>

      <!-- Vehicle Schedule Configuration -->
      <div class="box-info">
        <h2>Vehicle Schedule Configuration</h2>
        <div class="cargo-container">
          <select name="destination_city" class="editable" required>
            <option value="">Select Departure City</option>
            <!-- Populate from database -->
          </select>
          <select name="destination_city" class="editable" required>
            <option value="">Select Arrival City</option>
            <!-- Populate from database -->
          </select>
          <br>
          <select name="Vehicle_Type" class="editable" required>
            <option value="">Select Vehicle Type</option>
                  <input type="number" name="bus_bo" class="editable" step="0.01" placeholder="Vehicle No" required>
            <input type="number" name="bus_capacity" class="editable" step="0.01" placeholder="Vehicle Capacity" required>
            <!-- Populate from database -->
          </select>
          <select name="destination_city" class="editable" required>
            <option value="">Set Frequency</option>
            <option value="">2h</option>
            <option value="">4h</option>
            <option value="">6h</option>
            <option value="">8h</option>
            <option value="">24h</option>
          </select>
          <br>
          <h5>Select Days</h5>
          <div class="days-container">
            <label><input type="checkbox" name="available_days[]" value="Monday"> Monday</label>
            <label><input type="checkbox" name="available_days[]" value="Tuesday"> Tuesday</label>
            <label><input type="checkbox" name="available_days[]" value="Wednesday"> Wednesday</label>
            <label><input type="checkbox" name="available_days[]" value="Thursday"> Thursday</label>
            <label><input type="checkbox" name="available_days[]" value="Friday"> Friday</label>
            <label><input type="checkbox" name="available_days[]" value="Saturday"> Saturday</label>
            <label><input type="checkbox" name="available_days[]" value="Sunday"> Sunday</label>
          </div>
          <div class="button-container">
            <button type="button" class="save-btn" onclick="addWeightTier()">Save</button>
          </div>
        </div>
      </div>
      <div class="box-info">
        <h1>Buses Information</h1>
        <div class="top-bar">
          <label>Show 
            <select>
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
            </select> entries
          </label>
        </div>
        <table>
          <thead>
            <tr>
              <th>S. No.</th>
              <th>Vehicle No.</th>
              <th>Departure</th>
              <th>Arrival</th>
              <th>Vehicle Type</th>
              <th>Fare Per Seat</th>
              
              <th>Vehicle Capacity</th>
              <th>Frequency</th>
              <th>Available Days</th>
            </tr>
            <tr>
              <th></th>
              <th><input type="text" class="search-input" placeholder="Search"></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td><a href="#">20250117472719</a></td>
              <td>Lahore</td>
              <td>Karachi</td>
              <td>Luxury Bus</td>
              <td>1500 PKR</td>
              
              <td>50</td>
              <td>6h</td>
              <td>Monday, Wednesday, Friday</td>
            </tr>
            <!-- More rows... -->
          </tbody>
        </table>
        <div class="button-container">
          <button type="button" class="edit-btn" onclick="enableRowEditing()">Edit</button>
          <button class="save-btn" onclick="Delete()">Delete</button>
          <button class="save-btn" onclick="saveRowChanges()">Save Changes</button>
        </div>
      </div>

      <!-- Ticket Booking -->
      <div class="box-info">
        <h1>Ticket Booking</h1>
        <div class="cargo-container">
          <form id="shippingForm">
            <h3>Customer Information</h3>
            <label>Departure City</label>
            <select class="editable" id="Departure_city">
              <option>Lahore</option>
              <option>Karachi</option>
            </select>
            <br>
            <label>Name:</label>
            <input type="text" class="editable" id="shipperName">
            <label>Phone Number:</label>
            <input type="text" class="editable" id="shipperPhone">
            <label>Address:</label>
            <input type="text" class="editable" id="shipperAddress">
            <br><br>
            <label>Arrival City</label>
            <select class="editable" id="Arrival_City">
              <option>Karachi</option>
              <option>Lahore</option>
            </select>
            <br>
            <label>Total Seats</label>
            <input type="number" id="number" class="editable" min="1">
            <label>Bus Type</label>
            <select class="editable" id="Bus">
              <option>Economy Class</option>
              <option>Business Class</option>
              <option>Luxury</option>
            </select>
            <br><br>
            <button type="button" onclick="calculateFare()">Calculate Fare</button>
          </form>
          <h2 id="fareDisplay">Total Fare: 0</h2>
          <div class="button-container">
            <button class="cargo_ticket_print" onclick="generatePDF()">Book & Print</button>
          </div>
        </div>
      </div>

      
      

      <!-- Tickets History -->
      <div class="box-info">
        <h1>Tickets History</h1>
        <div class="cargo-container">
          <div class="top-bar">
            <label>Show 
              <select>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
              </select> entries
            </label>
          </div>
          <table>
            <thead>
              <tr>
                <th>S. No.</th>
                <th>Order Id.</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Address</th>
                <th>Booking Date</th>
              </tr>
              <tr>
                <th></th>
                <th><input type="text" class="search-input" placeholder="Search"></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#">20250117472719</a></td>
                <td>Karachi</td>
                <td>Karachi</td>
                <td>syeda</td>
                <td>0345-001078</td>
                <td>R-201 commercial society karachi</td>
                <td>2025-03-01</td>
              </tr>
              <!-- More rows... -->
            </tbody>
          </table>
          <div class="button-container">
            <button type="button" class="edit-btn" onclick="enableRowEditing()">Edit</button>
            <button class="save-btn" onclick="Delete()">Delete</button>
            <button class="save-btn" onclick="saveRowChanges()">Save Changes</button>
          </div>
        </div>
      </div>
    </main>
  </section>

  <script>
    // Vehicle Registration Function
    function registerVehicle() {
      const form = document.getElementById('vehicleRegistrationForm');
      const formData = new FormData(form);
      
      // Here you would typically send the data to a server
      console.log('Vehicle Registration Data:', Object.fromEntries(formData));
      alert('Vehicle registered successfully!');
      form.reset();
    }

    // Enable row editing when Edit button is clicked for checked rows
    function enableRowEditing() {
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        const cells = row.querySelectorAll('td:not(:first-child)'); // Exclude the checkbox cell
  
        if (checkbox.checked) {
          cells.forEach(cell => {
            cell.setAttribute('contenteditable', 'true');
          });
        } else {
          cells.forEach(cell => {
            cell.setAttribute('contenteditable', 'false');
          });
        }
      });
    }
  
    // Save row changes
    function saveRowChanges() {
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        if (checkbox.checked) {
          const cells = row.querySelectorAll('td:not(:first-child)');
          cells.forEach(cell => {
            cell.setAttribute('contenteditable', 'false');
          });
          checkbox.checked = false; // Uncheck the checkbox after saving
        }
      });
      alert("Row changes saved successfully!");
    }
    function Delete(){
      alert("Deleted")
    }
  
    // Fare Calculator
    function calculateFare() {
      let totalSeats = document.getElementById("number").value;
      let busType = document.getElementById("Bus").value;
  
      // Convert input value to integer
      totalSeats = parseInt(totalSeats);
  
      // Fare Rates
      let acFarePerSeat = 1000;
      let nonAcFarePerSeat = 700;
  
      let totalFare = 0;
  
      // Check if totalSeats is valid
      if (!isNaN(totalSeats) && totalSeats > 0) {
        if (busType === "AC") {
          totalFare = totalSeats * acFarePerSeat;
        } else {
          totalFare = totalSeats * nonAcFarePerSeat;
        }
        document.getElementById("fareDisplay").innerHTML = "Total Fare: " + totalFare + " PKR";
      } else {
        document.getElementById("fareDisplay").innerHTML = "Please enter a valid number of seats!";
      }
    }
  </script>
</div>