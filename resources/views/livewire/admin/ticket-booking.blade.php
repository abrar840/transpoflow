<div>
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
</div>
