<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlbumGenre>
 */
class AlbumGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $albums = Album::all()->pluck('id');
        $album_id = fake()->randomElement($albums);

        $genres = Genre::all()->pluck('id');
        $genre_id = fake()->randomElement($genres);


        return [
            'album_id' => $album_id,
            'genre_id' => $genre_id
        ];
    }
}
