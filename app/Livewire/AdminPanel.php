<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Vehicle;
use App\Models\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AdminPanel extends Component
{
    public $company;
    public $stats = [];
    public $editCompany = [];

    public $service;

    public function mount()
    {
        $this->company = Auth::user()->company;

        if (!$this->company) {
            return redirect('/p');
        }


        $this->editCompany = $this->company?->toArray() ?? [];
       $this->service = $this->company->services->pluck('name')->map(fn ($n) => trim($n))->toArray();

     
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->stats = [
            'performance' => $this->calculatePerformance(),
            'active_users' => $this->company->user()->count(),
            'revenue' => $this->calculateRevenue(),
            'monthly_revenue' => $this->calculateMonthlyRevenue(),
            'vehicle_count' => $this->company->vehicles()->count(),
            'route_count' => $this->company->routes()->count(),
            'active_vehicles' => $this->company->vehicles()->where('is_active', true)->count(),
            'scheduled_vehicles' => $this->company->vehicles()->where('scheduled', true)->count(),

            // Ticket service
            'ticket_count' => $this->company->tickets()->count(),
            'tickets_paid' => $this->company->tickets()->where('payment_status', 'paid')->count(),
            'ticket_revenue' => (float) $this->company->tickets()->where('payment_status', 'paid')->sum('total_amount'),

            // Cargo service
            'cargo_count' => DB::table('cargo_books')->where('company_id', $this->company->id)->count(),
            'cargo_in_transit' => DB::table('cargo_books')->where('company_id', $this->company->id)->where('status', 'in_transit')->count(),
            'cargo_delivered' => DB::table('cargo_books')->where('company_id', $this->company->id)->where('status', 'delivered')->count(),
            'cargo_revenue' => (float) DB::table('cargo_books')->where('company_id', $this->company->id)->sum('total_amount'),

            // Support service
            'message_count' => DB::table('messages')->where('company_id', $this->company->id)->count(),
        ];
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
        // Calculate ticket revenue (sum of all ticket totals for the company)
        $ticketRevenue = $this->company->tickets()
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        // Calculate cargo revenue (sum of all cargo booking totals)
        $cargoRevenue = DB::table('cargo_books')
            ->where('company_id', $this->company->id)

            ->sum('total_amount');

        return $ticketRevenue + $cargoRevenue;
    }

    protected function calculateMonthlyRevenue()
    {
        $ticketRevenue = $this->company->tickets()
            ->where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $cargoRevenue = DB::table('cargo_books')
            ->where('company_id', $this->company->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        return $ticketRevenue + $cargoRevenue;
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
