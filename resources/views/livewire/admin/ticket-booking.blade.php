<div class="ticket-booking-container" style="background-color: #f0f8ff; min-height: 100vh; padding: 20px;">

  <style>
    /* Base Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f8ff;
      color: #333;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    select,
    input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: white;
    }

    button {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-weight: bold;
    }

    /* Specific Components */
    .booking-form,
    .fare-calculator {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .btn-search,
    .btn-calculate {
      background-color: #1e90ff;
      color: white;
    }

    .btn-search:hover,
    .btn-calculate:hover {
      background-color: #187bcd;
    }

    .error-message {
      color: #dc3545;
      font-size: 0.875em;
      margin-top: 5px;
    }

    /* Popup Overlay Styles */
    .overlay-box {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup-content {
      background: white;
      padding: 30px;
      border-radius: 8px;
      width: 90%;
      max-width: 800px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 1.5rem;
      cursor: pointer;
      color: #333;
    }

    /* Search Results */
    .results-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 15px;
      margin-top: 20px;
    }

    .ticket-result,
    .bus-item {
      background-color: #f8f9fa;
      padding: 15px;
      border-radius: 6px;
      border-left: 4px solid #1e90ff;
    }

    .ticket-header,
    .bus-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }

    .ticket-status {
      padding: 0.25rem 0.5rem;
      border-radius: 4px;
      font-size: 0.8rem;
    }

    .ticket-status.paid {
      background: #e8f5e9;
      color: #2e7d32;
    }

    .ticket-status.pending {
      background: #fff8e1;
      color: #f57f17;
    }

    /* Confirmation Modal */
    .confirmation-content {
      background: white;
      padding: 30px;
      border-radius: 8px;
      width: 90%;
      max-width: 500px;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #eee;
    }

    /* Utility Classes */
    .hidden {
      display: none;
    }

    .text-red-500 {
      color: #dc3545;
    }

    .text-sm {
      font-size: 0.875em;
    }

    .no-results {
      text-align: center;
      padding: 2rem;
      color: #666;
    }



    /* css for table  */
     /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #1e90ff;
            color: white;
            font-weight: bold;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .search-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .table-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .table-actions {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
        
        .edit-btn, .save-btn, .delete-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .edit-btn {
            background-color: #ffc107;
            color: #333;
        }
        
        .save-btn {
            background-color: #28a745;
            color: white;
        }
        
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }



          .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
    }
    
    .page-item {
        margin: 0 2px;
    }
    
    .page-item.active .page-link {
        background-color: #1e90ff;
        border-color: #1e90ff;
        color: white;
    }
    
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #1e90ff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .page-link:hover {
        color: #0d6efd;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    
    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .pagination {
            flex-wrap: wrap;
        }
        
        .page-item {
            margin: 2px;
        }
    }
  </style>

  <!-- Booking Form -->
  <div class="booking-form">
    <h2>Book Your Ticket</h2>
    <form wire:submit.prevent="searchSchedules">
      <div class="form-group">
        <label for="departure_city">From</label>
        <select wire:model.live="selectedDepartureCity" wire:change="filterArrivalCities" required>
          <option value="">Select Departure City</option>
          @foreach ($departureCities as $city)
          <option value="{{ $city }}">{{ $city }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="arrival_city">To</label>
        <select wire:model.live="selectedArrivalCity" {{ empty($arrivalCities) ? 'disabled' : '' }} required>
          <option value="">Select Arrival City</option>
          @foreach ($arrivalCities as $city)
          <option value="{{ $city }}">{{ $city }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="date">Travel Date</label>
        <input wire:model="date" type="date" min="{{ now()->format('Y-m-d') }}" required />
      </div>

      <button type="submit" class="btn-search">Search Buses</button>
    </form>
  </div>

  <!-- Ticket Search Form -->
  <div class="booking-form">
    <h3>Search Your Tickets</h3>
    <div class="form-group">
      <input wire:model="searchTerm" type="text" placeholder="Search by ticket number, name, phone or email">
      <button wire:click="searchTickets" class="btn-search" style="margin-top: 10px;">Search</button>
    </div>
  </div>

  <!-- Available Buses Popup -->
  @if(count($availableSchedules) > 0 && !$selectedSchedule)
  <div class="overlay-box">
    <div class="popup-content">
      <span class="close-btn" wire:click="$set('searched', false)">&times;</span>
      <h3>Available Buses</h3>
      <div class="results-grid">
        @foreach($availableSchedules as $schedule)
        <div class="bus-item">
          <div class="bus-header">
            <h4>{{ $schedule->vehicle->vehicle_type }}</h4>
            <span>{{ $schedule->vehicle->available_seats }} seats available</span>
          </div>
          <p><strong>Route:</strong> {{ $schedule->route->departure_city }} to {{ $schedule->route->arrival_city }}</p>
          <p><strong>Departure:</strong> {{ $schedule->departure_time }}</p>
          <p><strong>Arrival:</strong> {{ $schedule->arrival_time }}</p>
          <p><strong>Fare:</strong> Rs {{ number_format($schedule->route->fare_per_seat, 2) }}</p>
          <button wire:click="selectSchedule({{ $schedule->id }})" class="btn-search" style="margin-top: 10px;" {{
            $schedule->vehicle->available_seats <= 0 ? 'disabled' : '' }}>
              Select Bus
          </button>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  <!-- Selected Bus Popup -->
  @if($selectedSchedule && $selectedScheduleForm)


  <div class="overlay-box">
    <div class="popup-content">
      <span class="close-btn" wire:click="$set('selectedSchedule', null)">&times;</span>
      <h3>Your Selection</h3> <button wire:click="$set('selectedSchedule', '')" style="background-color: #ccc;">
        Close
      </button>
      <div class="bus-item" style="margin-bottom: 20px;">
        <h4>{{ $selectedSchedule->vehicle->vehicle_type }}</h4>
        <p><strong>Route:</strong> {{ $selectedSchedule->route->departure_city }} to {{
          $selectedSchedule->route->arrival_city }}</p>
        <p><strong>Departure:</strong> {{ $selectedSchedule->departure_time }}</p>
        <p><strong>Arrival:</strong> {{ $selectedSchedule->arrival_time }}</p>
        <p><strong>Fare:</strong> Rs {{ number_format($selectedSchedule->route->fare_per_seat, 2) }}</p>
      </div>

      <h4>Passenger Details</h4>
      <div class="form-group">
        <input wire:model="passengerName" type="text" placeholder="Full Name" required>
        @error('passengerName') <span class="error-message">{{ $message}}</span> @enderror
      </div>

      <div class="form-group">
        <input wire:model="passengerPhone" type="tel" placeholder="Phone Number" required>
        @error('passengerPhone') <span class="error-message">{{ $message}}</span> @enderror
      </div>

      <div class="form-group">
        <input wire:model="passengerEmail" type="email" placeholder="Email" required>
        @error('passengerEmail') <span class="error-message">{{ $message}}</span> @enderror
      </div>

      <div class="form-group">
        <label for="seatSelection">Select Seat:</label>
        <select wire:model="selectedSeat" id="seatSelection" required>
          <option value="">Select a seat</option>
          @foreach(range(1, $selectedSchedule->vehicle->seating_capacity) as $seat)
          @if(!in_array($seat, $bookedSeats))
          <option value="{{ $seat }}">Seat {{ $seat }}</option>
          @endif
          @endforeach
        </select>
        @error('selectedSeat') <span class="error-message">{{ $message}}</span> @enderror
      </div>

      <button wire:click="bookTicket" class="btn-search" style="width: 100%;">
        Confirm Booking (Rs{{ number_format($selectedSchedule->fare, 2) }})
      </button>
    </div>
  </div>
  @endif

  <!-- Ticket Search Results Popup -->
  @if($showSearchResults)
  <button wire:click="$set('showSearchResults', false)" style="background-color: #ccc;">
    Close
  </button>
  <div class="overlay-box">
    <div class="popup-content">
      <span class="close-btn" wire:click="$set('showSearchResults', false)">&times;</span>
      <h3>Search Results</h3>

      @if($searchResults->count() > 0)
      <div class="results-grid">
        @foreach($searchResults as $result)
        <div class="ticket-result">
          <div class="ticket-header">
            <span class="ticket-number">{{ $result->ticket_number }}</span>
            <span class="ticket-status {{ $result->payment_status }}">
              {{ ucfirst($result->payment_status) }}
            </span>
          </div>
          <p><strong>Passenger:</strong> {{ $result->passenger_name }}</p>
          <p><strong>Route:</strong> {{ $result->route->departure_city }} to {{ $result->route->arrival_city }}</p>
          <p><strong>Date:</strong> {{ $result->travel_date->format('M d, Y') }}</p>
          <p><strong>Seat:</strong> {{ $result->seats->pluck('seat_number')->join(', ') }}</p>
          <button wire:click="downloadTicket({{ $result->id }})" class="btn-search" style="margin-top: 10px;">
            Download Ticket
          </button>
        </div>
        @endforeach
      </div>
      @else
      <div class="no-results">
        <p>No tickets found matching your search.</p>
      </div>
      @endif
    </div>
  </div>
  @endif

  <!-- Booking Confirmation Popup -->
  @if($bookingConfirmed && $paymentStatus === 'success')
  <div class="overlay-box">
    <div class="confirmation-content">
      <h3>Booking Confirmed!</h3>
      <div class="ticket-details">
        <div class="detail-row">
          <span>Ticket Number:</span>
          <span>{{ $ticket->ticket_number }}</span>
        </div>
        <div class="detail-row">
          <span>Passenger:</span>
          <span>{{ $ticket->passenger_name }}</span>
        </div>
        <div class="detail-row">
          <span>Route:</span>
          <span>{{ $bookedRoute->route->departure_city }} to {{ $bookedRoute->route->arrival_city }}</span>
        </div>
        <div class="detail-row">
          <span>Departure:</span>
          <span>{{ \Carbon\Carbon::parse($bookedRoute->schedule->departure_time)->format('h:i A') }}</span>
        </div>
        <div class="detail-row">
          <span>Seat Number:</span>
          <span>{{ $ticket->seat_number }}</span>
        </div>
        <div class="detail-row">
          <span>Total Paid:</span>
          <span>Rs {{ number_format($ticket->total_amount, 2) }}</span>
        </div>
      </div>
      <div style="margin-top: 20px; display: flex; gap: 10px;">
        <button wire:click="downloadTicket({{ $ticket->id }})" class="btn-search">
          Download Ticket
        </button>
        <button onclick="window.print()" class="btn-search">
          Print Ticket
        </button>
        <button wire:click="$set('bookingConfirmed', false)" style="background-color: #ccc;">
          Close
        </button>
      </div>
    </div>
  </div>
  @endif

  <!-- Fare Calculator -->
  <div class="fare-calculator">
    <h2>Fare Calculator</h2>
    <form wire:submit.prevent="calculateFare">
      <div class="form-group">
        <label>From</label>
        <select wire:model="fareFrom" wire:change="filterArrivalCities" required>
          <option value="">Select City</option>
          @foreach($departureCities as $city)
          <option value="{{ $city }}">{{ $city }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>To</label>
        <select wire:model="fareTo" required>
          <option value="">Select City</option>
          @if($fareFrom)
          @foreach($routes->where('departure_city', $fareFrom)->pluck('arrival_city')->unique() as $city)
          <option value="{{ $city }}">{{ $city }}</option>
          @endforeach
          @endif
        </select>
      </div>

      <div class="form-group">
        <label>Number of Seats</label>
        <input wire:model="seats" type="number" min="1" max="10" required />
      </div>

      <div class="form-group">
        <label>Passenger Type</label>
        <select wire:model="passengerType">
          <option value="adult">Adult</option>
          <option value="child">Child (Under 12)</option>
          <option value="senior">Senior (60+)</option>
        </select>
      </div>

      <button type="submit" class="btn-calculate">Calculate Fare</button>

      <div style="margin-top: 15px;">
        <p><strong>Total Fare:</strong>
          @if($totalFare !== '--')
          Rs{{ number_format($totalFare, 2) }}
          @else
          {{ $totalFare }}
          @endif
        </p>
      </div>
    </form>
  </div>
  <div
    style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 30px;">
    <h2>Tickets History</h2>

    <div class="table-controls">
      <label>Show
        <select wire:model="perPage">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select> entries
      </label>

      <div>
        <input type="text" wire:model.live="search" placeholder="Search..." class="search-input" style="width: 300px;">
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>S. No.</th>
          <th>Ticket No.</th>
          <th>Departure</th>
          <th>Arrival</th>
          <th>Passenger</th>
          <th>Contact</th>
          <th>Seats</th>
          <th>Booking Date</th>
          <th>Actions</th>
          <th>        </th>
        </tr>
      </thead>
      <tbody>
        @forelse($tickets as $ticket)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $ticket->ticket_number }}</td>
          <td>{{ $ticket->route->departure_city }}</td>
          <td>{{ $ticket->route->arrival_city }}</td>
          <td>{{ $ticket->passenger_name }}</td>
          <td>{{ $ticket->passenger_phone }}</td>
          <td>{{ $ticket->seats->pluck('seat_number')->join(', ') }}</td>
          <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
          <td>
            <button wire:click="downloadTicket({{ $ticket->id }})" class="btn-search"
              style="padding: 5px 10px; font-size: 0.8rem;">
              Download
            </button>
          </td>
          <td>     
      <button class="delete-btn" wire:click="deleteSelected">Delete</button></td>
        </tr>
        @empty
        <tr>
          <td colspan="9" style="text-align: center;">No tickets found</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="table-actions">

      
    </div>

   <div class="pagination-container" style="margin-top: 20px;">
    <div class="pagination-wrapper" style="display: flex; justify-content: center; align-items: center;">
        {{ $tickets->links() }}
    </div>
</div>


  </div>
</div>
</div>