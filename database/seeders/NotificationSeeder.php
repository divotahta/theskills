<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Course;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some students and courses for sample data
        $students = User::where('role', 'student')->take(5)->get();
        $courses = Course::take(3)->get();

        if ($students->isEmpty() || $courses->isEmpty()) {
            $this->command->warn('No students or courses found. Please run UserSeeder and CourseSeeder first.');
            return;
        }

        $notifications = [];

        foreach ($students as $student) {
            // Course enrollment notifications
            foreach ($courses->take(2) as $course) {
                $notifications[] = [
                    'user_id' => $student->id,
                    'type' => 'course_enrolled',
                    'title' => 'Berhasil Mendaftar Kursus!',
                    'message' => "Selamat! Anda telah berhasil mendaftar ke kursus \"{$course->title}\". Silakan mulai belajar sekarang!",
                    'data' => [
                        'course_id' => $course->id,
                        'course_title' => $course->title,
                        'course_thumbnail' => $course->thumbnail,
                    ],
                    'is_read' => rand(0, 1),
                    'read_at' => rand(0, 1) ? now()->subDays(rand(1, 7)) : null,
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30)),
                ];
            }

            // Course completion notifications
            if ($courses->count() > 0) {
                $completedCourse = $courses->first();
                $notifications[] = [
                    'user_id' => $student->id,
                    'type' => 'course_completed',
                    'title' => 'Kursus Selesai!',
                    'message' => "Selamat! Anda telah menyelesaikan kursus \"{$completedCourse->title}\". Sertifikat telah tersedia!",
                    'data' => [
                        'course_id' => $completedCourse->id,
                        'course_title' => $completedCourse->title,
                        'course_thumbnail' => $completedCourse->thumbnail,
                    ],
                    'is_read' => rand(0, 1),
                    'read_at' => rand(0, 1) ? now()->subDays(rand(1, 3)) : null,
                    'created_at' => now()->subDays(rand(1, 15)),
                    'updated_at' => now()->subDays(rand(1, 15)),
                ];
            }

            // Payment success notifications
            $notifications[] = [
                'user_id' => $student->id,
                'type' => 'payment_success',
                'title' => 'Pembayaran Berhasil!',
                'message' => 'Pembayaran sebesar Rp 299.000 telah berhasil diproses.',
                'data' => [
                    'payment_id' => rand(1000, 9999),
                    'amount' => 299000,
                    'course_id' => $courses->first()->id ?? null,
                ],
                'is_read' => rand(0, 1),
                'read_at' => rand(0, 1) ? now()->subDays(rand(1, 5)) : null,
                'created_at' => now()->subDays(rand(1, 20)),
                'updated_at' => now()->subDays(rand(1, 20)),
            ];

            // Course updated notifications
            if ($courses->count() > 1) {
                $updatedCourse = $courses->skip(1)->first();
                $notifications[] = [
                    'user_id' => $student->id,
                    'type' => 'course_updated',
                    'title' => 'Kursus Diperbarui',
                    'message' => "Kursus \"{$updatedCourse->title}\" telah diperbarui dengan konten baru. Silakan periksa!",
                    'data' => [
                        'course_id' => $updatedCourse->id,
                        'course_title' => $updatedCourse->title,
                        'course_thumbnail' => $updatedCourse->thumbnail,
                    ],
                    'is_read' => rand(0, 1),
                    'read_at' => rand(0, 1) ? now()->subDays(rand(1, 2)) : null,
                    'created_at' => now()->subDays(rand(1, 10)),
                    'updated_at' => now()->subDays(rand(1, 10)),
                ];
            }

            // Announcement notifications
            $notifications[] = [
                'user_id' => $student->id,
                'type' => 'announcement',
                'title' => 'Pembaruan Platform TheSkills',
                'message' => 'Kami telah meluncurkan fitur baru! Sekarang Anda dapat mengakses kursus dari perangkat mobile dengan lebih mudah.',
                'data' => [
                    'announcement_id' => rand(100, 999),
                    'feature' => 'Mobile Access',
                ],
                'is_read' => rand(0, 1),
                'read_at' => rand(0, 1) ? now()->subDays(rand(1, 3)) : null,
                'created_at' => now()->subDays(rand(1, 7)),
                'updated_at' => now()->subDays(rand(1, 7)),
            ];

            // Reminder notifications
            $notifications[] = [
                'user_id' => $student->id,
                'type' => 'reminder',
                'title' => 'Pengingat Belajar',
                'message' => 'Jangan lupa untuk melanjutkan pembelajaran Anda! Ada konten baru yang menunggu untuk dipelajari.',
                'data' => [
                    'reminder_type' => 'study_reminder',
                    'course_id' => $courses->first()->id ?? null,
                ],
                'is_read' => rand(0, 1),
                'read_at' => rand(0, 1) ? now()->subHours(rand(1, 12)) : null,
                'created_at' => now()->subHours(rand(1, 24)),
                'updated_at' => now()->subHours(rand(1, 24)),
            ];
        }

        // Insert notifications one by one to handle JSON data properly
        foreach ($notifications as $notificationData) {
            Notification::create($notificationData);
        }

        $this->command->info('Sample notifications created successfully!');
    }
}