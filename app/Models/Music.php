<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'musics';

    /**
     * Generate a new UUID for the model.
     *
     * @return string
     */
    public function newUniqueId()
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get all of the comments for the PLaylist
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function musicPlaylist(): HasMany
    {
        return $this->hasMany(PlaylistMusic::class, 'music_id');
    }
}
