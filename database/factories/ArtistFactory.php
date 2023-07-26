<?php

namespace Database\Factories;

use Carbon\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languageId = \App\Models\language::inRandomOrder()->value('id');
        return [
            'name' => fake()->name(),
            'info' => fake()->sentence,
            'language_id' => $languageId,
            'date_of_birth' => fake()->date
        ];
    }
}
