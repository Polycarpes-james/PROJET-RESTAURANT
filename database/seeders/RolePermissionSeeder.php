<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $client = Role::findByName('client');

        $admin = Role::findByName('admin');

        $superAdmin = Role::findByName('super_admin');

        $admin->givePermissionTo([
            'manage plats',
            'manage categories',
            'manage ingredients',
            'manage reservations',
            'manage commandes',
            'manage menus',
            'manage dashboard',
        ]);

        $superAdmin->givePermissionTo(
            Permission::all()
        );
    }
}
