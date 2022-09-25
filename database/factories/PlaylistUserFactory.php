<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlaylistUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->pluck('id');
        $user_id = fake()->randomElement($users);

        $playlists = Playlist::all()->pluck('id');
        $playlist_id = fake()->randomElement($users);


        return [
            'user_id' => $user_id,
            'playlist_id' => $playlist_id
        ];
    }
}
