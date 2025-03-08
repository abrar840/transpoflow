<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanyService;
use App\Models\Company;
class SideBar extends Component
{
   
  public  $services,$user_id,$Company_id,$serviceNames=[];


  public function mount()
  {
      // Get the logged-in user's ID
      $this->user_id = auth()->user()->id;
  
      // Fetch the company associated with the user
      $this->company = Company::where('user_id', $this->user_id)->first();
  
      // Fetch services for the company
      if ($this->company) {
          $this->services = $this->company->services; // Fetch related services
      } else {
          $this->services = collect();  
      }
  
      // Debugging: Check the fetched services
       
  
      // Extract service names (if needed)
      $this->serviceNames = $this->services->pluck('name'); // Get an array of service names
  }

  public function render()
  {
      return view('livewire.side-bar', [
          'serviceNames' => $this->serviceNames, // Pass serviceNames to the view
      ]);
  }
}
