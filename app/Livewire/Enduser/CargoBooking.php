<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use app\models\Company;

class CargoBooking extends Component
{
    public   $company;

    public function mount(Company $company)
    {
        $this->company = $company;


        if (!$this->company) {
            abort(404); // Company not found, show 404 page
        }
        // dd($this->company->name);
        // Store company id in session
        // session(['company_id' => $this->company->id]);
    }

    public function render()
    {
        return view('livewire.enduser.cargo-booking')->layout('layouts.user');
    }
}
