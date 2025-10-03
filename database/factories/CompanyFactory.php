<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => User::factory(),
            'admin_username'=>$this->faker->userName // ✅ Add this line// e.g., 123

            
        ];
    }
}
