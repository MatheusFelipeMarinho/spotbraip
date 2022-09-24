<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory, HasUuids;

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
    public function music(): HasMany
    {
        return $this->hasMany(Music::class);
    }
}
