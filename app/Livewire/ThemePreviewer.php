<?php

namespace App\Livewire;

use Livewire\Component;

class ThemePreviewer extends Component
{
    public $theme = 'light';

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    public function render()
    {
        return view('livewire.theme-previewer')->layout('layouts.user');
    }
}

