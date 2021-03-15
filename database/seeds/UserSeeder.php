<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            0 => [
                'name' => 'Rahul Baraiya',
                'loginid' => 'rahul01@gmail.com',
                'password' => Hash::make('123456'),
                'email' => 'rahul01@gmail.com',
                'mobileno' => '9427412789',
                'role' => 'admin',
                'createdate' => date('Y-m-d H:i:s')
            ],
            1 =>  [
                'name' => 'Rahul',
                'loginid' => 'rahul05@gmail.com',
                'password' => Hash::make('123456'),
                'email' => 'rahul05@gmail.com',
                'mobileno' => '9427412780',
                'role' => 'vendor',
                'createdate' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
