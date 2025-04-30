 
   
      <section class="content">
       
        <main>
            <header class="management-header">
                <h2 class="management-title">Vehicle Management System</h2>
                <div class="header-actions">
                    <button id="toggleFormBtn" onclick="toggleForm()">Register New Vehicle</button>
                </div>
            </header>
    
    
    <div  class="vehicle-box-info ">
    <!-- Header Section -->
    

    <!-- Success Message -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Vehicle Registration Form (Conditional) -->
    <div id="registrationForm" class="registration-card vehicle-management-container" @if($showForm) style="display:block;" @else style="display:none;" @endif>
        <div class="card-header">
            <h3 class="card-title">Vehicle Registration Form</h3>
            
            <div class="card-actions">
                {{-- <button wire:click="$toggle('showForm')" class="close-btn">
                    &times;
                </button> --}}
            </div>
        </div>
        
        <form wire:submit.prevent="registerVehicle" class="registration-form">
            <div class="form-grid">
                <!-- Row 1 -->
                <div class="form-group">
                    <label for="registration_number">Registration Number</label>
                    <input type="text" wire:model="registration_number" id="registration_number" 
                           class="form-input" placeholder="ABC-1234" required @if($editingVehicleId)@disabled(true)@endif>
                       
                    @error('registration_number') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="vehicle_type">Vehicle Type</label>
                    <select wire:model="vehicle_type" id="vehicle_type" class="form-input" required>
                        <option value="">Select Type</option>
                        <option value="Car">Car</option>
                        <option value="Bus">Bus</option>
                        <option value="Truck">Truck</option>
                        <option value="Motorbike">Motorbike</option>
                        <option value="Van">Van</option>
                        <option value="Bicycle">Bicycle</option>
                        <option value="Scooter">Scooter</option>
                        <option value="Trailer">Trailer</option>
                    </select>
                    
                    @error('vehicle_type') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <!-- Row 2 -->
                <div class="form-group">
                    <label for="seating_capacity">Seating Capacity</label>
                    <input type="number" wire:model="seating_capacity" id="seating_capacity" 
                           class="form-input" min="1" max="100" required>
                    @error('seating_capacity') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="year">Manufacture Year</label>
                    <input type="number" wire:model="year" id="year" 
                           class="form-input" min="1900" max="{{ date('Y') }}" required>
                    @error('year') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <!-- Row 3 -->
                <div class="form-group">
                    <label for="make">Make/Manufacturer</label>
                    <input type="text" wire:model="make" id="make" 
                           class="form-input" placeholder="e.g., Toyota" required>
                    @error('make') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" wire:model="model" id="model" 
                           class="form-input" placeholder="e.g., Hiace" required>
                    @error('model') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <!-- Row 4 -->
                <div class="form-group span-2">
                    <label for="notes">Additional Notes</label>
                    <textarea wire:model="notes" id="notes" 
                              class="form-input" rows="3"></textarea>
                    @error('notes') <span class="form-error">{{$message}}</span> @enderror
                </div>
                
                <!-- Row 5 -->
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" wire:model="is_active" class="checkbox-input">
                        <span>Active Vehicle</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" wire:model="scheduled" class="checkbox-input">
                        <span>Available for Scheduling</span>
                    </label>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" wire:click="resetForm()" class="cancel-btn">
                    Cancel
                </button>
                <button type="submit" class="submit-btn">
                    <span wire:loading.remove>{{ $editingVehicleId ? 'Update Vehicle' : 'Register Vehicle' }}</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </form>
    </div>
    

    <!-- Vehicle List Section -->
    <div class="vehicle-list-section">
        <h3 class="section-title">Registered Vehicles</h3>
        <div class="list-actions">
            <div class="search-box">
                <input type="text" wire:model.live="search" placeholder="Search vehicles...">
                <svg class="search-icon" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 001.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 00-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 005.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </div>
            <div class="filter-options">
                <select wire:model.live="filterStatus">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        
        <div class="vehicle-table-container">
            <table class="vehicle-table">
                <thead>
                    <tr>
                        <th>Registration Number</th>  <!-- Column header added -->
                        <th>Vehicle Type</th>
                        <th>Make/Model</th>
                        <th>Year</th>
                        <th>Seating Capacity</th>
                        <th>Status</th>
                        <th>Schedule</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->registration_number }}</td>
                        <td>{{ $vehicle->vehicle_type }}</td>
                        <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->seating_capacity }}</td>
                        <td>
                            <span class="status-badge {{ $vehicle->is_active ? 'active' : 'inactive' }}">
                                {{ $vehicle->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ $vehicle->scheduled ? 'active' : 'inactive' }}">
                                {{ $vehicle->scheduled ? 'sheduled' : 'not-scheduled' }}
                            </span>
                        </td>
                        <td class="action-buttons">
                            <button id=edit  wire:click="editVehicle('{{ $vehicle->registration_number }}')" class="edit-btn">
                                Edit
                            </button>
                            <button wire:click="deleteVehicle('{{ $vehicle->registration_number }}')" 
                                onclick="return confirm('Are you sure?')"
                                class="delete-btn">
                            Delete
                        </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="no-records">No vehicles found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- <div class="pagination-container">
                {{ $vehicles->links() }}
            </div>  --}}
        </div>
    </div>
</div>
</main>
<script>
    function toggleForm() {
        const form = document.getElementById("registrationForm");
        const button = document.getElementById("toggleFormBtn");
        
        // Toggle visibility
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
            button.textContent = "Hide Registration Form";
        } else {
            form.style.display = "none";
            button.textContent = "Register New Vehicle";
        }
    }</script>
</section>
 