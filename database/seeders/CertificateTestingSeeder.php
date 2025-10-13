<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Enrollment;
use App\Models\ContentProgress;
use App\Models\User;

class CertificateTestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a student
        $student = User::where('role', 'student')->first();
        
        if (!$student) {
            $this->command->warn('No student found. Please run UserSeeder first.');
            return;
        }

        // Get an enrollment
        $enrollment = Enrollment::where('user_id', $student->id)->first();
        
        if (!$enrollment) {
            $this->command->warn('No enrollment found. Please run EnrollmentSeeder first.');
            return;
        }

        $course = $enrollment->course;
        $contents = $course->contents;

        // Mark all contents as completed
        foreach($contents as $content) {
            ContentProgress::updateOrCreate(
                ['user_id' => $student->id, 'course_content_id' => $content->id],
                ['is_completed' => true, 'completed_at' => now(), 'time_spent' => 3600]
            );
        }

        // Create certificate
        $certificate = Certificate::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'certificate_number' => 'CERT-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
            'issued_at' => now(),
            'expires_at' => now()->addYear(),
            'is_valid' => true,
            'download_count' => 0,
        ]);

        $this->command->info('Certificate created: ' . $certificate->certificate_number);
    }
}
