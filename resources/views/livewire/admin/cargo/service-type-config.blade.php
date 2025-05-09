<!-- resources/views/livewire/cargo/service-type-config.blade.php -->
<div class="box-info">

    <style>
        /* Base Box Styling */
        .box-info {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            margin-left: 250px;
        }
        
        /* Headings */
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
        
        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }
        
        /* Input Group */
        .input-group {
            display: flex;
            align-items: stretch;
        }
        
        .input-group-append {
            display: flex;
        }
        
        .input-group-text {
            padding: 8px 12px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-left: none;
            border-radius: 0 4px 4px 0;
        }
        
        /* Checkbox Styling */
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-check-input {
            margin: 0;
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
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        /* Button Container */
        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
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
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        /* Code Display */
        code {
            background-color: #f8f9fa;
            padding: 2px 4px;
            border-radius: 3px;
            font-family: monospace;
            color: #e83e8c;
        }
        
        /* Text Elements */
        .text-muted {
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .text-center {
            text-align: center;
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
        
        /* Spacing Utilities */
        .mt-3 {
            margin-top: 15px;
        }
        
        .mt-4 {
            margin-top: 20px;
        }
        
        .mb-3 {
            margin-bottom: 15px;
        }
        
        /* Flex Utilities */
        .d-flex {
            display: flex;
        }
        
        .align-items-end {
            align-items: flex-end;
        }
    </style>
    <h1>Service Types Configuration</h1>
    
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveServiceType">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Service Name*</label>
                <input type="text" wire:model="name" class="form-control" required>
            </div>
            
            <div class="form-group col-md-3">
                <label>Code*</label>
                <input type="text" wire:model="code" class="form-control" required>
                <small class="text-muted">Unique identifier (e.g. "express")</small>
            </div>
            
            <div class="form-group col-md-3">
                <label>Surcharge Percentage*</label>
                <div class="input-group">
                    <input type="number" wire:model="surcharge_percentage" 
                           min="0" max="100" step="0.01" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            
            <div class="form-group col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" wire:model="is_active" 
                           class="form-check-input" id="is_active">
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea wire:model="description" class="form-control" rows="2"></textarea>
        </div>
        
        <div class="button-container">
            <button type="submit" class="btn btn-primary">
                {{ $editingId ? 'Update' : 'Add' }} Service
            </button>
            @if($editingId)
                <button type="button" wire:click="resetForm" class="btn btn-secondary">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <div class="mt-4">
        <h3>Available Services</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Surcharge</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($serviceTypes as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td><code>{{ $service->code }}</code></td>
                            <td>{{ $service->surcharge_percentage }}%</td>
                            <td>
                                <span class="badge badge-{{ $service->is_active ? 'success' : 'danger' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <button wire:click="editServiceType({{ $service->id }})" 
                                        class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                                <button wire:click="toggleStatus({{ $service->id }})" 
                                        class="btn btn-sm btn-{{ $service->is_active ? 'warning' : 'success' }}">
                                    {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button wire:click="deleteServiceType({{ $service->id }})" 
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this service?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No services configured yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>