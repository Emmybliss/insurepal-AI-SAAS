<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InsuranceProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word().' Insurance',
            'slug' => $this->faker->slug(),
            'type' => $this->faker->randomElement(['motor', 'health', 'life', 'property', 'travel']),
            'description' => $this->faker->sentence(),
            'form_fields' => [],
            'premium_rules' => [],
            'base_premium' => $this->faker->randomFloat(2, 100, 10000),
            'is_active' => true,
        ];
    }
}
