<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = [
            [
                'name' => 'Prof. Dr. Sari Matematika',
                'email' => 'sari.matematika@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Profesor Matematika dengan 15+ tahun pengalaman mengajar. Spesialisasi dalam aljabar, kalkulus, dan geometri. Memiliki passion untuk membuat matematika mudah dipahami oleh semua kalangan.',
                'skill' => 'Matematika, Aljabar, Kalkulus, Geometri, Statistika, Trigonometri',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Budi Koder',
                'email' => 'budi.koder@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Software Engineer dan Coding Instructor dengan 10+ tahun pengalaman. Expert dalam Python, JavaScript, dan Java. Memiliki metode mengajar yang interaktif dan mudah dipahami pemula.',
                'skill' => 'Python, JavaScript, Java, C++, Web Development, Mobile Development',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maya Seni',
                'email' => 'maya.seni@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Artis dan Seniman profesional dengan 12+ tahun pengalaman. Spesialisasi dalam teknik mewarnai, menggambar, dan seni kreatif. Memiliki studio seni sendiri dan sering mengadakan workshop.',
                'skill' => 'Mewarnai, Menggambar, Watercolor, Digital Art, Craft, Seni Kreatif',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rizki Orator',
                'email' => 'rizki.orator@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Public Speaking Coach dan Motivator dengan 8+ tahun pengalaman. Pernah menjadi MC di berbagai event besar dan melatih ratusan profesional untuk meningkatkan kemampuan komunikasi mereka.',
                'skill' => 'Public Speaking, Presentasi, Komunikasi, Leadership, Motivasi, MC',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Senior Full-Stack Developer dengan 8+ tahun pengalaman dalam pengembangan web menggunakan Laravel, React, dan Node.js. Spesialisasi dalam arsitektur aplikasi dan best practices.',
                'skill' => 'Laravel, PHP, React.js, Node.js, Database Design',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sarah Wijaya',
                'email' => 'sarah.wijaya@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'UI/UX Designer dan Frontend Developer dengan passion untuk menciptakan pengalaman pengguna yang luar biasa. Expert dalam Figma, Adobe XD, dan React.',
                'skill' => 'UI/UX Design, Figma, Adobe XD, React.js, CSS, Design Systems',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Data Scientist dan Machine Learning Engineer dengan pengalaman 7+ tahun dalam analisis data dan pengembangan model AI. Spesialisasi dalam Python, TensorFlow, dan cloud computing.',
                'skill' => 'Python, Machine Learning, Data Science, TensorFlow, AWS, SQL',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maya Putri',
                'email' => 'maya.putri@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Mobile App Developer expert dengan fokus pada Flutter dan React Native. Memiliki pengalaman 5+ tahun dalam pengembangan aplikasi cross-platform dan native.',
                'skill' => 'Flutter, React Native, Dart, JavaScript, Mobile App Development',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki.pratama@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Cybersecurity Expert dan Ethical Hacker dengan sertifikasi internasional. Spesialisasi dalam penetration testing, network security, dan security auditing.',
                'skill' => 'Cybersecurity, Ethical Hacking, Penetration Testing, Network Security, Linux',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dewi Sari',
                'email' => 'dewi.sari@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Digital Marketing Specialist dan Growth Hacker dengan track record meningkatkan traffic dan konversi hingga 300%. Expert dalam SEO, SEM, dan social media marketing.',
                'skill' => 'Digital Marketing, SEO, Google Ads, Facebook Ads, Content Marketing, Analytics',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Andi Kurniawan',
                'email' => 'andi.kurniawan@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'DevOps Engineer dan Cloud Architect dengan pengalaman 8+ tahun dalam automation, containerization, dan cloud infrastructure. Expert dalam AWS, Docker, dan Kubernetes.',
                'skill' => 'DevOps, AWS, Docker, Kubernetes, CI/CD, Infrastructure as Code, Linux',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Lisa Hartati',
                'email' => 'lisa.hartati@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'bio' => 'Business Analyst dan Product Manager dengan pengalaman 7+ tahun dalam mengelola produk digital dan strategi bisnis. Spesialisasi dalam agile methodology dan user research.',
                'skill' => 'Product Management, Business Analysis, Agile, User Research, Strategy, Analytics',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($instructors as $instructorData) {
            User::create($instructorData);
        }

        $this->command->info('InstructorSeeder berhasil dijalankan! ' . count($instructors) . ' instructor telah dibuat.');
    }
}
