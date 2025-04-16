<div>
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

</div>
