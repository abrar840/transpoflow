<?php

namespace App\Livewire\Enduser;

use Livewire\Component;
use App\Models\Company;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class Home extends Component
{


    public $theme = 'light';
    public $company;
    public $user;
    public $isauth=false;
    public $services;
    public function mount(Company $company)
    {
        $this->company = $company;


        $this->user = Auth::guard('end_user')->user();


        if($this->user){

if($this->user->company->id==$this->company->id){
            $this->isauth=true;
}


        }


              $this->services = $company->services->pluck('name')->toArray() ?? [];

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
