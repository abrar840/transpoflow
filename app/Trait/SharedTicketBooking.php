<?php

namespace App\Trait;
use App\Models\CargoBook;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

 


use App\Models\Company;
use App\Models\Routes;
use App\Models\VehicleSchedule;
use App\Models\Ticket;
use App\Models\TicketSeat;

 
use App\Models\Bus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


trait SharedTicketBooking
{









 


 
    public $searchTerm = '';
    public $searchResults = [];
    public $showSearchResults = false;
    public $company;
    public $theme = 'light';
    public $selectedScheduleForm = false;
    // Booking form fields

    public $bookedRoute;
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
    public $paymentStatus;
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
            ->whereHas('route', function ($query) {
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
        $this->bookedTicket = Ticket::with('seats')->where('schedule_id', $scheduleId)->first();

        $this->bookedSeats = $this->bookedTicket
            ? $this->bookedTicket->seats->pluck('seat_number')->toArray()
            : [];


        $this->selectedScheduleForm = true;

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
                    $isTaken = TicketSeat::whereHas('ticket', function ($query) {
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

        try {
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
                    'travel_date' => $this->date,
                    'seat_number' => $this->selectedSeat,
                    'fare' => $this->selectedSchedule->route->fare_per_seat,
                    'total_amount' => $this->selectedSchedule->route->fare_per_seat,
                    'payment_status' => 'paid',
                    'valid_until' => now()->addDays(1),
                    'booking_date' => now(),
                ]);

                // Create the ticket seat record
                TicketSeat::create([
                    'ticket_id' => $this->ticket->id,
                    'seat_number' => $this->selectedSeat
                ]);

                // Set success flags
                $this->bookedRoute = Ticket::with('route', 'schedule')->find($this->ticket->id)->first();
                $this->bookingConfirmed = true;
                $this->paymentStatus = 'success';
            });

            // Clear form fields after successful booking
            $this->resetForm();

        } catch (\Exception $e) {
            $this->paymentStatus = 'failed';
            $this->addError('bookingError', 'Failed to create booking: ' . $e->getMessage());
        }
    }




    protected function resetForm()
    {
        $this->reset([
            'passengerName',
            'passengerPhone',
            'passengerEmail',
            'selectedSeat',
            'selectedSchedule',
            'bookedSeats',
            'availableSchedules',
            'searched'
        ]);

        // Keep these values as they're needed for UI
        session()->keep([
            'company',
            'theme',
            'departureCities',
            'arrivalCities',
            'cities',
            'routes'
        ]);

    }




    public function downloadTicket($ticketId)
    {
        $ticket = Ticket::with(['vehicle', 'schedule', 'route','seats'])->findOrFail($ticketId);
        $pdf = Pdf::loadView('pdf.TicketBookingSlip', compact('ticket'));

        return response()->streamDownload(
            fn() => print ($pdf->output()),
            "ticket-{$ticket->ticket_number}.pdf"
        );
    }








    public function calculateFare()
    {
        $this->validate([
            'fareFrom' => 'required',
            'fareTo' => 'required',
            'seats' => 'required|integer|min:1|max:10',
        ]);

        $route = Routes::where('departure_city', $this->fareFrom)
            ->where('arrival_city', $this->fareTo)->where('company_id', $this->company->id)
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

        $this->totalFare = $route->fare_per_seat * $this->seats * $this->passengerMultiplier;
        $this->calculatedFare = true;
    }




public function searchTickets()
{
    $this->validate([
        'searchTerm' => 'required|min:3'
    ]);

    $this->searchResults = Ticket::where('user_id', auth('end_user')->id())
        ->where(function($query) {
            $query->where('ticket_number', 'like', '%'.$this->searchTerm.'%')
                  ->orWhere('passenger_name', 'like', '%'.$this->searchTerm.'%')
                  ->orWhere('passenger_phone', 'like', '%'.$this->searchTerm.'%')
                   ->orWhere('booking_date', 'like', '%'.$this->searchTerm.'%');
        })
        ->with(['vehicle', 'route', 'schedule'])
        ->latest()
        ->get();

    $this->showSearchResults = true;
}

public function clearSearch()
{
    $this->reset(['searchTerm', 'searchResults', 'showSearchResults']);
}






    






}