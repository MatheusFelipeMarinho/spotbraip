<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'musics';

    protected $fillable = [
        'album_id',
        'user_id',
        'name' ,
        'hash',
        'original_name',
        'extension',
        'image_path',
        'path',
        'duration',
        'plays'
    ];

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
     * Get the user that owns the Music
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
