<div class="box-info">
    <style>
        .box-info {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        /* ... (keep all existing styles) ... */
        .box-info h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
        }
        
        .box-info h3 {
            font-size: 1.2rem;
            margin: 20px 0 15px;
            color: #444;
        }
        
        .cargo-container {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .form-group {
            flex: 1;
            min-width: 200px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .editable {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .form-action {
            display: flex;
            align-items: flex-end;
        }
        
        .save-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .save-btn:hover {
            background-color: #45a049;
        }
        
        .edit-btn {
            background-color: #7c3aed;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .edit-btn:hover {
            background-color: #0b7dda;
        }
        
        .table-container {
            overflow-x: auto;
            margin-top:50px;
        }
        
        table {
   
    width: 100%;
    border-collapse: collapse;
}
        
        table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }
        
        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .action-buttons button {
            padding: 5px 10px;
            min-width: 30px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
        }
        
        .search-container {
            margin-bottom: 20px;
        }
        
        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
            max-width: 100%;
        }
        /* Add new styles for days checkboxes and time input */
        .days-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }
        
        .days-container label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        
        input[type="time"] {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
        }
    </style>
    
    <h1>Manage Cargo Routes</h1>
    
    <div class="cargo-container">
        @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="search-container">
            <input type="text" wire:model.live="search" class="search-input" placeholder="Search by city, vehicle ID or days...">
        </div>

        <form wire:submit.prevent="saveRoute" class="cargo-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Departure City</label>
                    <input type="text" wire:model.live="departure_city" 
                           class="editable @error('departure_city') is-invalid @enderror" 
                           placeholder="{{ $editingId ? $departure_city : 'From' }}">
                    @error('departure_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label>Arrival City</label>
                    <input type="text" wire:model="arrival_city" 
                           class="editable @error('arrival_city') is-invalid @enderror" 
                           placeholder="To">
                    @error('arrival_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label>Base Fare (PKR)</label>
                    <input type="number" step="0.01" wire:model="base_fare" 
                           class="editable @error('base_fare') is-invalid @enderror">
                    @error('base_fare') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Vehicle Number</label>
                    <input type="text" wire:model="query" 
                           class="editable @error('query') is-invalid @enderror">
                    @error('query') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label>Departure Time</label>
                    <input type="time" wire:model="departure_time"
                           class="editable @error('departure_time') is-invalid @enderror"
                           required>
                    @error('departure_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label>Shipment Days</label>
                    <div class="days-container">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <label>
                                <input type="checkbox" 
                                       wire:model="selectedDays" 
                                       value="{{ $day }}"
                                       @if(in_array($day, $selectedDays)) checked @endif>
                                {{ $day }}
                            </label>
                        @endforeach
                    </div>
                    @error('selectedDays') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group form-action">
                    <button type="submit" class="save-btn">
                        {{ $editingId ? 'Update' : 'Add' }}
                    </button>
                </div>
            </div>
            
            @if($editingId)
                <button type="button" wire:click="resetForm" class="edit-btn">
                    Cancel Edit
                </button>
            @endif
        </form>
        
        <div class="mt-4">
           
            <div class="table-container">
                <h3>Current Routes</h3>
                <table>
                   
                    <thead>
                        <tr>
                            <th>Route</th>
                            <th>Vehicle</th>
                            <th>Departure Time</th>
                            <th>Days</th>
                            <th>Base Fare</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($routes as $route)
                            <tr>
                                <td>{{ $route->departure_city }} → {{ $route->arrival_city }}</td>
                                <td>{{ $route->vehicle_id }}</td>
                                <td>{{ $route->departure_time ? \Carbon\Carbon::parse($route->departure_time)->format('h:i A') : 'N/A' }}</td>
                                <td>
                                    @if($route->shipment_days)
                                        {{ implode(', ', json_decode($route->shipment_days)) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>Rs {{ number_format($route->base_fare, 2) }}</td>
                                <td class="action-buttons">
                                    <button wire:click="editRoute({{ $route->id }})" 
                                            class="edit-btn">
                                        <i class="fas fa-edit"></i>

                                    </button>
                                    <button wire:click="deleteRoute({{ $route->id }})" 
                                            class="save-btn"
                                            onclick="return confirm('Delete this route?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No routes added yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>