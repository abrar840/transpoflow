<div>
    <section class="content">
        <main>
          <div class="head-title">
            <div class="left">
              <h1>Ticket Management</h1>
              <ul class="breadcrumb">
                <li>
                  <a href="admin.html">Dashboard</a>
                </li>
                <i class="fas fa-chevron-right"></i>
                <li>
                  <a href="#" class="active">Ticket Management</a>
                </li>
              </ul>
            </div>
            <a href="#" class="download-btn">
              <i class="fas fa-globe"></i>
              <span class="text">View Website</span>
            </a>
          </div>
  
          <!-- Manage Ticket Pricing Module -->
          <div class="box-info">
            <h1>Manage Ticket Pricing</h1>
            <div class="ticket-container">
              <table>
                <thead>
                  <tr>
                    <th>Ticket ID</th>
                    <th>Event</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" value="T001" disabled></td>
                    <td><input type="text" value="Concert" disabled></td>
                    <td><input type="text" value="VIP" disabled></td>
                    <td><input type="text" value="$150" disabled></td>
                    <td>
                      <button class="edit-btn">Edit</button>
                      <button class="delete-btn">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
              <button class="add-ticket">Add New Ticket</button>
            </div>
          </div>
  
          <!-- Manage Ticket Booking Module -->
          <div class="box-info">
            <h1>Manage Ticket Booking</h1>
            <div class="booking-container">
              <table>
                <thead>
                  <tr>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Event</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" value="B001" disabled></td>
                    <td><input type="text" value="John Doe" disabled></td>
                    <td><input type="text" value="Concert" disabled></td>
                    <td><input type="text" value="2" disabled></td>
                    <td><input type="text" value="Confirmed" disabled></td>
                    <td>
                      <button class="edit-btn">Edit</button>
                      <button class="delete-btn">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
              <button class="add-booking">Add New Booking</button>
            </div>
          </div>
  
          <!-- Customer Support Module -->
          <div class="box-info">
            <h1>Customer Support</h1>
            <div class="support-container">
              <p>Manage customer queries related to ticketing.</p>
              <button>View Tickets</button>
              <button>Live Chat</button>
              <button>Contact Support</button>
            </div>
          </div>
          
        </main>
      </section>
  
      <script>
        // Handle edit button click
        const editButtons = document.querySelectorAll('.edit-btn');
        
        editButtons.forEach((editBtn) => {
          editBtn.addEventListener('click', function() {
            const row = editBtn.closest('tr');
            const inputs = row.querySelectorAll('input');
            const isEditable = inputs[0].disabled;
  
            // Toggle the disabled state
            inputs.forEach(input => input.disabled = !isEditable);
  
            
          });
        });
      </script>
</div>
