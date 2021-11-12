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
    //     $role = [
    //         'create role',
    //         'update role',
    //         'delete role',
    //         'view role',
    //    ];

    //    $permission = [
    //        'create permission',
    //         'update permission',
    //         'delete permission',
    //         'view permission',
    //         'assign permission'
    //    ];

       $permissions = [
            'view reports',
            'manage super agent cash ins',
            'manage super agent cash outs',
            'view super agent credits',
            'manage agents',
            'manage users',
            'deactivate user',
            'manage roles and permissions'
       ];

        // $permissions = array_merge($user, $role, $permission);
        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Set permissions
        $system_admin = Role::create(['name' => 'system admin'])->givePermissionTo($permissions);
        $finance_admin = Role::create(['name' => 'finance admin'])->givePermissionTo(['manage users']);
        // $master_cashier = Role::create(['name' => 'master cashier'])
        //     ->givePermissionTo([
        //         'view reports',
        //         'manage agents',
        //         'manage super agent cash ins',
        //         'manage super agent cash outs',
        //         'view super agent credits',
        //     ]);
        $finance_user = Role::create(['name' => 'finance user'])
            ->givePermissionTo([
                'view reports',
                'manage agents',
                'manage super agent cash ins',
                'manage super agent cash outs',
            ]);
        // $super_agent = Role::create(['name' => 'super agent']);
        // $agent = Role::create(['name' => 'agent']);
    }
}
