<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Enrollment;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = Enrollment::where('status', 'completed')->get();

        if ($enrollments->isEmpty()) {
            $this->command->warn('Tidak ada enrollment yang completed. Jalankan EnrollmentSeeder terlebih dahulu.');
            return;
        }

        foreach ($enrollments as $enrollment) {
            // Random 80% chance to get certificate
            if (rand(1, 100) <= 80) {
                $certificateNumber = 'CERT-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
                
                Certificate::create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                    'certificate_number' => $certificateNumber,
                    'issued_at' => $enrollment->completed_at,
                    'expires_at' => $enrollment->completed_at->addYear(), // Valid for 1 year
                    'is_valid' => true,
                    'download_count' => rand(0, 5),
                ]);
            }
        }

        $this->command->info('CertificateSeeder berhasil dijalankan!');
    }
}
