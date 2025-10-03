<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company;
use App\Models\Routes;
use App\Models\VehicleSchedule;
use App\Models\Ticket;
use App\Models\TicketSeat;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Trait\SharedTicketBooking;
class TicketBooking extends Component
{use SharedTicketBooking;
    
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->theme = session('theme');
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
 




    public function render()
    {
        return view('livewire.enduser.ticket-booking')->layout('layouts.user', ['company' => $this->company,]);
    }
}