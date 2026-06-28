<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Policy;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'policy_id' => Policy::factory(),
            'customer_id' => Customer::factory(),
            'claim_reference' => 'CLM-'.now()->year.'-'.$this->faker->unique()->numberBetween(1000000, 9999999),
            'claim_type' => $this->faker->randomElement(['accident', 'theft', 'damage', 'fire', 'medical']),
            'incident_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'incident_description' => $this->faker->paragraph(),
            'incident_location' => $this->faker->address(),
            'claim_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'status' => 'submitted',
            'submitted_at' => now(),
        ];
    }
}
