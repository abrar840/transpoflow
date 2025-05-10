<!-- resources/views/livewire/cargo/booking-manager.blade.php -->
<div>
    <div class="box-info">
        <style>
            /* Base Box Styling */
            .box-info {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                margin-left: 300px;
            }

            /* Headings */
            .box-info h1 {
                font-size: 1.5rem;
                margin-bottom: 20px;
                color: #333;
            }

            .box-info h3,
            .box-info h4,
            .box-info h5 {
                margin: 15px 0;
                color: #444;
            }

            .box-info h3 {
                font-size: 1.2rem;
            }

            .box-info h4 {
                font-size: 1.1rem;
            }

            .box-info h5 {
                font-size: 1rem;
            }

            /* Form Container */
            .cargo-container {
                padding: 15px;
                background: #f9f9f9;
                border-radius: 5px;
            }

            /* Form Layout */
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

            /* Input Styling */
            .form-control {
                width: 100%;
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }

            select.form-control {
                height: 38px;
            }

            textarea.form-control {
                min-height: 80px;
                resize: vertical;
            }

            /* Button Styling */
            .btn {
                padding: 8px 15px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.3s;
                border: none;
            }

            .btn-primary {
                background-color: #4CAF50;
                color: white;
            }

            .btn-primary:hover {
                background-color: #45a049;
            }

            .btn-success {
                background-color: #28a745;
                color: white;
            }

            .btn-success:hover {
                background-color: #218838;
            }

            .btn-success:disabled {
                background-color: #6c757d;
                cursor: not-allowed;
            }

            /* Charges Summary */
            .bg-light {
                background-color: #f8f9fa !important;
            }

            .rounded {
                border-radius: 4px;
            }

            .p-3 {
                padding: 15px;
            }

            .mt-2 {
                margin-top: 10px;
            }

            .mt-3 {
                margin-top: 15px;
            }

            .mt-4 {
                margin-top: 20px;
            }

            /* Table Styling */
            .table-responsive {
                overflow-x: auto;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th {
                background-color: #f2f2f2;
                padding: 10px;
                text-align: left;
            }

            .table td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            /* Status Badges */
            .badge {
                padding: 5px 10px;
                border-radius: 4px;
                font-size: 12px;
                font-weight: 500;
            }

            .badge-primary {
                background-color: #cce5ff;
                color: #004085;
            }

            .badge-success {
                background-color: #d4edda;
                color: #155724;
            }

            .badge-warning {
                background-color: #fff3cd;
                color: #856404;
            }

            /* Alert Styling */
            .alert {
                padding: 10px 15px;
                margin-bottom: 20px;
                border-radius: 4px;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }

            /* Button Container */
            .button-container {
                display: flex;
                gap: 10px;
            }

            /* Responsive Grid */
            .row {
                display: flex;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }

            .col-md-3,
            .col-md-2,
            .col-md-6,
            .col-md-12 {
                position: relative;
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }

            @media (min-width: 768px) {
                .col-md-2 {
                    flex: 0 0 16.666667%;
                    max-width: 16.666667%;
                }

                .col-md-3 {
                    flex: 0 0 25%;
                    max-width: 25%;
                }

                .col-md-6 {
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                .col-md-12 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
            }

            /* Text Elements */
            strong {
                font-weight: 600;
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

            
        </style>
        <h1>Cargo Booking</h1>

        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="cargo-container">
            <form wire:submit.prevent="calculateCharges" id="shippingForm">
                <!-- Shipper Information -->
                <h3>Shipper Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Shipper City</label>
                        <select wire:model="shipper_city" wire:click='findDestination' class="form-control" required>
                            <option value="">Select City</option>
                            @foreach($availableCities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Shipper Name</label>
                        <input type="text" wire:model="shipper_name" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Phone Number</label>
                        <input type="text" wire:model="shipper_phone" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea wire:model="shipper_address" class="form-control" rows="2"></textarea>
                </div>

                <!-- Consignee Information -->
                <h3>Consignee Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Consignee City</label>
                        <select wire:model="consignee_city" class="form-control" required>
                            <option value="">Select City</option>
                            @if($destination)
                            @foreach($destination as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Name</label>
                        <input type="text" wire:model="consignee_name" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Phone Number</label>
                        <input type="text" wire:model="consignee_phone" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea wire:model="consignee_address" class="form-control" rows="2"></textarea>
                </div>

                <!-- Order Information -->
                <h3>Order Information</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Item Description</label>
                        <textarea wire:model="item_description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Quantity</label>
                        <input type="number" wire:model="quantity" min="1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Insurance</label>
                        <select wire:model="insurance" class="form-control">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>

                <!-- Rate Calculation -->
                <h3>Rate Calculation</h3>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Weight (kg)</label>
                        <input type="number" wire:model="weight" step="0.01" min="0.1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Length (cm)</label>
                        <input type="number" wire:model="length" min="1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Width (cm)</label>
                        <input type="number" wire:model="width" min="1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Height (cm)</label>
                        <input type="number" wire:model="height" min="1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Service Type</label>
                        <select wire:model="service_type" class="form-control">
                            <option value="">Standard</option>
                            @foreach($serviceTypes as $service)
                            <option value="{{ $service->code }}">{{ $service->name }} (+{{
                                $service->surcharge_percentage }}%)</option>
                            @endforeach
                        </select>
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

                <button type="submit" class="btn btn-primary">
                    Calculate Charges
                </button>
            </form>

            <!-- Charges Summary -->
            <div class="mt-4 p-3 bg-light rounded">
                <h4>Charges Breakdown</h4>
                <div class="row">
                    <div class="col-md-3">
                        <p>Base Fare: <strong>Rs {{ number_format($base_fare, 2) }}</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p>Weight Charge: <strong>Rs {{ number_format($weight_charge, 2) }}</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p>Volume Charge: <strong>Rs {{ number_format($volume_charge, 2) }}</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p>Service Charge: <strong>Rs {{ number_format($service_charge, 2) }}</strong></p>
                    </div>
                </div>






                
                <div class="row mt-2">
                    <div class="col-md-12">
                        <h5>Total Charges: <strong>Rs {{ number_format($total_amount, 2) }}</strong></h5>
                    </div>
                </div>
            </div>

            <div class="button-container mt-3">
                <button wire:click="createBooking" class="btn btn-success" @if($total_amount <=0) disabled @endif>
                    Confirm Booking
                </button>
            </div>
        </div>
    </div>

    <!-- Bookings List -->
    <div class="box-info mt-4">

        <div class="search-container">
            <input type="text" wire:model.live="search" class="search-input"
                placeholder="Search by city, vehicle ID or days...">
        </div>



        <h1>Recent Bookings</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tracking #</th>
                        <th>Route</th>
                        <th>Consignee</th>
                        <th>Weight</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>booked-by</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->tracking_number }}</td>
                        <td>{{ $booking->shipper_city }} → {{ $booking->consignee_city }}</td>
                        <td>{{ $booking->consignee_name }}</td>
                        <td>{{ $booking->weight }} kg</td>
                        <td>Rs {{ number_format($booking->total_amount, 2) }}</td>
                        <td>
                            <div x-data="{ open: false }" class="relative">
                                <span class="badge cursor-pointer" @click="open = !open">
                                    {{ ucfirst($booking->status) }}
                                </span>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute z-10 mt-1 bg-white shadow-lg rounded-md p-2">
                                    <select wire:model="editingStatus.{{ $booking->id }}" class="form-control text-sm">
                                        @foreach($statusOptions as $status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click="updateStatus('{{ $booking->id }}')"
                                        class="mt-1 btn btn-primary btn-sm" @click="open = false">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                        <td>
                            @if($booking->user->hasRole('admin'))
                            Admin
                        @else
                            End User
                        @endif
                        

                        </td>
                        <td>
                            <button wire:click="downloadSlip('{{ $booking->id }}')" class="btn btn-primary btn-sm">
                                Download Slip
                            </button>
                            <button wire:click="confirmDelete('{{ $booking->id }}')" class="btn btn-danger btn-sm ml-2">
                                Delete
                            </button>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($confirmingDeletion)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h3 class="text-lg font-medium mb-4">Confirm Deletion</h3>
        <p class="mb-4">Are you sure you want to delete this booking? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button wire:click="$set('confirmingDeletion', false)" class="btn btn-secondary">
                Cancel
            </button>
            <button wire:click="deleteBooking" class="btn btn-danger">
                Delete
            </button>
        </div>
    </div>
</div>
@endif
</div>