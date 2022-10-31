<?php

namespace App\Spot\Music\Repositories;

use App\Spot\Music\Entities\MusicEntity;
use App\Spot\Abstract\AbstractRepository;

class MusicRepository extends AbstractRepository
{
    public function __construct(MusicEntity $music)
    {
        $this->model = $music;
    }
    
}
