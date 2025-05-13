<?php

namespace App\Livewire\Enduser;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Header1 extends Component
{
    public $company;
    public $serviceNames = [];
    public $user;
    public $isauth = false;

    public $logo;
    public function mount(Company $company = null)
    {


        $this->user = Auth::guard('end_user')->user();


        if ($this->user) {

            if ($this->user->company->id == $this->company->id) {
                $this->isauth = true;
            }
        }






        $this->company = $company;


        $this->logo=$this->company->logo;
        $this->serviceNames = $company->services->pluck('name')->toArray() ?? [];
        // dd($this->serviceNames[]);
    }

    public function render()
    {
        return view('livewire.enduser.header1');
    }
}
