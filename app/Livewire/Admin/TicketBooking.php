<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Trait\SharedTicketBooking;
use App\Models\Ticket;
use App\Models\TicketSeat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketBooking extends Component
{
    use SharedTicketBooking, WithPagination;
    
    public $user;
    public $company;
    public $search= '';
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->user = auth()->user();
        $this->company = $this->user->company;
        $this->loadInitialData();
    }


  public function bookTicket()
    {
        
         $user = auth()->user();
    
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




















    

    public function getTicketsProperty()
    {
        return Ticket::with(['route', 'schedule', 'vehicle', 'seats'])
            ->where('company_id', $this->company->id)
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('ticket_number', 'like', '%'.$this->search.'%')
                      ->orWhere('passenger_name', 'like', '%'.$this->search.'%')
                      ->orWhere('passenger_phone', 'like', '%'.$this->search.'%')
                      ->orWhereHas('route', function($routeQuery) {
                          $routeQuery->where('departure_city', 'like', '%'.$this->search.'%')
                                    ->orWhere('arrival_city', 'like', '%'.$this->search.'%');
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

















    public function render()
    {
        return view('livewire.admin.ticket-booking', [
            'tickets' => $this->tickets
        ]);
    }
}