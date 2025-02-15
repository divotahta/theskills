<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.create', compact('categories', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'max_students' => 'nullable|integer|min:1',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'is_public' => 'boolean',
            'video_type' => 'required|in:youtube,vimeo,native',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
            }

            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'instructor_id' => $request->instructor_id,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'max_students' => $request->max_students,
                'difficulty_level' => $request->difficulty_level,
                'is_public' => $request->boolean('is_public'),
                'video_type' => $request->video_type,
                'video_url' => $request->video_url,
                'thumbnail' => $thumbnailPath,
            ]);

            if ($request->has('topics')) {
                foreach ($request->topics as $topic) {
                    $course->topics()->create([
                        'title' => $topic['title'],
                        'description' => $topic['description'] ?? null,
                    ]);
                }
            }

            return redirect()
                ->route('admin.courses.index')
                ->with('success', 'Course created successfully!');

        } catch (\Exception $e) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            return back()
                ->withInput()
                ->with('error', 'Failed to create course. Please try again.');
        }
    }

    public function index()
    {
        $courses = Course::with(['category', 'instructor'])
            ->latest()
            ->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }
} 