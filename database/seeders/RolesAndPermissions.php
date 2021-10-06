<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\Admin;
use DB;

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
        // $super_admin = Role::create(['name' => 'Super Admin']);
        // $system_admin = Role::create(['name' => 'System Admin']);
        // $finance = Role::create(['name' => 'Finance']);
        // $superagent = Role::create(['name' => 'Finance']);

        $super_admin = Role::create(['name' => 'Super Admin']);
        $system_admin = Role::create(['name' => 'System Admin']);
        $super_agent = Role::create(['name' => 'Super Agent']);
        $agent = Role::create(['name' => 'Agent']);
        $bettor = Role::create(['name' => 'Bettor']);
    }
}
