<?php

namespace App\Livewire\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Routes;

class BusRouteRegistration extends Component
{


    public $departure_city;
    public $arrival_city;
    public $fare_per_seat;
    public $vehicle_type;
    public $editingId = null;
    public $company;
    public $routeFares = [];

    public $formId=null;

    
    protected $messages = [
        'departure_city.required' => 'Departure city is required',
        'arrival_city.different' => 'Arrival city must be different from departure',
        // ... other custom messages
    ];
    protected $rules = [
        'departure_city' => 'required|string|max:255',
        'arrival_city' => 'required|string|max:255|different:departure_city',
        'fare_per_seat' => 'required|numeric|min:0.01',
        'vehicle_type' => 'required|string|max:255'
    ];

    public function mount()
    {
        $this->initializeCompany();
        $this->loadRouteFares();
        
    }

    protected function initializeCompany()
    {
        $this->user = Auth::user();
        if ($this->user && $this->user->company) {
            $this->company = $this->user->company;
        } else {
            $this->company = null;
        }
      
        // dd($this->company->id);
        
    }
    public function loadRouteFares()
    {
        $this->routeFares = Routes::where('company_id',$this->company->id)->latest()->get();
    }

    public function saveRouteFare()
    {
        if (!$this->company) {
            session()->flash('message', 'Company not found. Cannot save route fare.');
            return;
        }
        $this->validate();

     

   // Check if route with same cities and vehicle type already exists
   $existingRoute = Routes::where('company_id', $this->company->id)
   ->where('departure_city', $this->departure_city)
   ->where('arrival_city', $this->arrival_city)
   ->where('vehicle_type', $this->vehicle_type)
   ->when($this->editingId, function ($query) {
       return $query->where('id', '!=', $this->editingId);
   })
   ->first();

   //when() will allow query to fetch result if id are not equal then seeion meesage od sipatheced ...
   //if id's are equal then it will return no result which willl cause no session meessage 



   //now check if we re  creating same route again 
    if ($existingRoute) {
        session()->flash('message', 'Route with this vehicle type already exists.');
        return;
    }



        
        $data = [
            'departure_city' => $this->departure_city,
            'arrival_city' => $this->arrival_city,
            'fare_per_seat' => $this->fare_per_seat,
            'vehicle_type'   => $this->vehicle_type,
            'company_id'     => $this->company->id,
        ];
        
        
        if ($this->editingId) {
           Routes::find($this->editingId)->update($data);
           $this->resetForm();
            session()->flash('message', 'Route fare updated successfully!');
        } else {
            Routes::create($data);
            $this->resetForm();
            session()->flash('message', 'Route fare added successfully!');
           
        }
        
        
        $this->loadRouteFares();
    }

    public function editRouteFare($id)
    {  $this->resetForm();
        $routeFare =Routes::findOrFail($id);
        $this->editingId = $id;
        $this->departure_city = $routeFare->departure_city;
        $this->arrival_city = $routeFare->arrival_city;
        $this->fare_per_seat = $routeFare->fare_per_seat;
        $this->vehicle_type = $routeFare->vehicle_type;
       
    }

    public function deleteRouteFare($id)
    {
        // Routes::find($id)->delete();

        Routes::find($id)->forceDelete();
        $this->loadRouteFares();
        session()->flash('message', 'Route fare deleted successfully!');
    }

    public function resetForm()
    {
        $this->departure_city = '';
        $this->arrival_city = '';
        $this->fare_per_seat = '';
        $this->vehicle_type = '';
        $this->editingId = null;

        $this->resetValidation(); 
        $this->resetErrorBag();
        $this->formId++;
    }

    public function render()
    {
        return view('livewire.route.bus-route-registration');
    }
}
