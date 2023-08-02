<?php
namespace Tests\Feature\UserFavourite;
use App\Models\Artist;
use App\Models\Language;
use App\Models\Song;
use App\Services\Audio;
use getID3;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Tests\TestCase;

class UserFavouriteTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_song_is_added_to_favorites(): void
    {
        $language = Language::factory()->create();
        $artists = Artist::factory()->create();
        $song = Song::factory()->create();
        $user = auth()->user();

        $this->get(route('add.favorites', [$song->id]));

        $this->assertDatabaseHas('favorites', ['user_id' => 1], ['song_id' => $song->id]);
    }
}
