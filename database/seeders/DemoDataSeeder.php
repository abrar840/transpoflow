<?php

namespace Database\Seeders;

use App\Models\CargoBook;
use App\Models\CargoRoute;
use App\Models\CargoServiceType;
use App\Models\CargoVolumeTier;
use App\Models\CargoWeightTier;
use App\Models\Company;
use App\Models\CompanyTheme;
use App\Models\Routes;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Seeds a realistic multi-tenant demo dataset so a freshly deployed site
 * (e.g. on Render) looks populated for an interview walkthrough.
 *
 * Idempotent: safe to run more than once. Companies are keyed by email;
 * existing demo companies are skipped so re-running (entrypoint `db:seed --force`)
 * does not duplicate or error on unique constraints.
 *
 * NOTE: all rows are explicitly scoped with company_id — this seeder does NOT
 * rely on any global tenant scope (that refactor is a separate workstream).
 */
class DemoDataSeeder extends Seeder
{
    /** Shared demo password for every seeded admin login. */
    private const DEMO_PASSWORD = 'password';

    public function run(): void
    {
        // Make sure the base service rows exist (ServicesTableSeeder runs first
        // in DatabaseSeeder, but guard in case this seeder is called alone).
        if (Service::count() === 0) {
            $this->call(ServicesTableSeeder::class);
        }

        $companies = [
            [
                'name'          => 'Skyline Transport',
                'email'         => 'admin@skyline.test',
                'type'          => 'transport',
                'num_employees' => '20-100',
                'theme'         => 'theme1',
                'cities'        => ['Lahore', 'Islamabad', 'Faisalabad', 'Multan'],
            ],
            [
                'name'          => 'Metro Fleet Co',
                'email'         => 'admin@metrofleet.test',
                'type'          => 'fleet',
                'num_employees' => '5-20',
                'theme'         => 'theme2',
                'cities'        => ['Karachi', 'Hyderabad', 'Sukkur'],
            ],
        ];

        $credentials = [];

        foreach ($companies as $data) {
            if (Company::where('email', $data['email'])->exists()) {
                $this->command?->warn("  • Demo company {$data['name']} already exists — skipping.");
                continue;
            }

            $credentials[] = $this->seedCompany($data);
        }

        $this->printCredentials($credentials);
    }

    /**
     * Seed one full tenant: admin user, company, services, theme, routes,
     * vehicles, schedules, tickets, and cargo.
     *
     * @return array{name:string,email:string,password:string}
     */
    private function seedCompany(array $data): array
    {
        // 1. Admin user first (companies.user_id requires an existing user).
        //    company_id is backfilled once the company row exists.
        $admin = User::create([
            'name'     => $data['name'].' Admin',
            'email'    => $data['email'],
            'password' => Hash::make(self::DEMO_PASSWORD),
        ]);
        $admin->assignRole('admin'); // web-guard admin role (see RoleSeeder)

        // 2. Company (tenant root).
        $company = Company::create([
            'user_id'        => $admin->id,
            'name'           => $data['name'],
            'type'           => $data['type'],
            'address'        => $data['cities'][0].', Pakistan',
            'email'          => $data['email'],
            'admin_username' => Str::slug($data['name'], '_'),
            'num_employees'  => $data['num_employees'],
        ]);

        // Backfill the admin's tenant id.
        $admin->update(['company_id' => $company->id]);

        // 3. Attach all services to the company (match names exactly — one
        //    seeded service name has a trailing space: 'CargoManagement ').
        $company->services()->syncWithoutDetaching(Service::pluck('id')->all());

        // 4. Theme (drives the public /{company} themed site).
        CompanyTheme::create([
            'company_id' => $company->id,
            'theme'      => $data['theme'],
        ]);

        // 5. Routes + vehicles + schedules + tickets.
        $this->seedRoutesVehiclesTickets($company, $admin, $data['cities']);

        // 6. Cargo (tiers, routes, bookings).
        $this->seedCargo($company, $admin, $data['cities']);

        return [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => self::DEMO_PASSWORD,
        ];
    }

    private function seedRoutesVehiclesTickets(Company $company, User $admin, array $cities): void
    {
        $vehicleTypes = ['Bus', 'Coaster', 'Van'];
        $vehicles = [];

        // A couple of vehicles per company (string PK = registration_number).
        foreach ($vehicleTypes as $i => $type) {
            $reg = strtoupper(Str::slug($company->name, '')).'-'.(1000 + $i);
            $vehicles[] = Vehicle::create([
                'registration_number' => $reg,
                'company_id'          => $company->id,
                'vehicle_type'        => $type,
                'seating_capacity'    => [40, 30, 15][$i],
                'make'                => ['Hino', 'Toyota', 'Ford'][$i],
                'model'               => ['AK', 'Coaster', 'Transit'][$i],
                'year'                => 2020 + $i,
                'is_active'           => true,
                'scheduled'           => true,
                'available_seats'     => [40, 30, 15][$i],
            ]);
        }

        // Routes between consecutive city pairs.
        for ($i = 0; $i < count($cities) - 1; $i++) {
            $vehicle = $vehicles[$i % count($vehicles)];

            $route = Routes::create([
                'company_id'     => $company->id,
                'departure_city' => $cities[$i],
                'arrival_city'   => $cities[$i + 1],
                'vehicle_type'   => $vehicle->vehicle_type,
                'fare_per_seat'  => 1500 + ($i * 500),
            ]);

            $schedule = VehicleSchedule::create([
                'route_id'       => $route->id,
                'vehicle_id'     => $vehicle->registration_number,
                'days_of_week'   => ['Mon', 'Wed', 'Fri', 'Sun'],
                'departure_time' => '08:00:00',
                'arrival_time'   => '14:00:00',
            ]);

            // A couple of confirmed tickets per route.
            for ($t = 0; $t < 2; $t++) {
                $fare  = (float) $route->fare_per_seat;
                $travel = Carbon::today()->addDays(3 + $i + $t);

                $ticket = Ticket::create([
                    'ticket_number'    => 'TKT-'.strtoupper(Str::random(8)),
                    'user_id'          => $admin->id,
                    'company_id'       => $company->id,
                    'route_id'         => $route->id,
                    'schedule_id'      => $schedule->id,
                    'vehicle_id'       => $vehicle->registration_number,
                    'passenger_name'   => 'Passenger '.($t + 1).' — '.$route->departure_city,
                    'passenger_phone'  => '03'.rand(10000000, 99999999),
                    'passenger_gender' => $t % 2 === 0 ? 'male' : 'female',
                    'travel_date'      => $travel->toDateString(),
                    'fare'             => $fare,
                    'discount'         => 0,
                    'total_amount'     => $fare,
                    'valid_until'      => $travel->copy()->addDay()->toDateString(),
                    'status'           => 'confirmed',
                    'booking_date'     => Carbon::now(),
                    'payment_method'   => 'cash',
                    'payment_status'   => 'paid',
                ]);

                TicketSeat::create([
                    'ticket_id'   => $ticket->id,
                    'seat_number' => 'S'.($t + 1),
                ]);
            }
        }
    }

    private function seedCargo(Company $company, User $admin, array $cities): void
    {
        // Pricing tiers.
        CargoWeightTier::create([
            'company_id'   => $company->id,
            'min_weight'   => 0,
            'max_weight'   => 50,
            'rate_per_kg'  => 25,
        ]);
        CargoVolumeTier::create([
            'company_id'    => $company->id,
            'min_volume'    => 0,
            'max_volume'    => 100000,
            'rate_per_cm3'  => 0.01,
        ]);
        CargoServiceType::create([
            'company_id'           => $company->id,
            'name'                 => 'Standard',
            'code'                 => 'STD-'.$company->id, // code is globally unique in schema — keep per-company distinct
            'surcharge_percentage' => 0,
            'description'          => 'Standard cargo delivery',
            'is_active'            => true,
        ]);

        // A cargo route on the first city pair.
        CargoRoute::create([
            'company_id'     => $company->id,
            'departure_city' => $cities[0],
            'arrival_city'   => $cities[1],
            'vehicle_id'     => strtoupper(Str::slug($company->name, '')).'-1000',
            'base_fare'      => 500,
            // CargoRoute has no array cast for shipment_days — store JSON explicitly.
            'shipment_days'  => json_encode(['Mon', 'Thu']),
        ]);

        // A couple of bookings.
        for ($i = 0; $i < 2; $i++) {
            $weight = 20 + ($i * 10);
            $volume = 5000 + ($i * 2000);
            $base   = 500;
            $wCharge = $weight * 25;
            $vCharge = $volume * 0.01;
            $sCharge = 0;
            $total   = $base + $wCharge + $vCharge + $sCharge;

            CargoBook::create([
                'company_id'        => $company->id,
                'user_id'           => $admin->id,
                'tracking_number'   => 'CRG-'.strtoupper(Str::random(8)),
                'shipper_name'      => 'Shipper '.($i + 1),
                'shipper_phone'     => '03'.rand(10000000, 99999999),
                'shipper_address'   => 'Warehouse '.($i + 1).', '.$cities[0],
                'shipper_city'      => $cities[0],
                'consignee_name'    => 'Consignee '.($i + 1),
                'consignee_phone'   => '03'.rand(10000000, 99999999),
                'consignee_address' => 'Depot '.($i + 1).', '.$cities[1],
                'consignee_city'    => $cities[1],
                'weight'            => $weight,
                'volume'            => $volume,
                'item_description'  => 'Demo parcel #'.($i + 1),
                'quantity'          => $i + 1,
                'base_fare'         => $base,
                'weight_charge'     => $wCharge,
                'volume_charge'     => $vCharge,
                'service_charge'    => $sCharge,
                'total_amount'      => $total,
                'status'            => $i === 0 ? 'pending' : 'in_transit',
            ]);
        }
    }

    /** @param array<int,array{name:string,email:string,password:string}> $credentials */
    private function printCredentials(array $credentials): void
    {
        if (empty($credentials) || ! $this->command) {
            return;
        }

        $this->command->info('');
        $this->command->info('=== Demo admin logins (login at /login) ===');
        foreach ($credentials as $c) {
            $this->command->info("  {$c['name']}:  {$c['email']}  /  {$c['password']}");
        }
        $this->command->info('===========================================');
    }
}
