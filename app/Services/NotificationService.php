<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send notification to user.
     */
    public static function send(User $user, string $type, string $title, string $message, array $data = []): Notification
    {
        try {
            $notification = $user->notifications()->create([
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
            ]);

            Log::info("Notification sent to user {$user->id}: {$type} - {$title}");

            return $notification;
        } catch (\Exception $e) {
            Log::error("Failed to send notification to user {$user->id}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send notification to multiple users.
     */
    public static function sendToMany(array $userIds, string $type, string $title, string $message, array $data = []): int
    {
        $notifications = [];
        $now = now();

        foreach ($userIds as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        try {
            $count = Notification::insert($notifications);
            Log::info("Bulk notification sent to " . count($userIds) . " users: {$type} - {$title}");
            return $count;
        } catch (\Exception $e) {
            Log::error("Failed to send bulk notification: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send course enrollment notification.
     */
    public static function courseEnrolled(User $user, $course): Notification
    {
        return self::send(
            $user,
            'course_enrolled',
            'Berhasil Mendaftar Kursus!',
            "Selamat! Anda telah berhasil mendaftar ke kursus \"{$course->title}\". Silakan mulai belajar sekarang!",
            [
                'course_id' => $course->id,
                'course_title' => $course->title,
                'course_thumbnail' => $course->thumbnail,
            ]
        );
    }

    /**
     * Send course completion notification.
     */
    public static function courseCompleted(User $user, $course): Notification
    {
        return self::send(
            $user,
            'course_completed',
            'Kursus Selesai!',
            "Selamat! Anda telah menyelesaikan kursus \"{$course->title}\". Sertifikat telah tersedia!",
            [
                'course_id' => $course->id,
                'course_title' => $course->title,
                'course_thumbnail' => $course->thumbnail,
            ]
        );
    }

    /**
     * Send payment success notification.
     */
    public static function paymentSuccess(User $user, $payment): Notification
    {
        return self::send(
            $user,
            'payment_success',
            'Pembayaran Berhasil!',
            "Pembayaran sebesar Rp " . number_format($payment->amount, 0, ',', '.') . " telah berhasil diproses.",
            [
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'course_id' => $payment->course_id ?? null,
            ]
        );
    }

    /**
     * Send payment failed notification.
     */
    public static function paymentFailed(User $user, $payment): Notification
    {
        return self::send(
            $user,
            'payment_failed',
            'Pembayaran Gagal',
            "Pembayaran sebesar Rp " . number_format($payment->amount, 0, ',', '.') . " gagal diproses. Silakan coba lagi.",
            [
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'course_id' => $payment->course_id ?? null,
            ]
        );
    }

    /**
     * Send course updated notification.
     */
    public static function courseUpdated(User $user, $course): Notification
    {
        return self::send(
            $user,
            'course_updated',
            'Kursus Diperbarui',
            "Kursus \"{$course->title}\" telah diperbarui dengan konten baru. Silakan periksa!",
            [
                'course_id' => $course->id,
                'course_title' => $course->title,
                'course_thumbnail' => $course->thumbnail,
            ]
        );
    }

    /**
     * Send announcement notification.
     */
    public static function announcement(User $user, string $title, string $message, array $data = []): Notification
    {
        return self::send(
            $user,
            'announcement',
            $title,
            $message,
            $data
        );
    }

    /**
     * Send reminder notification.
     */
    public static function reminder(User $user, string $title, string $message, array $data = []): Notification
    {
        return self::send(
            $user,
            'reminder',
            $title,
            $message,
            $data
        );
    }

    /**
     * Send bulk announcement to all students.
     */
    public static function sendAnnouncementToAllStudents(string $title, string $message, array $data = []): int
    {
        $studentIds = User::where('role', 'student')->pluck('id')->toArray();
        
        return self::sendToMany(
            $studentIds,
            'announcement',
            $title,
            $message,
            $data
        );
    }

    /**
     * Send course reminder to enrolled students.
     */
    public static function sendCourseReminderToStudents($course, string $message): int
    {
        $studentIds = $course->enrollments()
            ->where('status', 'active')
            ->pluck('user_id')
            ->toArray();
        
        return self::sendToMany(
            $studentIds,
            'reminder',
            "Pengingat: {$course->title}",
            $message,
            [
                'course_id' => $course->id,
                'course_title' => $course->title,
                'course_thumbnail' => $course->thumbnail,
            ]
        );
    }
}
