<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'type' => fake()->randomElement(['lomba', 'seminar', 'upacara']),
            'description' => fake()->sentence(50),
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'published' => fake()->boolean(),
        ];
    }
}
