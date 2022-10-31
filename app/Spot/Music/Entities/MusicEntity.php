<?php

namespace App\Spot\Music\Entities;

use App\Models\Music;

class MusicEntity extends Music
{
    public function __construct(Music $music)
    {
        $this->music = $music;
    }
}
