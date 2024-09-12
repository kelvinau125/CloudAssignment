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
            [
                'name' => 'Parent User',
                'email' => 'parent@gmail.com',
                'user_role' => 'parent',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user6',
                'email' => 'user6@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user7',
                'email' => 'user7@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user8',
                'email' => 'user8@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user9',
                'email' => 'user9@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user10',
                'email' => 'user10@gmail.com',
                'user_role' => 'student',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
