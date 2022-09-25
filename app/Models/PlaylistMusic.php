<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaylistMusic extends Model
{
    use HasFactory;

    protected $table = 'playlist_musics';

    /**
     * Get the playlist that owns the PlaylistMusic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }
}
