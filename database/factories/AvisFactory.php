<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Plat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'plat_id' => Plat::inRandomOrder()->first()->id,
            'note' => $this->faker->numberBetween(1, 5),
            'commentaire' => $this->faker->sentences(10, 35)
        ];
    }
}
