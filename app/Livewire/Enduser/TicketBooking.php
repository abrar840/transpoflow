<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company;
use App\Models\Routes;
use App\Models\VehicleSchedule;
use App\Models\Ticket;
use App\Models\TicketSeat;


use App\Models\Bus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TicketBooking extends Component
{
    public $company;
    public $theme = 'light';

    // Booking form fields
    public $selectedDepartureCity = null;
    public $selectedArrivalCity = null;
    public $date;
    public $availableSchedules = [];
    public $searched = false;
    public $selectedSchedule = null;
    public $bookedSeats = [];
    
    // Passenger details
    public $passengerName;
    public $passengerPhone;
    public $passengerEmail;
    public $selectedSeat;
    
    // Booking confirmation
    public $bookingConfirmed = false;
    public $ticket;
    
    // Fare calculator fields
    public $fareFrom;
    public $fareTo;
    public $seats = 1;
    public $passengerType = 'adult';
    public $totalFare = '--';
    public $calculatedFare = false;
    public $passengerMultiplier = 1.0;

    // Data from DB
    public $departureCities = [];
    public $arrivalCities = [];
    public $cities = [];
    public $routes;

    public $seatTaken;
     



    public function mount(Company $company)
    {
        $this->company = $company;
        $this->theme = $company->theme ?? 'light';
        $this->loadInitialData();
    }

    public function loadInitialData(): void
    {
        $this->routes = Routes::where('company_id', $this->company->id)->get();
        
        $this->departureCities = $this->routes
            ->pluck('departure_city')
            ->unique()
            ->sort()
            ->values()
            ->toArray();
            
        $this->cities = $this->routes
            ->pluck('departure_city')
            ->merge($this->routes->pluck('arrival_city'))
            ->unique()
            ->sort()
            ->values()
            ->toArray();
    }

    public function filterArrivalCities()
    {
        $this->reset(['selectedArrivalCity', 'arrivalCities', 'availableSchedules', 'selectedSchedule']);
        
        if ($this->selectedDepartureCity) {
            $this->arrivalCities = $this->routes
                ->where('departure_city', $this->selectedDepartureCity)
                ->pluck('arrival_city')
                ->unique()
                ->sort()
                ->values()
                ->toArray();
        }
    }

    public function searchSchedules()
    {
        $this->validate([
            'selectedDepartureCity' => 'required',
            'selectedArrivalCity' => 'required',
            'date' => 'required|date|after_or_equal:today',
        ]);
        
        $fifteenDaysAgo = now()->subDays(15);
        
        $this->availableSchedules = VehicleSchedule::with(['vehicle', 'route'])
            ->whereHas('route', function($query) {
                $query->where('departure_city', $this->selectedDepartureCity)
                      ->where('arrival_city', $this->selectedArrivalCity);
            })
            ->where('created_at', '>=', $fifteenDaysAgo)
            // ->whereDate('date', $this->date) // Make sure you have a 'date' column
            // ->where('status', 'active')
            ->get();   
 
            
        $this->searched = true;
        $this->selectedSchedule = null;
    }

    public function selectSchedule($scheduleId)
    {
        $this->selectedSchedule = VehicleSchedule::with(['vehicle', 'route'])->find($scheduleId);
        $this->bookedTicket = Ticket::where('schedule_id', $scheduleId);
          $this->bookedSeats=$this->bookedTicket->seats->seat_number->toArray();;
        
       
            
    }
    public function bookTicket()
    {
        // Check authentication
        $user = auth('end_user')->user();
        if (!$user) {
            return redirect()->route('end-user-login', ['company' => $this->company->name]);
        }
    
        $this->validate([
            'passengerName' => 'required|string|max:255',
            'passengerPhone' => 'required|string|max:20',
            'passengerEmail' => 'required|email|max:255',
            'selectedSeat' => [
                'required',
                'integer',
                'min:1',
                'max:' . $this->selectedSchedule->vehicle->seating_capacity,
                function ($attribute, $value, $fail) {
                    $isTaken = TicketSeat::whereHas('ticket', function($query) {
                            $query->where('schedule_id', $this->selectedSchedule->id);
                        })
                        ->where('seat_number', $value)
                        ->exists();
                    
                    if ($isTaken) {
                        $fail('This seat has already been booked.');
                    }
                },
            ],
        ]);
    
        DB::transaction(function () use ($user) {
            // Create the ticket
            $this->ticket = Ticket::create([
                'ticket_number' => 'TKT-' . Str::upper(Str::random(8)),
                'user_id' => $user->id,
                'company_id' => $this->company->id,
                'vehicle_id' => $this->selectedSchedule->vehicle_id,
                'schedule_id' => $this->selectedSchedule->id,
                'route_id' => $this->selectedSchedule->route_id,
                'passenger_name' => $this->passengerName,
                'passenger_phone' => $this->passengerPhone,
                'passenger_email' => $this->passengerEmail,
                'travel_date' => $this->date, // Make sure $this->date is set
                'seat_number' => $this->selectedSeat, // Still keeping this for backward compatibility
                'fare' => $this->selectedSchedule->fare,
                'status' => 'confirmed',
                'booking_date' => now(),
            ]);
    
            // Create the ticket seat record
            TicketSeat::create([
                'ticket_id' => $this->ticket->id,
                'seat_number' => $this->selectedSeat
            ]);
    
            $this->bookingConfirmed = true;
        });
    }

    public function calculateFare()
    {
        $this->validate([
            'fareFrom' => 'required',
            'fareTo' => 'required',
            'seats' => 'required|integer|min:1|max:10',
        ]);
        
        $route = Routes::where('departure_city', $this->fareFrom)
            ->where('arrival_city', $this->fareTo)->where('company_id',$this->company->id)
            ->first();

          
            
        if (!$route) {
            $this->totalFare = 'Route not found';
            $this->calculatedFare = false;
            return;
        }
        
        // Set multiplier based on passenger type
        $this->passengerMultiplier = 1.0;
        if ($this->passengerType === 'child') {
            $this->passengerMultiplier = $route->child_fare_multiplier ?? 0.75;
        } elseif ($this->passengerType === 'senior') {
            $this->passengerMultiplier = $route->senior_fare_multiplier ?? 0.8;
        }
        
        $this->totalFare = $route->fare_per_seat* $this->seats * $this->passengerMultiplier;
        $this->calculatedFare = true;
    }

    public function render()
    {
        return view('livewire.enduser.ticket-booking')->layout('layouts.user', [ 'company' => $this->company, ]);
    }
}