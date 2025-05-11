<!-- resources/views/livewire/enduser/ticket-booking.blade.php -->
<div class="ticket-booking-container">


    @if($theme->theme === 'light')
    @vite('resources/css/enduser/theme1/ticketbooking.css')
    @else
    @vite('resources/css/enduser/theme1/ticketbooking2.css')
    @endif

    <style>
        .hero {
            margin-top: -115px;
            width: 667px;
        }

        .content-wrapper {
            display: flex;
            flex-direction: row
        }

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

        .confirmation-content,
        .error-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            animation: fadeIn 0.3s ease-out;
        }

        .confirmation-header,
        .error-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .success-icon {
            color: #28a745;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .error-icon {
            color: #dc3545;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .ticket-details {
            margin: 1.5rem 0;
        }

        .ticket-search-section {
            color: black;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        .detail-value {
            color: #333;
        }

        .confirmation-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-download,
        .btn-print,
        .btn-close,
        .btn-retry {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-download {
            background: #17a2b8;
            color: white;
        }

        .btn-print {
            background: #6c757d;
            color: white;
        }

        .btn-close {
            background: #f8f9fa;
            color: #333;
        }

        .btn-retry {
            background: #dc3545;
            color: white;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }




        /* Add to your CSS */
        .ticket-search-section {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-form {
            display: flex;
            flex-grow: 1;
            gap: 0.5rem;
        }

        .search-form input {
            flex-grow: 1;
            padding: 0.75rem;
            border: 1px solid hsl(0, 0%, 87%);
            border-radius: 4px;
            color: black;
        }

        .btn-search,
        .btn-clear {
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .hero .btn-search {
            background: #866e1d;
            color: white;
            width: 100px;
            padding: 10px;
        }

        . .btn-clear {
            background: #f8f9fa;
            color: #333;
        }

        .search-results {
            border-top: 1px solid #eee;
            padding-top: 1rem;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .ticket-result {
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 6px;
            border-left: 4px solid #3a7bd5;
        }

        .ticket-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .ticket-number {
            font-weight: bold;
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

        .ticket-actions {
            margin-top: 0.5rem;
            display: flex;
            justify-content: flex-end;
        }

        .btn-download-sm {
            padding: 0.5rem 1rem;
            background: #17a2b8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .no-results {
            text-align: center;
            padding: 1rem;
            color: #666;
        }
    </style>


    <section class="hero-section"
        style="background: url('{{ Vite::asset('resources/images/ticket.jpg') }}') no-repeat center center/cover; min-height: 400px;">
        <div class="content-wrapper">
            <!-- Left: Booking Form -->
            <div id="dynamicContent">
                <div class="booking-form">
                    <h2>Book Your Ticket</h2>
                    <p>this is error {{$bookingConfirmed}}</p>
                    <form wire:submit.prevent="searchSchedules">
                        <!-- Departure City -->
                        <div class="form-group">
                            <label for="departure_city">From</label>
                            <select name="departure_city" id="departure_city" wire:model.live="selectedDepartureCity"
                                wire:change="filterArrivalCities" class="form-control" required>
                                <option value="">Select Departure City</option>
                                @foreach ($departureCities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach

                            </select>
                            @error('selectedDepartureCity')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Arrival City -->
                        <div class="form-group">
                            <label for="arrival_city">To</label>
                            <select name="arrival_city" id="arrival_city" wire:model.live="selectedArrivalCity"
                                class="form-control" {{ empty($arrivalCities) ? 'disabled' : '' }} required>

                                <option value="">Select Arrival City</option>
                                @foreach ($arrivalCities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                            @error('selectedArrivalCity')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            <label for="date">Travel Date</label>
                            <input wire:model="date" type="date" id="date" class="form-control"
                                min="{{ now()->format('Y-m-d') }}" required />
                            @error('date')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-search">
                            {{-- {{ !$selectedDepartureCity || !$selectedArrivalCity || !$date ? 'disabled' : '' }}>
                            --}}
                            Search Buses
                        </button>
                    </form>
                </div>

            </div>


            <!-- search result  -->
            <!-- Add this near the top of your blade file -->


            @if($showSearchResults)
            <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center text-black">

                <!-- Close button -->
                <button class="absolute top-4 right-4 text-white text-2xl hover:text-red-500 z-50"
                    wire:click.away="$set('showSearchResults', false)" aria-label="Close">
                    &times;
                </button>

                <!-- Modal content -->
                <div class="search-results mt-4 relative bg-white p-6 rounded shadow-lg max-h-[90vh] overflow-y-auto">
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
                            <div class="ticket-body">
                                <p><strong>Passenger:</strong> {{ $result->passenger_name }}</p>
                                <p><strong>Route:</strong> {{ $result->route->departure_city }} to {{
                                    $result->route->arrival_city }}</p>
                                <p><strong>Date:</strong> {{ $result->travel_date->format('M d, Y') }}</p>
                                <p><strong>Seat:</strong>
                                    {{ $result->seats->pluck('seat_number')->join(', ') }}
                                </p>

                                <div class="ticket-actions">
                                    <p class="m-1">Download to view more detail</p>
                                    <button wire:click="downloadTicket({{ $result->id }})" class="btn-download-sm">
                                        <i class="fas fa-download"></i> Download
                                    </button>
                                </div>
                            </div>
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



















            <!-- Available Buses -->
            @if(count($availableSchedules) > 0 && !$selectedSchedule)


<div x-data="{ open: true }" x-cloak>
                    <div class="modal-overlay fixed inset-0 z-50" x-show="open" @click.away="open = false" x-transition>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 overlay-box ticket-detail">
                



                        <button class="absolute top-4 right-4 text-white text-2xl hover:text-red-500 z-50"
                            wire:click.away="$set('selectedSchedule', true)" aria-label="Close">
                            &times;
                        </button>
                        <h1>Available</h1>
                        @foreach($availableSchedules as $schedule)
                        <div
                            class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition duration-300 flex flex-col justify-between ">
                            <div>
                                <h4 class="text-xl font-bold text-blue-700 mb-2">{{ $schedule->vehicle->vehicle_type }}
                                </h4>
                                <p class="text-gray-600 text-sm mb-1">Vehicle Type: <span class="font-medium">{{
                                        $schedule->route->vehicle_type }}</span></p>

                                <div class="flex items-center justify-between mt-4 text-sm text-gray-700">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-clock text-blue-500"></i>
                                        Departure: {{ $schedule->departure_time }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-flag-checkered text-green-500"></i>
                                        Arrival: {{ $schedule->arrival_time }}
                                    </span>
                                </div>

                                <div class="mt-4 flex items-center text-sm text-gray-700">
                                    <i class="fas fa-chair mr-2 text-orange-400"></i>
                                    {{ $schedule->vehicle->available_seats }} seats available
                                </div>

                                <div class="mt-2 text-lg font-semibold text-green-600">
                                    Fare: Rs {{ number_format($schedule->route->fare_per_seat, 2) }}
                                </div>
                            </div>

                            <button wire:click="selectSchedule({{ $schedule->id }})"
                                class="mt-6 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ $schedule->vehicle->available_seats <= 0 ? 'disabled' : '' }}>
                                    Select
                            </button>
                        </div>
                        @endforeach
                    </div>

                    @elseif($searched && count($availableSchedules) === 0)
                    <div class="no-buses">
                        <p>No buses available for the selected route and date.</p>
                    </div>
                </div>
            </div>
            @endif


            <!-- Selected Bus Details -->
            @if($selectedSchedule && $selectedScheduleForm)
            <div class="selected-bus overlay-box">

  <button class="absolute top-4 right-4 text-white text-2xl hover:text-red-500 z-50"
                            wire:click.away="$set('selectedSchedule', null)" aria-label="Close">
                            &times;
                        </button>


                <h3>Your Selection</h3>
                <div class="bus-details">
                    <div class="ticke-info">
                        <h4>{{ $selectedSchedule->vehicle->vehicle_type }}</h4>
                        <p>Departure: {{ $selectedSchedule->departure_time }}</p>
                        <p>Arrival: {{ $selectedSchedule->arrival_time}}</p>
                        <p>Duration:</p>
                        <p>Fare: ${{ number_format($selectedSchedule->route->fare_per_seat, 2) }}</p>
                    </div>
                    <div class="passenger-details">
                        <h4>Passenger Details</h4>

                        <input wire:model="passengerName" type="text" placeholder="Full Name" required>
                        @error('passengerName')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror

                        <input wire:model="passengerPhone" type="tel" placeholder="Phone Number" required>
                        @error('passengerPhone')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror

                        <input wire:model="passengerEmail" type="email" placeholder="Email" required>
                        @error('passengerEmail')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror

                        <label for="seatSelection">Select Seat:</label>
                        <select wire:model="selectedSeat" id="seatSelection" required>
                            <option value="">Select a seat</option>
                            @foreach(range(1, $selectedSchedule->vehicle->seating_capacity) as $seat)
                            @if(!in_array($seat, $bookedSeats))
                            <option value="{{ $seat }}">Seat {{ $seat }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('selectedSeat')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                    </div>

                    <button wire:click="bookTicket" class="btn-book">
                        Confirm Booking (${{ number_format($selectedSchedule->fare, 2) }})
                    </button>
                </div>
            </div>
            @endif


            <!-- Booking Confirmation -->
            <!-- Booking Confirmation Section -->


            @if($bookingConfirmed && $paymentStatus === 'success')
            <div x-data="{ open: true }" x-cloak>
                <div class="modal-overlay fixed inset-0 z-50" x-show="open" @click.away="open = false" x-transition>
                    <p class="hidden">{{$bookingConfirmed }}</p>
                    <button class="absolute top-4 right-4 text-white text-2xl hover:text-red-500 z-50"
                        wire:click.away="$set('bookingConfirmed', false )" aria-label="Close">
                        &times;
                    </button>
                    <div class="booking-confirmation overlay-box">
                        <div class="confirmation-content">
                            <div class="confirmation-header">
                                <i class="fas fa-check-circle success-icon"></i>
                                <h3>Booking Confirmed!</h3>
                            </div>

                            <div class="ticket-details">
                                <div class="detail-row">
                                    <span class="detail-label">Ticket Number:</span>
                                    <span class="detail-value">{{ $ticket->ticket_number }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Passenger:</span>
                                    <span class="detail-value">{{ $ticket->passenger_name }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Route:</span>
                                    <span class="detail-value">
                                        {{ $bookedRoute->route->departure_city }} to {{
                                        $bookedRoute->route->arrival_city }}

                                    </span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Departure:</span>
                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($bookedRoute->schedule->departure_time)->format(' h:i
                                        A') }}
                                    </span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Seat Number:</span>
                                    <span class="detail-value">{{ $ticket->seat_number }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Total Paid:</span>
                                    <span class="detail-value">Rs {{ number_format($ticket->total_amount, 2) }}</span>
                                </div>
                            </div>

                            <div class="confirmation-actions">
                                <button wire:click="downloadTicket({{ $ticket->id }})" class="btn-download">
                                    <i class="fas fa-download"></i> Download Ticket
                                </button>
                                <button onclick="window.print()" class="btn-print">
                                    <i class="fas fa-print"></i> Print Ticket
                                </button>
                                <button wire:click="$set('bookingConfirmed', false)" class="btn-close">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($errors->has('bookingError'))
                    <div class="booking-error overlay-box">
                        <div class="error-content">
                            <div class="error-header">
                                <i class="fas fa-times-circle error-icon"></i>
                                <h3>Booking Failed</h3>
                            </div>
                            <p>{{ $errors->first('bookingError') }}</p>
                            <button wire:click="$set('paymentStatus', null)" class="btn-retry">
                                Try Again
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif



            <div class="flex flex-col hero">
                <!-- Right: Hero Text -->
                <div class="hero-text">
                    <h1>Book Your Ticket Now</h1>

                    <p>
                        We ensure the ticket booking is accessible to passengers at transparent
                        prices with no booking charges. Passengers can get the most accurate real-time
                        data of bus seat availability from among the list of operators.

                    </p>



                </div>
                <div class="search-container flex flex-col ">
                    <h3>Search Your Tickets</h3>
                    <div class="search-form">
                        <input wire:model="searchTerm" type="text"
                            placeholder="Search by ticket number, name, phone or email">
                        <button wire:click="searchTickets" class="btn-search">Search</button>
                        @if($showSearchResults)
                        <button wire:click="clearSearch" class="btn-clear">Clear</button>
                        @endif
                    </div>
                </div>

            </div>


        </div>
    </section>

    <!-- Fare Calculator Section -->
    <section class="fare-section">




        <div class="fare-calculator">
            <h2>Fare Calculator</h2>
            <form wire:submit.prevent="calculateFare">
                <div class="form-group">
                    <label for="fare-from">From</label>
                    <select wire:model="fareFrom" wire:change="filterArrivalCities" name="fare-from" id="fare-from"
                        class="form-control" required>
                        <option value="">-- Select City --</option>
                        @foreach($departureCities as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fare-to">To</label>
                    <select wire:model="fareTo" name="fare-to" id="fare-to" class="form-control" {{ !$departureCities
                        ? 'disabled' : '' }} required>
                        <option value="">-- Select City --</option>
                        @if($fareFrom)
                        @foreach($routes->where('departure_city', $fareFrom)->pluck('arrival_city')->unique() as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="fare-seats">Number of Seats</label>
                    <input wire:model="seats" type="number" id="fare-seats" min="1" max="10" class="form-control"
                        required />
                </div>

                <div class="form-group">
                    <label for="passenger">Passenger Type</label>
                    <select wire:model="passengerType" id="passenger" class="form-control">
                        <option value="adult">Adult</option>
                        <option value="child">Child (Under 12)</option>
                        <option value="senior">Senior (60+)</option>
                    </select>
                </div>

                <button type="submit" class="btn-calculate">

                    Calculate Fare
                </button>

                <div class="fare-display">
                    <p class="total-fare">
                        <strong>Total Fare:</strong>
                        <span id="totalFare">
                            @if($totalFare !== '--')
                            ${{ number_format($totalFare, 2) }}
                            @else
                            {{ $totalFare }}
                            @endif
                        </span>
                    </p>
                    @if($calculatedFare)
                    <p class="fare-details">
                        (Base Fare: Rs{{ number_format($routes->where('departure_city',
                        $fareFrom)->where('arrival_city', $fareTo)->first()->fare_per_seat ?? 0, 2) }} ×
                        {{ $seats }} {{ Str::plural('seat', $seats) }} ×
                        {{ $passengerType }} multiplier: {{ $passengerMultiplier }})
                    </p>
                    @endif
                </div>
            </form>
        </div>

        <div class="hero-text">
            <h1>Calculate Your Fare Instantly</h1>
            <p>
                Easily estimate your bus fare with our transparent and accurate fare calculator.
                Get real-time pricing details with no hidden charges.
            </p>
        </div>
    </section>
</div>