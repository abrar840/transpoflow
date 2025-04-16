<?php

namespace App\Livewire;

use Livewire\Component;

class ManageTicket extends Component
{

    public $activeForm = 'route'; // Controls which form is visible
    
    // Update method that header can call
    public function switchForm($form)
    {
        $this->activeForm = $form;
    }

    public function render()
    {
        return view('livewire.manage-ticket');
    }
}
