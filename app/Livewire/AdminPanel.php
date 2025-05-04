<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Vehicle;
use App\Models\Route;
use Illuminate\Support\Facades\Auth;

class AdminPanel extends Component
{
    public $company;
    public $previewMode;
    public $stats = [];
    public $editCompany = [];

    protected $queryString = ['preview']; // Add this
    public function mount($preview = null)
    {
        $this->previewMode = $preview !== null || request()->routeIs('AdminPanel.preview');
       // dd($this->previewMode);
        $this->company = Auth::user()->company;
        $this->editCompany = $this->company?->toArray() ?? [];
        $this->loadStats();
    }

    public function loadStats()
    {
        if ($this->previewMode) {
            // Fake data for preview
            $this->stats = [
                'performance' => 75,
                'active_users' => 42,
                'revenue' => 1200000,
                'vehicle_count' => 12,
                'route_count' => 8,
                'active_vehicles' => 9,
                'scheduled_vehicles' => 5
            ];
        } else {
            // Real data from database
            $this->stats = [
                'performance' => $this->calculatePerformance(),
                'active_users' => $this->company->user()->count(),
                'revenue' => $this->calculateRevenue(),
                'vehicle_count' => $this->company->vehicles()->count(),
                'route_count' => $this->company->routes()->count(),
                'active_vehicles' => $this->company->vehicles()->where('is_active', true)->count(),
                'scheduled_vehicles' => $this->company->vehicles()->where('scheduled', true)->count()
            ];
        }
    }

    public function updateCompany()
    {
        $this->validate([
            'editCompany.name' => 'required|string|max:255',
            'editCompany.type' => 'required|in:fleet,shuttle,transport',
            'editCompany.address' => 'nullable|string',
            'editCompany.num_employees' => 'nullable|string'
        ]);

        $this->company->update($this->editCompany);
        session()->flash('company_updated', 'Company information updated successfully!');
    }

    protected function calculatePerformance()
    {
        $total = $this->company->vehicles()->count();
        $active = $this->company->vehicles()->where('is_active', true)->count();
        return $total > 0 ? round(($active / $total) * 100) : 0;
    }

    protected function calculateRevenue()
    {
        return $this->company->routes()->sum('fare_per_seat') * 100;
    }

    public function getVehicleIcon($type)
    {
        $icons = [
            'Bus' => 'bus',
            'Mini Bus' => 'bus-alt',
            'Van' => 'shuttle-van',
            'Motorbike' => 'motorcycle'
        ];
        return $icons[$type] ?? 'car';
    }

    
    protected function getVehicleTypesDistribution()
    {
        if ($this->previewMode) {
            return [
                'Economy Bus' => 6,
                'Luxury Bus' => 3,
                'Mini Bus' => 2,
                'Van' => 1
            ];
        }
    
        if (!$this->company) {
            return [];
        }
    
        return $this->company->vehicles()
            ->selectRaw('vehicle_type, count(*) as count')
            ->groupBy('vehicle_type')
            ->pluck('count', 'vehicle_type')
            ->toArray();
    }
    public function render()
    {
        return view('livewire.admin-panel')->layout('layouts.app');
    }
}