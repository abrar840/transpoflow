<x-app-layout>
    <!-- Page Header -->
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
        </h2>
    </x-slot> --}}

    

    <!-- Sidebar -->
    @livewire('side-bar')

    <!-- Livewire Component for Ticket Management -->
    @livewire('manage-ticket')
</x-app-layout>
