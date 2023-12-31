<?php

namespace Tests\Feature\Song;

use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Models\User;
use App\Services\Audio;
use getID3;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Tests\TestCase;

class SongTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    public function test_song_is_store_in_database(): void
    {
        $user = User::factory()->create();
        $language = Language::factory()->create();

        $artist = Artist::factory()->create(['language_id' => $language->id]);

        $attributes = [
            'name' => 'hello',
            'artist_id' => $artist->id,
            'audio' =>  UploadedFile::fake()->create('test_song.mp3', 100),
        ];

        $this->actingAs($user)->post('songs/store', $attributes);

        $this->assertDatabaseHas('songs',['name' => 'hello']);
    }

    public function test_song_duration_is_displayed_along()
    {
        $user = User::factory()->create();
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();
        $song = Song::factory()->create();


        $this->get(route('songs.index', [$artist->id]))
            ->assertSee($song->duration);

    }

    public function test_click_on_artist_display_its_songs(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();
        $song = Song::factory()->create();

        $this->get(route('songs.index',['artist' => $artist->id]))
            ->assertSee($artist->song);
    }
}
