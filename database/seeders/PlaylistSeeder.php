<?php

namespace Database\Seeders;

use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Playlist::factory(10)->create();
    }
}
