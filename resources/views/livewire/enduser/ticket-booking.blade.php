<!-- resources/views/livewire/enduser/ticket-booking.blade.php -->
<div class="ticket-booking-container">
    

    @if($theme->theme === 'light')
        @vite('resources/css/enduser/theme1/ticketbooking.css')
    @else
        @vite('resources/css/enduser/theme1/ticketbooking2.css')
    @endif


    <style>/* Make form controls clearly visible */
        .form-control {
            background-color: white;
            color: #333;
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        /* Style placeholders */
        .form-control::placeholder {
            color: #999;
            opacity: 1;
        }
        
        /* Make labels more prominent */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }</style>

    <section class="hero-section" style="background: url('{{ Vite::asset('resources/images/ticket.jpg') }}') no-repeat center center/cover; min-height: 400px;">
        <div class="content-wrapper">
            <!-- Left: Booking Form -->
            <div id="dynamicContent">
                <div class="booking-form">
                    <h2>Book Your Ticket</h2>

                    <form wire:submit.prevent="searchSchedules">
                        <!-- Departure City -->
                        <div class="form-group">
                            <label for="departure_city">From</label>
                            <select name="departure_city" id="departure_city" 
                                    wire:model.live="selectedDepartureCity" 
                                    wire:change="filterArrivalCities"
                                    class="form-control" required>
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
                            <select name="arrival_city" id="arrival_city" 
                                    wire:model.live="selectedArrivalCity" 
                                    class="form-control" 
                                    {{ empty($arrivalCities) ? 'disabled' : '' }} required>
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
                            <input wire:model="date" type="date" id="date" 
                                   class="form-control" 
                                   min="{{ now()->format('Y-m-d') }}" required />
                            @error('date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-search">
                                {{-- {{ !$selectedDepartureCity || !$selectedArrivalCity || !$date ? 'disabled' : '' }}> --}}
                            Search Buses
                        </button>
                    </form>

                    <!-- Available Buses -->
                    @if(count($availableSchedules) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <h1>Available Buses</h1>
                        @foreach($availableSchedules as $schedule)
                            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition duration-300 flex flex-col justify-between">
                                <div>
                                    <h4 class="text-xl font-bold text-blue-700 mb-2">{{ $schedule->vehicle->vehicle_type }}</h4>
                                    <p class="text-gray-600 text-sm mb-1">Vehicle Type: <span class="font-medium">{{ $schedule->route->vehicle_type }}</span></p>
                    
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
                    @endif

                    <!-- Selected Bus Details -->
                    @if($selectedSchedule)
                        <div class="selected-bus">
                            <h3>Your Selection</h3>
                            <div class="bus-details">
                                <h4>{{ $selectedSchedule->bus->name }}</h4>
                                <p>Departure: {{ $selectedSchedule->departure_time->format('h:i A, M d, Y') }}</p>
                                <p>Arrival: {{ $selectedSchedule->arrival_time->format('h:i A, M d, Y') }}</p>
                                <p>Duration: {{ $selectedSchedule->duration }} hours</p>
                                <p>Fare: ${{ number_format($selectedSchedule->fare, 2) }}</p>
                                
                                <div class="passenger-details">
                                    <h4>Passenger Details</h4>
                                    <input wire:model="passengerName" type="text" placeholder="Full Name" required>
                                    <input wire:model="passengerPhone" type="tel" placeholder="Phone Number" required>
                                    <input wire:model="passengerEmail" type="email" placeholder="Email" required>
                                    
                                    <label for="seatSelection">Select Seat:</label>
                                    <select wire:model="selectedSeat" id="seatSelection" required>
                                        <option value="">Select a seat</option>
                                        @foreach(range(1, $selectedSchedule->bus->total_seats) as $seat)
                                            @if(!in_array($seat, $bookedSeats))
                                                <option value="{{ $seat }}">Seat {{ $seat }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <button wire:click="bookTicket" class="btn-book">
                                    Confirm Booking (${{ number_format($selectedSchedule->fare, 2) }})
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Booking Confirmation -->
                    @if($bookingConfirmed)
                        <div class="booking-confirmation">
                            <h3>Booking Confirmed!</h3>
                            <p>Your ticket has been successfully booked.</p>
                            <div class="ticket-details">
                                <p><strong>Ticket #:</strong> {{ $ticket->ticket_number }}</p>
                                <p><strong>Bus:</strong> {{ $ticket->schedule->bus->name }}</p>
                                <p><strong>Route:</strong> {{ $ticket->schedule->route->departure_city }} to {{ $ticket->schedule->route->arrival_city }}</p>
                                <p><strong>Departure:</strong> {{ $ticket->schedule->departure_time->format('M d, Y h:i A') }}</p>
                                <p><strong>Seat:</strong> {{ $ticket->seat_number }}</p>
                                <p><strong>Total Paid:</strong> ${{ number_format($ticket->fare, 2) }}</p>
                            </div>
                            <button class="btn-print" onclick="window.print()">Print Ticket</button>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Right: Hero Text -->
            <div class="hero-text">
                <h1>Book Your Ticket Now</h1>
                <p>
                    We ensure the ticket booking is accessible to passengers at transparent
                    prices with no booking charges. Passengers can get the most accurate real-time
                    data of bus seat availability from among the list of operators.
                </p>
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
                    <select wire:model="fareFrom"  wire:change="filterArrivalCities" name="fare-from" id="fare-from" class="form-control" required>
                        <option value="">-- Select City --</option>
                        @foreach($departureCities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="fare-to">To</label>
                    <select wire:model="fareTo" name="fare-to" id="fare-to" class="form-control" 
                            {{ !$departureCities ? 'disabled' : '' }} required>
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
                    <input wire:model="seats" type="number" id="fare-seats" min="1" max="10" class="form-control" required />
                </div>
                
                <div class="form-group">
                    <label for="passenger">Passenger Type</label>
                    <select wire:model="passengerType" id="passenger" class="form-control">
                        <option value="adult">Adult</option>
                        <option value="child">Child (Under 12)</option>
                        <option value="senior">Senior (60+)</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-calculate" >
                        
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
                            (Base Fare: Rs{{ number_format($routes->where('departure_city', $fareFrom)->where('arrival_city', $fareTo)->first()->fare_per_seat ?? 0, 2) }} × 
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