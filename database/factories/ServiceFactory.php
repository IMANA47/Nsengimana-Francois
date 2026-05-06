<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['Creation API', 'Application Web', 'Maintenance']),
            'description' => fake()->sentence(12),
            'delivery_time' => fake()->randomElement(['1 semaine', '2 semaines', '1 mois']),
            'price_hint' => fake()->randomElement(['A partir de 300$', 'A partir de 800$', 'Sur devis']),
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
