<?php

namespace App\Spot\Music\Services;

use App\Spot\Abstract\AbstractService;
use App\Spot\Music\Repositories\MusicRepository;

class MusicService extends AbstractService
{
    public function __construct(MusicRepository $repository)
    {
        $this->repository = $repository;
    }
}
