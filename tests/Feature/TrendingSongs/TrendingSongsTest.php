<?php

namespace Tests\Feature\TrendingSongs;

use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Routing\Route;
use Tests\TestCase;

class TrendingSongsTest extends \Tests\TestCase
{
    use DatabaseMigrations;

    public function test_artist_page_display_artists(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();

        $this->get('artists')
            ->assertSee($artist->name);
    }

    public function test_trending_tab_shows_the_songs_sorted_by_views_count():void
    {
        $song = User::factory()->create();

        $this->get(route(''));

    }
}
