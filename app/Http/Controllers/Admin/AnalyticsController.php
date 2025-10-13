<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Category;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    /**
     * Display analytics dashboard.
     */
    public function index(Request $request)
    {
        // Get date range from request or default to last 30 days
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        
        // Convert to Carbon instances
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Overall Statistics
        $stats = $this->getOverallStats();
        
        // Revenue Analytics
        $revenueData = $this->getRevenueData($start, $end);
        
        // User Analytics
        $userData = $this->getUserData($start, $end);
        
        // Course Analytics
        $courseData = $this->getCourseData($start, $end);
        
        // Enrollment Analytics
        $enrollmentData = $this->getEnrollmentData($start, $end);
        
        // Category Analytics
        $categoryData = $this->getCategoryData();
        
        // Recent Activity
        $recentActivity = $this->getRecentActivity();
        
        // Top Performing Courses
        $topCourses = $this->getTopCourses($start, $end);
        
        // Top Instructors
        $topInstructors = $this->getTopInstructors($start, $end);
        
        // Monthly Trends
        $monthlyTrends = $this->getMonthlyTrends();

        return view('admin.analytics.index', compact(
            'stats',
            'revenueData',
            'userData',
            'courseData',
            'enrollmentData',
            'categoryData',
            'recentActivity',
            'topCourses',
            'topInstructors',
            'monthlyTrends',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Get overall statistics.
     */
    private function getOverallStats()
    {
        return [
            'total_users' => User::count(),
            'total_instructors' => User::where('role', 'instructor')->count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_courses' => Course::count(),
            'total_enrollments' => Enrollment::count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'total_reviews' => Review::count(),
            'average_rating' => Review::avg('rating') ?? 0,
            'active_courses' => Course::where('is_public', true)->count(),
            'pending_courses' => Course::where('is_public', false)->count(),
        ];
    }

    /**
     * Get revenue data for charts.
     */
    private function getRevenueData($start, $end)
    {
        // Daily revenue for the period
        $dailyRevenue = Payment::where('status', 'completed')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, SUM(amount) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // If no data, create sample data for the period
        if ($dailyRevenue->isEmpty()) {
            $dailyRevenue = collect();
            $current = $start->copy();
            while ($current->lte($end)) {
                $dailyRevenue->push((object)[
                    'date' => $current->format('Y-m-d'),
                    'revenue' => 0
                ]);
                $current->addDay();
            }
        }

        // Revenue by month for the last 12 months
        $monthlyRevenue = Payment::where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'daily' => $dailyRevenue,
            'monthly' => $monthlyRevenue,
            'total_period' => $dailyRevenue->sum('revenue'),
            'average_daily' => $dailyRevenue->avg('revenue') ?? 0,
        ];
    }

    /**
     * Get user data for charts.
     */
    private function getUserData($start, $end)
    {
        // User registrations by day
        $dailyUsers = User::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // If no data, create sample data for the period
        if ($dailyUsers->isEmpty()) {
            $dailyUsers = collect();
            $current = $start->copy();
            while ($current->lte($end)) {
                $dailyUsers->push((object)[
                    'date' => $current->format('Y-m-d'),
                    'count' => 0
                ]);
                $current->addDay();
            }
        }

        // Users by role
        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->get();

        // User growth over time
        $userGrowth = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // If no growth data, create sample data
        if ($userGrowth->isEmpty()) {
            $userGrowth = collect();
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $userGrowth->push((object)[
                    'month' => $date->format('Y-m'),
                    'count' => 0
                ]);
            }
        }

        return [
            'daily' => $dailyUsers,
            'by_role' => $usersByRole,
            'growth' => $userGrowth,
            'total_period' => $dailyUsers->sum('count'),
        ];
    }

    /**
     * Get course data for charts.
     */
    private function getCourseData($start, $end)
    {
        // Courses created by day
        $dailyCourses = Course::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Courses by status
        $coursesByStatus = Course::selectRaw('is_public, COUNT(*) as count')
            ->groupBy('is_public')
            ->get();

        // Courses by category
        $coursesByCategory = Course::join('categories', 'courses.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(*) as count')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('count', 'desc')
            ->get();

        return [
            'daily' => $dailyCourses,
            'by_status' => $coursesByStatus,
            'by_category' => $coursesByCategory,
            'total_period' => $dailyCourses->sum('count'),
        ];
    }

    /**
     * Get enrollment data for charts.
     */
    private function getEnrollmentData($start, $end)
    {
        // Enrollments by day
        $dailyEnrollments = Enrollment::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // If no data, create sample data for the period
        if ($dailyEnrollments->isEmpty()) {
            $dailyEnrollments = collect();
            $current = $start->copy();
            while ($current->lte($end)) {
                $dailyEnrollments->push((object)[
                    'date' => $current->format('Y-m-d'),
                    'count' => 0
                ]);
                $current->addDay();
            }
        }

        // Enrollments by month
        $monthlyEnrollments = Enrollment::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'daily' => $dailyEnrollments,
            'monthly' => $monthlyEnrollments,
            'total_period' => $dailyEnrollments->sum('count'),
        ];
    }

    /**
     * Get category analytics.
     */
    private function getCategoryData()
    {
        return Category::withCount('courses')
            ->with(['courses' => function($query) {
                $query->selectRaw('category_id, AVG(price) as avg_price, SUM(price) as total_revenue')
                    ->groupBy('category_id');
            }])
            ->get()
            ->map(function($category) {
                $course = $category->courses->first();
                $enrollmentsCount = Enrollment::whereHas('course', function($query) use ($category) {
                    $query->where('category_id', $category->id);
                })->count();
                
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'courses_count' => $category->courses_count,
                    'enrollments_count' => $enrollmentsCount,
                    'avg_price' => $course ? $course->avg_price : 0,
                    'total_revenue' => $course ? $course->total_revenue : 0,
                ];
            });
    }

    /**
     * Get recent activity.
     */
    private function getRecentActivity()
    {
        $activities = collect();

        // Recent course enrollments
        $enrollments = Enrollment::with(['course', 'user'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($enrollment) {
                return [
                    'type' => 'enrollment',
                    'message' => "{$enrollment->user->name} enrolled in {$enrollment->course->title}",
                    'time' => $enrollment->created_at,
                    'icon' => 'fas fa-graduation-cap',
                    'color' => 'text-green-600',
                ];
            });

        // Recent course creations
        $courses = Course::with('instructor')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($course) {
                return [
                    'type' => 'course',
                    'message' => "{$course->instructor->name} created course '{$course->title}'",
                    'time' => $course->created_at,
                    'icon' => 'fas fa-book',
                    'color' => 'text-blue-600',
                ];
            });

        // Recent payments
        $payments = Payment::with(['user', 'course'])
            ->where('status', 'completed')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($payment) {
                return [
                    'type' => 'payment',
                    'message' => "Payment of Rp " . number_format($payment->amount, 0, ',', '.') . " from {$payment->user->name}",
                    'time' => $payment->created_at,
                    'icon' => 'fas fa-credit-card',
                    'color' => 'text-green-600',
                ];
            });

        // Recent reviews
        $reviews = Review::with(['user', 'course'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($review) {
                return [
                    'type' => 'review',
                    'message' => "{$review->user->name} rated '{$review->course->title}' {$review->rating} stars",
                    'time' => $review->created_at,
                    'icon' => 'fas fa-star',
                    'color' => 'text-yellow-600',
                ];
            });

        return $activities
            ->merge($enrollments)
            ->merge($courses)
            ->merge($payments)
            ->merge($reviews)
            ->sortByDesc('time')
            ->take(20);
    }

    /**
     * Get top performing courses.
     */
    private function getTopCourses($start, $end)
    {
        return Course::with(['instructor', 'category'])
            ->withCount(['enrollments', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->whereHas('enrollments', function($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })
            ->orderBy('enrollments_count', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Get top instructors.
     */
    private function getTopInstructors($start, $end)
    {
        return User::where('role', 'instructor')
            ->withCount(['courses', 'enrollments'])
            ->withSum('courses', 'price')
            ->whereHas('courses.enrollments', function($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            })
            ->orderBy('enrollments_count', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Get monthly trends.
     */
    private function getMonthlyTrends()
    {
        $months = collect();
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push([
                'month' => $date->format('M Y'),
                'month_key' => $date->format('Y-m'),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'courses' => Course::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'enrollments' => Enrollment::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'revenue' => Payment::where('status', 'completed')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('amount'),
            ]);
        }

        return $months;
    }

    /**
     * Export analytics data.
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Get data for export
        $data = [
            'overall_stats' => $this->getOverallStats(),
            'revenue_data' => $this->getRevenueData($start, $end),
            'user_data' => $this->getUserData($start, $end),
            'course_data' => $this->getCourseData($start, $end),
            'enrollment_data' => $this->getEnrollmentData($start, $end),
        ];

        if ($format === 'csv') {
            return $this->exportToCsv($data, $startDate, $endDate);
        }

        return response()->json($data);
    }

    /**
     * Export data to CSV.
     */
    private function exportToCsv($data, $startDate, $endDate)
    {
        $filename = "analytics_{$startDate}_to_{$endDate}.csv";
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Overall stats
            fputcsv($file, ['Overall Statistics']);
            fputcsv($file, ['Metric', 'Value']);
            foreach ($data['overall_stats'] as $key => $value) {
                fputcsv($file, [ucwords(str_replace('_', ' ', $key)), $value]);
            }
            
            fputcsv($file, []); // Empty row
            
            // Revenue data
            fputcsv($file, ['Daily Revenue']);
            fputcsv($file, ['Date', 'Revenue']);
            foreach ($data['revenue_data']['daily'] as $item) {
                fputcsv($file, [$item->date, $item->revenue]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}