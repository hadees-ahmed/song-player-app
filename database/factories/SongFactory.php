<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $artistId = Artist::inRandomOrder()->value('id');
        return [
            'name'=> fake()->sentence,
            'artist_id' => $artistId,
            'path'=> fake()->filePath(),
            'duration' => fake()->numerify
        ];
    }
}
