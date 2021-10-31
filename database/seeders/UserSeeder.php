<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // User::create([
        //     'name' => 'Kanye West',
        //     'email' => 'donda@gmail.com',
        //     'password' => Hash::make('123456'),
        // ]);

        //ADMINISTRATOR
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        //INSURER #1
        User::create([
            'name' => 'Micheal Edwards',
            'email' => 'edwards@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'insurer',
        ]);

        //INSURER #2
        User::create([
            'name' => 'Ole Gunnar',
            'email' => 'ole@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'insurer',
        ]);

        //DOCTOR
        User::create([
            'name' => 'Caleb Abel',
            'email' => 'abel@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'doctor',
        ]);
    }

}
