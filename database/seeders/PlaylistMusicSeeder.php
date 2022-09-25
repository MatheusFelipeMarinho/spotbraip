<?php

namespace Database\Seeders;

use App\Models\PlaylistMusic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaylistMusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlaylistMusic::factory(30)->create();
    }
}
