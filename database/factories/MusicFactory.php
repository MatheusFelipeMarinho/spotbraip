<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Album;
use Illuminate\Support\Facades\Hash;
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

        $name = fake()->name();
        $extension = fake()->fileExtension();

        return [
            'name' => $name,
            'duration' => fake()->randomNumber(4, true),
            'original_name' => fake()->firstName(),
            'hash' => Hash::make(Carbon::now()->format('Ymd').'_'.$name).'.'.$extension,
            'extension' => $extension,
            'image_path' => fake()->image(null, 640, 480),
            'path'=> '/path/file.mp3',
            'album_id' => $album_id,
            'user_id' => $user_id,
            'plays' => fake()->randomNumber(5, true),
        ];
    }
}
