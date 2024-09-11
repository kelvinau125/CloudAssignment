<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'user_role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'), // Replace with a more secure password
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Educator User',
                'email' => '1@gmail.com',
                'user_role' => 'educator',
                'email_verified_at' => now(),
                'password' => Hash::make('11111111'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student User',
                'email' => 'student@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

?>