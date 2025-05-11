<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Trait\SharedTicketBooking;
use App\Models\Ticket;

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