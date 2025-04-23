<?php

namespace App\Livewire\Admin;


use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Routes;
use App\Models\VehicleSchedule;
use Illuminate\Support\Facades\Auth;

class VehiclesSchedule extends Component
{

    
    public array $departureCities = [];
    public array $arrivalCities = [];
    public array $vehicleTypes = [];
    public ?string $selectedDepartureCity = null;
    public ?string $selectedArrivalCity = null;

    public $company;
    public $user;
    public array $vehicleType = [];
    public ?string $selectedVehicleType = null;

    public $query = '';
    public $suggestions = [];

    public $selectedDays = [];

    // Edit mode fields
    public $editMode = false;
    public $scheduleId = null;

    public $arrivalTime,$departureTime;

    public $schedules;
    public $perpage=10;
 
    public function loadschedules(){
        $this->schedules = VehicleSchedule::with('vehicle', 'route')->get();
       
      
    }
    public function mount()
    {
        $this->initializeCompany();
        $this->loadInitialData();
        $this->loadschedules();
        
    }

    //loading user data and company data 
    protected function initializeCompany(): void
    {
        $this->user = Auth::user();

        if (!$this->user) {
            abort(403, 'Please log in to access this page');
        }

        $this->company = $this->user->company;

        if (!$this->company) {
            session()->flash('error', 'No company associated with your account');
        }
    }


    //load departure cities initiallyy
    public function loadInitialData(): void
    {
        if (!$this->company) {
            return;
        }

        try {
            $this->departureCities = Routes::where('company_id', $this->company->id)
                ->orderBy('departure_city')
                ->distinct('departure_city')
                ->pluck('departure_city')
                ->toArray();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load departure cities');
            $this->departureCities = [];
        }
    }


    // filter arrival cities afdter user selects dep[arture city]
    public function filterArrivalCities(): void
    {
        $this->reset(['arrivalCities', 'selectedArrivalCity', 'vehicleType', 'selectedVehicleType']);

        if (empty($this->selectedDepartureCity) || !$this->company) {
            return;
        }

        try {
            $this->arrivalCities = Routes::where('company_id', $this->company->id)
                ->where('departure_city', $this->selectedDepartureCity)
                ->orderBy('arrival_city')
                ->distinct('arrival_city')
                ->pluck('arrival_city')
                ->toArray();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load arrival cities');
            $this->arrivalCities = [];
        }
    }



    //show registered vehicle type for selected route by user
    public function showVehicle(): void
    {
        $this->reset(['vehicleType', 'selectedVehicleType']);

        if (empty($this->selectedDepartureCity) || empty($this->selectedArrivalCity) || !$this->company) {
            return;
        }

        try {
            $this->vehicleType = Routes::where('company_id', $this->company->id)
                ->where('departure_city', $this->selectedDepartureCity)
                ->where('arrival_city', $this->selectedArrivalCity)
                ->orderBy('vehicle_type')
                ->distinct('vehicle_type')
                ->pluck('vehicle_type')
                ->toArray();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load vehicle types');
            $this->vehicleType = [];
        }
    }



    

    //registered vehicle number search 

    public function updatedQuery()
    {
        if (strlen($this->query) < 1) {
            $this->suggestions = [];
            return;
        }

        // $this->resetErrorBag(); // Clears all errors
        // OR for specific field:
        $this->resetErrorBag(['query']); 
        $this->suggestions = Vehicle::where('company_id', $this->company->id)
            ->where('registration_number', 'like', '%' . $this->query . '%')
            ->take(5)
            ->pluck('registration_number')
            ->toArray();

        if (!$this->suggestions && $this->query) {
            $this->addError('query', 'Vehicle not registered');
           
        }
    }



    //saving selected vehicle number in query varibale after user slecteion
    public function selectSuggestion($value)
    {
        $this->query = $value;
        $this->suggestions = [];
    }


// validation rules for form input

protected $rules=[

    'selectedDepartureCity' => 'required',
        'selectedArrivalCity' => 'required',
        'selectedVehicleType' => 'required',
        'query' => 'required',
        'selectedDays' => 'required|array|min:1'
        
];
 


public function saveSchedule()
{


$this->validate();
  // Check if the vehicle number is in the suggestions
    if (!in_array($this->query, $this->suggestions)) {
        session()->flash('error', 'Please select a vehicle number from the suggestions.');
        return;
    }
    
try{
$route=Routes::where('company_id',$this->company->id)
->where('departure_city',$this->selectedDepartureCity)
->where('arrival_city',$this->selectedArrivalCity)
->where('vehicle_type',$this->selectedVehicleType)
->firstOrFail();}catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    session()->flash('error', 'Route not found!');
    return;
}
try{
$vehicle=Vehicle::where('company_id',$this->company->id)
->where('registration_number',$this->query)
->firstOrFail();}catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    session()->flash('error', 'Vehicle not found!');
    return;
}


//check if vehicel is alredy registered and we are not in edit mode

if($vehicle->scheduled==1 && !$this->editMode) {
    session()->flash('error','this vehicle is alreday scheduled');
    return;
}




$registrationnumber=strtoupper($vehicle->registration_number);
 
$data = [
    'route_id'=>$route->id,
    'vehicle_id'=>$registrationnumber,
    'days_of_week'=>$this->selectedDays,
    'departure_time'=>$this->departureTime,
    'arrival_time'=>$this->arrivalTime
];

if($this->editMode){
    $schedule=VehicleSchedule::findOrFail($this->scheduleId);
    $schedule->update($data);
    session()->flash('message', 'Schedule updated successfully!');

}
else {
    VehicleSchedule::create($data);
    session()->flash('message', 'Schedule created successfully!');
}
$this->clearFields();
$this->loadschedules();
 

}
public function editSchedule($id)
{
    $schedule = VehicleSchedule::with(['route','vehicle'])->findOrFail($id);
    $this->scheduleId   = $id;
    $this->editMode     = true;
    $this->selectedDepartureCity = $schedule->route->departure_city;

    // Immediately populate arrivalCities from that city:
    $this->filterArrivalCities();

    $this->selectedArrivalCity   = $schedule->route->arrival_city;

    // Now populate vehicleType from those two:
    $this->showVehicle();

    $this->selectedVehicleType   = $schedule->route->vehicle_type;
    $this->query                 = $schedule->vehicle->registration_number;
    $this->selectedDays          = $schedule->days_of_week;
    $this->departureTime         = $schedule->departure_time;
    $this->arrivalTime           = $schedule->arrival_time;
}


public function deleteSchedule($scheduleId)
{
    $schedule = VehicleSchedule::findOrFail($scheduleId);
    $schedule->delete();
    $this->loadschedules();
    session()->flash('message', 'Schedule deleted successfully!');
   
}

public function clearFields()
{
    // Reset all properties
    $this->reset([
        'selectedDepartureCity',
        'selectedArrivalCity',
        'selectedVehicleType',
        'query',
        'departureTime',
        'arrivalTime',
        'selectedDays',
        'editMode',
        'scheduleId',
        'arrivalCities',
        'vehicleType',
        'suggestions'
    ]);
    
    // Reload initial data if needed
    $this->loadInitialData();
    
    // Dispatch event for Alpine.js to handle
    $this->dispatch('fields-reset');
}





 
    public function render()
    {
        return view('livewire.admin.vehicles-schedule');
    }
}
