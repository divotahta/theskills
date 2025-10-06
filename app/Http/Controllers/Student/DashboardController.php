<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display student dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get enrollment statistics
        $enrollments = $user->enrollments()->with('course')->get();
        $enrolled = $enrollments->count();
        $inProgress = $enrollments->where('progress', '>', 0)->where('progress', '<', 100)->count();
        $completed = $enrollments->where('progress', '>=', 100)->count();
        $learningHours = $enrollments->sum('learning_hours') ?? 0;

        // Get recent courses (last 3)
        $recentCourses = $user->enrollments()
            ->with(['course.instructor'])
            ->latest()
            ->limit(3)
            ->get();

        // Get recent activity (mock data for now)
        $recentActivity = collect([
            [
                'message' => 'Anda menyelesaikan materi "Pengenalan HTML"',
                'time' => '2 jam yang lalu'
            ],
            [
                'message' => 'Anda mendaftar di kursus "Web Development"',
                'time' => '1 hari yang lalu'
            ],
            [
                'message' => 'Anda menyelesaikan kursus "JavaScript Basics"',
                'time' => '3 hari yang lalu'
            ]
        ]);

        $stats = [
            'enrolled' => $enrolled,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'learning_hours' => $learningHours
        ];

        return view('student.dashboard', compact('stats', 'recentCourses', 'recentActivity'));
    }
}