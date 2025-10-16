<?php

namespace App\Http\Controllers\Student;

use App\Models\Enrollment;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\ContentProgress;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display student certificates page
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all certificates for the user
        $certificates = Certificate::where('user_id', $user->id)
            ->with(['course.instructor', 'course.category', 'course.courseLevel'])
            ->orderBy('issued_at', 'desc')
            ->get();

        // Get completed courses (courses where all contents are completed)
        $completedCourses = $this->getCompletedCourses($user->id);

        return view('student.certificates-tutor', compact('certificates', 'completedCourses'));
    }

    /**
     * Download certificate as PDF
     */
    public function download(Certificate $certificate)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return view('certificates.download-error', [
                'certificate' => $certificate,
                'error' => 'login_required'
            ]);
        }

        // Check if the certificate belongs to the authenticated user
        if ($certificate->user_id !== Auth::id()) {
            return view('certificates.download-error', [
                'certificate' => $certificate,
                'error' => 'unauthorized_access'
            ]);
        }

        try {
            // Generate PDF
            $pdf = Pdf::loadView('student.certificate-pdf', compact('certificate'));
            
            // Update download count
            $certificate->increment('download_count');
            
            return $pdf->download("certificate-{$certificate->certificate_number}.pdf");
        } catch (\Exception $e) {
            Log::error('Certificate PDF generation failed: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Gagal menghasilkan PDF sertifikat. Silakan coba lagi.');
        }
    }

    /**
     * Generate certificate for completed course
     */
    public function generate(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->course_id;
        
        // Check if user is enrolled and course is completed
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();
            
        if (!$enrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }

        // Check if course is completed
        $course = $enrollment->course;
        $totalContents = $course->contents->count();
        $completedContents = ContentProgress::where('user_id', $user->id)
            ->whereHas('courseContent', function($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->where('is_completed', true)
            ->count();

        if ($completedContents < $totalContents || $totalContents === 0) {
            return redirect()->back()->with('error', 'Course must be completed to generate certificate.');
        }

        // Check if certificate already exists
        $existingCertificate = Certificate::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($existingCertificate) {
            return redirect()->back()->with('error', 'Certificate already exists for this course.');
        }

        // Generate certificate
        $certificateNumber = 'CERT-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'certificate_number' => $certificateNumber,
            'issued_at' => now(),
            'expires_at' => now()->addYear(),
            'is_valid' => true,
            'download_count' => 0,
        ]);

        return redirect()->back()->with('success', 'Certificate generated successfully!');
    }

    /**
     * Get completed courses for the user
     */
    private function getCompletedCourses($userId)
    {
        $enrollments = Enrollment::where('user_id', $userId)
            ->with(['course.instructor', 'course.category', 'course.courseLevel', 'course.contents'])
            ->get();

        $completedCourses = collect();

        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            $totalContents = $course->contents->count();
            
            if ($totalContents === 0) continue;

            $completedContents = ContentProgress::where('user_id', $userId)
                ->whereHas('courseContent', function($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->where('is_completed', true)
                ->count();

            if ($completedContents === $totalContents) {
                // Check if certificate already exists
                $hasCertificate = Certificate::where('user_id', $userId)
                    ->where('course_id', $course->id)
                    ->exists();

                $completedCourses->push([
                    'course' => $course,
                    'has_certificate' => $hasCertificate,
                    'completed_at' => ContentProgress::where('user_id', $userId)
                        ->whereHas('courseContent', function($query) use ($course) {
                            $query->where('course_id', $course->id);
                        })
                        ->where('is_completed', true)
                        ->latest('completed_at')
                        ->first()?->completed_at
                ]);
            }
        }

        return $completedCourses;
    }
}
