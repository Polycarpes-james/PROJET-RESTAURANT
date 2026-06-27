<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plat>
 */
class PlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->randomElement([
                'Poulet Yassa',
                'Mafé',
                'Tacos',
                'Sauce de Maré',
                'Poulet doux de la banquette',
                'Pattes de Mares',
            ]),
            'description' => $this->faker->sentences(7, true), 
            'price' => $this->faker->numberBetween(25, 75),
            'disponible' => true,
            'temps_preparation' => $this->faker->numberBetween(1600, 36000),
            'raison_indisponible' => $this->faker->sentences(7, true)
        ];
    }

    public function disponible (): static
    {
        return $this->state(fn (array $attributes) => [
            'disponible' => true,
        ]);
    }
}
