<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $payer = Role::create(['name' => 'payer']);
        $freemium = Role::create(['name' => 'freemium']);
        $singer = Role::create(['name' => 'singer']);

        $adminPermissions = Permission::create([
            'name' => 'approve_singer',
            'name' => 'block_singer'
        ]);


        $admin->givePermissionTo($adminPermissions);


    }
}
