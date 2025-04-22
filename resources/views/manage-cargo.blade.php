<x-app-layout>
  <!-- Passing the header content -->
  {{-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Cargo Management
      </h2>
  </x-slot> --}}

  <!-- Side Bar -->
  @livewire('side-bar')

  <!-- Manage Cargo Component -->
  @livewire('manage-cargo')
</x-app-layout>
