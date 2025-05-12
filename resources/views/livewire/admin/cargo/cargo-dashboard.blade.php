<!-- resources/views/livewire/cargo/cargo-dashboard.blade.php -->
<div class="cargo-management-system">
    <!-- Header -->
    <style>
        /* resources/css/cargo.css */
        .cargo-management-system {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;

        }

        .dashboard-header {
            padding: 20px;
            background-color: #3c91e6;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 284px;
        }

        .dashboard-header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .cargo-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-left: 284px;
        }

        .cargo-tabs button {
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            color: #555;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .cargo-tabs button:hover {
            background: #f5f5f5;
            color: #2c3e50;
        }

        .cargo-tabs button.active {
            color: #2c3e50;
            border-bottom-color: #3490dc;
            font-weight: 600;
        }

        .tab-content {
            padding: 20px;
        }
    </style>
    <div class="dashboard-header">
        <h1>Cargo Management System</h1>
        <div class="header-actions">
            <button id="toggleFormBtn" class="btn btn-primary">
                <i class="fas fa-cog"></i> System Settings
            </button>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="cargo-tabs">
        @foreach($tabs as $key => $label)
        <button wire:click="switchTab('{{ $key }}')" class="{{ $activeTab === $key ? 'active' : '' }}"
            @if($activeTab===$key) disabled @endif>
            {{ $label }}
        </button>
        @endforeach
    </div>


    <!-- Tab Content -->
    <div class="tab-content">
        @if($activeTab === 'routes')
        @livewire('admin.cargo.route-manager')
        @elseif($activeTab === 'weight')
        @livewire('admin.cargo.weight-config', key('weight'))
        @elseif($activeTab === 'volume')
        @livewire('admin.cargo.volume-config', key('volume'))
        @elseif($activeTab === 'services')
        @livewire('admin.cargo.service-type-config', key('services'))

        @elseif($activeTab === 'cargo')
        @vite("resources/css/admin.css")
        @livewire("side-bar")
        @livewire('admin.cargo.booking-manager')
        @endif
    </div>

</div>