<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Roles
        $super_admin = Role::create(['name' => 'Super Admin']);
        $system_admin = Role::create(['name' => 'System Admin']);
        $finance = Role::create(['name' => 'Finance']);
        $superagent = Role::create(['name' => 'Finance']);
    }
}
