<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Course;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and courses
        $users = User::where('role', 'student')->take(5)->get();
        $courses = Course::take(3)->get();

        if ($users->count() === 0 || $courses->count() === 0) {
            $this->command->info('No users or courses found. Please run UserSeeder and CourseSeeder first.');
            return;
        }

        foreach ($users as $user) {
            foreach ($courses as $course) {
                // Create enrollment with random progress
                $progress = rand(0, 100);
                $learningHours = rand(1, 20);
                
                Enrollment::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'enrolled_at' => now()->subDays(rand(1, 30)),
                    'progress' => $progress,
                    'learning_hours' => $learningHours,
                    'completed_at' => $progress >= 100 ? now()->subDays(rand(1, 10)) : null,
                ]);
            }
        }

        $this->command->info('EnrollmentSeeder completed successfully!');
    }
}