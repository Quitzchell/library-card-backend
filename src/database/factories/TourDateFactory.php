<?php

namespace Database\Factories;

use App\Models\TourDate;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TourDate>
 */
class TourDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_id' => Venue::factory(),
            'date' => fake()->dateTimeBetween('+1 week', '+1 year'),
            'ticket_url' => fake()->url(),
            'sold_out' => false,
        ];
    }

    public function soldOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'sold_out' => true,
        ]);
    }

    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'date' => fake()->dateTimeBetween('-2 years', '-1 day'),
        ]);
    }
}
