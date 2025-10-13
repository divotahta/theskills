<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Course;

class InstructorNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get instructor users
        $instructors = User::where('role', 'instructor')->get();
        
        if ($instructors->isEmpty()) {
            $this->command->warn('No instructor users found. Please create instructor users first.');
            return;
        }

        // Get some courses for context
        $courses = Course::with('instructor')->get();
        
        if ($courses->isEmpty()) {
            $this->command->warn('No courses found. Please create courses first.');
            return;
        }

        $notifications = [];

        foreach ($instructors as $instructor) {
            // Get courses for this instructor
            $instructorCourses = $courses->where('instructor_id', $instructor->id);
            
            if ($instructorCourses->isEmpty()) {
                continue;
            }

            // Create various types of notifications for each instructor
            $sampleNotifications = [
                [
                    'type' => 'student_enrolled',
                    'title' => 'Student Baru Mendaftar',
                    'message' => 'Ahmad Rizki telah mendaftar di kursus "Matematika Dasar"',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'student_id' => 1,
                        'course_title' => $instructorCourses->first()->title,
                        'student_name' => 'Ahmad Rizki'
                    ]
                ],
                [
                    'type' => 'student_completed',
                    'title' => 'Student Menyelesaikan Kursus',
                    'message' => 'Siti Nurhaliza telah menyelesaikan kursus "Fisika Lanjutan"',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'student_id' => 2,
                        'course_title' => 'Fisika Lanjutan',
                        'student_name' => 'Siti Nurhaliza'
                    ]
                ],
                [
                    'type' => 'new_review',
                    'title' => 'Review Baru Diterima',
                    'message' => 'Budi Santoso memberikan review 5 bintang untuk kursus "Kimia Organik"',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'review_id' => 1,
                        'course_title' => 'Kimia Organik',
                        'student_name' => 'Budi Santoso',
                        'rating' => 5
                    ]
                ],
                [
                    'type' => 'payment_received',
                    'title' => 'Pembayaran Diterima',
                    'message' => 'Pembayaran Rp 150.000 diterima untuk kursus "Matematika Dasar" dari Dewi Kartika',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'payment_id' => 1,
                        'course_title' => 'Matematika Dasar',
                        'student_name' => 'Dewi Kartika',
                        'amount' => 150000
                    ]
                ],
                [
                    'type' => 'course_approved',
                    'title' => 'Kursus Disetujui',
                    'message' => 'Kursus "Biologi Sel" telah disetujui dan dapat diakses oleh student',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'course_title' => 'Biologi Sel'
                    ]
                ],
                [
                    'type' => 'student_question',
                    'title' => 'Pertanyaan Student',
                    'message' => 'Rina Sari mengajukan pertanyaan di kursus "Matematika Dasar": Bagaimana cara menyelesaikan persamaan kuadrat?',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'question_id' => 1,
                        'course_title' => 'Matematika Dasar',
                        'student_name' => 'Rina Sari',
                        'question' => 'Bagaimana cara menyelesaikan persamaan kuadrat?'
                    ]
                ],
                [
                    'type' => 'content_updated',
                    'title' => 'Konten Kursus Diperbarui',
                    'message' => 'Konten video di kursus "Fisika Dasar" telah diperbarui',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'course_title' => 'Fisika Dasar',
                        'content_type' => 'video'
                    ]
                ],
                [
                    'type' => 'system_announcement',
                    'title' => 'Pembaruan Sistem',
                    'message' => 'Sistem TheSkills telah diperbarui dengan fitur-fitur baru. Silakan cek dashboard untuk informasi lebih lanjut.',
                    'data' => [
                        'announcement_type' => 'system_update',
                        'version' => '2.1.0'
                    ]
                ],
                [
                    'type' => 'reminder',
                    'title' => 'Pengingat Jadwal',
                    'message' => 'Jangan lupa untuk mempersiapkan materi untuk kelas "Matematika Dasar" besok pukul 09:00',
                    'data' => [
                        'course_id' => $instructorCourses->first()->id,
                        'course_title' => 'Matematika Dasar',
                        'reminder_type' => 'class_schedule',
                        'scheduled_time' => '09:00'
                    ]
                ]
            ];

            // Create notifications for this instructor
            foreach ($sampleNotifications as $notificationData) {
                $notifications[] = [
                    'user_id' => $instructor->id,
                    'type' => $notificationData['type'],
                    'title' => $notificationData['title'],
                    'message' => $notificationData['message'],
                    'data' => $notificationData['data'],
                    'is_read' => rand(0, 1) == 1, // Random read status
                    'read_at' => rand(0, 1) == 1 ? now()->subDays(rand(1, 7)) : null,
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30))
                ];
            }
        }

        // Insert notifications one by one to handle JSON data properly
        foreach ($notifications as $notificationData) {
            Notification::create($notificationData);
        }

        $this->command->info('Instructor notifications seeded successfully!');
        $this->command->info('Total notifications created: ' . count($notifications));
    }
}