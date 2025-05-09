<?php

namespace App\Livewire\Admin\Cargo;

 

use Livewire\Component;
use App\Models\CargoServiceType;

class ServiceTypeConfig extends Component
{
    public $name;
    public $code;
    public $surcharge_percentage = 0;
    public $description;
    public $is_active = true;
    
    public $editingId = null;
    public $serviceTypes = [];
    public $company;

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|alpha_dash|max:50|unique:cargo_service_types,code',
        'surcharge_percentage' => 'required|numeric|min:0|max:100',
        'description' => 'nullable|string',
        'is_active' => 'boolean'
    ];

    public function mount()
    {
        $this->company = auth()->user()->company;
        $this->loadServiceTypes();
    }


 

    public function loadServiceTypes()
    {
        $this->serviceTypes = CargoServiceType::where('company_id', $this->company->id)
            ->latest()
            ->get();
    }

    public function saveServiceType()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => $this->editingId 
                ? 'required|alpha_dash|max:50|unique:cargo_service_types,code,'.$this->editingId
                : 'required|alpha_dash|max:50|unique:cargo_service_types,code',
            // ... other rules
        ]);

        $data = [
            'company_id' => $this->company->id,
            'name' => $this->name,
            'code' => strtolower($this->code),
            'surcharge_percentage' => $this->surcharge_percentage,
            'description' => $this->description,
            'is_active' => $this->is_active
        ];

        if ($this->editingId) {
            CargoServiceType::find($this->editingId)->update($data);
            $message = 'Service updated successfully!';
        } else {
            CargoServiceType::create($data);
            $message = 'Service added successfully!';
        }

        $this->resetForm();
        $this->loadServiceTypes();
        session()->flash('message', $message);
    }

    public function editServiceType($id)
    {
        $service = CargoServiceType::findOrFail($id);
        $this->editingId = $id;
        $this->name = $service->name;
        $this->code = $service->code;
        $this->surcharge_percentage = $service->surcharge_percentage;
        $this->description = $service->description;
        $this->is_active = $service->is_active;
    }

    public function toggleStatus($id)
    {
        $service = CargoServiceType::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);
        $this->loadServiceTypes();
    }

    public function deleteServiceType($id)
    {
        CargoServiceType::findOrFail($id)->delete();
        $this->loadServiceTypes();
        session()->flash('message', 'Service deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'surcharge_percentage', 'description', 'is_active', 'editingId']);
    }

    public function render()
    {
        return view('livewire.admin.cargo.service-type-config');
    }
}