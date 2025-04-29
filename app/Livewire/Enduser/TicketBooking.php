<?php

namespace App\Livewire\Enduser;

use Livewire\Component;

class TicketBooking extends Component
{
    public function render()
    {
        return view('livewire.enduser.ticket-booking')->layout('layouts.user');
    }
}
