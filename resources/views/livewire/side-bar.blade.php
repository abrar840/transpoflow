@vite('resources/css/admin.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<div>
    <section class="sidebar">
        <a href="/admin" class="logo">
          <i class="fab fa-slack"></i>
          <span class="text">Admin Panel</span>
        </a>
  


        <ul class="side-menu top">
          @foreach ($serviceNames as $name)

          <li class="{{request()->routeIs($name) ? 'active' : '' }}" >
                  <a href="/{{$name}}" class="nav-link" wire:navigate>
                      <i class="fas fa-border-all"></i>
                      <span class="text">{{ $name }}</span>
                  </a>
              </li>

          @endforeach
      </ul>
          {{-- <li >
            <a href="/fleet" class="nav-link">
              <i class="fas fa-road"></i>
              <span class="text">Fleet Managment</span>
            </a>
          </li>
          <li>
            <a href="/ticket" class="nav-link">
              <i class="fas fa-ticket"></i>
              <span class="text">Ticket Management</span>
            </a>
          </li>
          <li>
            <a href="/cargo" class="nav-link">
              <i class="fas fa-truck"></i>
              <span class="text">Cargo Management</span>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <i class="fas fa-people-group"></i>
              <span class="text">Customer Support</span>
            </a>
          </li> --}}
     
  
        <ul class="side-menu">
          <li>
            <a href="#">
              <i class="fas fa-cog"></i>
              <span class="text">Settings</span>
            </a>
          </li>
          <li>
            <a href="#" class="logout">
              <i class="fas fa-right-from-bracket"></i>
              <span class="text">Logout</span>
            </a>
          </li>
        </ul>
      </section>
</div>

@vite('resources/js/admin.js')
@vite('resources/js/script.js')
