<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Review;
use App\Models\ContentProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display analytics dashboard
     */
    public function index(Request $request)
    {
        $instructor = Auth::user();
        $period = $request->get('period', '30'); // Default to last 30 days

        // Calculate date range
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays($period);

        // Revenue analytics
        $revenueData = $this->getRevenueData($instructor, $startDate, $endDate);
        
        // Enrollment analytics
        $enrollmentData = $this->getEnrollmentData($instructor, $startDate, $endDate);
        
        // Course performance
        $coursePerformance = $this->getCoursePerformance($instructor);
        
        // Student engagement
        $engagementData = $this->getEngagementData($instructor, $startDate, $endDate);
        
        // Reviews and ratings
        $reviewData = $this->getReviewData($instructor);
        
        // Geographic data (if available)
        $geographicData = $this->getGeographicData($instructor);

        return view('instructor.analytics.index', compact(
            'revenueData',
            'enrollmentData', 
            'coursePerformance',
            'engagementData',
            'reviewData',
            'geographicData',
            'period'
        ));
    }

    /**
     * Get revenue data for charts
     */
    private function getRevenueData($instructor, $startDate, $endDate)
    {
        // Daily revenue
        $dailyRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(amount) as revenue')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Monthly revenue (last 12 months)
        $monthlyRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subMonths(12))
        ->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as revenue')
        )
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // Total revenue
        $totalRevenue = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->sum('amount');

        // Revenue by course
        $revenueByCourse = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->select('courses.title', DB::raw('SUM(payments.amount) as revenue'))
        ->join('courses', 'payments.course_id', '=', 'courses.id')
        ->groupBy('courses.id', 'courses.title')
        ->orderBy('revenue', 'desc')
        ->get();

        return [
            'daily' => $dailyRevenue,
            'monthly' => $monthlyRevenue,
            'total' => $totalRevenue,
            'by_course' => $revenueByCourse
        ];
    }

    /**
     * Get enrollment data
     */
    private function getEnrollmentData($instructor, $startDate, $endDate)
    {
        // Daily enrollments
        $dailyEnrollments = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->whereBetween('created_at', [$startDate, $endDate])
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as enrollments')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Total enrollments
        $totalEnrollments = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->count();

        // Enrollments by course
        $enrollmentsByCourse = Course::where('instructor_id', $instructor->id)
            ->withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->get();

        return [
            'daily' => $dailyEnrollments,
            'total' => $totalEnrollments,
            'by_course' => $enrollmentsByCourse
        ];
    }

    /**
     * Get course performance data
     */
    private function getCoursePerformance($instructor)
    {
        return Course::where('instructor_id', $instructor->id)
            ->withCount(['enrollments', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->with(['category'])
            ->orderBy('enrollments_count', 'desc')
            ->get();
    }

    /**
     * Get student engagement data
     */
    private function getEngagementData($instructor, $startDate, $endDate)
    {
        // Content completion rate
        $totalContents = ContentProgress::whereHas('courseContent.course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->count();

        $completedContents = ContentProgress::whereHas('courseContent.course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('is_completed', true)
        ->count();

        $completionRate = $totalContents > 0 ? round(($completedContents / $totalContents) * 100, 2) : 0;

        // Active students (students who accessed content in last 7 days)
        $activeStudents = ContentProgress::whereHas('courseContent.course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->distinct('user_id')
        ->count('user_id');

        // Average time to complete course
        $avgCompletionTime = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->whereNotNull('completed_at')
        ->selectRaw('AVG(DATEDIFF(completed_at, enrolled_at)) as avg_days')
        ->value('avg_days');

        return [
            'completion_rate' => $completionRate,
            'active_students' => $activeStudents,
            'avg_completion_time' => $avgCompletionTime ? round($avgCompletionTime, 1) : 0
        ];
    }

    /**
     * Get review and rating data
     */
    private function getReviewData($instructor)
    {
        $baseQuery = Review::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        });

        // $totalReviews = $baseQuery->count();
        // $averageRating = $baseQuery->avg('rating') ?? 0;

        // Rating distribution
        $ratingDistribution = DB::table('reviews')
            ->join('courses', 'reviews.course_id', '=', 'courses.id')
            ->where('courses.instructor_id', $instructor->id)
            ->select(
                'reviews.rating',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('reviews.rating')
            ->orderBy('reviews.rating')
            ->get();

        // Recent reviews
        $recentReviews = Review::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->with(['user', 'course'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        return [
            // 'total' => $totalReviews,
            // 'average' => round($averageRating, 2),
            'distribution' => $ratingDistribution,
            'recent' => $recentReviews
        ];
    }

    /**
     * Get geographic data (if available)
     */
    private function getGeographicData($instructor)
    {
        // This would require additional user location data
        // For now, return empty data
        return [
            'countries' => [],
            'cities' => []
        ];
    }

    /**
     * Export analytics data
     */
    public function export(Request $request)
    {
        $instructor = Auth::user();
        $type = $request->get('type', 'revenue');

        switch ($type) {
            case 'revenue':
                return $this->exportRevenueData($instructor);
            case 'enrollments':
                return $this->exportEnrollmentData($instructor);
            case 'courses':
                return $this->exportCourseData($instructor);
            default:
                abort(400, 'Invalid export type');
        }
    }

    private function exportRevenueData($instructor)
    {
        $data = Payment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->where('status', 'completed')
        ->with(['course', 'user'])
        ->orderBy('created_at', 'desc')
        ->get();

        $csvData = [];
        $csvData[] = ['Date', 'Course', 'Student', 'Amount', 'Status'];

        foreach ($data as $payment) {
            $csvData[] = [
                $payment->created_at->format('Y-m-d'),
                $payment->course->title,
                $payment->user->name,
                $payment->amount,
                $payment->status
            ];
        }

        return $this->generateCSV($csvData, 'revenue_export_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }

    private function exportEnrollmentData($instructor)
    {
        $data = Enrollment::whereHas('course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->with(['course', 'user'])
        ->orderBy('created_at', 'desc')
        ->get();

        $csvData = [];
        $csvData[] = ['Date', 'Course', 'Student', 'Status', 'Progress'];

        foreach ($data as $enrollment) {
            $csvData[] = [
                $enrollment->created_at->format('Y-m-d'),
                $enrollment->course->title,
                $enrollment->user->name,
                $enrollment->status,
                $enrollment->progress . '%'
            ];
        }

        return $this->generateCSV($csvData, 'enrollments_export_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }

    private function exportCourseData($instructor)
    {
        $data = Course::where('instructor_id', $instructor->id)
            ->withCount(['enrollments', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->with(['category'])
            ->get();

        $csvData = [];
        $csvData[] = ['Course', 'Category', 'Price', 'Enrollments', 'Reviews', 'Average Rating', 'Created Date'];

        foreach ($data as $course) {
            $csvData[] = [
                $course->title,
                $course->category->name ?? 'N/A',
                $course->price,
                $course->enrollments_count,
                $course->reviews_count,
                $course->reviews_avg_rating ?? 'N/A',
                $course->created_at->format('Y-m-d')
            ];
        }

        return $this->generateCSV($csvData, 'courses_export_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }

    private function generateCSV($data, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
