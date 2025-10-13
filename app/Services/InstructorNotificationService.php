<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class InstructorNotificationService
{
    /**
     * Send notification to instructor.
     */
    public function send($instructorId, $type, $title, $message, $data = [])
    {
        try {
            $notification = Notification::create([
                'user_id' => $instructorId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
            ]);

            Log::info('Instructor notification sent', [
                'instructor_id' => $instructorId,
                'type' => $type,
                'notification_id' => $notification->id
            ]);

            return $notification;
        } catch (\Exception $e) {
            Log::error('Failed to send instructor notification', [
                'instructor_id' => $instructorId,
                'type' => $type,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send notification to multiple instructors.
     */
    public function sendToMany($instructorIds, $type, $title, $message, $data = [])
    {
        $notifications = [];
        
        foreach ($instructorIds as $instructorId) {
            $notification = $this->send($instructorId, $type, $title, $message, $data);
            if ($notification) {
                $notifications[] = $notification;
            }
        }

        return $notifications;
    }

    /**
     * Student enrolled in course.
     */
    public function studentEnrolled($instructorId, $courseId, $studentId, $courseTitle, $studentName)
    {
        return $this->send(
            $instructorId,
            'student_enrolled',
            'Student Baru Mendaftar',
            "{$studentName} telah mendaftar di kursus '{$courseTitle}'",
            [
                'course_id' => $courseId,
                'student_id' => $studentId,
                'course_title' => $courseTitle,
                'student_name' => $studentName
            ]
        );
    }

    /**
     * Student completed course.
     */
    public function studentCompletedCourse($instructorId, $courseId, $studentId, $courseTitle, $studentName)
    {
        return $this->send(
            $instructorId,
            'student_completed',
            'Student Menyelesaikan Kursus',
            "{$studentName} telah menyelesaikan kursus '{$courseTitle}'",
            [
                'course_id' => $courseId,
                'student_id' => $studentId,
                'course_title' => $courseTitle,
                'student_name' => $studentName
            ]
        );
    }

    /**
     * New review received.
     */
    public function newReview($instructorId, $courseId, $reviewId, $courseTitle, $studentName, $rating)
    {
        return $this->send(
            $instructorId,
            'new_review',
            'Review Baru Diterima',
            "{$studentName} memberikan review {$rating} bintang untuk kursus '{$courseTitle}'",
            [
                'course_id' => $courseId,
                'review_id' => $reviewId,
                'course_title' => $courseTitle,
                'student_name' => $studentName,
                'rating' => $rating
            ]
        );
    }

    /**
     * Payment received.
     */
    public function paymentReceived($instructorId, $courseId, $paymentId, $courseTitle, $studentName, $amount)
    {
        return $this->send(
            $instructorId,
            'payment_received',
            'Pembayaran Diterima',
            "Pembayaran Rp " . number_format($amount, 0, ',', '.') . " diterima untuk kursus '{$courseTitle}' dari {$studentName}",
            [
                'course_id' => $courseId,
                'payment_id' => $paymentId,
                'course_title' => $courseTitle,
                'student_name' => $studentName,
                'amount' => $amount
            ]
        );
    }

    /**
     * Course approved by admin.
     */
    public function courseApproved($instructorId, $courseId, $courseTitle)
    {
        return $this->send(
            $instructorId,
            'course_approved',
            'Kursus Disetujui',
            "Kursus '{$courseTitle}' telah disetujui dan dapat diakses oleh student",
            [
                'course_id' => $courseId,
                'course_title' => $courseTitle
            ]
        );
    }

    /**
     * Course rejected by admin.
     */
    public function courseRejected($instructorId, $courseId, $courseTitle, $reason = null)
    {
        $message = "Kursus '{$courseTitle}' ditolak";
        if ($reason) {
            $message .= ". Alasan: {$reason}";
        }

        return $this->send(
            $instructorId,
            'course_rejected',
            'Kursus Ditolak',
            $message,
            [
                'course_id' => $courseId,
                'course_title' => $courseTitle,
                'reason' => $reason
            ]
        );
    }

    /**
     * Student asked question.
     */
    public function studentQuestion($instructorId, $courseId, $questionId, $courseTitle, $studentName, $question)
    {
        return $this->send(
            $instructorId,
            'student_question',
            'Pertanyaan Student',
            "{$studentName} mengajukan pertanyaan di kursus '{$courseTitle}': " . substr($question, 0, 100) . "...",
            [
                'course_id' => $courseId,
                'question_id' => $questionId,
                'course_title' => $courseTitle,
                'student_name' => $studentName,
                'question' => $question
            ]
        );
    }

    /**
     * Course content updated.
     */
    public function courseContentUpdated($instructorId, $courseId, $courseTitle, $contentType)
    {
        return $this->send(
            $instructorId,
            'content_updated',
            'Konten Kursus Diperbarui',
            "Konten {$contentType} di kursus '{$courseTitle}' telah diperbarui",
            [
                'course_id' => $courseId,
                'course_title' => $courseTitle,
                'content_type' => $contentType
            ]
        );
    }

    /**
     * System announcement.
     */
    public function systemAnnouncement($instructorId, $title, $message, $data = [])
    {
        return $this->send(
            $instructorId,
            'system_announcement',
            $title,
            $message,
            $data
        );
    }

    /**
     * Reminder notification.
     */
    public function reminder($instructorId, $title, $message, $data = [])
    {
        return $this->send(
            $instructorId,
            'reminder',
            $title,
            $message,
            $data
        );
    }
}
