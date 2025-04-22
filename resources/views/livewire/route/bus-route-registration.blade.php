<div>
    <!-- First Section -->
  
    <div class="box-info">
        <h1>Ticket Fare Configuration Form</h1>

        @if(session('message'))
            <div class="alert alert-success mb-4">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="saveRouteFare">
            <h3>{{ $editingId ? 'Edit Route' : 'Add New Route' }}</h3>
            
            <div class="cargo-container">
                <!-- Add wire:key to all inputs -->
                <input type="text" wire:model="departure_city" wire:key="departure-{{ $editingId ?? 'new' }}" 
                       class="editable" placeholder="Departure City">
                @error('departure_city') <span class="error">{{ $message }}</span> @enderror
        
                <input type="text" wire:model="arrival_city" wire:key="arrival-{{ $editingId ?? 'new' }}" 
                       class="editable" placeholder="Arrival City">
                @error('arrival_city') <span class="error">{{ $message }}</span> @enderror
        
                <input type="number" wire:model="fare_per_seat" wire:key="fare-{{ $editingId ?? 'new' }}" 
                       class="editable" step="0.01" placeholder="Fare Per Seat">
                @error('fare_per_seat') <span class="error">{{ $message }}</span> @enderror
        
                <br>
                <select wire:model="vehicle_type" wire:key="vehicle-{{ $editingId ?? 'new' }}" class="editable">
                    <option value="">Select Vehicle Type</option>
                    <option value="Economy Bus">Economy Bus</option>
                    <option value="Luxury Bus">Luxury Bus</option>
                    <option value="Mini Bus">Mini Bus</option>
                </select>
                @error('vehicle_type') <span class="error">{{ $message }}</span> @enderror
            </div>
        
            <div class="button-container">
                <button type="submit" class="save-btn {{ $editingId ? 'bg-yellow-500' : 'bg-blue-500' }}">
                    {{ $editingId ? 'Update' : 'Save' }}
                </button>
        
                @if($editingId)
                    <button type="button" wire:click="resetForm" class="cancel-btn">Cancel</button>
                @endif
            </div>
        </form>
    </div>

    <!-- Second Section: Current Routes -->
    <div class="box-info mt-6">
        <h2>Current Routes</h2>

        @if($routeFares->isEmpty())
            <p class="text-gray-500 py-4">No routes found. Add your first route above.</p>
        @else
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Departure</th>
                        <th class="px-4 py-2">Arrival</th>
                        <th class="px-4 py-2">Vehicle Type</th>
                        <th class="px-4 py-2">Fare</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($routeFares as $fare)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $fare->departure_city }}</td>
                            <td class="px-4 py-2">{{ $fare->arrival_city }}</td>
                            <td class="px-4 py-2">{{ $fare->vehicle_type }}</td>
                            <td class="px-4 py-2">{{ number_format($fare->fare_per_seat, 2) }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="editRouteFare({{ $fare->id }})"
                                        class="bg-blue-500 text-white px-2 py-1 rounded mr-2">
                                    Edit
                                </button>
                                <button wire:click="deleteRouteFare({{ $fare->id }})"
                                        class="bg-red-500 text-white px-2 py-1 rounded"
                                        onclick="return confirm('Delete this route?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
