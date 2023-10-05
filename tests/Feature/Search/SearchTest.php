<?php

namespace Tests\Feature\Search;

use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Models\User;
use App\Services\Audio;
use getID3;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SearchTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    public function test_search_song_title_displays_the_searched_song(): void
    {
        $user = User::factory()->create();
        $language = Language::factory()->create();

        $artist = Artist::factory()->create(['language_id' => $language->id]);

        $song = Song::factory()->create();
        $attributes = [
            'search' => $song->name,
            ];

        $this->actingAs($user)->get(route('songs.index', $attributes))
        ->assertSee($song->name);
    }

    public function test_search_artist_name_displays_the_searched_artist_songs(): void
    {
        $user = User::factory()->create();
        $language = Language::factory()->create();

        $artist = Artist::factory()->create(['language_id' => $language->id]);
        $artist2 = Artist::factory()->create(['language_id' => $language->id]);

        $song = Song::factory()->create(['artist_id' => $artist->id]);
        $song2 = Song::factory()->create(['artist_id' => $artist2->id]);

        $attributes = [
            'artist_id' => $artist->id,
        ];


        $this->actingAs($user)->get(route('songs.index', $attributes))
            ->assertSee($song->name)
            ->assertDontSee($song2->name);
    }
}
