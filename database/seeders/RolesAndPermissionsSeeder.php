<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);

        // create permissions
        Permission::create(['name' => 'modify data']);
        Permission::create(['name' => 'view data']);

        // add permissions to roles
        $adminRole->givePermissionTo(['view data', 'modify data']);
        $userRole->givePermissionTo(['view data']);

    }
}
