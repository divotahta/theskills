<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create instructor
        User::create([
            'name' => 'Instructor',
            'email' => 'instructor@example.com',
            'password' => bcrypt('password'),
            'role' => 'instructor',
            'email_verified_at' => now(),
        ]);

        // Create student
        User::create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        $this->call([
            CategorySeeder::class,
        ]);

        // Create sample course
        Course::create([
            'title' => 'Sample Course',
            'description' => 'This is a sample course',
            'instructor_id' => 2,
            'price' => 99.99,
            'video_type' => 'youtube',
            'video_url' => 'https://youtube.com/watch?v=sample',
            'is_public' => true,
            'category_id' => 1,
        ]);
    }
} 