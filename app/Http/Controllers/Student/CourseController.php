<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of available courses
     */
    public function index(Request $request)
    {
        $query = Course::with(['instructor', 'category', 'enrollments'])
            ->withCount(['enrollments', 'contents'])
            ->where('is_public', true);

        // Search filter
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Price filter
        if ($request->filled('price')) {
            if ($request->price === 'free') {
                $query->where('price', 0);
            } elseif ($request->price === 'paid') {
                $query->where('price', '>', 0);
            }
        }

        // Level filter
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $courses = $query->latest()->paginate(12);
        $categories = Category::all();
        
        // Get user statistics
        $enrolledCount = Auth::user()->enrollments()->count();
        $completedCount = Auth::user()->enrollments()->where('progress', '>=', 100)->count();
        $learningHours = Auth::user()->enrollments()->sum('learning_hours') ?? 0;

        return view('student.courses.index', compact('courses', 'categories', 'enrolledCount', 'completedCount', 'learningHours'));
    }

    /**
     * Display enrolled courses (My Courses)
     */
    public function myCourses()
    {
        $enrolledCourses = Auth::user()->enrollments()
            ->with(['course.instructor', 'course.category'])
            ->get();

        $inProgressCount = $enrolledCourses->where('progress', '>', 0)->where('progress', '<', 100)->count();
        $completedCount = $enrolledCourses->where('progress', '>=', 100)->count();
        $certificatesCount = $completedCount; // Assuming certificate = completed course

        return view('student.courses.my-courses', compact(
            'enrolledCourses', 
            'inProgressCount', 
            'completedCount', 
            'certificatesCount'
        ));
    }

    /**
     * Show course details
     */
    public function show(Course $course)
    {
        $course->load([
            'instructor', 
            'category', 
            'contents' => function($query) {
                $query->orderBy('order');
            },
            'reviews'
        ])->loadCount(['enrollments', 'contents']);

        // Check if user is enrolled
        $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        $isEnrolled = $enrollment !== null;
        $progress = $enrollment ? $enrollment->progress : 0;

        return view('student.courses.show', compact('course', 'isEnrolled', 'progress'));
    }

    /**
     * Show course learning interface
     */
    public function learn(Course $course)
    {
        // Check if user is enrolled
        $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment) {
            return redirect()->route('student.courses.show', $course)
                ->with('error', 'Anda belum terdaftar di kursus ini.');
        }

        $course->load(['instructor', 'category', 'contents' => function($query) {
            $query->orderBy('order');
        }]);

        return view('student.courses.learn', compact('course', 'enrollment'));
    }

    /**
     * Enroll in a course
     */
    public function enroll(Request $request, Course $course)
    {
        // Check if user is already enrolled
        $existingEnrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        
        if ($existingEnrollment) {
            return redirect()->route('student.courses.learn', $course)
                ->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        // Check if course is public
        if (!$course->is_public) {
            return redirect()->route('student.courses.index')
                ->with('error', 'Kursus ini tidak tersedia untuk pendaftaran.');
        }

        // Check max students limit
        if ($course->max_students && $course->enrollments()->count() >= $course->max_students) {
            return redirect()->route('student.courses.show', $course)
                ->with('error', 'Kursus ini sudah penuh.');
        }

        // Create enrollment
        Auth::user()->enrollments()->create([
            'course_id' => $course->id,
            'enrolled_at' => now(),
            'progress' => 0,
            'learning_hours' => 0,
        ]);

        return redirect()->route('student.courses.learn', $course)
            ->with('success', 'Berhasil mendaftar di kursus! Selamat belajar!');
    }

    /**
     * Update course progress
     */
    public function updateProgress(Request $request, Course $course)
    {
        $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment) {
            return response()->json(['error' => 'Not enrolled'], 404);
        }

        $progress = $request->input('progress', 0);
        $learningHours = $request->input('learning_hours', 0);

        $enrollment->update([
            'progress' => min($progress, 100),
            'learning_hours' => $learningHours,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark content as completed
     */
    public function markCompleted(Request $request, Course $course)
    {
        $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment) {
            return response()->json(['error' => 'Not enrolled'], 404);
        }

        $contentId = $request->input('content_id');
        
        // Update progress based on completed contents
        $totalContents = $course->contents()->count();
        $completedContents = $request->input('completed_contents', []);
        $progress = $totalContents > 0 ? round((count($completedContents) / $totalContents) * 100) : 0;

        $enrollment->update([
            'progress' => $progress,
        ]);

        return response()->json(['success' => true, 'progress' => $progress]);
    }
}