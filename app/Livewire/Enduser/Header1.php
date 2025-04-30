<?php

namespace App\Livewire\Enduser;
use App\Models\Company;
use Livewire\Component;

class Header1 extends Component
{
    public $company;
    public $serviceNames = [];

    public function mount(Company $company=null)
    {
        $this->company = $company;
        $this->serviceNames = $company->services->pluck('name')->toArray() ?? [];
        // dd($this->serviceNames[]);
    }
 
    public function render()
    {
        return view('livewire.enduser.header1');
    }
}
