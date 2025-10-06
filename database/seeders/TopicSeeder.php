<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Course;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kursus
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('Tidak ada kursus yang ditemukan. Jalankan CourseSeeder terlebih dahulu.');
            return;
        }

        foreach ($courses as $course) {
            $this->createTopicsForCourse($course);
        }

        $this->command->info('TopicSeeder berhasil dijalankan!');
    }

    private function createTopicsForCourse(Course $course)
    {
        $topics = [
            [
                'title' => 'Pengenalan dan Dasar-dasar',
                'description' => 'Materi pengenalan dan konsep dasar untuk memahami ' . $course->title,
                'order' => 1,
                'duration' => 30,
            ],
            [
                'title' => 'Konsep Teori',
                'description' => 'Pembahasan teori dan konsep-konsep penting dalam ' . $course->title,
                'order' => 2,
                'duration' => 45,
            ],
            [
                'title' => 'Praktik dan Implementasi',
                'description' => 'Sesi praktik untuk menerapkan pengetahuan yang telah dipelajari',
                'order' => 3,
                'duration' => 60,
            ],
            [
                'title' => 'Studi Kasus',
                'description' => 'Analisis studi kasus nyata untuk memahami aplikasi praktis',
                'order' => 4,
                'duration' => 40,
            ],
            [
                'title' => 'Evaluasi dan Penilaian',
                'description' => 'Tes dan evaluasi untuk mengukur pemahaman peserta',
                'order' => 5,
                'duration' => 30,
            ],
        ];

        foreach ($topics as $topicData) {
            Topic::create([
                'course_id' => $course->id,
                'title' => $topicData['title'],
                'description' => $topicData['description'],
                'order' => $topicData['order'],
                'duration' => $topicData['duration'],
            ]);
        }
    }
}