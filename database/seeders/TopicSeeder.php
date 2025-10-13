<?php

namespace Database\Seeders;

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
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('Tidak ada course yang ditemukan. Jalankan CourseSeeder terlebih dahulu.');
            return;
        }

        foreach ($courses as $course) {
            $topics = $this->getTopicsForCourse($course->title);
            
            foreach ($topics as $index => $topicData) {
                Topic::create([
                    'course_id' => $course->id,
                    'title' => $topicData['title'],
                    'description' => $topicData['description'],
                    'order' => $index + 1,
                    'duration' => rand(15, 60), // Random duration 15-60 minutes
                ]);
            }
        }

        $this->command->info('TopicSeeder berhasil dijalankan!');
    }

    private function getTopicsForCourse($courseTitle)
    {
        $topicsMap = [
            'Matematika Dasar untuk Pemula' => [
                ['title' => 'Pengenalan Angka dan Operasi Dasar', 'description' => 'Mempelajari angka 0-100 dan operasi penjumlahan, pengurangan, perkalian, pembagian'],
                ['title' => 'Pecahan dan Desimal', 'description' => 'Memahami konsep pecahan, desimal, dan cara mengkonversinya'],
                ['title' => 'Persentase dan Rasio', 'description' => 'Belajar menghitung persentase dan memahami konsep rasio'],
                ['title' => 'Geometri Dasar', 'description' => 'Mengenal bentuk-bentuk geometri dan menghitung luas serta keliling'],
                ['title' => 'Aljabar Sederhana', 'description' => 'Pengenalan variabel dan persamaan linear sederhana'],
            ],
            'Kalkulus untuk SMA dan Perguruan Tinggi' => [
                ['title' => 'Limit dan Kontinuitas', 'description' => 'Memahami konsep limit dan kontinuitas fungsi'],
                ['title' => 'Turunan dan Aplikasinya', 'description' => 'Belajar menghitung turunan dan aplikasinya dalam kehidupan'],
                ['title' => 'Integral dan Aplikasinya', 'description' => 'Memahami konsep integral dan cara menghitungnya'],
                ['title' => 'Fungsi Trigonometri', 'description' => 'Mempelajari fungsi trigonometri dan turunannya'],
                ['title' => 'Aplikasi Kalkulus', 'description' => 'Menerapkan kalkulus dalam masalah optimasi dan laju perubahan'],
            ],
            'Statistika dan Probabilitas' => [
                ['title' => 'Pengenalan Statistika', 'description' => 'Memahami konsep dasar statistika dan jenis data'],
                ['title' => 'Ukuran Pemusatan Data', 'description' => 'Mempelajari mean, median, modus, dan kuartil'],
                ['title' => 'Probabilitas Dasar', 'description' => 'Memahami konsep probabilitas dan aturan dasar'],
                ['title' => 'Distribusi Normal', 'description' => 'Mempelajari distribusi normal dan aplikasinya'],
                ['title' => 'Uji Hipotesis', 'description' => 'Belajar melakukan uji hipotesis statistik'],
            ],
            'Belajar Koding dari Nol - Python untuk Pemula' => [
                ['title' => 'Pengenalan Python', 'description' => 'Memahami sintaks dasar Python dan cara menjalankan program'],
                ['title' => 'Variabel dan Tipe Data', 'description' => 'Mempelajari cara mendeklarasikan variabel dan tipe data'],
                ['title' => 'Struktur Kontrol', 'description' => 'Belajar if-else, loop, dan struktur kontrol lainnya'],
                ['title' => 'Fungsi dan Modul', 'description' => 'Membuat dan menggunakan fungsi serta modul'],
                ['title' => 'OOP Dasar', 'description' => 'Pengenalan konsep Object-Oriented Programming'],
            ],
            'Web Development dengan HTML, CSS, dan JavaScript' => [
                ['title' => 'HTML Dasar', 'description' => 'Mempelajari struktur HTML dan tag-tag dasar'],
                ['title' => 'CSS Styling', 'description' => 'Belajar styling dengan CSS dan layout'],
                ['title' => 'JavaScript Dasar', 'description' => 'Memahami sintaks JavaScript dan DOM manipulation'],
                ['title' => 'Responsive Design', 'description' => 'Membuat website yang responsif untuk berbagai device'],
                ['title' => 'Proyek Website', 'description' => 'Membuat website portfolio lengkap'],
            ],
            'Mobile App Development dengan Flutter' => [
                ['title' => 'Pengenalan Flutter', 'description' => 'Memahami konsep Flutter dan setup development environment'],
                ['title' => 'Widget dan Layout', 'description' => 'Mempelajari berbagai widget dan cara mengatur layout'],
                ['title' => 'State Management', 'description' => 'Belajar mengelola state aplikasi dengan Provider'],
                ['title' => 'Navigation dan Routing', 'description' => 'Mengatur navigasi antar halaman dalam aplikasi'],
                ['title' => 'API Integration', 'description' => 'Menghubungkan aplikasi dengan API dan database'],
            ],
            'Mewarnai untuk Anak-anak (Usia 4-8 tahun)' => [
                ['title' => 'Pengenalan Warna', 'description' => 'Mengenal warna-warna dasar dan cara mencampurnya'],
                ['title' => 'Teknik Memegang Pensil', 'description' => 'Belajar cara memegang pensil warna yang benar'],
                ['title' => 'Mewarnai dalam Garis', 'description' => 'Melatih ketelitian mewarnai dalam batas garis'],
                ['title' => 'Gradasi Warna', 'description' => 'Mempelajari teknik gradasi dan pencampuran warna'],
                ['title' => 'Mewarnai Berbagai Objek', 'description' => 'Praktik mewarnai hewan, tumbuhan, dan benda'],
            ],
            'Watercolor Painting untuk Pemula' => [
                ['title' => 'Pengenalan Watercolor', 'description' => 'Memahami karakteristik cat air dan peralatannya'],
                ['title' => 'Teknik Dasar', 'description' => 'Mempelajari teknik wet-on-wet dan dry brush'],
                ['title' => 'Pencampuran Warna', 'description' => 'Belajar mencampur warna dan membuat palet'],
                ['title' => 'Melukis Landscape', 'description' => 'Praktik melukis pemandangan alam'],
                ['title' => 'Melukis Portrait', 'description' => 'Teknik melukis wajah dan figur manusia'],
            ],
            'Digital Art dan Mewarnai Digital' => [
                ['title' => 'Pengenalan Software Digital Art', 'description' => 'Mempelajari interface dan tools software digital art'],
                ['title' => 'Teknik Digital Painting', 'description' => 'Belajar teknik melukis digital dengan tablet'],
                ['title' => 'Layer dan Blending', 'description' => 'Memahami konsep layer dan mode blending'],
                ['title' => 'Brush Customization', 'description' => 'Membuat dan mengkustomisasi brush untuk kebutuhan'],
                ['title' => 'Proyek Artwork Lengkap', 'description' => 'Membuat artwork digital dari konsep hingga finishing'],
            ],
            'Public Speaking untuk Pemula' => [
                ['title' => 'Mengatasi Rasa Takut', 'description' => 'Teknik mengatasi nervous dan membangun kepercayaan diri'],
                ['title' => 'Teknik Pernapasan', 'description' => 'Mempelajari teknik pernapasan untuk suara yang jelas'],
                ['title' => 'Body Language', 'description' => 'Memahami pentingnya bahasa tubuh dalam presentasi'],
                ['title' => 'Voice Projection', 'description' => 'Belajar memproyeksikan suara dengan baik'],
                ['title' => 'Struktur Presentasi', 'description' => 'Menyusun presentasi yang efektif dan menarik'],
            ],
            'Presentasi Bisnis yang Menarik' => [
                ['title' => 'Struktur Presentasi Bisnis', 'description' => 'Menyusun presentasi yang profesional untuk bisnis'],
                ['title' => 'Visual Design', 'description' => 'Membuat slide yang menarik dan mudah dipahami'],
                ['title' => 'Storytelling dalam Bisnis', 'description' => 'Menggunakan storytelling untuk presentasi yang memukau'],
                ['title' => 'Handling Q&A', 'description' => 'Teknik menjawab pertanyaan dengan baik'],
                ['title' => 'Presentasi Online', 'description' => 'Tips presentasi melalui video conference'],
            ],
            'MC dan Hosting Event' => [
                ['title' => 'Teknik MC Profesional', 'description' => 'Mempelajari teknik menjadi MC yang profesional'],
                ['title' => 'Improvisasi dan Humor', 'description' => 'Belajar improvisasi dan menggunakan humor yang tepat'],
                ['title' => 'Mengatur Timing', 'description' => 'Mengatur waktu dan pacing acara dengan baik'],
                ['title' => 'Handling Technical Issues', 'description' => 'Mengatasi masalah teknis saat hosting'],
                ['title' => 'Networking dan Koneksi', 'description' => 'Membangun jaringan dan koneksi dalam industri'],
            ],
        ];

        return $topicsMap[$courseTitle] ?? [
            ['title' => 'Pengenalan Materi', 'description' => 'Pengenalan dasar materi kursus'],
            ['title' => 'Konsep Dasar', 'description' => 'Memahami konsep-konsep fundamental'],
            ['title' => 'Praktik dan Latihan', 'description' => 'Praktik langsung dan latihan'],
            ['title' => 'Aplikasi Lanjutan', 'description' => 'Menerapkan konsep dalam situasi nyata'],
            ['title' => 'Proyek Akhir', 'description' => 'Membuat proyek akhir sebagai bukti pembelajaran'],
        ];
    }
}