<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ticket Management | Tivotal</title>
  @vite("resources/css/admin.css")
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- CSS File -->
  <link rel="stylesheet" href="assets/css/admin.css" />

  <style>
    .header-tabs {
      display: flex;
      justify-content: center;
      background-color: #f4f4f4;
      padding: 10px;
      margin-bottom: 20px;
      gap: 15px;
      border-bottom: 1px solid #ccc;
    }
    .header-tabs button {
      padding: 10px 20px;
      border: none;
      background-color: #ddd;
      cursor: pointer;
      font-weight: bold;
      border-radius: 5px;
    }
    .header-tabs button.active {
      background-color: #246ddb333;
      color: white;
    }
    .module {
      display: none;
    }
    .module.active {
      display: block;
    }
  </style>
</head>
<body>
  <!-- Sidebar remains unchanged -->
  <section class="sidebar">
    <a href="admin.html" class="logo">
      <i class="fab fa-slack"></i>
      <span class="text">Admin Panel</span>
    </a>
    <ul class="side-menu top">
      <li><a href="admin.html"><i class="fas fa-border-all"></i><span>Admin Dashboard</span></a></li>
      <li><a href="fms.html"><i class="fas fa-road"></i><span>Fleet Management</span></a></li>
      <li class="active"><a href="ticket.html"><i class="fas fa-ticket"></i><span>Ticket Management</span></a></li>
      <li><a href="cms.html"><i class="fas fa-truck"></i><span>Cargo Management</span></a></li>
      <li><a href="#"><i class="fas fa-people-group"></i><span>Customer Support</span></a></li>
    </ul>
    <ul class="side-menu">
      <li><a href="#"><i class="fas fa-cog"></i><span>Settings</span></a></li>
      <li><a href="#" class="logout"><i class="fas fa-right-from-bracket"></i><span>Logout</span></a></li>
    </ul>
  </section>

  <section class="content">
    <!-- ✅ New Header Tabs -->
    <div class="header-tabs">
      <button class="tab-btn active" onclick="showModule('ticket')">Ticket</button>
      <button class="tab-btn" onclick="showModule('route')">Route</button>
      <button class="tab-btn" onclick="showModule('scheduling')">Scheduling</button>
    </div>

    <main>
      <!-- ✅ Ticket Booking Module -->
      <div class="module active" id="ticket">
        <!-- Paste ticket booking and ticket history content here -->
        <div class="box-info">
          <h1>Ticket Booking</h1>
          <div class="cargo-container">
            <!-- Ticket Booking Form Here -->
            <!-- ... -->
          </div>
        </div>

        <div class="box-info">
          <h1>Tickets History</h1>
          <!-- Ticket History Table Here -->
          <!-- ... -->
        </div>
      </div>

      <!-- ✅ Route Configuration Module -->
      <div class="module" id="route">
        <div class="box-info">
          <h1>Ticket Fare Configuration Form</h1>
          <!-- Ticket Fare Form Here -->
          <!-- ... -->
        </div>
        <div class="box-info">
          <h1>Buses Information</h1>
          <!-- Buses Info Table Here -->
          <!-- ... -->
        </div>
      </div>

      <!-- ✅ Scheduling Configuration Module -->
      <div class="module" id="scheduling">
        <div class="box-info">
          <h2>Vehicle Schedule Configuration</h2>
          <!-- Vehicle Schedule Form Here -->
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
          <!-- ... -->
        </div>
      </div>
    </main>
  </section>

  <!-- ✅ JavaScript to Switch Tabs -->
  <script>
    function showModule(id) {
      const modules = document.querySelectorAll('.module');
      const buttons = document.querySelectorAll('.tab-btn');

      modules.forEach(mod => mod.classList.remove('active'));
      buttons.forEach(btn => btn.classList.remove('active'));

      document.getElementById(id).classList.add('active');
      event.target.classList.add('active');
    }
  </script>
</body>
</html>
