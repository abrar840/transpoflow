<?php

namespace App\Livewire;

use Livewire\Component;

class ThemePreviewer extends Component
{
    public $color = '#f39c12';

    public $presets = [
        '#f39c12', // orange
        '#7c3aed', // violet
        '#2563eb', // blue
        '#059669', // emerald
        '#e11d48', // rose
        '#0891b2', // cyan
        '#db2777', // pink
        '#ea580c', // deep orange
    ];

    public function setColor($color)
    {
        if (preg_match('/^#[A-Fa-f0-9]{6}$/', $color)) {
            $this->color = $color;
        }
    }

    public function render()
    {
        return view('livewire.theme-previewer')->layout('layouts.user');
    }
}
