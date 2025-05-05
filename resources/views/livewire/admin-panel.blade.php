<div>
    <style>
        body {
          margin: 0;
          font-family: Arial, sans-serif;
          background: #f6f6f9;
        }
    
    
    
    
    
        nav {
          display: flex;
          flex-wrap: wrap;
          align-items: center;
          gap: 15px;
          padding: 15px;
          background: #fff;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    
        .menu-btn, .switch-mode, .notification, .profile {
          flex-shrink: 0;
        }
    
        .form-input {
          flex: 1;
          min-width: 200px;
        }
    
        .form-input input {
          width: 100%;
          padding: 8px;
        }
    
        main {
          padding: 15px;
        }
    
        .head-title {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          gap: 15px;
          margin-bottom: 20px;
        }
    
        .action-buttons {
          display: flex;
          flex-wrap: wrap;
          gap: 10px;
        }
    
        .box-info {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
          gap: 15px;
          margin-bottom: 20px;
        }
    
        .box-info li {
          background: #fff;
          padding: 15px;
          border-radius: 8px;
          box-shadow: 0 2px 5px rgba(0,0,0,0.05);
          display: flex;
          align-items: center;
          gap: 15px;
          list-style: none;
        }
    
        .sidebar-toggle-btn {
          display: none;
          background: transparent;
          border: none;
          color: #444;
          font-size: 1.5rem;
          position: fixed;
          top: 15px;
          left: 15px;
          z-index: 1000;
          cursor: pointer;
        }
    
        @media (max-width: 1000px) {
          .sidebar-toggle-btn {
            display: block;
          }
        }
    
        @media (max-width: 480px) {
          nav {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 10px;
          }
    
          .head-title {
            flex-direction: column;
            gap: 8px;
          }
    
          .action-buttons {
            flex-direction: column;
            gap: 8px;
          }
    
          .box-info {
            grid-template-columns: 1fr !important;
          }
        }




        @media (max-width: 480px) {
          nav {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
            padding: 10px;
          }
    
          .head-title {
            flex-direction: column;
            gap: 8px;
          }
    
          .action-buttons {
            flex-direction: column;
            gap: 8px;
          }
    
          .box-info {
            grid-template-columns: 1fr !important;
          }
        }

      </style>
        
    

    <section class="content">
     

            <button id="sidebar-toggle" class="sidebar-toggle-btn" style="display:none;">
                <i class="fas fa-bars menu-btn"></i>
            </button>
       
       
            {{-- <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="search..." />
                    <button class="search-btn">
                        <i class="fas fa-search search-icon"></i>
                    </button>
                </div>
            </form> --}}
{{-- 
            <input type="checkbox" hidden id="switch-mode" />
            <label for="switch-mode" class="switch-mode"></label>

            <a href="#" class="notification">
                <i class="fas fa-bell"></i>
                <span class="num">28</span>
            </a>

            <a href="#" class="profile">
                <img src="profile.png" alt="" />
            </a>
        </nav> --}}

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Overview Panel</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <i class="fas fa-chevron-right"></i>
                        <li><a href="#" class="active">Overview Panel</a></li>
                    </ul>
                </div>
                
                <div class="action-buttons">
                    <button wire:click="togglePreview" class="preview-btn">
                        <i class="fas fa-eye"></i>
                         
                    </button>
                    <button wire:click="exportData" class="download-btn">
                        <i class="fas fa-file-export"></i>
                        <span class="text">Export Data</span>
                    </button>
                    <a href="#" class="download-btn">
                        <i class="fas fa-globe"></i>
                        <span class="text">View Website</span>
                    </a>
                </div>
            </div>

           

            <div class="box-info">
                <li>
                    <i class="fas fa-chart-line"></i>
                    <span class="text">
                        <h3>{{ $stats['performance'] }}%</h3>
                        <p>Performance</p>
                    </span>
                </li>
                <li>
                    <i class="fas fa-users"></i>
                    <span class="text">
                        <h3>{{ number_format($stats['active_users']) }}</h3>
                        <p>Active Users</p>
                    </span>
                </li>
                <li>
                    <i class="fas fa-hand-holding-usd"></i>
                    <span class="text">
                        <h3>${{ number_format($stats['revenue']) }}</h3>
                        <p>Revenue</p>
                    </span>
                </li>
                <li>
                    <i class="fas fa-bus"></i>
                    <span class="text">
                        <h3>{{ $stats['vehicle_count'] }}</h3>
                        <p>Total Vehicles</p>
                    </span>
                </li>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Vehicle Statistics</h3>
                        <i class="fas fa-search"></i>
                        <i class="fas fa-filter"></i>
                    </div>

                    <div class="chart">
                        <div class="bar" style="width: {{ $stats['performance'] }}%; background: #4caf50;">
                            {{ $stats['performance'] }}%
                        </div>
                        <div class="bar" style="width: {{ $stats['vehicle_count'] ? ($stats['active_vehicles']/$stats['vehicle_count'])*100 : 0 }}%; background: #2196f3;">
                            {{ $stats['vehicle_count'] ? round(($stats['active_vehicles']/$stats['vehicle_count'])*100) : 0 }}% Active
                        </div>
                        <div class="bar" style="width: {{ $stats['vehicle_count'] ? ($stats['scheduled_vehicles']/$stats['vehicle_count'])*100 : 0 }}%; background: #ff9800;">
                            {{ $stats['vehicle_count'] ? round(($stats['scheduled_vehicles']/$stats['vehicle_count'])*100) : 0 }}% Scheduled
                        </div>
                    </div>
                </div>

                <section class="vehicle-distribution">
                    <div class="head">
                        <h2>Vehicle Type Distribution</h2>
                        <p>This section shows the count of each type of vehicle managed by your company.</p>
                    </div>
                    <div class="box-info distribution">
                        @foreach($this->getVehicleTypesDistribution() as $type => $count)
                            <li>
                                <i class="fas fa-{{ $this->getVehicleIcon($type) }}"></i>
                                <span class="text">
                                    <h3>{{ $count }}</h3>
                                    <p>{{ ucfirst($type) }}</p>
                                </span>
                            </li>
                        @endforeach
                    </div>
                </section>

                <div class="todo">
                    <div class="head">
                        <h3>Manage Company Info</h3>
                    </div>
                    @if (session()->has('company_updated'))
                        <div class="alert alert-success" style="margin-bottom: 1rem;">
                            {{ session('company_updated') }}
                        </div>
                    @endif
                    <form wire:submit.prevent="updateCompany">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" wire:model="editCompany.name" placeholder="Company Name" />
                        </div>
                       
                        <div class="form-group">
                            <label>Company Type</label>
                            <select wire:model="editCompany.type">
                                <option value="fleet">Fleet</option>
                                <option value="shuttle">Shuttle</option>
                                <option value="transport">Transport</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea wire:model="editCompany.address" placeholder="Company address"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Employee Count</label>
                            <select wire:model="editCompany.num_employees">
                                <option value="<5">Less than 5</option>
                                <option value="5-20">5-20</option>
                                <option value="20-100">20-100</option>
                                <option value="100-250">100-250</option>
                                <option value=">250">More than 250</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-submit">Save Changes</button>
                    </form>
                </div>
            </div>
        </main>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                });
            }
            // Optional: Hide sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 1000 && sidebar && sidebar.classList.contains('active')) {
                    if (!sidebar.contains(e.target) && e.target !== toggleBtn) {
                        sidebar.classList.remove('active');
                    }
                }
            });
        });
    </script>
@endpush
</div>