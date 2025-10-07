<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ChildFriendlyCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $codingCategory = Category::where('slug', 'coding-programming')->first();
        $mathCategory = Category::where('slug', 'matematika-seru')->first();
        $scienceCategory = Category::where('slug', 'eksperimen-sains')->first();
        $speakingCategory = Category::where('slug', 'public-speaking')->first();
        $artCategory = Category::where('slug', 'seni-kreativitas')->first();
        $englishCategory = Category::where('slug', 'bahasa-inggris')->first();
        $musicCategory = Category::where('slug', 'musik-tari')->first();
        $sportsCategory = Category::where('slug', 'olahraga-kebugaran')->first();

        // Get instructors
        $instructors = User::where('role', 'instructor')->take(5)->get();
        if ($instructors->isEmpty()) {
            // Create sample instructors if none exist
            $instructors = collect([
                User::create([
                    'name' => 'Bu Sarah',
                    'email' => 'sarah@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => 'Guru coding yang ramah dan sabar'
                ]),
                User::create([
                    'name' => 'Pak Budi',
                    'email' => 'budi@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => 'Ahli matematika dengan metode yang menyenangkan'
                ]),
                User::create([
                    'name' => 'Bu Lisa',
                    'email' => 'lisa@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => 'Guru sains yang kreatif dan inovatif'
                ]),
                User::create([
                    'name' => 'Pak Andi',
                    'email' => 'andi@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => 'Pelatih public speaking untuk anak-anak'
                ]),
                User::create([
                    'name' => 'Bu Maya',
                    'email' => 'maya@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'instructor',
                    'bio' => 'Seniman dan guru seni yang inspiratif'
                ])
            ]);
        }

        $courses = [
            // Coding & Programming
            [
                'title' => 'Belajar Scratch untuk Pemula',
                'description' => 'Kursus coding pertama yang menyenangkan menggunakan Scratch! Anak-anak akan belajar membuat game dan animasi sederhana sambil memahami konsep dasar pemrograman.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $codingCategory->id,
                'price' => 150000,
                'max_students' => 20,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/scratch-course.jpg',
                'duration' => 8,
                'level' => 'beginner',
                'age_group' => '6-12',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada, cocok untuk pemula',
                'what_you_will_learn' => 'Dasar-dasar pemrograman, membuat game sederhana, animasi, dan proyek kreatif',
                'course_includes' => 'Video tutorial, proyek praktis, sertifikat, akses seumur hidup',
                'is_published' => true,
            ],
            [
                'title' => 'Membuat Website Pertamaku',
                'description' => 'Belajar membuat website sederhana dengan HTML dan CSS. Anak-anak akan membuat website pribadi mereka sendiri dengan desain yang menarik!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $codingCategory->id,
                'price' => 200000,
                'max_students' => 15,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/web-course.jpg',
                'duration' => 12,
                'level' => 'intermediate',
                'age_group' => '8-14',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Dasar-dasar komputer',
                'what_you_will_learn' => 'HTML, CSS, desain web, hosting website',
                'course_includes' => 'Template website, hosting gratis, sertifikat',
                'is_published' => true,
            ],

            // Matematika
            [
                'title' => 'Matematika dengan Permainan',
                'description' => 'Belajar matematika dasar melalui permainan yang menyenangkan! Penjumlahan, pengurangan, perkalian, dan pembagian menjadi lebih mudah dipahami.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $mathCategory->id,
                'price' => 100000,
                'max_students' => 25,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/math-game-course.jpg',
                'duration' => 6,
                'level' => 'beginner',
                'age_group' => '5-10',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Operasi dasar matematika, logika, pemecahan masalah',
                'course_includes' => 'Permainan interaktif, worksheet, sertifikat',
                'is_published' => true,
            ],
            [
                'title' => 'Geometri Kreatif',
                'description' => 'Mengenal bentuk-bentuk geometri melalui seni dan kerajinan tangan. Anak-anak akan belajar sambil membuat karya seni yang indah!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $mathCategory->id,
                'price' => 120000,
                'max_students' => 20,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/geometry-course.jpg',
                'duration' => 8,
                'level' => 'beginner',
                'age_group' => '6-12',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Dasar-dasar matematika',
                'what_you_will_learn' => 'Bentuk geometri, pengukuran, kerajinan tangan',
                'course_includes' => 'Bahan kerajinan, template, sertifikat',
                'is_published' => true,
            ],

            // Eksperimen Sains
            [
                'title' => 'Eksperimen Kimia Sederhana',
                'description' => 'Melakukan eksperimen kimia yang aman dan menyenangkan di rumah! Anak-anak akan belajar sains sambil bermain dengan bahan-bahan yang aman.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $scienceCategory->id,
                'price' => 180000,
                'max_students' => 15,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/chemistry-course.jpg',
                'duration' => 10,
                'level' => 'beginner',
                'age_group' => '7-12',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Pengawasan orang tua',
                'what_you_will_learn' => 'Dasar-dasar kimia, eksperimen aman, metode ilmiah',
                'course_includes' => 'Kit eksperimen, panduan keamanan, sertifikat',
                'is_published' => true,
            ],
            [
                'title' => 'Astronomi untuk Anak',
                'description' => 'Mengenal planet, bintang, dan galaksi dengan cara yang menarik! Anak-anak akan belajar tentang alam semesta melalui cerita dan aktivitas kreatif.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $scienceCategory->id,
                'price' => 160000,
                'max_students' => 20,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/astronomy-course.jpg',
                'duration' => 8,
                'level' => 'beginner',
                'age_group' => '6-14',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Sistem tata surya, bintang, galaksi, observasi',
                'course_includes' => 'Teleskop mini, peta bintang, sertifikat',
                'is_published' => true,
            ],

            // Public Speaking
            [
                'title' => 'Berbicara di Depan Umum dengan Percaya Diri',
                'description' => 'Mengembangkan kepercayaan diri dan kemampuan berbicara di depan umum. Anak-anak akan belajar teknik-teknik presentasi yang menyenangkan!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $speakingCategory->id,
                'price' => 140000,
                'max_students' => 12,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/public-speaking-course.jpg',
                'duration' => 6,
                'level' => 'beginner',
                'age_group' => '8-16',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Kepercayaan diri, teknik presentasi, komunikasi',
                'course_includes' => 'Praktik presentasi, feedback, sertifikat',
                'is_published' => true,
            ],

            // Seni & Kreativitas
            [
                'title' => 'Menggambar dan Melukis untuk Pemula',
                'description' => 'Mengembangkan bakat seni anak-anak melalui menggambar dan melukis. Belajar teknik dasar dengan media yang beragam!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $artCategory->id,
                'price' => 130000,
                'max_students' => 18,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/drawing-course.jpg',
                'duration' => 8,
                'level' => 'beginner',
                'age_group' => '5-12',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Teknik menggambar, melukis, warna, komposisi',
                'course_includes' => 'Peralatan seni, canvas, sertifikat',
                'is_published' => true,
            ],
            [
                'title' => 'Kerajinan Tangan Kreatif',
                'description' => 'Membuat berbagai kerajinan tangan yang unik dan menarik! Dari origami hingga clay, anak-anak akan menciptakan karya seni yang menakjubkan.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $artCategory->id,
                'price' => 110000,
                'max_students' => 15,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/craft-course.jpg',
                'duration' => 6,
                'level' => 'beginner',
                'age_group' => '6-14',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Origami, clay, paper craft, dekorasi',
                'course_includes' => 'Bahan kerajinan, template, sertifikat',
                'is_published' => true,
            ],

            // Bahasa Inggris
            [
                'title' => 'Bahasa Inggris dengan Lagu dan Cerita',
                'description' => 'Belajar bahasa Inggris dengan cara yang menyenangkan melalui lagu, cerita, dan permainan interaktif!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $englishCategory->id,
                'price' => 170000,
                'max_students' => 20,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/english-song-course.jpg',
                'duration' => 10,
                'level' => 'beginner',
                'age_group' => '4-10',
                'language' => 'Bahasa Indonesia & English',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Kosakata dasar, pronunciation, listening, speaking',
                'course_includes' => 'Lagu dan cerita, worksheet, sertifikat',
                'is_published' => true,
            ],

            // Musik & Tari
            [
                'title' => 'Belajar Piano untuk Pemula',
                'description' => 'Mengenal piano dan belajar memainkan lagu-lagu sederhana. Anak-anak akan mengembangkan bakat musik mereka dengan cara yang menyenangkan!',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $musicCategory->id,
                'price' => 250000,
                'max_students' => 8,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/piano-course.jpg',
                'duration' => 12,
                'level' => 'beginner',
                'age_group' => '6-14',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Akses ke piano/keyboard',
                'what_you_will_learn' => 'Notasi musik, teknik piano, lagu sederhana',
                'course_includes' => 'Notasi musik, video tutorial, sertifikat',
                'is_published' => true,
            ],

            // Olahraga & Kebugaran
            [
                'title' => 'Yoga untuk Anak',
                'description' => 'Belajar yoga dengan pose-pose yang mudah dan menyenangkan! Anak-anak akan belajar relaksasi dan fleksibilitas sambil bermain.',
                'instructor_id' => $instructors->random()->id,
                'category_id' => $sportsCategory->id,
                'price' => 120000,
                'max_students' => 15,
                'is_public' => true,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'course-thumbnails/kids-yoga-course.jpg',
                'duration' => 6,
                'level' => 'beginner',
                'age_group' => '5-12',
                'language' => 'Bahasa Indonesia',
                'prerequisites' => 'Tidak ada',
                'what_you_will_learn' => 'Pose yoga dasar, pernapasan, relaksasi',
                'course_includes' => 'Mat yoga, panduan pose, sertifikat',
                'is_published' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }
    }
}
