<div>
    <style>
        .form-group{
            color:black;
        }

        .booking-card{
            color: black;
        }
    </style>
    <main>
     

        @if($theme->theme==='light')
        @push('styles')
        @vite('resources/css/enduser/theme1/cargo.css')
        @endpush
        @else
        @push('styles')
        @vite('resources/css/enduser/theme2/cargo.css')
        @endpush
        @endif

        <!-- Cargo Fare Calculator Form -->
        <section>
            <div class="cargo-booking-container">
                <h1 class="cargo-title">Cargo Booking</h1>
                <div class="cargo-form-container">
                    <form wire:submit.prevent="calculateCharges" class="modern-form">
                        <!-- Shipper Information -->
                        <section class="form-section">
                            <h3 class="section-title">Shipper Information</h3>
                            {{$shipper_city}}
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Shipper City</label>
                                    <select wire:model="shipper_city" wire:change="findDestination" class="form-select" required>
                                        <option value="">Select City</option>
                                        @foreach($availableCities as $city)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    @error('shipper_city') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Shipper Name</label>
                                    <input type="text" wire:model="shipper_name" class="form-input" required>
                                    @error('shipper_name') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" wire:model="shipper_phone" class="form-input" required>
                                    @error('shipper_phone') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Shipper Address</label>
                                    <input type="text" wire:model="shipper_address" class="form-input">
                                    @error('shipper_address') <div class="error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </section>

                        <!-- Consignee Information -->
                        <section class="form-section">
                            <h3 class="section-title">Consignee Information</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Consignee City</label>
                                    <select wire:model="consignee_city" class="form-select" required>
                                        <option value="">Select City</option>
                                        @if($destination)
                                            @foreach($destination as $city)
                                                <option value="{{ $city }}">{{ $city }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('consignee_city') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" wire:model="consignee_name" class="form-input" required>
                                    @error('consignee_name') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" wire:model="consignee_phone" class="form-input" required>
                                    @error('consignee_phone') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Address</label>
                                    <input type="text" wire:model="consignee_address" class="form-input">
                                    @error('consignee_address') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" wire:model="consignee_email" class="form-input">
                                    @error('consignee_email') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Delivery Option</label>
                                    <select wire:model="delivery_option" class="form-select">
                                        <option value="Company Office">Company Office</option>
                                        <option value="Home">Home</option>
                                    </select>
                                    @error('delivery_option') <div class="error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </section>

                        <!-- Order Information -->
                        <section class="form-section">
                            <h3 class="section-title">Order Information</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Order Date</label>
                                    <input type="date" class="form-input" value="{{ date('Y-m-d') }}" disabled>
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label">Item Description</label>
                                    <textarea wire:model="item_description" class="form-textarea" required></textarea>
                                    @error('item_description') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Item Quantity</label>
                                    <input type="number" wire:model="quantity" min="1" class="form-input" required>
                                    @error('quantity') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Insurance</label>
                                    <select wire:model="insurance" class="form-select">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                    @error('insurance') <div class="error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </section>

                        <!-- Rate Calculation -->
                        <section class="form-section">
                            <h3 class="section-title">Rate Calculation</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Weight (kg)</label>
                                    <input type="number" wire:model="weight" step="0.01" min="0.1" class="form-input" required>
                                    @error('weight') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="dimension-group">
                                    <div class="form-group">
                                        <label class="form-label">Length (cm)</label>
                                        <input type="number" wire:model="length" min="1" class="form-input" required>
                                        @error('length') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Width (cm)</label>
                                        <input type="number" wire:model="width" min="1" class="form-input" required>
                                        @error('width') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Height (cm)</label>
                                        <input type="number" wire:model="height" min="1" class="form-input" required>
                                        @error('height') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Service Type</label>
                                    <select wire:model="service_type" class="form-select">
                                        <option value="">Standard</option>
                                        @foreach($serviceTypes as $service)
                                            <option value="{{ $service->code }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_type') <div class="error">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group full-width">
                                    <label class="form-label file-upload-label">
                                        <span>Upload Images</span>
                                        <input type="file" wire:model="images" multiple accept="image/*">
                                    </label>
                                    @error('images') <div class="error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </section>

                        <div class="action-buttons">
                            <button type="submit" class="btn calculate-btn" >Calculate Charges</button>
                            <h3 class="total-charges">Total Charges: <span>Rs {{ number_format($total_amount, 2) }}</span></h3>
                        </div>
                    </form>

                    <div class="button-container">
                        <button wire:click="createBooking" class="btn print-btn" @if($total_amount <= 0) disabled @endif>
                            Book & Print
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tracking Section -->
        <section>
            <div class="cargo-booking-container">
                <div class="cargo-form-container tracking-section">
                    <h1 class="cargo-title">Cargo Tracking System</h1>
                    <div class="modern-form">
                        <h3 class="section-title">Track Your Parcel Here</h3>
                        <div class="tracking-input form-group">
                            <input type="text" 
                                   wire:model="tracking_number" 
                                   class="form-input"
                                   placeholder="Enter tracking number">
                            <button wire:click="checkStatus" class="btn calculate-btn">Track</button>
                        </div>
                        
                        @if($tracking_status)
                        <div class="status-container">
                            <div class="progress-bar">
                                <div class="progress-line"></div>
                                <div class="progress-fill" style="width: {{ 
                                    $tracking_status == 'pending' ? '25%' : 
                                    ($tracking_status == 'in_transit' ? '50%' : 
                                    ($tracking_status == 'dispatched' ? '75%' : '100%')) 
                                }}"></div>
                                <div class="stage">
                                    <div class="stage-dot {{ $tracking_status == 'pending' ? 'active' : '' }}"></div>
                                    <span class="stage-label">Pending</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot {{ $tracking_status == 'in_transit' ? 'active' : '' }}"></div>
                                    <span class="stage-label">In Transit</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot {{ $tracking_status == 'dispatched' ? 'active' : '' }}"></div>
                                    <span class="stage-label">Dispatched</span>
                                </div>
                                <div class="stage">
                                    <div class="stage-dot {{ $tracking_status == 'delivered' ? 'active' : '' }}"></div>
                                    <span class="stage-label">Delivered</span>
                                </div>
                            </div>
                            <div class="status-message">
                                Current Status: <strong>{{ ucfirst($tracking_status) }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- My Bookings Section -->
        <section>
            <div class="cargo-booking-container">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                    <h1>booking info</h1>
                    @foreach($bookings as $booking)
                        <div class="bg-white shadow-lg rounded-2xl p-5 border border-gray-200 hover:shadow-xl transition">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $booking->tracking_number }}</h3>
                                <span class="text-sm px-3 py-1 rounded-full 
                                             @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                             @elseif($booking->status === 'shipped') bg-blue-100 text-blue-800
                                             @elseif($booking->status === 'delivered') bg-green-100 text-green-800
                                             @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                
                            <div class="text-gray-600 space-y-1 mb-4">
                                <p><span class="font-semibold">Route:</span> {{ $booking->shipper_city }} → {{ $booking->consignee_city }}</p>
                                <p><span class="font-semibold">Item:</span> {{ $booking->item_description }}</p>
                                <p><span class="font-semibold">Amount:</span> Rs {{ number_format($booking->total_amount, 2) }}</p>
                            </div>
                
                            <button wire:click="downloadSlip('{{ $booking->id }}')" 
                                    class="w-full py-2 text-center text-white bg-indigo-600 hover:bg-indigo-700 rounded-md font-medium transition">
                                Download Slip
                            </button>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </section>
    </main>

    <!-- Footer remains the same -->
    <footer class="footer">
        <!-- ... existing footer code ... -->
    </footer>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('booking-created', () => {
            alert('Booking created successfully!');
        });
        
        Livewire.on('tracking-error', (message) => {
            alert(message);
        });
    });
</script>
@endpush