<?php

namespace Tests\Unit;

use App\Services\Audio;
use PHPUnit\Framework\TestCase;

class HelpersTest extends \Tests\TestCase
{
    /**
     * A basic test example.
     */

    public function secondsDataProvider()
    {
        return [
            [20, "00:00:20"],
            [60, "00:01:00"],
            [70, "00:01:10"]
        ];
    }
    /**
     * @dataProvider secondsDataProvider
     */
    public function test_that_format_duration_function_works_properly($a, $expected): void
    {
      $duration = formatDuration($a);

      $this->assertTrue($duration === $expected);
    }
}
