<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name'          => 'Super Admin',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'superadmin',
            'password'      =>  bcrypt('magnus2k'.date('y').'!'),
            'mobile_number' => 123  ,
            'agent_code'    => 'Agent 1' 
        ]);


        DB::table('users')->insert([
            'name'          => 'System Admin',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'system_admin',
            'password'      =>  bcrypt('password'),
            'mobile_number' => 123   ,
            'agent_code'    => 'Agent 2' 
        ]);

        DB::table('users')->insert([
            'name'          => 'Super Agent',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'super_agent',
            'password'      =>  bcrypt('password'),
            'mobile_number' => 123 ,
            'agent_code'    => 'Agent 3'   
        ]);

        DB::table('users')->insert([
            'name'          => 'Agent',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'agent',
            'password'      =>  bcrypt('password'),
            'mobile_number' => 123 ,
            'agent_code'    => 'Agent 4'   
        ]);

        DB::table('users')->insert([
            'name'          => 'Bettor',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'bettor',
            'password'      =>  bcrypt('password'),
            'mobile_number' => 123 ,
            'agent_code'    => 'Agent 5'   
        ]);

        DB::table('users')->insert([
            'name'          => 'Master Cashier',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'master_cashier',
            'password'      =>  bcrypt('password'),
            'mobile_number' => 123 ,
            'agent_code'    => 'Agent 6'   
        ]);

        // Assign roles to preinserted accounts.
        $super_admin        = \App\Models\User::find(1)->assignRole('Super Admin');
        $system_admin       = \App\Models\User::find(2)->assignRole('System Admin');
        $super_agent        = \App\Models\User::find(3)->assignRole('Super Agent');
        $agent              = \App\Models\User::find(4)->assignRole('Agent');
        $bettor             = \App\Models\User::find(5)->assignRole('Bettor');
        $master_cashier     = \App\Models\User::find(6)->assignRole('Master Cashier');

        // factory(App\User::class, 100)->create();
    }
}
