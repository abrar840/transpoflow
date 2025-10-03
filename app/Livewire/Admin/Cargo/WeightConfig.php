<?php

// app/Http/Livewire/Cargo/WeightConfig.php
namespace App\Livewire\Admin\Cargo;

use Livewire\Component;
use App\Models\CargoWeightTier;

class WeightConfig extends Component
{
    public $min_weight;
    public $max_weight;
    public $rate_per_kg;
    public $editingId = null;
    public $weightTiers = [];
    public $company;

    protected $rules = [
        'min_weight' => 'required|numeric|min:0',
        'max_weight' => 'required|numeric|gt:min_weight',
        'rate_per_kg' => 'required|numeric|min:0'
    ];

    public function mount()
    {
        $this->company = auth()->user()->company;
        $this->loadWeightTiers();
    }


     



    public function loadWeightTiers()
    {
        $this->weightTiers = CargoWeightTier::where('company_id', $this->company->id)
            ->orderBy('min_weight')
            ->get();
    }

    public function saveWeightTier()
    {
        $this->validate();

        $data = [
            'company_id' => $this->company->id,
            'min_weight' => $this->min_weight,
            'max_weight' => $this->max_weight,
            'rate_per_kg' => $this->rate_per_kg
        ];

        if ($this->editingId) {
            CargoWeightTier::find($this->editingId)->update($data);
            $message = 'Weight tier updated successfully!';
        } else {
            CargoWeightTier::create($data);
            $message = 'Weight tier added successfully!';
        }

        $this->resetForm();
        $this->loadWeightTiers();
        session()->flash('message', $message);
    }

    public function editWeightTier($id)
    {
        $tier = CargoWeightTier::findOrFail($id);
        $this->editingId = $id;
        $this->min_weight = $tier->min_weight;
        $this->max_weight = $tier->max_weight;
        $this->rate_per_kg = $tier->rate_per_kg;
    }

    public function deleteWeightTier($id)
    {
        CargoWeightTier::findOrFail($id)->delete();
        $this->loadWeightTiers();
        session()->flash('message', 'Weight tier deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['min_weight', 'max_weight', 'rate_per_kg', 'editingId']);
    }

    public function render()
    {
        return view('livewire.admin.cargo.weight-config')->layout('layouts.user');
    }
}