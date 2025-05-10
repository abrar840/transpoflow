<?php

namespace App\Livewire\Admin\Cargo;
 

use Livewire\Component;

class CargoDashboard extends Component
{
    public $activeTab = 'routes';
    public $tabs = [
        'routes' => 'City Routes',
        'weight' => 'Weight Tiers', 
        'volume' => 'Volume Tiers',
        'services' => 'Service Types',
        'cargo' => 'Cargo Booking'
    ];

    public function switchTab($tab)
{
    if($this->activeTab != $tab){
        $this->activeTab = $tab;
        $this->dispatch('refreshChildTab', tab: $tab);
    }
}

    

    public function render()
    {
        return view('livewire.admin.cargo.cargo-dashboard')->layout('layouts.user');
        
       
    }
   
}