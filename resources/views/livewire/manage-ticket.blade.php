<div x-data="{
    activeForm: 'route', // Default active form
    switchForm(formName) {
        this.activeForm = formName;
        // You could add additional logic here if needed
    }
}">
 

  <section class="content">
    <main>
      <!-- Updated header using Alpine.js -->
      <header class="page-header">
        <div class="header-options">
          <button @click="switchForm('route')" 
                 :class="{ 'active': activeForm === 'route' }">
            <i class="fas fa-road"></i>
            <span>Route Registration</span>
          </button>
          
          <button @click="switchForm('schedule')"
                 :class="{ 'active': activeForm === 'schedule' }">
            <i class="fas fa-calendar-check"></i>
            <span>Scheduling</span>
          </button>
          
          <button @click="switchForm('ticket')"
                 :class="{ 'active': activeForm === 'ticket' }">
            <i class="fas fa-ticket-alt"></i>
            <span>Ticket Booking</span>
          </button>
        </div>
      </header>

      <!-- Forms section with transitions -->
      <div x-transition>
        <template x-if="activeForm === 'route'">
          @livewire('route.bus-route-registration')
        </template>
        
        <template x-if="activeForm === 'schedule'">
          @livewire('admin.vehicles-schedule')
        </template>
        
        <template x-if="activeForm === 'ticket'">
          @livewire('admin.ticket-booking')
        </template>
      </div>
    </main>
  </section>
</div>