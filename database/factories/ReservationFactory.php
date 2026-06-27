<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use League\CommonMark\Extension\CommonMark\Node\Inline\HtmlInline;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'name' => $this->faker->name(),
            'phone' => $this->faker->numberBetween(6, 10),
            'email' => fake()->unique()->safeEmail(),
            'guests' => $this->faker->numberBetween(6, 10),
            'reservation_date' => fake()->dateTime(),
            'reservation_time' => fake()->dateTime(),
            'message' => $this->faker->sentences(10, 35),
            'status' => $this->faker->randomElement([
                'pending',
                'confirmed',
                'cancelled'
            ])
        ];
    }
}
