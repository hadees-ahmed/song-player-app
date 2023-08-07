<?php

namespace Tests\Feature\Views;

use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Services\Audio;
use getID3;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Tests\TestCase;

class ViewsTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_view_is_incremented_in_database(): void
    {
        $language = Language::factory()->create();

        $artist = Artist::factory()->create();

        $song = Song::factory()->create();

        $this->assertEquals(0, $song->views);

        $this->post(route('songs.views.increment',['song' => $song->id]));

        $this->assertDatabaseHas('songs', ['id' => $song->id, 'views' => 1,]);
    }
}
