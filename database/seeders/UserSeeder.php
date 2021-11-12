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
            'name'          => 'System Admin',
            'dob'      => date('Y-m-d H:i:s'),
            'username'      => 'sa_phmagnus',
            'email'         => 'sa_phmagnus@phmagnus.com',
            'password'      =>  bcrypt('PHmagnus2k21!'),
            'mobile_number' => '9190000000',
            'email'         => 'sa@phmagnus.com',
            'agent_code'    => 'sa_phmagnus',
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name'          => 'Finance Admin',
            'dob'           => date('Y-m-d H:i:s'),
            'username'      => 'finance_admin',
            'email'         => 'finance_admin@phmagnus.com',
            'password'      =>  bcrypt('secret'),
            'mobile_number' => '9191111111',
            'email'         => 'finance.admin@phmagnus.com',
            'agent_code'    => 'finance_admin',
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        // DB::table('users')->insert([
        //     'name'          => 'Master Cashier',
        //     'dob'           => date('Y-m-d H:i:s'),
        //     'username'      => 'master_cashier',
        //     'email'         => 'master_cashier@phmagnus.com',
        //     'password'      =>  bcrypt('secret'),
        //     'mobile_number' => '9192222222',
        //     'email'         => 'master.cashier@phmagnus.com',
        //     'agent_code'    => 'master_cashier',
        //     'created_at'    => date('Y-m-d H:i:s'),
        // ]);

        DB::table('users')->insert([
            'name'          => 'Finance User',
            'dob'           => date('Y-m-d H:i:s'),
            'username'      => 'finance_user',
            'email'         => 'finance_user@phmagnus.com',
            'password'      =>  bcrypt('secret'),
            'mobile_number' => '9193333333',
            'email'         => 'finance.user@phmagnus.com',
            'agent_code'    => 'finance',
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        // DB::table('users')->insert([
        //     'name'          => 'Super Agent',
        //     'dob'           => date('Y-m-d H:i:s'),
        //     'username'      => 'super_agent',
        //     'email'         => 'super_agent@phmagnus.com',
        //     'password'      =>  bcrypt('secret'),
        //     'mobile_number' => '9194444444' ,
        //     'agent_code'    => 'super_agent',
        //     'created_at'    => date('Y-m-d H:i:s')
        // ]);

        // DB::table('users')->insert([
        //     'name'          => 'Agent',
        //     'dob'      => date('Y-m-d H:i:s'),
        //     'username'      => 'agent',
        //     'email'         => 'agent@phmagnus.com',
        //     'password'      =>  bcrypt('secret'),
        //     'mobile_number' => '9195555555' ,
        //     'agent_code'    => 'agent',
        //     'created_at'    => date('Y-m-d H:i:s')
        // ]);

        // DB::table('users')->insert([
        //     'name'          => 'Bettor',
        //     'dob'      => date('Y-m-d H:i:s'),
        //     'username'      => 'bettor',
        //     'password'      =>  bcrypt('secret'),
        //     'mobile_number' => '9191111111' ,
        //     'agent_code'    => 'Agent 5'
        // ]);



        // Assign roles to preinserted accounts.
        $system_admin       = \App\Models\User::find(1)->assignRole('system admin');
        $finance_admin      = \App\Models\User::find(2)->assignRole('finance admin');
        // $master_cashier     = \App\Models\User::find(3)->assignRole('master cashier');
        $finance_user       = \App\Models\User::find(3)->assignRole('finance user');
        // $super_agent        = \App\Models\User::find(5)->assignRole('super agent');
        // $agent              = \App\Models\User::find(6)->assignRole('agent');
        // $bettor             = \App\Models\User::find(7)->assignRole('Bettor');
    }
}
