<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enrollment;
use App\Models\Review;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of available courses for students
     */
    public function index(Request $request)
    {
        $query = Course::where('is_public', true)
            ->with(['instructor', 'category', 'enrollments']);

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by video type instead of difficulty level
        if ($request->filled('video_type')) {
            $query->where('video_type', $request->video_type);
        }

        // Search by title or description
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->withCount('enrollments')->orderBy('enrollments_count', 'desc');
                break;
            case 'rating':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            default:
                $query->latest();
        }

        $courses = $query->paginate(12);
        $categories = Category::all();

        return view('student.courses.index', compact('courses', 'categories'));
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {
        if (!$course->is_public) {
            abort(404);
        }

        $course->load(['instructor', 'topics', 'category', 'reviews.user']);
        
        // Check if user is enrolled
        $isEnrolled = false;
        $enrollment = null;
        if (Auth::check()) {
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
            $isEnrolled = $enrollment ? true : false;
        }

        // Get average rating
        $averageRating = $course->reviews()->avg('rating');
        $totalReviews = $course->reviews()->count();

        // Get related courses
        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->where('is_public', true)
            ->with(['instructor', 'category'])
            ->limit(4)
            ->get();

        return view('student.courses.show', compact(
            'course', 
            'isEnrolled', 
            'enrollment', 
            'averageRating', 
            'totalReviews',
            'relatedCourses'
        ));
    }

    /**
     * Enroll in a course
     */
    public function enroll(Request $request, Course $course)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to enroll in courses.');
        }

        if (!$course->is_public) {
            abort(404);
        }

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        // Check if course has maximum students limit
        if ($course->max_students && $course->enrollments()->count() >= $course->max_students) {
            return back()->with('error', 'This course is full.');
        }

        try {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'status' => 'active'
            ]);

            return redirect()->route('student.courses.my-courses')
                ->with('success', 'Successfully enrolled in ' . $course->title);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to enroll. Please try again.');
        }
    }

    /**
     * Display enrolled courses
     */
    public function myCourses()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())
            ->with(['course.instructor', 'course.category'])
            ->latest()
            ->paginate(12);

        return view('student.courses.my-courses', compact('enrollments'));
    }

    /**
     * Display course content for enrolled students
     */
    public function learn(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return redirect()->route('student.courses.show', $course)
                ->with('error', 'You must enroll in this course to access the content.');
        }

        $course->load(['topics', 'instructor']);
        
        return view('student.courses.learn', compact('course', 'enrollment'));
    }

    /**
     * Store a course review
     */
    public function review(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        // Check if user is enrolled
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'You must be enrolled to review this course.');
        }

        // Check if user already reviewed
        $existingReview = Review::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this course.');
        }

        try {
            Review::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);

            return back()->with('success', 'Thank you for your review!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to submit review. Please try again.');
        }
    }

    /**
     * Update course progress
     */
    public function updateProgress(Request $request, Course $course)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'completed' => 'required|boolean'
        ]);

        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return response()->json(['error' => 'Not enrolled in this course'], 403);
        }

        // Here you would typically update progress in a course_progress table
        // For now, we'll just return success
        return response()->json(['success' => true]);
    }

    /**
     * Get course statistics for enrolled students
     */
    public function statistics(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'You must be enrolled to view course statistics.');
        }

        $course->load(['topics', 'reviews']);
        
        $totalTopics = $course->topics->count();
        $completedTopics = 0; // This would come from course_progress table
        
        $statistics = [
            'total_topics' => $totalTopics,
            'completed_topics' => $completedTopics,
            'completion_percentage' => $totalTopics > 0 ? round(($completedTopics / $totalTopics) * 100, 2) : 0,
            'enrollment_date' => $enrollment->created_at,
            'average_rating' => $course->reviews()->avg('rating'),
            'total_reviews' => $course->reviews()->count()
        ];

        return view('student.courses.statistics', compact('course', 'statistics'));
    }

    /**
     * Unenroll from a course
     */
    public function unenroll(Course $course)
    {
        $enrollment = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            return back()->with('error', 'You are not enrolled in this course.');
        }

        try {
            $enrollment->delete();
            return redirect()->route('student.courses.my-courses')
                ->with('success', 'Successfully unenrolled from ' . $course->title);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to unenroll. Please try again.');
        }
    }

    /**
     * Get courses by category
     */
    public function category(Category $category)
    {
        $courses = Course::where('category_id', $category->id)
            ->where('is_public', true)
            ->with(['instructor', 'category'])
            ->latest()
            ->paginate(12);

        return view('student.courses.category', compact('courses', 'category'));
    }

    /**
     * Search courses
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('student.courses.index');
        }

        $courses = Course::where('is_public', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['instructor', 'category'])
            ->latest()
            ->paginate(12);

        return view('student.courses.search', compact('courses', 'query'));
    }
}
