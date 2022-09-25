<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Music;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
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

        $musics = Music::all()->pluck('id');
        $music_id = fake()->randomElement($musics);

        return [
            'user_id' => $user_id,
            'music_id' => $music_id
        ];
    }
}
