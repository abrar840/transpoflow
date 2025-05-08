<div class="sidebar">
    
    <!-- Header Section -->
    <div class="sidebar-header">
        <a href="/admin" class="logo" wire:navigate>
            <i class="fab fa-slack"></i>
            <span class="text">Admin Panel</span>
        </a>
    </div>

    <!-- Main Navigation -->
    <div class="sidebar-menu">
        <ul class="side-menu top">
            @foreach($serviceNames as $name)
            <li class="{{ request()->is($name) ? 'active' : '' }}">
                <a href="/{{ $name }}" class="nav-link" >
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
                    <span class="text">{{ ucfirst($name) }}</span>
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
                <a href="#" class="logout" wire:navigate>
                    <i class="fas fa-right-from-bracket"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>