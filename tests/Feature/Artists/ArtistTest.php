<?php

namespace Tests\Feature\Artists;

use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Routing\Route;
use Tests\TestCase;

class ArtistTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    public function test_artist_page_display_artists(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();

        $this->get('artists')
            ->assertSee($artist->name);
    }
    public function test_click_on_artist_display_its_info(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();

        $this->get(\route('artists.songs.index',['artist' => $artist->id]))
            ->assertSee($artist->info);
    }

    public function test_click_on_artist_display_its_songs(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();
        $song = Song::factory()->create();

        $this->get(\route('artists.songs.index',['artist' => $artist->id]))
            ->assertSee($song->name);
    }

    public function test_artist_image_are_shown_besides_its_name(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();

        $this->get(\route('artists.songs.index',['artist' => $artist->id]))
            ->assertSee($artist->image);
    }
}
