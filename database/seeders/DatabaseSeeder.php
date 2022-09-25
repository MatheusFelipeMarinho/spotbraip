<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            GenreSeeder::class,
            AlbumSeeder::class,
            MusicSeeder::class,
            PlaylistSeeder::class,
            PlaylistMusicSeeder::class,
            PlaylistUserSeeder::class,
            LikeSeeder::class,
            AlbumGenreSeeder::class
        ]);
    }
}
