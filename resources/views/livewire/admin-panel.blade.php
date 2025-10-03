<div>
    <style>
        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: #f6f6f9;
            color: #333;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu-btn,
        .switch-mode,
        .notification,
        .profile {
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
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .box-info li {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            list-style: none;
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid;
        }

        .box-info li:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .box-info li .text h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .box-info li .text p {
            color: #666;
            font-size: 0.9rem;
        }

        .box-info li i {
            font-size: 1.8rem;
            padding: 15px;
            border-radius: 10px;
            color: white;
        }

        /* Color coding for different stats */
        .box-info li:nth-child(1) { border-color: #4CAF50; }
        .box-info li:nth-child(1) i { background: #4CAF50; }
        
        .box-info li:nth-child(2) { border-color: #2196F3; }
        .box-info li:nth-child(2) i { background: #2196F3; }
        
        .box-info li:nth-child(3) { border-color: #FF9800; }
        .box-info li:nth-child(3) i { background: #FF9800; }
        
        .box-info li:nth-child(4) { border-color: #9C27B0; }
        .box-info li:nth-child(4) i { background: #9C27B0; }
        
        .box-info li:nth-child(5) { border-color: #607D8B; }
        .box-info li:nth-child(5) i { background: #607D8B; }
        
        .box-info li:nth-child(6) { border-color: #E91E63; }
        .box-info li:nth-child(6) i { background: #E91E63; }

        /* Chart styles */
        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-header h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .chart-actions {
            display: flex;
            gap: 10px;
        }

        .chart-actions i {
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            color: #666;
        }

        .chart-actions i:hover {
            background: #f0f0f0;
        }

        /* Vehicle distribution */
        .distribution-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .distribution-item {
            background: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .distribution-item:hover {
            transform: translateY(-3px);
        }

        .distribution-item i {
            font-size: 1.5rem;
            color: white;
            background: #4CAF50;
            padding: 12px;
            border-radius: 50%;
            margin-bottom: 10px;
            display: inline-block;
        }

        .distribution-item h4 {
            margin: 5px 0;
            font-size: 1.1rem;
        }

        .distribution-item p {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 1000px) {
            .sidebar-toggle-btn {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .box-info {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .distribution-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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
            
            .distribution-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <section class="content">
        <button id="sidebar-toggle" class="sidebar-toggle-btn" style="display:none;">
            <i class="fas fa-bars menu-btn"></i>
        </button>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Company Overview</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <i class="fas fa-chevron-right"></i>
                        <li><a href="#" class="active">Company Overview</a></li>
                    </ul>
                </div>

                <div class="action-buttons">
                    <a href="{{route('user-home',$company->name)}}" class="download-btn">
                        <i class="fas fa-globe"></i>
                        <span class="text">View Website</span>
                    </a>

                    <div x-data={open:false} @click.away="open=false">
                        <button @click="open=true" class="download-btn">
                            <i class="fas fa-file-export"></i>
                            <span class="text">Export Data</span>
                        </button>

                        <div x-show=open x-transition>
                            @livewire('Admin.CompanyDataExport')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics Section -->
            <div class="box-info">
                @if(!empty($service) && in_array('FleetManagement', $service))
                <li>
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="text">
                        <h3>{{ $stats['performance'] }}%</h3>
                        <p>Fleet Performance</p>
                    </span>
                </li>
                @endif
                
                <li>
                    <i class="fas fa-users"></i>
                    <span class="text">
                        <h3>{{ number_format($stats['active_users']) }}</h3>
                        <p>Active Users</p>
                    </span>
                </li>
                
                <li>
                    <i class="fas fa-dollar-sign"></i>
                    <span class="text">
                        <h3>{{ number_format($stats['revenue']) }}</h3>
                        <p>Monthly Revenue</p>
                    </span>
                </li>
                
                @if(!empty($service) && in_array('FleetManagement', $service))
                <li>
                    <i class="fas fa-bus"></i>
                    <span class="text">
                        <h3>{{ $stats['vehicle_count'] }}</h3>
                        <p>Total Vehicles</p>
                    </span>
                </li>
                
                <li>
                    <i class="fas fa-road"></i>
                    <span class="text">
                        <h3>{{ $stats['route_count'] }}</h3>
                        <p>Active Routes</p>
                    </span>
                </li>
                
                <li>
                    <i class="fas fa-check-circle"></i>
                    <span class="text">
                        <h3>{{ $stats['active_vehicles'] }}</h3>
                        <p>Active Vehicles</p>
                    </span>
                </li>
                
                <li>
                    <i class="fas fa-calendar-check"></i>
                    <span class="text">
                        <h3>{{ $stats['scheduled_vehicles'] }}</h3>
                        <p>Scheduled Vehicles</p>
                    </span>
                </li>
                @endif
            </div>

            <!-- Fleet Management Visualizations -->
            @if(!empty($service) && in_array('FleetManagement', $service))
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Fleet Utilization</h3>
                    <div class="chart-actions">
                        <i class="fas fa-expand" title="Fullscreen"></i>
                        <i class="fas fa-download" title="Download"></i>
                    </div>
                </div>
                <canvas id="fleetUtilizationChart" height="100"></canvas>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Vehicle Status Distribution</h3>
                </div>
                {{-- <canvas id="vehicleStatusChart" height="100"></canvas> --}}
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Vehicle Type Distribution</h3>
                    <p>Breakdown of your fleet by vehicle type</p>
                </div>
                <div class="distribution-grid">
                    @foreach($this->getVehicleTypesDistribution() as $type => $count)
                    <div class="distribution-item">
                        <i class="fas fa-{{ $this->getVehicleIcon($type) }}"></i>
                        <h4>{{ $count }}</h4>
                        <p>{{ ucfirst($type) }} Vehicles</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Company Management Section -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Company Information</h3>
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
        </main>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar toggle functionality
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                });
            }
            
            // Hide sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 1000 && sidebar && sidebar.classList.contains('active')) {
                    if (!sidebar.contains(e.target) && e.target !== toggleBtn) {
                        sidebar.classList.remove('active');
                    }
                }
            });

            // Initialize charts if fleet management is active
            @if(!empty($service) && in_array('FleetManagement', $service))
            // Fleet Utilization Chart
            const fleetCtx = document.getElementById('fleetUtilizationChart').getContext('2d');
            const fleetChart = new Chart(fleetCtx, {
                type: 'bar',
                data: {
                    labels: ['Performance', 'Active Vehicles', 'Scheduled Vehicles'],
                    datasets: [{
                        label: 'Percentage',
                        data: [
                            {{ $stats['performance'] }},
                            {{ $stats['vehicle_count'] ? round(($stats['active_vehicles']/$stats['vehicle_count'])*100) : 0 }},
                            {{ $stats['vehicle_count'] ? round(($stats['scheduled_vehicles']/$stats['vehicle_count'])*100) : 0 }}
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Percentage (%)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + '%';
                                }
                            }
                        }
                    }
                }
            });

            // Vehicle Status Chart
            const statusCtx = document.getElementById('vehicleStatusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active', 'Inactive', 'Scheduled'],
                    datasets: [{
                        data: [
                            {{ $stats['active_vehicles'] }},
                            {{ $stats['vehicle_count'] - $stats['active_vehicles'] }},
                            {{ $stats['scheduled_vehicles'] }}
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(255, 206, 86, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const value = context.raw;
                                    const percentage = Math.round((value / total) * 100);
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            @endif
        });
    </script>
    @endpush
</div>