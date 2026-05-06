<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-6 years', '-1 years');
        return [
            'company' => fake()->company(),
            'role' => fake()->jobTitle(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => fake()->boolean(35) ? null : fake()->dateTimeBetween($start, 'now')->format('Y-m-d'),
            'summary' => fake()->paragraph(),
            'is_current' => fake()->boolean(25),
        ];
    }
}
