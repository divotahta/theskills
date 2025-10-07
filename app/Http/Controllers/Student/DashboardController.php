<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ContentProgress;
use App\Models\Enrollment;
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
        $enrollments = Enrollment::where('user_id', $user->id)->with('course')->get();
        $enrolled = $enrollments->count();
        
        // Calculate progress using ContentProgress
        $inProgress = 0;
        $completed = 0;
        $totalLearningHours = 0;
        
        foreach ($enrollments as $enrollment) {
            $courseProgress = $enrollment->course->getUserProgress($user->id);
            if ($courseProgress['completed'] > 0 && $courseProgress['completed'] < $courseProgress['total']) {
                $inProgress++;
            } elseif ($courseProgress['completed'] === $courseProgress['total'] && $courseProgress['total'] > 0) {
                $completed++;
            }
            
            // Calculate learning hours from ContentProgress
            $courseLearningHours = ContentProgress::where('user_id', $user->id)
                ->whereHas('courseContent', function($query) use ($enrollment) {
                    $query->where('course_id', $enrollment->course_id);
                })
                ->sum('time_spent') / 3600; // Convert seconds to hours
            
            $totalLearningHours += $courseLearningHours;
        }

        // Get recent courses (last 5)
        $recentCourses = Enrollment::where('user_id', $user->id)
            ->with(['course.instructor', 'course.topics', 'course.contents'])
            ->latest()
            ->limit(5)
            ->get();

        // Get recent activity from ContentProgress
        $recentActivity = ContentProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->with(['courseContent.course'])
            ->latest('completed_at')
            ->limit(5)
            ->get()
            ->map(function($progress) {
                return [
                    'message' => 'You completed "' . $progress->courseContent->title . '"',
                    'course' => $progress->courseContent->course->title,
                    'time' => $progress->completed_at->diffForHumans()
                ];
            });

        // Get recommended courses (courses not enrolled)
        $enrolledCourseIds = $enrollments->pluck('course_id');
        $recommendedCourses = Course::where('is_public', true)
            ->whereNotIn('id', $enrolledCourseIds)
            ->with(['instructor', 'category', 'courseLevel'])
            ->latest()
            ->limit(4)
            ->get();

        $stats = [
            'enrolled' => $enrolled,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'learning_hours' => round($totalLearningHours, 1)
        ];

        return view('student.dashboard-tutor', compact('stats', 'recentCourses', 'recentActivity', 'recommendedCourses'));
    }
}