<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->hasMany(AlbumGenre::class);
    }
}
