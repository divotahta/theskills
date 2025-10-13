<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseContent;
use App\Models\Topic;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = Topic::all();

        if ($topics->isEmpty()) {
            $this->command->warn('Tidak ada topic yang ditemukan. Jalankan TopicSeeder terlebih dahulu.');
            return;
        }

        foreach ($topics as $topic) {
            $contents = $this->getContentsForTopic($topic->title);
            
            foreach ($contents as $index => $contentData) {
                CourseContent::create([
                    'course_id' => $topic->course_id,
                    'topic_id' => $topic->id,
                    'title' => $contentData['title'],
                    'content' => $contentData['description'],
                    'video_url' => $contentData['content_url'],
                    'youtube_embed_url' => $contentData['content_url'],
                    'order' => $index + 1,
                    'is_published' => true,
                    'drip_available' => $contentData['is_free'],
                ]);
            }
        }

        $this->command->info('CourseContentSeeder berhasil dijalankan!');
    }

    private function getContentsForTopic($topicTitle)
    {
        $contentsMap = [
            'Pengenalan Angka dan Operasi Dasar' => [
                ['title' => 'Video: Mengenal Angka 1-10', 'description' => 'Video pembelajaran mengenal angka 1-10', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=angka1-10', 'duration' => 15, 'is_free' => true],
                ['title' => 'Video: Penjumlahan Dasar', 'description' => 'Video pembelajaran penjumlahan sederhana', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=penjumlahan', 'duration' => 20, 'is_free' => true],
                ['title' => 'Latihan: Soal Penjumlahan', 'description' => 'Latihan soal penjumlahan 1-20', 'content_type' => 'quiz', 'content_url' => null, 'duration' => 10, 'is_free' => true],
            ],
            'Pecahan dan Desimal' => [
                ['title' => 'Video: Konsep Pecahan', 'description' => 'Video pembelajaran konsep dasar pecahan', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=pecahan', 'duration' => 25, 'is_free' => false],
                ['title' => 'Video: Konversi Pecahan ke Desimal', 'description' => 'Video cara mengkonversi pecahan ke desimal', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=konversi', 'duration' => 20, 'is_free' => false],
                ['title' => 'Latihan: Soal Pecahan', 'description' => 'Latihan soal pecahan dan desimal', 'content_type' => 'quiz', 'content_url' => null, 'duration' => 15, 'is_free' => false],
            ],
            'Limit dan Kontinuitas' => [
                ['title' => 'Video: Pengenalan Limit', 'description' => 'Video konsep dasar limit', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=limit', 'duration' => 30, 'is_free' => false],
                ['title' => 'Video: Menghitung Limit', 'description' => 'Video cara menghitung limit', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=menghitung-limit', 'duration' => 35, 'is_free' => false],
                ['title' => 'Latihan: Soal Limit', 'description' => 'Latihan soal limit dan kontinuitas', 'content_type' => 'quiz', 'content_url' => null, 'duration' => 20, 'is_free' => false],
            ],
            'Pengenalan Python' => [
                ['title' => 'Video: Install Python', 'description' => 'Video cara install Python di komputer', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=install-python', 'duration' => 15, 'is_free' => true],
                ['title' => 'Video: Hello World', 'description' => 'Video program Python pertama', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=hello-world', 'duration' => 10, 'is_free' => true],
                ['title' => 'Praktik: Coding Python', 'description' => 'Praktik coding Python dasar', 'content_type' => 'exercise', 'content_url' => null, 'duration' => 30, 'is_free' => true],
            ],
            'HTML Dasar' => [
                ['title' => 'Video: Struktur HTML', 'description' => 'Video struktur dasar HTML', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=html-struktur', 'duration' => 20, 'is_free' => true],
                ['title' => 'Video: Tag HTML', 'description' => 'Video tag-tag HTML penting', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=html-tag', 'duration' => 25, 'is_free' => true],
                ['title' => 'Praktik: Membuat Halaman HTML', 'description' => 'Praktik membuat halaman HTML', 'content_type' => 'exercise', 'content_url' => null, 'duration' => 45, 'is_free' => true],
            ],
            'Pengenalan Warna' => [
                ['title' => 'Video: Warna Dasar', 'description' => 'Video mengenal warna-warna dasar', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=warna-dasar', 'duration' => 10, 'is_free' => true],
                ['title' => 'Video: Mencampur Warna', 'description' => 'Video cara mencampur warna', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=campur-warna', 'duration' => 15, 'is_free' => true],
                ['title' => 'Aktivitas: Mewarnai', 'description' => 'Aktivitas mewarnai gambar', 'content_type' => 'exercise', 'content_url' => null, 'duration' => 30, 'is_free' => true],
            ],
            'Mengatasi Rasa Takut' => [
                ['title' => 'Video: Teknik Relaksasi', 'description' => 'Video teknik relaksasi sebelum presentasi', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=relaksasi', 'duration' => 20, 'is_free' => true],
                ['title' => 'Video: Building Confidence', 'description' => 'Video membangun kepercayaan diri', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=confidence', 'duration' => 25, 'is_free' => true],
                ['title' => 'Praktik: Presentasi Singkat', 'description' => 'Praktik presentasi singkat', 'content_type' => 'exercise', 'content_url' => null, 'duration' => 15, 'is_free' => true],
            ],
        ];

        return $contentsMap[$topicTitle] ?? [
            ['title' => 'Video Pembelajaran', 'description' => 'Video pembelajaran materi', 'content_type' => 'video', 'content_url' => 'https://youtube.com/watch?v=default', 'duration' => 20, 'is_free' => true],
            ['title' => 'Latihan Praktik', 'description' => 'Latihan praktik materi', 'content_type' => 'exercise', 'content_url' => null, 'duration' => 30, 'is_free' => true],
            ['title' => 'Kuis Pemahaman', 'description' => 'Kuis untuk menguji pemahaman', 'content_type' => 'quiz', 'content_url' => null, 'duration' => 15, 'is_free' => true],
        ];
    }
}