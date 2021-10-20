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

        // Create initial permissions
        $user = [
            'create user',
            'update user',
            'delete user',
            'view user',
        ];
        $role = [
            'create role',
            'update role',
            'delete role',
            'view role',
       ];
       $permission = [
            'create permission',
            'update permission',
            'delete permission',
            'view   permission',
            'assign permission'
       ];

        $permissions = array_merge($user, $role, $permission);
        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Set permissions
        $super_admin = Role::create(['name' => 'Super Admin'])->givePermissionTo($permissions);
        $system_admin = Role::create(['name' => 'System Admin'])->givePermissionTo($permissions);
        $super_agent = Role::create(['name' => 'Super Agent']);
        $agent = Role::create(['name' => 'Agent']);
        $bettor = Role::create(['name' => 'Bettor']);
        $master_cashier = Role::create(['name' => 'Master Cashier']);
    }
}
