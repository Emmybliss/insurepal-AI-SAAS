<?php

namespace Database\Factories;

use App\Models\Deployment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Deployment>
 */
class DeploymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commit_hash' => fake()->sha1(),
            'deployed_at' => fake()->dateTimeThisMonth(),
            'status' => 'success',
            'user_id' => null,
        ];
    }
}
