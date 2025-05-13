<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        DB::table('vehicleregistarions')->insert([
           
            'registration_number' => 'ABC-1234',
            'vehicle_type' => 'Bus',
            'seating_capacity' => 50,
            'make' => 'Toyota',
            'model' => 'Coaster',
            'year' => 2020,
            'is_active' => true,
            'scheduled' => true,
            'notes' => 'Assigned to morning shift route',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ]);
    }
}
