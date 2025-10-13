<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\ContentProgress;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display student progress page
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all enrollments with course details
        $enrollments = Enrollment::where('user_id', $user->id)
            ->with([
                'course.instructor', 
                'course.category', 
                'course.courseLevel',
                'course.topics' => function($query) {
                    $query->with(['contents' => function($q) {
                        $q->orderBy('order');
                    }])->orderBy('order');
                }
            ])
            ->get();

        // Calculate statistics
        $totalCourses = $enrollments->count();
        $inProgressCourses = 0;
        $completedCourses = 0;
        $totalLearningHours = 0;
        $totalContents = 0;
        $completedContents = 0;

        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            
            // Count total contents for this course
            $courseContents = $course->contents->count();
            $totalContents += $courseContents;
            
            // Count completed contents for this course
            $completedCourseContents = ContentProgress::where('user_id', $user->id)
                ->whereHas('courseContent', function($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->where('is_completed', true)
                ->count();
            
            $completedContents += $completedCourseContents;
            
            // Calculate learning hours for this course
            $courseLearningHours = ContentProgress::where('user_id', $user->id)
                ->whereHas('courseContent', function($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->sum('time_spent') / 3600; // Convert seconds to hours
            
            $totalLearningHours += $courseLearningHours;
            
            // Determine course status
            if ($completedCourseContents > 0 && $completedCourseContents < $courseContents) {
                $inProgressCourses++;
            } elseif ($completedCourseContents === $courseContents && $courseContents > 0) {
                $completedCourses++;
            }
        }

        // Get certificates
        $certificates = Certificate::where('user_id', $user->id)
            ->with('course')
            ->get();

        // Get recent activity (last 10 content progress)
        $recentActivity = ContentProgress::where('user_id', $user->id)
            ->with(['courseContent.course', 'courseContent.topic'])
            ->latest()
            ->limit(10)
            ->get();

        // Calculate overall progress percentage
        $overallProgress = $totalContents > 0 ? round(($completedContents / $totalContents) * 100, 1) : 0;

        return view('student.progress-tutor', compact(
            'enrollments',
            'totalCourses',
            'inProgressCourses', 
            'completedCourses',
            'totalLearningHours',
            'totalContents',
            'completedContents',
            'overallProgress',
            'certificates',
            'recentActivity'
        ));
    }
}
