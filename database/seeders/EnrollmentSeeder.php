<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $students = User::where('role', 'student')->get();

        if ($courses->isEmpty() || $students->isEmpty()) {
            $this->command->warn('Tidak ada course atau student yang ditemukan. Jalankan CourseSeeder dan UserSeeder terlebih dahulu.');
            return;
        }

        // Enroll setiap student ke beberapa course
        foreach ($students as $student) {
            // Random 2-4 courses per student
            $randomCourses = $courses->random(rand(2, 4));
            
            foreach ($randomCourses as $course) {
                // Random enrollment date (last 30 days)
                $enrollmentDate = now()->subDays(rand(0, 30));
                
                // Random progress (0-100%)
                $progress = rand(0, 100);
                
                // Random completion status
                $isCompleted = $progress === 100;
                $completedAt = $isCompleted ? $enrollmentDate->addDays(rand(1, 20)) : null;
                
                // Random last accessed
                $lastAccessedAt = $isCompleted ? $completedAt : now()->subDays(rand(0, 5));

                Enrollment::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'enrolled_at' => $enrollmentDate,
                    'progress' => $progress,
                    'completed_at' => $completedAt,
                    'learning_hours' => rand(1, 50),
                    'price' => $course->price,
                    'status' => $isCompleted ? 'completed' : 'active',
                ]);
            }
        }

        $this->command->info('EnrollmentSeeder berhasil dijalankan!');
    }
}