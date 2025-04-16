@vite('resources/css/admin.css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<div>
    <section class="sidebar">
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
                @foreach ($serviceNames as $name)
                <li class="{{ 
                    request()->routeIs($name) ? 'active' : '' }} 
                    {{ ($name == 'TicketManagement' && request()->routeIs('RouteRegister')) ? 'active' : '' }}
                ">
                    <a href="/{{ $name }}" class="nav-link" wire:navigate>
                        @if($name == 'fleet')
                            <i class="fas fa-road"></i>
                        @elseif($name == 'ticket')
                            <i class="fas fa-ticket"></i>
                        @elseif($name == 'cargo')
                            <i class="fas fa-truck"></i>
                        @elseif($name == 'schedule')
                            <i class="fas fa-calendar-alt"></i>
                        @else
                            <i class="fas fa-border-all"></i>
                        @endif
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
    </section>
</div>

@vite('resources/js/admin.js')
@vite('resources/js/script.js')