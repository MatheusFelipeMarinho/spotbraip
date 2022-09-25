<?php

namespace Database\Seeders;

use App\Models\PlaylistUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlaylistUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlaylistUser::factory(18)->create();
    }
}
