<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    use AuthorizesRequests;

    public function create()
    {
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function index()
    {
        $courses = Course::where('instructor_id', Auth::id())
            // ->withCount('enrollments')
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('instructor.courses.index', compact('courses'));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
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
            // Ambil semua data kecuali thumbnail dan _token
            $data = $request->except(['thumbnail', '_token', '_method']);

            // Handle thumbnail jika ada
            if ($request->hasFile('thumbnail')) {
                try {
                    // Delete old thumbnail
                    if ($course->thumbnail) {
                        Storage::disk('public')->delete($course->thumbnail);
                    }
                    
                    // Store new thumbnail
                    $file = $request->file('thumbnail');
                    if ($file->isValid()) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $path = $file->move(public_path('storage/course-thumbnails'), $fileName);
                        if ($path) {
                            $data['thumbnail'] = 'course-thumbnails/' . $fileName;
                        }
                    }
                } catch (\Exception $e) {
                    Log::error('Thumbnail upload failed: ' . $e->getMessage());
                    return back()->withInput()->with('error', 'Failed to upload thumbnail. Please try again.');
                }
            }

            // Update course data
            $course->update($data);

            // Update topics jika ada
            if ($request->has('topics')) {
                // Delete existing topics
                $course->topics()->delete();
                
                // Create new topics
                foreach ($request->topics as $topic) {
                    if (!empty($topic['title'])) {
                        $course->topics()->create([
                            'title' => $topic['title'],
                            'description' => $topic['description'] ?? null,
                        ]);
                    }
                }
            }
            // dd(storage_path());

            // dd($course);
            // die();

            return redirect()
                ->route('instructor.courses.index')
                ->with('success', 'Course updated successfully!');

        } catch (\Exception $e) {
            Log::error('Course update failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Failed to update course. Please try again. ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
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
                'instructor_id' => Auth::id(),
                'category_id' => $request->category_id,
                'price' => $request->price,
                'max_students' => $request->max_students,
                'difficulty_level' => $request->difficulty_level,
                'is_public' => $request->boolean('is_public'),
                'video_type' => $request->video_type,
                'video_url' => $request->video_url,
                'thumbnail' => $thumbnailPath,
            ]);

            // Handle topics/curriculum
            if ($request->has('topics')) {
                foreach ($request->topics as $topic) {
                    $course->topics()->create([
                        'title' => $topic['title'],
                        'description' => $topic['description'] ?? null,
                    ]);
                }
            }

            return redirect()
                ->route('instructor.courses.index')
                ->with('success', 'Course created successfully!');

        } catch (\Exception $e) {
            // If thumbnail was uploaded but course creation failed, delete the thumbnail
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            return back()
                ->withInput()
                ->with('error', 'Failed to create course. Please try again.');
        }
    }
} 