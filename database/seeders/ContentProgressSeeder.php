<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentProgress;
use App\Models\Enrollment;
use App\Models\CourseContent;

class ContentProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = Enrollment::with('course.contents')->get();
        $courseContents = CourseContent::all();

        if ($enrollments->isEmpty() || $courseContents->isEmpty()) {
            $this->command->warn('Tidak ada enrollment atau course content yang ditemukan. Jalankan EnrollmentSeeder dan CourseContentSeeder terlebih dahulu.');
            return;
        }

        foreach ($enrollments as $enrollment) {
            $courseContents = $enrollment->course->contents;
            
            foreach ($courseContents as $content) {
                // Random progress (0-100%)
                $progress = rand(0, 100);
                
                // Random completion status
                $isCompleted = $progress === 100;
                $completedAt = $isCompleted ? now()->subDays(rand(0, 10)) : null;
                
                // Random last accessed
                $lastAccessedAt = $isCompleted ? $completedAt : now()->subDays(rand(0, 3));

                ContentProgress::create([
                    'user_id' => $enrollment->user_id,
                    'course_content_id' => $content->id,
                    'is_completed' => $isCompleted,
                    'completed_at' => $completedAt,
                    'time_spent' => rand(0, 3600), // Random time spent in seconds
                ]);
            }
        }

        $this->command->info('ContentProgressSeeder berhasil dijalankan!');
    }
}