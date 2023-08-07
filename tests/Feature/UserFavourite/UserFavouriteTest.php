<?php
namespace Tests\Feature\UserFavourite;
use App\Models\Artist;
use App\Models\Favorite;
use App\Models\Language;
use App\Models\Song;
use App\Models\User;
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
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get(route('add.favorites', [$song->id]));

        $this->assertDatabaseHas('favorites', ['user_id' => $user->id, 'song_id' => $song->id]);
    }

    public function test_song_is_removed_from_favorites(): void
    {
        $language = Language::factory()->create();
        $artists = Artist::factory()->create();
        $song = Song::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $user->favorites()->attach($song->id);

        $this->get(route('remove.favorites', [$song->id]));

        $this->assertDatabaseMissing('favorites', ['user_id' => $user->id, 'song_id' => $song->id]);
    }
}

