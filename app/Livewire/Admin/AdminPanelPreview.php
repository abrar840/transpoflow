<?php
namespace App\Livewire\Admin;

use Livewire\Component;

class AdminPanelPreview extends Component
{
    public $showLivePreview = false;


    public function togglePreview()
    {
        $this->showLivePreview = !$this->showLivePreview;
    }
    public function render()
    {
        return view('livewire.admin.admin-panel-preview')->layout('layouts.user');
    }

   
}