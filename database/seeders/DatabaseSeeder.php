<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(ServicesTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(VehicleSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Realistic multi-tenant demo data (companies, routes, tickets, cargo)
        // so a freshly deployed site isn't empty. Idempotent — safe to re-run.
        $this->call(DemoDataSeeder::class);
    }
}
 
