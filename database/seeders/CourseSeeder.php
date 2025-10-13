<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use App\Models\CourseLevel;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kategori, instructor, dan course levels
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();
        $courseLevels = CourseLevel::all();

        if ($categories->isEmpty()) {
            $this->command->warn('Tidak ada kategori yang ditemukan. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        if ($instructors->isEmpty()) {
            $this->command->warn('Tidak ada instructor yang ditemukan. Buat instructor terlebih dahulu.');
            return;
        }

        if ($courseLevels->isEmpty()) {
            $this->command->warn('Tidak ada course level yang ditemukan. Jalankan CourseLevelSeeder terlebih dahulu.');
            return;
        }

        $courses = [
            // Matematika
            [
                'title' => 'Matematika Dasar untuk Pemula',
                'description' => 'Kursus matematika dasar yang dirancang khusus untuk pemula. Pelajari konsep-konsep fundamental matematika dengan metode yang mudah dipahami dan menyenangkan.',
                'category' => 'Matematika',
                'course_level' => 'Pemula',
                'price' => 150000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'max_students' => 30,
                'is_public' => true,
                'duration' => 600, // 10 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Operasi dasar (tambah, kurang, kali, bagi), Pecahan, Desimal, Persentase, Geometri dasar, Aljabar sederhana',
                'course_includes' => '10+ jam video, Latihan soal, Kuis interaktif, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Kalkulus untuk SMA dan Perguruan Tinggi',
                'description' => 'Kursus kalkulus komprehensif yang mencakup limit, turunan, dan integral. Dirancang untuk siswa SMA dan mahasiswa yang ingin menguasai kalkulus.',
                'category' => 'Matematika',
                'course_level' => 'Lanjutan',
                'price' => 250000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'max_students' => 25,
                'is_public' => true,
                'duration' => 1200, // 20 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengetahuan aljabar dan trigonometri dasar',
                'what_you_will_learn' => 'Limit dan kontinuitas, Turunan dan aplikasinya, Integral dan aplikasinya, Fungsi trigonometri, Aplikasi kalkulus',
                'course_includes' => '20+ jam video, Soal latihan lengkap, Pembahasan step-by-step, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Statistika dan Probabilitas',
                'description' => 'Pelajari statistika dan probabilitas dari dasar hingga aplikasi praktis. Kursus ini sangat berguna untuk penelitian, bisnis, dan analisis data.',
                'category' => 'Matematika',
                'course_level' => 'Menengah',
                'price' => 200000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example3',
                'max_students' => 35,
                'is_public' => true,
                'duration' => 900, // 15 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Matematika dasar',
                'what_you_will_learn' => 'Distribusi data, Ukuran pemusatan dan penyebaran, Probabilitas dasar, Distribusi normal, Uji hipotesis, Regresi dan korelasi',
                'course_includes' => '15+ jam video, Dataset praktis, Analisis dengan Excel/SPSS, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Geometri dan Trigonometri',
                'description' => 'Kursus geometri dan trigonometri yang komprehensif. Pelajari konsep-konsep geometri dan trigonometri dengan aplikasi praktis dalam kehidupan sehari-hari.',
                'category' => 'Matematika',
                'course_level' => 'Menengah',
                'price' => 180000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example4',
                'max_students' => 30,
                'is_public' => true,
                'duration' => 750, // 12.5 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Matematika dasar',
                'what_you_will_learn' => 'Geometri bidang dan ruang, Teorema Pythagoras, Trigonometri dasar, Identitas trigonometri, Aplikasi geometri, Aplikasi trigonometri',
                'course_includes' => '12+ jam video, Latihan geometri, Kalkulator trigonometri, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],

            // Koding & Programming
            [
                'title' => 'Belajar Koding dari Nol - Python untuk Pemula',
                'description' => 'Kursus koding Python yang dirancang khusus untuk pemula. Pelajari dasar-dasar programming dengan Python yang mudah dipahami dan menyenangkan.',
                'category' => 'Koding & Programming',
                'course_level' => 'Pemula',
                'price' => 180000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example5',
                'max_students' => 40,
                'is_public' => true,
                'duration' => 1200, // 20 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Dasar-dasar Python, Variabel dan tipe data, Struktur kontrol, Fungsi, List dan dictionary, File handling, OOP dasar',
                'course_includes' => '20+ jam video, Kode sumber lengkap, Proyek praktis, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Web Development dengan HTML, CSS, dan JavaScript',
                'description' => 'Kursus lengkap web development untuk pemula. Pelajari HTML, CSS, dan JavaScript untuk membuat website yang menarik dan interaktif.',
                'category' => 'Koding & Programming',
                'course_level' => 'Pemula',
                'price' => 220000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example6',
                'max_students' => 35,
                'is_public' => true,
                'duration' => 1500, // 25 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'HTML5 dan struktur website, CSS3 dan styling, JavaScript dasar, Responsive design, DOM manipulation, Proyek website lengkap',
                'course_includes' => '25+ jam video, Template website, Proyek portfolio, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Mobile App Development dengan Flutter',
                'description' => 'Pelajari cara membuat aplikasi mobile dengan Flutter. Kursus ini akan membawa Anda dari dasar hingga membuat aplikasi mobile yang siap dipublikasikan.',
                'category' => 'Koding & Programming',
                'course_level' => 'Menengah',
                'price' => 300000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example7',
                'max_students' => 25,
                'is_public' => true,
                'duration' => 1800, // 30 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengetahuan dasar programming',
                'what_you_will_learn' => 'Dasar Flutter dan Dart, Widget dan layout, State management, Navigation, API integration, Database lokal, Publishing app',
                'course_includes' => '30+ jam video, 3 aplikasi lengkap, Source code, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Java Programming untuk Pemula',
                'description' => 'Kursus Java programming yang komprehensif untuk pemula. Pelajari konsep OOP, struktur data, dan pengembangan aplikasi dengan Java.',
                'category' => 'Koding & Programming',
                'course_level' => 'Pemula',
                'price' => 250000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example8',
                'max_students' => 30,
                'is_public' => true,
                'duration' => 1350, // 22.5 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Dasar Java, OOP concepts, Exception handling, Collections, File I/O, GUI programming, Database connectivity',
                'course_includes' => '22+ jam video, Proyek Java lengkap, IDE setup guide, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],

            // Mewarnai & Seni
            [
                'title' => 'Mewarnai untuk Anak-anak (Usia 4-8 tahun)',
                'description' => 'Kursus mewarnai yang dirancang khusus untuk anak-anak usia 4-8 tahun. Mengembangkan kreativitas dan motorik halus melalui aktivitas mewarnai yang menyenangkan.',
                'category' => 'Mewarnai & Seni',
                'course_level' => 'Pemula',
                'price' => 100000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example9',
                'max_students' => 20,
                'is_public' => true,
                'duration' => 300, // 5 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Teknik memegang pensil warna, Mengenal warna-warna dasar, Mewarnai dalam garis, Gradasi warna, Mewarnai berbagai objek',
                'course_includes' => '5+ jam video, Buku mewarnai digital, Panduan orang tua, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Watercolor Painting untuk Pemula',
                'description' => 'Pelajari teknik melukis dengan cat air (watercolor) dari dasar. Kursus ini cocok untuk pemula yang ingin mengembangkan kemampuan seni mereka.',
                'category' => 'Mewarnai & Seni',
                'course_level' => 'Pemula',
                'price' => 180000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example10',
                'max_students' => 15,
                'is_public' => true,
                'duration' => 900, // 15 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Teknik dasar watercolor, Pencampuran warna, Teknik wet-on-wet, Teknik dry brush, Melukis landscape, Melukis portrait',
                'course_includes' => '15+ jam video, Daftar peralatan, Template lukisan, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Digital Art dan Mewarnai Digital',
                'description' => 'Kursus seni digital menggunakan tablet dan software digital art. Pelajari teknik mewarnai dan menggambar digital yang modern dan kreatif.',
                'category' => 'Mewarnai & Seni',
                'course_level' => 'Menengah',
                'price' => 250000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example11',
                'max_students' => 20,
                'is_public' => true,
                'duration' => 1200, // 20 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengetahuan dasar komputer',
                'what_you_will_learn' => 'Pengenalan software digital art, Teknik digital painting, Layer dan blending, Brush customization, Color theory digital, Proyek artwork lengkap',
                'course_includes' => '20+ jam video, Software trial, Brush pack, Template digital, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Mewarnai Mandala untuk Relaksasi',
                'description' => 'Kursus mewarnai mandala yang dirancang untuk relaksasi dan meditasi. Pelajari teknik mewarnai mandala yang dapat mengurangi stres dan meningkatkan fokus.',
                'category' => 'Mewarnai & Seni',
                'course_level' => 'Pemula',
                'price' => 120000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example12',
                'max_students' => 25,
                'is_public' => true,
                'duration' => 450, // 7.5 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Teknik mewarnai mandala, Pemilihan warna yang harmonis, Teknik shading dan blending, Meditasi melalui mewarnai, Pattern recognition',
                'course_includes' => '7+ jam video, Koleksi mandala digital, Panduan relaksasi, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],

            // Public Speaking
            [
                'title' => 'Public Speaking untuk Pemula',
                'description' => 'Kursus public speaking yang dirancang untuk mengatasi rasa takut berbicara di depan umum. Pelajari teknik-teknik dasar untuk menjadi pembicara yang percaya diri.',
                'category' => 'Public Speaking',
                'course_level' => 'Pemula',
                'price' => 200000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example13',
                'max_students' => 30,
                'is_public' => true,
                'duration' => 900, // 15 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Tidak ada prasyarat khusus',
                'what_you_will_learn' => 'Mengatasi rasa takut, Teknik pernapasan, Body language, Voice projection, Struktur presentasi, Latihan praktis',
                'course_includes' => '15+ jam video, Latihan praktis, Feedback personal, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Presentasi Bisnis yang Menarik',
                'description' => 'Pelajari cara membuat presentasi bisnis yang profesional dan menarik. Kursus ini cocok untuk profesional yang ingin meningkatkan kemampuan presentasi mereka.',
                'category' => 'Public Speaking',
                'course_level' => 'Menengah',
                'price' => 250000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example14',
                'max_students' => 25,
                'is_public' => true,
                'duration' => 1200, // 20 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengalaman dasar public speaking',
                'what_you_will_learn' => 'Struktur presentasi bisnis, Visual design, Storytelling, Handling Q&A, Presentasi online, Pitching ideas',
                'course_includes' => '20+ jam video, Template presentasi, Case studies, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'MC dan Hosting Event',
                'description' => 'Kursus lengkap untuk menjadi MC dan host event yang profesional. Pelajari teknik-teknik hosting berbagai jenis acara dan event.',
                'category' => 'Public Speaking',
                'course_level' => 'Lanjutan',
                'price' => 300000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example15',
                'max_students' => 20,
                'is_public' => true,
                'duration' => 1500, // 25 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengalaman public speaking',
                'what_you_will_learn' => 'Teknik MC profesional, Improvisasi, Humor dan entertainment, Mengatur timing, Handling technical issues, Networking',
                'course_includes' => '25+ jam video, Script templates, Latihan MC, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Komunikasi Efektif dalam Tim',
                'description' => 'Pelajari teknik komunikasi yang efektif dalam lingkungan kerja dan tim. Kursus ini membantu meningkatkan kolaborasi dan produktivitas tim.',
                'category' => 'Public Speaking',
                'course_level' => 'Menengah',
                'price' => 220000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=example16',
                'max_students' => 25,
                'is_public' => true,
                'duration' => 1050, // 17.5 jam
                'language' => 'Indonesian',
                'prerequisites' => 'Pengalaman kerja dalam tim',
                'what_you_will_learn' => 'Active listening, Conflict resolution, Team communication, Meeting facilitation, Feedback techniques, Leadership communication',
                'course_includes' => '17+ jam video, Role play scenarios, Team exercises, Sertifikat, Akses seumur hidup',
                'is_published' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            // Cari kategori berdasarkan nama
            $category = $categories->where('name', $courseData['category'])->first();
            
            if (!$category) {
                $this->command->warn("Kategori '{$courseData['category']}' tidak ditemukan, menggunakan kategori pertama.");
                $category = $categories->first();
            }

            // Cari course level berdasarkan nama
            $courseLevel = $courseLevels->where('name', $courseData['course_level'])->first();
            
            if (!$courseLevel) {
                $this->command->warn("Course level '{$courseData['course_level']}' tidak ditemukan, menggunakan level pertama.");
                $courseLevel = $courseLevels->first();
            }

            // Pilih instructor secara random
            $instructor = $instructors->random();

            Course::create([
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'instructor_id' => $instructor->id,
                'category_id' => $category->id,
                'course_level_id' => $courseLevel->id,
                'price' => $courseData['price'],
                'video_type' => $courseData['video_type'],
                'video_url' => $courseData['video_url'],
                'max_students' => $courseData['max_students'],
                'is_public' => $courseData['is_public'],
                'duration' => $courseData['duration'],
                'language' => $courseData['language'],
                'prerequisites' => $courseData['prerequisites'],
                'what_you_will_learn' => $courseData['what_you_will_learn'],
                'course_includes' => $courseData['course_includes'],
                'is_published' => $courseData['is_published'],
                'thumbnail' => $this->generateThumbnailPath($courseData['title']),
            ]);
        }

        $this->command->info('CourseSeeder berhasil dijalankan!');
    }

    private function generateThumbnailPath($title)
    {
        // Generate nama file thumbnail berdasarkan title
        $slug = Str::slug($title);
        return "course-thumbnails/{$slug}-thumbnail.jpg";
    }
}