<?php

namespace Tests\Unit;

use App\Services\Audio;
use PHPUnit\Framework\TestCase;

class AudioTest extends \Tests\TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_the_get_duration_methode_works_properly(): void
    {
        $duration = (new Audio())->getDuration(storage_path('/app/public/tdd/song.mp3'));

        $this->assertTrue($duration == 13);
    }
}
