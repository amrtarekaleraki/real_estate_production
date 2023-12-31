<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table("users")->insert([
            //Admin
            [
               'name' => 'Admin',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('123456'),
               'role' => 'admin',
               'status' => 'active',
            ],

            //subscriber
            [
                'name' => 'subscriber',
                'email' => 'subscriber@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'subscriber',
                'status' => 'active',
            ],

        ]);
    }
}
