<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $contents = [
        //     [
        //         'title' => 'Introduction to Laravel',
        //         'description' => 'This content covers the basics of Laravel framework.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/laravel-intro.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Advanced Eloquent',
        //         'description' => 'Learn about advanced Eloquent features in Laravel.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/eloquent-advanced.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Understanding MVC',
        //         'description' => 'An in-depth explanation of MVC architecture.',
        //         'content_type' => 'image',
        //         'content_path' => 'images/mvc-diagram.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Building APIs with Laravel',
        //         'description' => 'How to build RESTful APIs using Laravel.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/api-building.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Working with Blade Templates',
        //         'description' => 'A guide to Blade templating engine in Laravel.',
        //         'content_type' => 'image',
        //         'content_path' => 'images/blade-templates.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Database Migrations',
        //         'description' => 'Learn how to manage database migrations in Laravel.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/database-migrations.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Middleware in Laravel',
        //         'description' => 'Middleware and its importance in request lifecycle.',
        //         'content_type' => 'image',
        //         'content_path' => 'images/middleware-diagram.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Authentication and Authorization',
        //         'description' => 'An overview of Laravel’s authentication and authorization systems.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/auth-system.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Form Validation',
        //         'description' => 'A detailed guide to form validation in Laravel.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/form-validation.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Query Builder vs Eloquent',
        //         'description' => 'Comparison of Laravel’s Query Builder and Eloquent ORM.',
        //         'content_type' => 'image',
        //         'content_path' => 'images/query-vs-eloquent.png',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Deploying Laravel Applications',
        //         'description' => 'Best practices for deploying Laravel applications.',
        //         'content_type' => 'video',
        //         'content_path' => 'videos/laravel-deployment.mp4',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // Insert data into the contents table
        DB::table('contents')->insert($contents);
    }
}
