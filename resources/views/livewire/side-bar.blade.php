<div class="sidebar">
    
    <!-- Header Section -->
    <div class="sidebar-header">
        <a href="/admin" class="logo" wire:navigate>
            <i class="fab fa-slack"></i>
            <span class="text">Admin Panel</span>
        </a>
        <button type="button" class="sidebar-collapse-btn"
            onclick="document.body.classList.toggle('sidebar-collapsed')" aria-label="Toggle sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Main Navigation -->
    <div class="sidebar-menu">
        <ul class="side-menu top">
            @foreach($serviceNames as $name)
            @php $name = trim($name); @endphp
            <li class="{{ request()->is($name) ? 'active' : '' }}">
                <a href="/{{ $name }}" class="nav-link" wire:navigate>
                    @switch($name)
                        @case('FleetManagement')
                            <i class="fas fa-road"></i>
                            @break
                        @case('TicketManagement')
                            <i class="fas fa-ticket"></i>
                            @break
                        @case('CustomerSupport')
                            <i class="fas fa-headset"></i>
                            @break
                        @case('CargoManagement')
                            <i class="fas fa-shipping-fast"></i>
                            @break
                        @default
                            <i class="fas fa-border-all"></i>
                    @endswitch
                    <span class="text">{{ \Illuminate\Support\Str::headline($name) }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Bottom Navigation -->
    <div class="sidebar-footer">
        <ul class="side-menu">
            <li>
                <a href="#" wire:navigate>
                    <i class="fas fa-cog"></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
               <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" style="background: none; border: none; color: #444; cursor: pointer; display: flex; align-items: center;">
        <i class="fas fa-right-from-bracket" style="margin-right: 8px; color:red;"></i>
        <span>Logout</span>
    </button>
</form>

            </li>
        </ul>
    </div>
</div>