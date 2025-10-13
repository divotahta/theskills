<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin TheSkills',
            'email' => 'admin@theskills.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'bio' => 'Administrator platform TheSkills',
            'skill' => 'Management, Administration, System Administration',
        ]);

        // Student Users
        $students = [
            [
                'name' => 'Ahmad Student',
                'email' => 'ahmad@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'bio' => 'Mahasiswa yang antusias belajar berbagai keterampilan',
                'skill' => 'Learning, Problem Solving, Communication',
            ],
            [
                'name' => 'Sari Student',
                'email' => 'sari@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'bio' => 'Pelajar yang suka matematika dan seni',
                'skill' => 'Mathematics, Art, Creative Thinking',
            ],
            [
                'name' => 'Budi Student',
                'email' => 'budi@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'bio' => 'Mahasiswa teknik yang ingin belajar programming',
                'skill' => 'Engineering, Programming, Analysis',
            ],
            [
                'name' => 'Maya Student',
                'email' => 'maya@student.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'bio' => 'Pelajar yang tertarik dengan public speaking',
                'skill' => 'Communication, Leadership, Presentation',
            ],
        ];

        foreach ($students as $student) {
            User::create($student);
        }

        // Instructor Users
        $instructors = [
            [
                'name' => 'Prof. Dr. Sari Matematika',
                'email' => 'sari.matematika@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
                'bio' => 'Profesor Matematika dengan 15+ tahun pengalaman mengajar. Spesialisasi dalam aljabar, kalkulus, dan geometri.',
                'skill' => 'Matematika, Aljabar, Kalkulus, Geometri, Statistika, Trigonometri',
            ],
            [
                'name' => 'Budi Koder',
                'email' => 'budi.koder@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
                'bio' => 'Software Engineer dan Coding Instructor dengan 10+ tahun pengalaman. Expert dalam Python, JavaScript, dan Java.',
                'skill' => 'Python, JavaScript, Java, C++, Web Development, Mobile Development',
            ],
            [
                'name' => 'Maya Seni',
                'email' => 'maya.seni@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
                'bio' => 'Artis dan Seniman profesional dengan 12+ tahun pengalaman. Spesialisasi dalam teknik mewarnai, menggambar, dan seni kreatif.',
                'skill' => 'Mewarnai, Menggambar, Watercolor, Digital Art, Craft, Seni Kreatif',
            ],
            [
                'name' => 'Rizki Orator',
                'email' => 'rizki.orator@theskills.com',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
                'bio' => 'Public Speaking Coach dan Motivator dengan 8+ tahun pengalaman. Pernah menjadi MC di berbagai event besar.',
                'skill' => 'Public Speaking, Presentasi, Komunikasi, Leadership, Motivasi, MC',
            ],
        ];

        foreach ($instructors as $instructor) {
            User::create($instructor);
        }

        $this->command->info('UserSeeder berhasil dijalankan!');
    }
}
