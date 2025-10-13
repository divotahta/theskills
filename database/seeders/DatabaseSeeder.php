<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create student
        User::create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        $this->call([
            // 1. CategorySeeder - Kategori kursus
            CategorySeeder::class,
            
            // 2. CourseLevelSeeder - Level kursus
            CourseLevelSeeder::class,
            
            // 3. UserSeeder - Users (admin, students, instructors)
            UserSeeder::class,
            
            // 4. CourseSeeder - Kursus
            CourseSeeder::class,
            
            // 5. TopicSeeder - Topik untuk setiap kursus
            TopicSeeder::class,
            
            // 6. CourseContentSeeder - Konten untuk setiap topik
            CourseContentSeeder::class,
            
            // 7. EnrollmentSeeder - Enrollments
            EnrollmentSeeder::class,
            
            // 8. ContentProgressSeeder - Progress konten
            ContentProgressSeeder::class,
            
            // 9. ReviewSeeder - Reviews
            ReviewSeeder::class,
            
            // 10. PaymentSeeder - Payments
            PaymentSeeder::class,
            
            // 11. CertificateSeeder - Certificates
            CertificateSeeder::class,
            
            // 12. PaymentTestSeeder - Test payment data
            PaymentTestSeeder::class,
        ]);
    }
} 