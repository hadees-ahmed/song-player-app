<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Artist;
use App\Models\Favorite;
use App\Models\Song;
use App\Models\User;
use Carbon\Language;
use Database\Factories\LanguageFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $users = User::factory(10)->create();



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Language::factory(5)->create();

        Artist::factory(50)->create();

        $songs = Song::factory(300)->create();

        foreach ($users as $user) {
            $user->favorites()->sync($songs->random(random_int(2,3))->pluck('id')->toArray());
        }
    }
}
