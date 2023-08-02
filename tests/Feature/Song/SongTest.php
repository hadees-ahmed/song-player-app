<?php

namespace Tests\Feature\Song;

use App\Models\Artist;
use App\Models\Language;
use App\Services\Audio;
use getID3;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use Tests\TestCase;

class SongTest extends TestCase
{
    use DatabaseMigrations;

    public function createFakeAudioFile($durationInSeconds)
    {
        // Create a temporary file path
        $tempFilePath = tempnam(sys_get_temp_dir(), 'fake_audio');

        // Generate a fake audio file with random data and a specific duration
        $fakeAudioData = str_repeat(random_bytes(1024), 1024);
        file_put_contents($tempFilePath, $fakeAudioData);

        // Use getID3 to set the duration metadata of the file
        $getID3 = new getID3();
        $fakeAudioFileInfo = $getID3->analyze($tempFilePath);
        $fakeAudioFileInfo['playtime_seconds'] = $durationInSeconds;

        // Store the fake audio file in the storage
        $storagePath = 'songs/' . uniqid() . '.mp3';
        Storage::put($storagePath, $fakeAudioData);

        // Delete the temporary file
        unlink($tempFilePath);

        return(object) [
            'path' => $storagePath,
            'duration' => $durationInSeconds,
        ];
    }

    public function test_song_is_store_in_database(): void
    {
//        $mock = $this->mock(Audio::class, function (MockInterface $mock) {
//            $mock->shouldReceive('process')
//                ->once()
//                ->andReturn(13);
//        });
//        dd($this->createFakeAudioFile(10));
        $language = Language::factory()->create();

        $artist = Artist::factory()->create(['language_id' => $language->id]);

        $attributes = [
            'name' => 'hello',
            'artist_id' => $artist->id,
            'audio' =>  UploadedFile::fake()->create('test_song.mp3', 100),
        ];

        $this->post('songs/store', $attributes);

        $this->assertDatabaseHas('songs',['name' => 'hello']);
    }
}
