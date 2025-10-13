<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of courses for public view
     */
    public function index(Request $request)
    {
        $query = Course::with(['category', 'courseLevel', 'instructor'])
                      ->withCount(['enrollments', 'topics'])
                      ->where('is_public', true);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Level filter
        if ($request->has('level') && $request->level) {
            $query->where('course_level_id', $request->level);
        }

        // Sort by created date (newest first)
        $query->orderBy('created_at', 'desc');

        $courses = $query->paginate(12);

        // Get categories and course levels for filters
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $courseLevels = CourseLevel::where('is_active', true)->orderBy('sort_order')->get();

        return view('courses', compact('courses', 'categories', 'courseLevels'));
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {
        // Load relationships
        $course->load(['category', 'courseLevel', 'instructor', 'topics', 'contents']);
        
        // Load counts
        $course->loadCount(['enrollments', 'topics', 'contents']);

        // Check if user is enrolled (if authenticated)
        $isEnrolled = false;
        if (Auth::check() && Auth::user()->role === 'student') {
            $isEnrolled = $course->enrollments()
                                ->where('user_id', Auth::id())
                                ->exists();
        }

        return view('course-detail', compact('course', 'isEnrolled'));
    }
}