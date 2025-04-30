<?php

namespace App\Livewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class VehicleRegistration extends Component
{
    use WithPagination;

    // Form Fields
    public $registration_number=null;
    public $vehicle_type;
    public $seating_capacity;
    public $make;
    public $model;
    public $year;
    public $notes;
    public $is_active = true;
    public $scheduled = false;

    // State Management
    public $search = '';
    public $filterStatus = '';
    public $editingVehicleId = null;
    public $showForm = false;

    // Add these properties
    public $vehicle;
    protected $user;
    public $company;
    public function rules()
    {
        return [
            'registration_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('vehicles', 'registration_number')->ignore($this->editingVehicleId, 'registration_number')
            ],
            'vehicle_type' => 'required|string|max:50',
            'seating_capacity' => 'required|integer|min:1',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (now()->year + 1), // ✅ Works correctly now
            'is_active' => 'sometimes|boolean',
            'scheduled' => 'sometimes|boolean',
            'notes' => 'nullable|string|max:500'
        ];
    }

    public function mount()
    {
        $this->initializeCompany();
    }

    protected function initializeCompany()
    {
        $this->user = Auth::user();
        $this->company = $this->user->company; // Fallback if needed
        
    }
    public function registerVehicle()
    {
        $this->validate();

        $registration=strtoupper($this->registration_number);
 
        $vehicleData = [
            'registration_number' => $registration,
            'vehicle_type' => $this->vehicle_type,
            'seating_capacity' => $this->seating_capacity,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'is_active' => $this->is_active,
            'scheduled' => !$this->scheduled,
            'notes' => $this->notes,
            'company_id' => $this->company->id
        ];
           
        if ($this->editingVehicleId) {
            $vehicle = Vehicle::findOrFail($this->editingVehicleId);
            
            $vehicle->update($vehicleData);
            $message = 'Vehicle updated successfully!';
        } else {
            
            Vehicle::create($vehicleData);
            $message = 'Vehicle registered successfully!';
        }

        $this->resetForm();
        session()->flash('message', $message);
    }

    public function editVehicle($registrationNumber)
    { $this->resetForm();
            
        $this->showForm = true;
        $this->vehicle = Vehicle::where('registration_number', $registrationNumber)
                         ->where('company_id', $this->company->id)
                         ->firstOrFail();
        
        $this->editingVehicleId = $this->vehicle->registration_number;
       
        $this->registration_number = strtoupper($this->vehicle->registration_number);
        $this->vehicle_type = $this->vehicle->vehicle_type;
        $this->seating_capacity = $this->vehicle->seating_capacity;
        $this->make = $this->vehicle->make;
        $this->model = $this->vehicle->model;
        $this->year = $this->vehicle->year;
        $this->is_active = $this->vehicle->is_active;
        $this->scheduled = $this->vehicle->scheduled;
        $this->notes = $this->vehicle->notes;
    
    }
    public function deleteVehicle($registrationNumber)
    {
         
            Vehicle::where('registration_number', $registrationNumber)
                  ->where('company_id', $this->company->id)
                  ->delete();
            session()->flash('message', 'Vehicle deleted successfully!');
        
    }

    public function resetForm()
    {
        $this->reset([
            'registration_number',
            'vehicle_type',
            'seating_capacity',
            'make',
            'model',
            'year',
            'is_active',
            'scheduled',
            'notes',
            'editingVehicleId'
        ]);
        $this->resetErrorBag();
        $this->showForm = false;
    }
   
    public function render()
    {
        $vehicles = Vehicle::where('company_id', $this->company->id)

        //     ->when($this->search, function($query) {
        //         $query->where(function($q) {
        //             $q->where('registration_number', 'like', '%'.$this->search.'%')
        //               ->orWhere('make', 'like', '%'.$this->search.'%')
        //               ->orWhere('model', 'like', '%'.$this->search.'%');
        //         });
        //     })
        //     ->when($this->filterStatus === 'active', function($query) {
        //         $query->where('is_active', true);
        //     })
        //     ->when($this->filterStatus === 'inactive', function($query) {
        //         $query->where('is_active', false);
        //     })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.vehicle-registration', [
            'vehicles' => $vehicles,
            'vehicleTypes' => ['Luxury Bus', 'Mini Bus', 'Van', 'Car', 'Truck', 'Other']
        ])->layout('layouts.app');
    }
}