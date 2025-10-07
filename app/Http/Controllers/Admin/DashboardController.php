<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        
        // Calculate total revenue from payments
        $totalRevenue = Payment::sum('amount') ?? 0;
        
        // Get recent enrollments
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent courses
        $recentCourses = Course::with(['instructor', 'category'])
            ->latest()
            ->take(5)
            ->get();
        
        // Get user statistics by role
        $userStats = [
            'students' => User::where('role', 'student')->count(),
            'instructors' => User::where('role', 'instructor')->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];
        
        // Get course statistics
        $courseStats = [
            'public' => Course::where('is_public', true)->count(),
            'private' => Course::where('is_public', false)->count(),
            'by_video_type' => Course::selectRaw('video_type, COUNT(*) as count')
                ->groupBy('video_type')
                ->get()
                ->pluck('count', 'video_type')
                ->toArray(),
        ];
        
        // Get enrollment statistics
        $enrollmentStats = [
            'active' => Enrollment::where('status', 'active')->count(),
            'completed' => Enrollment::where('status', 'completed')->count(),
            'cancelled' => Enrollment::where('status', 'cancelled')->count(),
        ];

        // Prepare stats for Tutor LMS Pro theme
        $stats = [
            'total_courses' => $totalCourses,
            'total_students' => $userStats['students'],
            'total_revenue' => $totalRevenue,
            'active_instructors' => $userStats['instructors'],
        ];

        return view('admin.dashboard-tutor', compact(
            'stats',
            'recentCourses'
        ));
    }
}
