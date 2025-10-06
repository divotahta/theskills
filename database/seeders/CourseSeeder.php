<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kategori dan instructor
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();

        if ($categories->isEmpty()) {
            $this->command->warn('Tidak ada kategori yang ditemukan. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        if ($instructors->isEmpty()) {
            $this->command->warn('Tidak ada instructor yang ditemukan. Buat instructor terlebih dahulu.');
            return;
        }

        $courses = [
            // Web Development
            [
                'title' => 'Laravel Framework: Dari Pemula hingga Mahir',
                'description' => 'Pelajari Laravel framework PHP yang powerful untuk membangun aplikasi web modern. Kursus ini akan membawa Anda dari dasar hingga level advanced dengan proyek-proyek nyata.',
                'category' => 'Web Development',
                'price' => 299000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
                'max_students' => 50,
                'is_public' => true,
            ],
            [
                'title' => 'React.js: Membangun Aplikasi Web Interaktif',
                'description' => 'Kuasai React.js untuk membangun user interface yang dinamis dan responsif. Pelajari hooks, state management, dan best practices dalam pengembangan frontend.',
                'category' => 'Web Development',
                'price' => 249000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=w7ejDZ8SWv8',
                'max_students' => 40,
                'is_public' => true,
            ],
            [
                'title' => 'Full-Stack Development dengan Node.js',
                'description' => 'Pelajari pengembangan full-stack menggunakan Node.js, Express, dan MongoDB. Bangun aplikasi web lengkap dari frontend hingga backend.',
                'category' => 'Web Development',
                'price' => 399000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=Oe421EPjeBE',
                'max_students' => 30,
                'is_public' => true,
            ],

            // Mobile Development
            [
                'title' => 'Flutter: Pengembangan Aplikasi Mobile Cross-Platform',
                'description' => 'Pelajari Flutter untuk membangun aplikasi mobile yang berjalan di Android dan iOS dengan satu codebase. Dari dasar hingga deployment.',
                'category' => 'Mobile Development',
                'price' => 349000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=1ukSR1GRtMU',
                'max_students' => 35,
                'is_public' => true,
            ],
            [
                'title' => 'React Native: Aplikasi Mobile dengan JavaScript',
                'description' => 'Bangun aplikasi mobile native menggunakan React Native. Pelajari navigasi, state management, dan integrasi dengan API.',
                'category' => 'Mobile Development',
                'price' => 279000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=0-S5a0eXPoc',
                'max_students' => 25,
                'is_public' => true,
            ],

            // Data Science
            [
                'title' => 'Python untuk Data Science dan Machine Learning',
                'description' => 'Pelajari Python untuk analisis data, visualisasi, dan machine learning. Gunakan pandas, numpy, matplotlib, dan scikit-learn.',
                'category' => 'Data Science',
                'price' => 449000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=vmEHCJofslg',
                'max_students' => 20,
                'is_public' => true,
            ],
            [
                'title' => 'SQL dan Database Management',
                'description' => 'Kuasai SQL untuk mengelola database dengan efisien. Pelajari query optimization, indexing, dan database design.',
                'category' => 'Data Science',
                'price' => 199000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=HXV3zeQKqGY',
                'max_students' => 45,
                'is_public' => true,
            ],

            // Cybersecurity
            [
                'title' => 'Ethical Hacking dan Penetration Testing',
                'description' => 'Pelajari ethical hacking untuk mengidentifikasi dan memperbaiki kerentanan keamanan. Kursus ini mencakup tools dan teknik penetration testing.',
                'category' => 'Cybersecurity',
                'price' => 599000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=3Kq1MIfTWCE',
                'max_students' => 15,
                'is_public' => false, // Kursus premium
            ],
            [
                'title' => 'Network Security Fundamentals',
                'description' => 'Pelajari dasar-dasar keamanan jaringan, firewall, VPN, dan monitoring. Essential untuk IT security professional.',
                'category' => 'Cybersecurity',
                'price' => 329000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=qiQR5rTSshw',
                'max_students' => 30,
                'is_public' => true,
            ],

            // Cloud Computing
            [
                'title' => 'AWS Cloud Practitioner Certification',
                'description' => 'Persiapkan diri untuk AWS Cloud Practitioner certification. Pelajari layanan AWS, pricing, dan best practices.',
                'category' => 'Cloud Computing',
                'price' => 499000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=3hLmDS179YE',
                'max_students' => 25,
                'is_public' => true,
            ],
            [
                'title' => 'Docker dan Kubernetes untuk DevOps',
                'description' => 'Pelajari containerization dengan Docker dan orchestration dengan Kubernetes. Essential untuk modern DevOps practices.',
                'category' => 'Cloud Computing',
                'price' => 379000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=pTFZFxd4hOI',
                'max_students' => 20,
                'is_public' => true,
            ],

            // UI/UX Design
            [
                'title' => 'UI/UX Design dengan Figma',
                'description' => 'Pelajari desain user interface dan user experience menggunakan Figma. Dari wireframe hingga prototype interaktif.',
                'category' => 'UI/UX Design',
                'price' => 229000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=FTqDQYZy6IY',
                'max_students' => 40,
                'is_public' => true,
            ],
            [
                'title' => 'Adobe XD untuk Prototyping',
                'description' => 'Kuasai Adobe XD untuk membuat prototype aplikasi mobile dan web yang interaktif. Pelajari design system dan collaboration.',
                'category' => 'UI/UX Design',
                'price' => 199000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=68w2VwalD5w',
                'max_students' => 35,
                'is_public' => true,
            ],

            // Digital Marketing
            [
                'title' => 'Google Ads dan Facebook Ads Mastery',
                'description' => 'Pelajari strategi iklan digital yang efektif di Google Ads dan Facebook Ads. Optimasi budget dan ROI untuk kampanye yang sukses.',
                'category' => 'Digital Marketing',
                'price' => 279000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=7vXjJ8lqgJk',
                'max_students' => 50,
                'is_public' => true,
            ],
            [
                'title' => 'SEO dan Content Marketing',
                'description' => 'Kuasai Search Engine Optimization dan content marketing untuk meningkatkan traffic organik website Anda.',
                'category' => 'Digital Marketing',
                'price' => 199000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=xsVTqzratPs',
                'max_students' => 60,
                'is_public' => true,
            ],

            // Business & Entrepreneurship
            [
                'title' => 'Startup dan Entrepreneurship',
                'description' => 'Pelajari cara membangun startup dari ide hingga scaling. Business model, funding, dan growth strategies.',
                'category' => 'Business & Entrepreneurship',
                'price' => 399000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=8b2mTq0XzUY',
                'max_students' => 30,
                'is_public' => true,
            ],
            [
                'title' => 'Digital Business Strategy',
                'description' => 'Pelajari strategi bisnis digital untuk transformasi perusahaan. E-commerce, digital transformation, dan innovation.',
                'category' => 'Business & Entrepreneurship',
                'price' => 329000,
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=9No-FiEInLA',
                'max_students' => 25,
                'is_public' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            // Cari kategori berdasarkan nama
            $category = $categories->where('name', $courseData['category'])->first();
            
            if (!$category) {
                $this->command->warn("Kategori '{$courseData['category']}' tidak ditemukan, menggunakan kategori pertama.");
                $category = $categories->first();
            }

            // Pilih instructor secara random
            $instructor = $instructors->random();

            Course::create([
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'instructor_id' => $instructor->id,
                'category_id' => $category->id,
                'price' => $courseData['price'],
                'video_type' => $courseData['video_type'],
                'video_url' => $courseData['video_url'],
                'max_students' => $courseData['max_students'],
                'is_public' => $courseData['is_public'],
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