<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_id' => 1,
            'name' => fake()->text('15'),
            'starting_date' => fake()->date(),
            'ending_date' => fake()->date(),
            'price' => fake()->numberBetween(100, 1000)

        ];
    }
}
