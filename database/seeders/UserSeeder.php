<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles = [
            'admin',
            'singer',
            'payer',
            'freemium'
       ];

       $users = User::factory(10)->create();

       foreach($users as $user){
           $role = fake()->randomElement($roles);
           $user->assignRole($role);
       }
    }
}
