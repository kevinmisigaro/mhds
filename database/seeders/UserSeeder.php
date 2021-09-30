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
        //CUSTOMER
        DB::table('users')->insert([
            'name' => 'Kanye West',
            'email' => 'donda@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => '2021-09-28 02:07:28',
            'updated_at' => '2021-09-28 02:07:28'
        ]);

        //ADMINISTRATOR
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'created_at' => '2021-09-28 02:07:28',
            'updated_at' => '2021-09-28 02:07:28'
        ]);

        //INSURER
        DB::table('users')->insert([
            'name' => 'Micheal Edwards',
            'email' => 'edwards@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'insurer',
            'created_at' => '2021-09-28 02:07:28',
            'updated_at' => '2021-09-28 02:07:28'
        ]);

        //DOCTOR
        DB::table('users')->insert([
            'name' => 'Caleb Abel',
            'email' => 'abel@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'doctor',
            'created_at' => '2021-09-28 02:07:28',
            'updated_at' => '2021-09-28 02:07:28'
        ]);
    }

}
