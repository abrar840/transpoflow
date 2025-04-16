<div>
  <section class="content">
    <main>
 <!-- resources/views/livewire/ticket-management.blade.php -->
 
  <!-- MOVED HEADER DIRECTLY INTO PARENT COMPONENT -->
  <header class="page-header">
      <div class="header-options">
          <!-- Now uses PARENT'S DIRECT METHODS/PROPERTIES -->
          <button wire:click="switchForm('route')" 
                 class="{{ $activeForm === 'route' ? 'active' : '' }}">
              <i class="fas fa-road"></i>
              <span>Route Registration</span>
          </button>
          
          <button wire:click="switchForm('schedule')"
                 class="{{ $activeForm === 'schedule' ? 'active' : '' }}">
              <i class="fas fa-calendar-check"></i>
              <span>Scheduling</span>
          </button>
          
          <button wire:click="switchForm('ticket')"
                 class="{{ $activeForm === 'ticket' ? 'active' : '' }}">
              <i class="fas fa-ticket-alt"></i>
              <span>Ticket Booking</span>
          </button>
      </div>
  </header>

  <!-- Forms section with transitions -->
  <div wire:transition.fade>
      @if($activeForm === 'route')
          @livewire('route.bus-route-registration')
      @elseif($activeForm === 'schedule')
          @livewire('admin.vehicle-schedule')
      @else
          @livewire('admin.ticket-booking')
      @endif
 
</div>
    </main>
  </section>
 
</div>