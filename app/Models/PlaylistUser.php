<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaylistUser extends Pivot
{
    use HasFactory;

    protected $table = 'playlist_users';
}
