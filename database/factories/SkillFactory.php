<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Laravel', 'PHP', 'JavaScript', 'MySQL', 'Bootstrap']),
            'category' => fake()->randomElement(['Backend', 'Frontend', 'Database']),
            'proficiency' => fake()->numberBetween(60, 98),
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
