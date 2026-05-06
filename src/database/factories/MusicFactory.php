<?php

namespace Database\Factories;

use App\Models\Music;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'release_date' => fake()->dateTimeBetween('-4 years', '+1 month'),
            'cover_image' => 'https://picsum.photos/seed/'.fake()->unique()->slug().'/600/600',
        ];
    }

    public function unreleased(): static
    {
        return $this->state(fn (array $attributes) => [
            'release_date' => fake()->dateTimeBetween('+1 day', '+1 year'),
        ]);
    }
}
