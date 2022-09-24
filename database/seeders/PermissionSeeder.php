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
        $this->setAdminPermissions();
        $this->setSingerPermissions();
        $this->setPayerPermissions();
        $this->setFreemiumPermissions();
    }

    private function setAdminPermissions()
    {
        $admin = Role::create(['name' => 'admin']);

        $adminArrayOfPermissions = [
            ['name' => 'block_singer'],
            ['name' => 'approve_singer'],
            ['name' => 'can_add_admin'],
            ['name' => 'can_add_genre'],
        ];

        foreach($adminArrayOfPermissions as $value){
            $adminPermissions = Permission::create($value);
        }

        $admin->givePermissionTo($adminPermissions);
    }

    private function setSingerPermissions()
    {
        $singer = Role::create(['name' => 'singer']);

        $singerArrayOfPermissions = [
            ['name' => 'can_add_music'],
            ['name' => 'can_edit_music'],
            ['name' => 'can_delete_music'],
            ['name' => 'can_add_album'],
            ['name' => 'can_edit_album'],
            ['name' => 'can_delete_album'],
        ];

        foreach($singerArrayOfPermissions as $value){
            $singerPermissions = Permission::create($value);
        }

        $singer->givePermissionTo($singerPermissions);
    }

    private function setPayerPermissions()
    {
        $payer = Role::create(['name' => 'payer']);

        $payerArrayOfPermissions = [
            ['name' => 'can_add_playlist'],
            ['name' => 'can_edit_playlist'],
        ];

        foreach($payerArrayOfPermissions as $value){
            $payerPermissions = Permission::create($value);
        }

        $payer->givePermissionTo($payerPermissions);
    }

    private function setFreemiumPermissions()
    {
        $freemium = Role::create(['name' => 'freemium']);

        $freemiumArrayOfPermissions = [
            ['name' => 'can_view_ads'],
        ];

        foreach($freemiumArrayOfPermissions as $value){
            $freemiumPermissions = Permission::create($value);
        }

        $freemium->givePermissionTo($freemiumPermissions);
    }
}
