<div>
  <div class="box-info">
    <h2>Vehicle Schedule Configuration</h2>

    @if (session('error'))
    <div class="alert alert-danger text-red-500">
      {{ session('error') }}
    </div>

    @endif

    @if (session('message'))
    <div class="alert alert-success text-red-500">
      {{ session('message') }}
    </div>
    @endif
    <form wire:submit.prevent="saveSchedule" wire:loading.attr="disabled" x-data="{
        init() {
            // Set up event listener for reset
                             

            Livewire.on('fields-reset', () => {
                this.$nextTick(() => {
                    // Reset all select elements
                    document.querySelectorAll('select').forEach(select => {
                        select.selectedIndex = 0;
                        select.dispatchEvent(new Event('change'));
                    });
                    
                    // Reset time inputs
                    document.querySelectorAll('input[type=time]').forEach(input => {
                        input.value = '';
                    });
                    
                    // Reset checkboxes
                    document.querySelectorAll('input[type=checkbox]').forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    // Reset vehicle search
                    const vehicleInput = this.$refs.vehicleInput;
                    if (vehicleInput) {
                        vehicleInput.value = '';
                        vehicleInput.dispatchEvent(new Event('input'));
                    }

                });
            });
        }
    }">

      <div class="debug">
        {{-- Departure: {{ $selectedDepartureCity }}<br>
        Arrival: {{ $selectedArrivalCity }}<br>
        Type: {{ $selectedVehicleType }}<br>
        Query: {{ $query }}<br> --}}
      
     
      </div>

      <div class="cargo-container">
        <select name="departure_city" wire:model="selectedDepartureCity" wire:change="filterArrivalCities"
          class="editable" required>
          @if($editMode)

          <option value=" {{ $selectedDepartureCity }}"> {{ $selectedDepartureCity }}</option>
          @else
          <option value="select">Select Departure City</option>
          @endif

          @foreach ($departureCities as $index => $city)
          <option value="{{ $city }}">
            {{ $city }}
          </option>
          @endforeach
          @error('selectedDepartureCity')
          <span class="error">{{$message}}</span>
          @enderror
        </select>

        <select name="destination_city" wire:model="selectedArrivalCity" wire:change="showVehicle" class="editable"
          required {{ empty($arrivalCities) ? 'disabled' : '' }}>
          @if($editMode)

          <option value=" {{ $selectedArrivalCity }}"> {{ $selectedArrivalCity }}</option>
          @else
          <option value="">Select Arrival City</option>
          @endif

          @foreach ($arrivalCities as $index => $city)
          <option wire:key="arrival-{{ $index }}" value="{{ $city }}">
            {{ $city }}
          </option>
          @endforeach
          @error('selectedArrivalCity')
          <span class="error">{{$message}}</span>
          @enderror
        </select>

        <br>

        <select name="Vehicle_Type" wire:model='selectedVehicleType' class="editable" required>
          @if($editMode)

          <option value=" {{ $selectedVehicleType }}"> {{ $selectedVehicleType }}</option>
          @else
          <option value="">Select Vehicle Type</option>
          @endif

          @foreach ($vehicleType as $index => $type)
          <option wire:key="type-{{ $index }}" value="{{ $type }}">{{ $type }}</option>
          @endforeach
        </select>
        @error('selectedVehicleType')
        <span class="error">{{$message}}</span>
        @enderror

        {{-- Vehicle number search --}}

        <div x-data="{ open:false, selectedVehicle: ''}" class="relative w-full" x-ref="vehicleSearch">

          @if($editMode)
      

            <input type="text" wire:model='query' x-model="selectedVehicle" x-on:focus="open=true"
            x-on:click.away="open=false" name="bus_bo" placeholder="vehicle no" required class="editable">

          @else
            

        
          <input type="text" wire:model.live='query' x-model="selectedVehicle" x-on:focus="open=true"
          x-on:click.away="open=false" name="bus_bo" class="editable" placeholder="vehicle no" required
          x-ref="vehicleInput">

         
          @endif

          @error('query')
          <span class="error">{{$message}}</span>
          @enderror

          @if(!empty($suggestions))
          <ul class="absolute bg-white border w-full z-10" x-show="open">
            @foreach ($suggestions as $item)
            <li 
            class="px-2 py-2 bg-gray-300 cursor-pointer"
            @click="
                selectedVehicle='{{$item}}';
                $wire.set('query', '{{$item}}');
                open=false
            ">
            {{ $item }}
        </li>
            @endforeach
          </ul>
        
 
          @endif
        </div>

        {{-- Time inputs --}}
        <div class="grid grid-cols-2 gap-4 mt-4">
          <div>
            <label>Departure Time</label>
            <input type="time" wire:model="departureTime" class="editable"  required>

            @error('departureTime')
            <span class="error">{{$message}}</span>
            @enderror
          </div>


          <div>
            <label>Arrival Time</label>
            <input type="time" wire:model="arrivalTime" class="editable" required>
            @error('arrivalTime')
            <span class="error">{{$message}}</span>
            @enderror
          </div>
        </div>

        {{-- Days selection --}}
        <div class="space-y-2 mt-4">
          @if($editMode)
          <p  class="px-2 py-2 bg-gray-300 cursor-pointer red-200">current days {{ json_encode($selectedDays) }}</p>
          @endif
          <br>

          @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
          <label class="inline-flex items-center">

          
            <input type="checkbox" wire:model="selectedDays" value="{{ $day }} "  
              class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <span class="ml-2">{{ $day }}</span>

          </label>


          @endforeach
          @error('selectedDays')
          <span class="error">{{$message}}</span>
          @enderror
        </div>

        {{-- Action buttons --}}
        <div class="button-container mt-4">
          @if($editMode)
          <button type="submit" class="bg-yellow-500 save-btn">Update Schedule</button>
          @else
          <button type="submit">Save</button>
          @endif
          <button type="button" wire:click="clearFields" wire:loading.attr="disabled" class="reset-btn">
            {{ $editMode ? 'Cancel' : 'Reset' }}
          </button>

        </div>
    </form>

  </div>
</div>


<div class="box-info mt-6">
  <h1>Buses Information</h1>
  <div class="top-bar">
    <label>Show
      <select wire:model="perPage">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select> entries
    </label>
  </div>
  <table>
    <thead>
      <tr>
        <th>S.No.</th>
        <th>Vehicle No.</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Type</th>
        <th>Days</th>
        <th>Schedule</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($schedules ?? [] as $index => $schedule)

      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $schedule->vehicle->registration_number ?? 'N/A' }}</td>
        <td>{{ $schedule->route->departure_city ?? 'N/A' }}</td>
        <td>{{ $schedule->route->arrival_city ?? 'N/A' }}</td>
        <td>{{ $schedule->route->vehicle_type ?? 'N/A' }}</td>
        <td>{{ implode(', ', $schedule->days_of_week ?? []) }}</td>
        <td>
          {{ $schedule->departure_time ?? '' }} - {{ $schedule->arrival_time ?? '' }}
        </td>
        <td>
          <button wire:click="editSchedule({{ $schedule->id }})">Edit</button>
          <button wire:click="deleteSchedule({{ $schedule->id }})">Delete</button>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="8" class="text-center py-4">No schedules found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
  {{-- <div class="mt-4">
    {{ $schedules->links() }}
  </div> --}}
</div>
</div>