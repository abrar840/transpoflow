
<div>
  <section class="content">
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Cargo Management</h1>
        </div>
        <a href="#" class="download-btn"><i class="fas fa-globe"></i><span>View Website</span></a>
      </div>

           
              
                <div class="cargo-container">
                  
                    <!-- Admin Rate Configuration Form -->
                    <div class="box-info">

                      <div class="box-info">
                        <h1>Admin Rate Configuration Form</h1>
                        <form id="adminConfigForm">
                    
                            <!-- City-to-City Rates -->
                            <h3>City-to-City Base Rates</h3>
                            <div class="cargo-container">
                                <div>
                                    <select name="origin_city" class="editable" required>
                                        <option value="">Select Origin City</option>
                                        <!-- Populate from database -->
                                    </select>
                    
                                    <select name="destination_city" class="editable" required>
                                        <option value="">Select Destination City</option>
                                        <!-- Populate from database -->
                                    </select>
                    
                                    <input type="number" name="base_rate" class="editable" step="0.01" placeholder="Base Rate" required>
                                    <input type="text" name="description" class="editable" placeholder="Rate Description">
                                <br>
                                <br>
                          
                                    <h5>Select Days for these cities Shipment</h5>
                                    <div class="days-container">
                                      <label><input type="checkbox" name="available_days[]" value="Monday"> Monday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Tuesday"> Tuesday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Wednesday"> Wednesday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Thursday"> Thursday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Friday"> Friday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Saturday"> Saturday</label>
                                      <label><input type="checkbox" name="available_days[]" value="Sunday"> Sunday</label>
                                  </div>
                                  </div>
                            </div>
                            <div class="button-container">
                                <button type="button" class="save-btn" onclick="addCityRateField()">+ Add Another City Pair</button>
                            </div>
                    
                            <br>
                            <br>
                            <br>
                            <!-- Weight-Based Pricing -->
                            <h3>Volumetric Settings</h3>
                            <div class="cargo-container">
                              <label>
                                  <input type="checkbox" name="enable_volumetric" id="enable_volumetric"> Enable Volumetric Weight
                              </label>
                              <div class="cargo-container">
                                  <div>
                                      <input type="number" name="min_volume" class="editable_vol" placeholder="Min Volume (cm³)" step="1" disabled>
                                      <input type="number" name="max_volume" class="editable_vol" placeholder="Max Volume (cm³)" step="1" disabled>
                                      <input type="number" name="rate_per_cm3" class="editable_vol" step="0.0001" placeholder="Rate/cm³" disabled>
                                      <br>
                                      <small>Volume = Length × Width × Height (calculated in cm³)</small>
                                  </div>
                              </div>
                          </div>
                            <div class="button-container">
                                <button type="button" class="save-btn" onclick="addWeightTier()">+ Add Tier</button>
                            </div>

                            
                         
                            <!-- Additional Charges -->
                            <h3>Additional Charges</h3>
                            <div class="cargo-container">
                                <div>
                                    <select name="charge_type" class="editable">
                                        <option value="fuel">Fuel Surcharge (%)</option>
                                        <option value="handling">Handling Fee (Fixed)</option>
                                        <!-- Other charge types -->
                                    </select>
                                    <input type="number" name="charge_value" class="editable" step="0.01" placeholder="Value">
                                </div>
                            </div>
                            <div class="button-container">
                                <button type="button" class="save-btn" onclick="addChargeField()">+ Add Charge</button>
                            </div>
                    
                            <!-- Service Types -->
                            <h3>Service Type</h3>
                            <div class="cargo-container">
                              <label>
                                <input type="radio" name="service_type" value="door_to_door" required>
                                Door-to-Door <span style="font-weight: 50;">(Home Pickup and Delivery)</span>
                              </label>
                              <br>
                              <label>
                                <input type="radio" name="service_type" value="office_to_office" required>
                                Office-to-Office <span style="font-weight: 50;">(Customer Drops and Picks Up at Offices)</span>
                              </label>
                              <br>
                              <label>
                                <input type="radio" name="service_type" value="hybrid" required >
                                Hybrid <span style="font-weight: 50;">(Customer could Drops and Picks Up from Home or Office)</span>
                              </label>
                            </div>
                            <div class="button-container">
                                <button type="button" class="save-btn" onclick="addServiceLevel()">+ Add Service</button>
                            </div>
                    
                            <!-- Save Button -->
                            <div class="button-container">
                                <button type="submit" class="save-btn">Save Configuration</button>
                            </div>
                        </form>
                    </div>
                    
      
                    <div class="box-info">
                      <h1>Cargo Booking</h1>
                      <div class="cargo-container">
                        <form id="shippingForm">
                          <!-- Shipper Information -->
                          <h3>Shipper Information</h3>
                          <label>Shipper City:</label>
                          <select id="shipperCity">
                              <option value="Lahore">Lahore</option>
                              <option value="Karachi">Karachi</option>
                          </select>
                          <br>
                          <label>Shipper Name:</label>
                          <input type="text" class="editable">
                      
                          <label>Contact Number:</label>
                          <input type="text" class="editable">
                      
                          <label>Shipper Address:</label>
                          <input type="text" class="editable">
                      
                          <br><br>
                      
                          <!-- Consignee Information -->
                          <h3>Consignee Information</h3>
                          <label>Consignee City:</label>
                          <select id="consigneeCity">
                              <option value="Lahore">Lahore</option>
                              <option value="Karachi">Karachi</option>
                          </select>
                      
                          <label>Name:</label>
                          <input type="text" class="editable">
                      
                          <label>Address:</label>
                          <input type="text" class="editable">
                      
                          <label>Phone Number :</label>
                          <input type="text" class="editable">
                      
                          <label>Email Address:</label>
                          <input type="email" class="editable">
                      
                          <label>Delivery Option</label>
                          <select class="editable">
                              <option>Company Office</option>
                              <option>Home</option>
                          </select>
                      
                          <br><br>
                      
                          <!-- Order Information -->
                          <h3>Order Information</h3>
                          <label>Order ID:</label>
                          <input type="text" class="editable">
                      
                          <label>Order Date:</label>
                          <input type="date" class="editable">
                      
                          <label>Item Description:</label>
                          <textarea class="editable"></textarea>
                      
                          <label>Item Quantity:</label>
                          <input type="number" class="editable">
                      
                          <label>Insurance:</label>
                          <select class="editable">
                              <option>No</option>
                              <option>Yes</option>
                          </select>
                      
                          <br><br>
                      
                          <!-- Shipping Information -->
                          <h3>Shipping Information</h3>
                          <label>Weight (kg):</label>
                          <input type="number" id="weight" class="weight">
                          <br>
                      
                          <label>Length (cm):</label>
                          <input type="number" id="length">
                          <label>Width (cm):</label>
                          <input type="number" id="width">
                          <label>Height (cm):</label>
                          <input type="number" id="height">
                          <br>
                      
                          <label for="imageUpload">Upload Images:</label>
                          <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple>
                      
                          <br><br>
                      
                          <!-- Calculate Charges Button -->
                          <button type="button" onclick="calculateCharges()">Calculate Charges</button>
                      
                          <h3>Total Charges: <span id="totalCharges">0 Rs</span></h3>
                      </form>
     
                    </div>
                  
                      <div class="button-container">

                          <button class="save-btn">Book & Print</button>
                      </div>
                  </div>
                  


      <!-- Cargo Price Management Module -->
      <div class="box-info">
        <h1>Cargo Price Management</h1>
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
           
                    <th>Service Type</th>
             
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Consignee Name</th>
                    <th>Consignee Contact</th>
                    <th>Consignee Address</th>

                    <th>Booking Date</th>

                    <th>Print</th>
                </tr>
            
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="#">20220117472719</a></td>
             
                    <td>Regular</td>
            
                    <td>Karachi</td>
                    <td>Karachi</td>
                    <td>syeda</td>
                    <td>0345-001078</td>
                    <td>R-201 commercial society karachi</td>

                    <td>2022-07-01 </td>

                    <td><button class="actions-button">Print</button></td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><a href="#">20220117582127</a></td>
            
                    <td>Regular</td>
           
                    <td>Karachi</td>
                    <td>Karachi</td>
                    <td>Test</td>
                    <td>0213-213132</td>
                    <td></td>

                    <td>2022-06-28 </td>

                    <td><button class="actions-button">Print</button></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>
        <div class="button-container">
          <button class="edit-btn">Delete</button>
          <button class="save-btn">Edit</button> <!-- Separate Save Button -->
        </div>
      </div>

    </main>
  </section>

  <script>
    document.querySelectorAll('.edit-btn').forEach((editBtn, index) => {
      editBtn.addEventListener('click', function() {
        const parent = editBtn.closest('.box-info');
        const inputs = parent.querySelectorAll('.editable');
        const isEditable = inputs[0].disabled;

        inputs.forEach(input => input.disabled = !isEditable);

        // Toggle Edit button text
        editBtn.textContent = isEditable ? "Editing Mode" : "Edit";
      });
    });

    document.querySelectorAll('.save-btn').forEach((saveBtn, index) => {
      saveBtn.addEventListener('click', function() {
        const parent = saveBtn.closest('.box-info');
        const inputs = parent.querySelectorAll('.editable_vol');

        // Log the saved data
        console.log("Saved Data:", Array.from(inputs).map(input => input.value));

        // Alert user (You can replace this with backend saving logic)
        alert("Changes Saved Successfully!");
      });
    });

  // Get the checkbox and inputs
  const checkbox = document.getElementById('enable_volumetric');
  const inputs = document.querySelectorAll('.editable_vol');

  // Function to toggle inputs based on checkbox
  function toggleInputs() {
      const enabled = checkbox.checked;
      inputs.forEach(input => {
          input.disabled = !enabled;  // Enable when checked, disable when unchecked
      });
  }

  // Add event listener to checkbox
  checkbox.addEventListener('change', toggleInputs);

  // Initial state (in case page loads with checkbox already checked)
  toggleInputs();


  function calculateCharges() {
                              const shipperCity = document.getElementById('shipperCity').value;
                              const consigneeCity = document.getElementById('consigneeCity').value;
                      
                              // Base City Rate (Lahore to Karachi = 500 Rs, you can add more conditions here)
                              let baseRate = 0;
                              if ((shipperCity === 'Lahore' && consigneeCity === 'Karachi') || 
                                  (shipperCity === 'Karachi' && consigneeCity === 'Lahore')) {
                                  baseRate = 200;
                              } else {
                                  baseRate = 100; // Default for same city or other cities
                              }
                      
                              // Get actual weight
                              const actualWeight = parseFloat(document.getElementById('weight').value) || 0;
                      
                              // Get dimensions for volumetric weight
                              const length = parseFloat(document.getElementById('length').value) || 0;
                              const width = parseFloat(document.getElementById('width').value) || 0;
                              const height = parseFloat(document.getElementById('height').value) || 0;
                      
                              // Calculate volumetric weight
                              const volumetricWeight = (length * width * height) / 5000;
                      
                              // Get the chargeable weight (greater of actual or volumetric weight)
                              const chargeableWeight = Math.max(actualWeight, volumetricWeight);
                      
                              // Rate per kg (dummy rate, you can adjust)
                              const ratePerKg = 20;
                      
                              // Additional charges
                              const additionalCharges = 135;
                      
                              // Total Charges Formula
                              const totalCharges = baseRate + (chargeableWeight * ratePerKg) + additionalCharges;
                      
                              // Display the total charges
                              document.getElementById('totalCharges').innerText = totalCharges.toFixed(2) + " Rs";
                          }
  </script>
</div>