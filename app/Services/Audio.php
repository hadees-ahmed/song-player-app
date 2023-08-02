<?php

namespace App\Services;

class Audio
{
    public function getDuration($path): int
    {
        $fileInfo = (new \getID3())->analyze($path);

        if (isset($fileInfo['playtime_seconds'])) {
            return (int) $fileInfo['playtime_seconds'];
        } else {
            // Set a default duration (e.g., 0) if the key is not present or unavailable
            return 0;
        }
    }
}
