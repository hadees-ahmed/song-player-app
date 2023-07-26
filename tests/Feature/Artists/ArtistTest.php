<?php

namespace Tests\Feature\Artists;

use App\Models\Artist;
use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    use databasemigrations;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_artist_page_display_artists(): void
    {
        $language = Language::factory()->create();
        $artist = Artist::factory()->create();

        $this->get('artists')
            ->assertSee($artist->name);

//        $this->assertDatabaseHas('comments', [
//            'comments' => 'hello',
//        ]);
//        $this->assertNull(Cache::tags('comments')->get('comments')); // Assuming the 'comments' cache tag is cleared
//        $this->assertNull(Cache::tags('posts')->get('posts')); // Assuming the 'posts' cache tag is cleared
    }
}