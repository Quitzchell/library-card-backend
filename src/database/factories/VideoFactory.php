<?php

namespace Database\Factories;

use App\Enums\VideoType;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'video_id' => $this->faker->numberBetween(1000, 9999),
            'category' => fake()->randomElement(VideoType::options()),
            'sort' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
