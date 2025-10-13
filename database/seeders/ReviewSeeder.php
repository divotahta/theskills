<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Enrollment;

class ReviewSeeder extends Seeder
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

        $reviews = [
            'Kursus yang sangat bagus dan mudah dipahami!',
            'Materi disampaikan dengan jelas dan terstruktur.',
            'Instruktur sangat berpengalaman dan sabar.',
            'Kursus ini sangat membantu meningkatkan skill saya.',
            'Worth it banget untuk harganya!',
            'Materi lengkap dan praktis untuk diterapkan.',
            'Sangat recommended untuk pemula.',
            'Kursus terbaik yang pernah saya ikuti.',
            'Instruktur sangat responsive dan helpful.',
            'Kursus ini mengubah cara pandang saya tentang materi ini.',
            'Sangat mudah diikuti dan dipahami.',
            'Kursus yang sangat informatif dan menarik.',
            'Saya sangat puas dengan kualitas kursus ini.',
            'Materi disampaikan dengan cara yang menyenangkan.',
            'Kursus ini sangat membantu karir saya.',
        ];

        foreach ($enrollments as $enrollment) {
            // Random 70% chance to leave review
            if (rand(1, 100) <= 70) {
                $rating = rand(3, 5); // Mostly positive ratings
                $reviewText = $reviews[array_rand($reviews)];
                
                Review::create([
                    'user_id' => $enrollment->user_id,
                    'course_id' => $enrollment->course_id,
                    'rating' => $rating,
                    'comment' => $reviewText,
                    'is_verified' => true,
                    'created_at' => $enrollment->completed_at,
                ]);
            }
        }

        $this->command->info('ReviewSeeder berhasil dijalankan!');
    }
}
