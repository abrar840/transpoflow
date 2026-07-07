<div x-data="{
    activeForm: 'route', // Default active form
    switchForm(formName) {
        this.activeForm = formName;
        // You could add additional logic here if needed
    }
}">

  <style>
    .tm-tabs { display: flex; flex-wrap: wrap; gap: 8px; }
    .tm-tabs button {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 9px 16px; border: 1px solid #e2e8f0; border-radius: 8px;
      background: #f8fafc; color: #475569; font-size: 0.85rem; font-weight: 600;
      cursor: pointer; transition: all 0.15s;
    }
    .tm-tabs button:hover { border-color: #c7d2fe; color: #7c3aed; }
    .tm-tabs button.active { background: #7c3aed; border-color: #7c3aed; color: #fff; }
    .tm-tabs button i { font-size: 0.9rem; }
  </style>

  <x-admin.page-header title="Ticket Management" icon="ticket"
      subtitle="Manage routes, schedules, fares, and bookings.">
      <x-slot:actions>
          <div class="tm-tabs">
              <button @click="switchForm('route')" :class="{ 'active': activeForm === 'route' }">
                  <i class="fas fa-road"></i> <span>Route Registration</span>
              </button>
              <button @click="switchForm('schedule')" :class="{ 'active': activeForm === 'schedule' }">
                  <i class="fas fa-calendar-check"></i> <span>Scheduling</span>
              </button>
              <button @click="switchForm('ticket')" :class="{ 'active': activeForm === 'ticket' }">
                  <i class="fas fa-ticket-alt"></i> <span>Ticket Booking</span>
              </button>
          </div>
      </x-slot:actions>
  </x-admin.page-header>

  <section class="content">
    <main>
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