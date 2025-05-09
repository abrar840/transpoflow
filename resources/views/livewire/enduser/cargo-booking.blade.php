<div>
    <style>
        .btns {
            display: flex;
            flex-direction: row;
            margin: 10px;
        }

        .cancel-btn {
    margin-right: 118px;
    margin-top: 112px;
    height: 38px;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
}

        .cancel-btn:hover {
            background-color: #cc0000;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
        }




















        .form-group {
            color: black;
        }

        /* Improved error message styling */
        .error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }



        /* Improved Booking Cards */
        .booking-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1.25rem;
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .booking-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f3f4f6;
        }



        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-in_transit {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-dispatched {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .status-delivered {
            background-color: #dcfce7;
            color: #166534;
        }

        .booking-details {
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .detail-label {
            font-weight: 600;
            color: #4b5563;
        }

        .download-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.5rem;
            background-color: #c4a727;
            color: white;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .download-btn:hover {
            background-color: #4338ca;
        }

        /* Image Upload Styles */
        .file-upload-label {
            display: inline-block;
            padding: 12px 20px;
            background-color: #f8f9fa;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            border-color: #4CAF50;
            background-color: #f0fdf4;
        }

        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .image-preview-item {
            position: relative;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: transform 0.2s;
        }

        .image-preview-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .image-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 6px 8px;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
        }

        .delete-image-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .image-preview-item:hover .delete-image-btn {
            opacity: 1;
        }

        .delete-image-btn:hover {
            background: #dc2626;
        }



        /* Booking Images Display */
        .booking-images {
            display: flex;
            gap: 10px;
            margin: 10px 0;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .booking-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #eee;
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

        <!-- My Bookings Section - Moved to Top -->
        <section class="mb-8">
            <div class="cargo-booking-container overflow-x-auto">
                <h1 class="cargo-title">My Recent Bookings</h1>
                <div class="flex gap-6">
                    @forelse($bookings as $booking)
                    <div class="min-w-[500px]  bg-white shadow p-4 rounded booking-card">
                        <div class="booking-header">
                            <h3 class="text-lg font-semibold">{{ $booking->tracking_number }}</h3>
                            <span class="status-badge status-{{ $booking->status }}">
                                {{ $booking->status }}
                            </span>
                        </div>

                        <div class="booking-details text-black h-[300px] max-h-[700px]">


                            <div class="detail-row">
                                <span class="detail-label">tracking_number:</span>
                                <span>{{ $booking->tracking_number }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Route:</span>
                                <span>{{ $booking->shipper_city }} → {{ $booking->consignee_city }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Item:</span>
                                <span class="truncate">{{ $booking->item_description }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Amount:</span>
                                <span>Rs {{ number_format($booking->total_amount, 2) }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Date:</span>
                                <span>{{ $booking->created_at->format('M d, Y') }}</span>
                            </div>

                            <div class="detail-row flex image-container">
                                @if(!empty($booking->images) && is_countable($booking->images) &&
                                $booking->images->count() > 0)
                                <div class="booking-images">
                                    @foreach($booking->images as $image)
                                    <img src="{{ asset('storage/'.$image->image_path) }}" alt="Cargo Image"
                                        class="booking-image">
                                    @endforeach
                                </div>
                                @endif

                                @if($booking->status == 'pending')
                                <button wire:click="cancelBooking({{ $booking->id }})" 
                                        class="cancel-btn"
                                        wire:confirm="Are you sure you want to cancel this booking?">
                                    Cancel Booking
                                </button>
                                @endif
                            </div>


                        </div>




                        <button wire:click="downloadSlip('{{ $booking->id }}')" class="download-btn bg-orange-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Download Slip
                        </button>



                    </div>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">You don't have any bookings yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Tracking Section - Moved up -->
        <section class="mb-8">
            <div class="cargo-booking-container">
                <div class="cargo-form-container tracking-section">
                    <h1 class="cargo-title">Cargo Tracking System</h1>
                    <div class="modern-form">
                        <h3 class="section-title">Track Your Parcel Here</h3>
                        <div class="tracking-input form-group">
                            <input type="text" wire:model="tracking_number" class="form-input"
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

        <!-- Booking Form - Moved to bottom -->
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
                                    <select wire:model="shipper_city" wire:change="findDestination" class="form-select"
                                        required>
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
                                    <input type="number" wire:model="weight" step="0.01" min="0.1" class="form-input"
                                        required>
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

                                <!-- Image Upload Section -->
                                <div class="form-group full-width">
                                    <label class="form-label file-upload-label">
                                        <span>Upload Cargo Images (Max 5)</span>
                                        <input type="file" wire:model="images" multiple accept="image/*" class="d-none">
                                    </label>

                                    <p class="text-sm text-gray-500 mt-1">Supported formats: JPG, PNG. Max 2MB per
                                        image.</p>

                                    <!-- Image Preview with Delete Option -->
                                    <div class="image-preview-container mt-4">
                                        @foreach($uploadedImages as $index => $image)
                                        <div class="image-preview-item relative group">
                                            <img src="{{($image['url'])}}" alt="Preview"
                                                class="h-full w-full object-cover">

                                            <!-- Image Info -->
                                            <div class="image-info">
                                                <span class="text-xs">{{ $image['name'] }}</span>
                                                {{-- <span class="text-xs">{{ $image['size'] }}</span> --}}
                                            </div>

                                            <!-- Delete Button -->
                                            <button type="button" wire:click="removeImage({{ $index }})"
                                                class="delete-image-btn" title="Remove image">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>

                                    @error('images.*') <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </section>
                        <div class="formula">
                            @if(isset($calculation_details))
                            <div class="pricing-breakdown">
                                <h4>Pricing Calculation</h4>
                                <p><strong>Formula:</strong> {{ $calculation_details['formula'] }}</p>

                                <div class="breakdown-values">
                                    <p>Base Fare: {{ number_format($calculation_details['base_fare'], 2) }}</p>
                                    <p>Weight Charge: {{ number_format($calculation_details['weight_charge'], 2) }}</p>
                                    <p>Volume Charge: {{ number_format($calculation_details['volume_charge'], 2) }}</p>
                                    <p>Service Charge: {{ number_format($calculation_details['service_charge'], 2) }} ×
                                        {{ $calculation_details['quantity'] }}</p>
                                    <hr>
                                    <p><strong>Total Amount:</strong> {{
                                        number_format($calculation_details['total_amount'], 2) }}</p>
                                </div>
                            </div>
                            @endif
                        </div>





                        <div class="action-buttons">
                            <button type="submit" class="btn calculate-btn">Calculate Charges</button>
                            <h3 class="total-charges">Total Charges: <span>Rs {{ number_format($total_amount, 2)
                                    }}</span></h3>
                        </div>
                    </form>

                    <div class="button-container">
                        <button wire:click="createBooking" class="btn print-btn" @if($total_amount <=0) disabled @endif>
                            Book & Print
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>