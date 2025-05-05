<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company; // Fix: Capital 'A' in App

class CargoBooking extends Component
{
    public $company;
    public $theme = 'light';

    public function mount(Company $company)
    {
        $this->company = $company;

        if (!$this->company) {
            abort(404); // Company not found, show 404 page
        }

        // Check if company has a theme (assuming relation: $company->theme or $company->companyTheme)
        $this->theme = $company->theme ?? 'light';
       //
    }

    public function render()
    {
        return view('livewire.enduser.cargo-booking', [
            'theme' => $this->theme,
        ])->layout('layouts.user');
    }
}