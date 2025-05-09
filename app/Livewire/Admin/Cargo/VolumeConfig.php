<?php
// app/Http/Livewire/Cargo/VolumeConfig.php
namespace App\Livewire\Admin\Cargo;

use Livewire\Component;
use App\Models\CargoVolumeTier;

class VolumeConfig extends Component
{
    public $min_volume;
    public $max_volume;
    public $rate_per_cm3;
    public $editingId = null;
    public $volumeTiers = [];
    public $company;

    protected $rules = [
        'min_volume' => 'required|numeric|min:1|unique:cargo_volume_tiers,min_volume',
        'max_volume' => 'required|numeric|gt:min_volume',
        'rate_per_cm3' => 'required|numeric|min:0.0001'
    ];
    
    protected $messages = [
        'min_volume.unique' => 'This minimum volume already exists.',
        'min_volume.required' => 'Please enter a minimum volume.',
        'max_volume.gt' => 'Maximum volume must be greater than minimum.',
        'rate_per_cm3.min' => 'Rate must be at least 0.0001.',
    ];
    
    public function mount()
    {
        $this->company = auth()->user()->company;
        $this->loadVolumeTiers();
    }


    






    public function loadVolumeTiers()
    {
        $this->volumeTiers = CargoVolumeTier::where('company_id', $this->company->id)
            ->orderBy('min_volume')
            ->get();
    }

    public function saveVolumeTier()
    {
        $this->validate();

        $data = [
            'company_id' => $this->company->id,
            'min_volume' => $this->min_volume,
            'max_volume' => $this->max_volume,
            'rate_per_cm3' => $this->rate_per_cm3
        ];

        if ($this->editingId) {
            CargoVolumeTier::find($this->editingId)->update($data);
            $message = 'Volume tier updated successfully!';
        } else {
            CargoVolumeTier::create($data);
            $message = 'Volume tier added successfully!';
        }

        $this->resetForm();
        $this->loadVolumeTiers();
        session()->flash('message', $message);
    }

    public function editVolumeTier($id)
    {
        $tier = CargoVolumeTier::findOrFail($id);
        $this->editingId = $id;
        $this->min_volume = $tier->min_volume;
        $this->max_volume = $tier->max_volume;
        $this->rate_per_cm3 = $tier->rate_per_cm3;
    }

    public function deleteVolumeTier($id)
    {
        CargoVolumeTier::findOrFail($id)->delete();
        $this->loadVolumeTiers();
        session()->flash('message', 'Volume tier deleted successfully!');
    }

    public function resetForm()
    {
        $this->reset(['min_volume', 'max_volume', 'rate_per_cm3', 'editingId']);
    }

    public function render()
    {
        return view('livewire.admin.cargo.volume-config');
    }
}