<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $instructor = Auth::user();

        // Get total courses by instructor
        $totalCourses = Course::where('instructor_id', $instructor->id)->count();

        // Get total students enrolled in instructor's courses
        $totalStudents = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->count();

        // Get total revenue from instructor's courses
        $totalRevenue = Course::where('instructor_id', $instructor->id)
            ->join('enrollments', 'courses.id', '=', 'enrollments.course_id')
            ->sum('courses.price');

        // Get latest enrollments with course price
        $latestEnrollments = Enrollment::with(['user', 'course'])
            ->whereHas('course', function($query) use ($instructor) {
                $query->where('instructor_id', $instructor->id);
            })
            ->select('enrollments.*', 'courses.price')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->latest()
            ->take(5)
            ->get();

        // Get monthly revenue data for chart
        $monthlyRevenue = DB::table(function($query) use ($instructor) {
            $query->from('courses')
                ->join('enrollments', 'courses.id', '=', 'enrollments.course_id')
                ->where('instructor_id', $instructor->id)
                ->select(
                    DB::raw('sum(courses.price) as revenue'),
                    DB::raw("DATE_FORMAT(enrollments.created_at,'%M %Y') as month"),
                    DB::raw('MAX(enrollments.created_at) as created_at')
                )
                ->groupBy(DB::raw("DATE_FORMAT(enrollments.created_at,'%M %Y')"));
        })
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

        return view('instructor.dashboard', compact(
            'totalCourses',
            'totalStudents', 
            'totalRevenue',
            'latestEnrollments',
            'monthlyRevenue'
        ));
    }
} 