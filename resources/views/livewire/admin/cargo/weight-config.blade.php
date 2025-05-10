<!-- resources/views/livewire/cargo/weight-config.blade.php -->
<div class="box-info">


<style>
     
    .box-info {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        margin-left: 250px;
    }


    

    
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
    
    .form-control {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .btn {
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        border: none;
    }
    
    .btn-primary {
        background-color: #007BFF;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #007BFF;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
    
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
    
    .button-container {
        display: flex;
        gap: 10px;
    }
    
    .mt-3 {
        margin-top: 15px;
    }
    
    .mt-4 {
        margin-top: 20px;
    }
    
    .w-100 {
        width: 100%;
    }
    
    .d-flex {
        display: flex;
    }
    
    .align-items-end {
        align-items: flex-end;
    }
</style>
 







    <h1>Weight Settings</h1>
    
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveWeightTier">
        <div class="cargo-container">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Min Weight (kg)</label>
                    <input type="number" wire:model="min_weight" 
                           class="form-control @error('min_weight') is-invalid @enderror" 
                           step="0.01" required>
                    @error('min_weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group col-md-3">
                    <label>Max Weight (kg)</label>
                    <input type="number" wire:model="max_weight" 
                           class="form-control @error('max_weight') is-invalid @enderror" 
                           step="0.01" required>
                    @error('max_weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group col-md-3">
                    <label>Rate/kg (PKR)</label>
                    <input type="number" wire:model="rate_per_kg" 
                           class="form-control @error('rate_per_kg') is-invalid @enderror" 
                           step="0.01" required>
                    @error('rate_per_kg') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ $editingId ? 'Update' : 'Add' }} Tier
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="button-container mt-3">
        @if($editingId)
            <button wire:click="resetForm" class="btn btn-secondary">
                Cancel Edit
            </button>
        @endif
    </div>

    <div class="mt-4">
        <h3>Current Weight Tiers</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Weight Range (kg)</th>
                        <th>Rate/kg (PKR)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($weightTiers as $tier)
                        <tr>
                            <td>{{ $tier->min_weight }} - {{ $tier->max_weight }}</td>
                            <td>{{ number_format($tier->rate_per_kg, 2) }}</td>
                            <td>
                                <button wire:click="editWeightTier({{ $tier->id }})" 
                                        class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                                <button wire:click="deleteWeightTier({{ $tier->id }})" 
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this weight tier?')">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No weight tiers configured yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>