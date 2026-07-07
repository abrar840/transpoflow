<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;

class SideBar extends Component
{
    public $serviceNames = [];
    public $company;

    public function mount()
    {
        $user = auth()->user();

        if (! $user) {
            return;
        }

        $this->company = Company::where('user_id', $user->id)->first();

        $this->serviceNames = $this->company
            ? $this->company->services->pluck('name')->map(fn ($n) => trim($n))->values()->all()
            : [];
    }

    public function render()
    {
        return view('livewire.side-bar');
    }
}