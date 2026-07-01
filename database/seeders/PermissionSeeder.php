<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate([
            'name'=>'manage plats'
        ]);


        Permission::firstOrCreate([
            'name'=>'manage commandes'
        ]);


        Permission::firstOrCreate([
            'name'=>'manage reservations'
        ]);


        Permission::firstOrCreate([
            'name'=>'manage users'
        ]);
    }
}
