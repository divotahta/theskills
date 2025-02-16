<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_public', true)
            ->with(['instructor', 'category'])
            ->latest()
            ->paginate(12);
            
        $categories = Category::all();
        
        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        if (!$course->is_public) {
            abort(404);
        }

        $course->load(['instructor', 'topics', 'category']);
        
        return view('courses.show', compact('course'));
    }
} 