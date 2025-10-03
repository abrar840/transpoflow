<?php
namespace App\Livewire\Admin\Cargo;

use Livewire\Component;
use App\Models\CargoRoute;

class RouteManager extends Component
{
    public $departure_city;
    public $arrival_city;
    public $base_fare;
    public $departure_time;
    public $editingId = null;
    public $routes = [];
    public $company;
    public $query;
    public $search = '';
    public $selectedDays = [];

    protected $rules = [
        'departure_city' => 'required|string|max:255',
        'arrival_city' => 'required|string|max:255|different:departure_city',
        'base_fare' => 'required|numeric|min:0',
        'query' => 'required|string|max:255',
        'departure_time' => 'required|date_format:H:i',
        'selectedDays' => 'required|array|min:1',
        'selectedDays.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'
    ];



 
    public function mount()
    {
        $this->company = auth()->user()->company;
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $query = CargoRoute::where('company_id', $this->company->id);
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('departure_city', 'like', '%'.$this->search.'%')
                  ->orWhere('arrival_city', 'like', '%'.$this->search.'%')
                  ->orWhere('vehicle_id', 'like', '%'.$this->search.'%');
            });
        }

        $this->routes = $query->latest()->get();
    }

    public function saveRoute()
    {
        $this->validate();

        $data = [
            'company_id' => $this->company->id,
            'departure_city' => $this->departure_city,
            'arrival_city' => $this->arrival_city,
            'base_fare' => $this->base_fare,
            'vehicle_id' => $this->query,
            'departure_time' => $this->departure_time,
            'shipment_days' => json_encode($this->selectedDays)
        ];

        if ($this->editingId) {
            CargoRoute::find($this->editingId)->update($data);
            $message = 'Route updated successfully!';
        } else {
            CargoRoute::create($data);
            $message = 'Route added successfully!';
        }

        $this->resetForm();
        $this->loadRoutes();
        session()->flash('message', $message);
    }

    public function editRoute($id)
    {
        $route = CargoRoute::findOrFail($id);
        $this->editingId = $id;
        $this->departure_city = $route->departure_city;
        $this->arrival_city = $route->arrival_city;
        $this->base_fare = $route->base_fare;
        $this->query = $route->vehicle_id;
        $this->departure_time = $route->departure_time;
        $this->selectedDays = json_decode($route->shipment_days, true) ?? [];
    }

    public function deleteRoute($id)
    {
        CargoRoute::findOrFail($id)->delete();
        $this->loadRoutes();
        session()->flash('message', 'Route deleted successfully!');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->reset([
            'departure_city',
            'arrival_city',
            'base_fare',
            'query',
            'departure_time',
            'selectedDays',
            'editingId'
        ]);
    }
    
    public function updatedSearch()
    {
        $this->loadRoutes();
    }
    
    public function render()
    {
        return view('livewire.admin.cargo.route-manager');
    }
}