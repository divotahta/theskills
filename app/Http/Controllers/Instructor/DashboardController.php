<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Review;
use App\Models\ContentProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Get total revenue from completed payments
        $totalRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->where('status', 'completed')->sum('amount');

        // Get average rating
        $averageRating = Review::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->avg('rating') ?? 0;

        // Get total reviews
        $totalReviews = Review::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->count();

        // Get recent enrollments
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->whereHas('course', function($query) use ($instructor) {
                $query->where('instructor_id', $instructor->id);
            })
            ->latest()
            ->take(5)
            ->get();

        // Get recent payments
        $recentPayments = Payment::with(['user', 'course'])
            ->whereHas('course', function($query) use ($instructor) {
                $query->where('instructor_id', $instructor->id);
            })
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        // Get monthly revenue data for chart (last 6 months)
        $monthlyRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->select(
            DB::raw('SUM(amount) as revenue'),
            DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'),
            DB::raw('MONTH(created_at) as month_num'),
            DB::raw('YEAR(created_at) as year')
        )
        ->groupBy('year', 'month_num', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month_num', 'asc')
        ->get();

        // Get course performance data
        $coursePerformance = Course::where('instructor_id', $instructor->id)
            ->withCount(['enrollments', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // Get student activity (recent content progress)
        $recentActivity = ContentProgress::with(['user', 'courseContent.course'])
            ->whereHas('courseContent.course', function($query) use ($instructor) {
                $query->where('instructor_id', $instructor->id);
            })
            ->latest()
            ->take(10)
            ->get();

        // Get this month's stats
        $thisMonthRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');

        $thisMonthEnrollments = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

        return view('instructor.dashboard', compact(
            'totalCourses',
            'totalStudents', 
            'totalRevenue',
            'averageRating',
            'totalReviews',
            'recentEnrollments',
            'recentPayments',
            'monthlyRevenue',
            'coursePerformance',
            'recentActivity',
            'thisMonthRevenue',
            'thisMonthEnrollments'
        ));
    }
} 