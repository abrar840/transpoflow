import './bootstrap';

// Livewire (and its bundled Alpine) is loaded and started by @livewireScripts
// in the Blade layouts. Do NOT also import/start it here — loading Livewire
// twice breaks the first wire:navigate click (it only works on the 2nd click).
// window.Livewire is provided globally by @livewireScripts.