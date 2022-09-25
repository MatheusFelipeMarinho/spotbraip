<?php

namespace Database\Seeders;

use App\Models\AlbumGenre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlbumGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AlbumGenre::factory(22)->create();
    }
}
