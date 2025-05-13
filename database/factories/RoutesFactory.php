<?php

namespace Database\Factories;

use App\Models\Routes;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoutesFactory extends Factory
{
    protected $model = Routes::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'fare_per_seat' => $this->faker->randomFloat(2, 1000, 2000),
        ];
    }
}
