<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
class Home extends Component
{


    public $theme = 'light';
    public $company;

    public function mount(Company $company)
    {
        $this->company = $company;

        

        if (!$this->company) {
            abort(404); // Company not found, show 404 page
        }
        // dd($this->company->name);
        // Store company id in session
        // session(['company_id' => $this->company->id]);
        $this->theme = $company->theme ?? 'light';
    }

    public function render()
    {


        return view('livewire.enduser.home')->layout('layouts.user', [ 'company' => $this->company, ]);
    }
}
