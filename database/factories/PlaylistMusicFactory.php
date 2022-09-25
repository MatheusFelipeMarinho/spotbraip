<?php

namespace Database\Factories;

use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaylistMusic>
 */
class PlaylistMusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $playlists = Playlist::all()->pluck('id');
        $playlist_id = fake()->randomElement($playlists);

        $musics = Music::all();
        $music = fake()->randomElement($musics);

        return [
            'music_id' => $music->id,
            'playlist_id' => $playlist_id,
            'music_name' => $music->name
        ];
    }
}
