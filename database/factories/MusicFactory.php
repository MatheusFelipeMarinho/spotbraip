<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users =  User::all()->pluck('id');
        $user_id = fake()->randomElement($users);

        $albums =  Album::all()->pluck('id');
        $album_id = fake()->randomElement($albums);

        return [
            'name' => fake()->name(),
            'duration' => fake()->randomNumber(4, true),
            'album_id' => $album_id,
            'user_id' => $user_id,
            'plays' => fake()->randomNumber(5, true),
        ];
    }
}
