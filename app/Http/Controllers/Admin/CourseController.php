<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'is_public' => 'boolean',
            'video_type' => 'required|in:youtube,vimeo,native',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $thumbnailPath = null;

            if ($request->hasFile('thumbnail')) {
                $uploadedFile = $request->file('thumbnail');

                // Debug: log error code if invalid
                if (!$uploadedFile->isValid()) {
                    $errorCode = $uploadedFile->getError();
                    Log::warning('Thumbnail upload failed with error code: ' . $errorCode);
                    // Optional: throw or skip
                } else {
                    // Only store if valid
                    $thumbnailPath = $uploadedFile->store('course-thumbnails', 'public');
                }
            }

            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'instructor_id' => $request->instructor_id,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'max_students' => $request->max_students,
                'is_public' => $request->boolean('is_public'),
                'video_type' => $request->video_type,
                'video_url' => $request->video_url,
                'thumbnail' => $thumbnailPath,
            ]);

            // Handle topics...
            if ($request->has('topics') && is_array($request->topics)) {
                foreach ($request->topics as $topic) {
                    if (!empty(trim($topic['title'] ?? ''))) {
                        $course->topics()->create([
                            'title' => $topic['title'],
                            'description' => $topic['description'] ?? null,
                            'order' => $topic['order'] ?? null,
                            'duration' => $topic['duration'] ?? null,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            Log::error('Course creation failed: ' . $e->getMessage());
            if (!empty($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            return back()->withInput()->withErrors(['error' => 'Failed to create course. Please try again.']);
        }
    }

    public function index(Request $request)
    {
        $query = Course::with(['category', 'instructor'])
            ->withCount('enrollments');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhereHas('instructor', function ($instructorQuery) use ($searchTerm) {
                        $instructorQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'public') {
                $query->where('is_public', true);
            } elseif ($request->status === 'private') {
                $query->where('is_public', false);
            }
        }

        // Video type filter
        if ($request->filled('video_type')) {
            $query->where('video_type', $request->video_type);
        }

        $courses = $query->latest()->paginate(15);
        $categories = Category::all();
        $totalEnrollments = Enrollment::count();

        return view('admin.courses.index', compact('courses', 'categories', 'totalEnrollments'));
    }

    /**
     * Toggle course public/private status
     */
    public function toggleStatus(Course $course)
    {
        $course->update(['is_public' => !$course->is_public]);

        $status = $course->is_public ? 'public' : 'private';
        return back()->with('success', "Course has been made {$status}.");
    }

    /**
     * Delete a course
     */
    public function destroy(Course $course)
    {
        try {
            // Delete thumbnail if exists
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            // Delete course (this will cascade delete related records if foreign keys are set up)
            $course->delete();

            return back()->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete course. Please try again.');
        }
    }

    /**
     * Show course details
     */
    public function show(Course $course)
    {
        $course->load(['instructor', 'category', 'topics', 'enrollments.user']);

        return view('admin.courses.show', compact('course'));
    }

    /**
     * Edit course form
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();

        return view('admin.courses.edit', compact('course', 'categories', 'instructors'));
    }

    /**
     * Update course
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'max_students' => 'nullable|integer|min:1',
            'is_public' => 'boolean',
            'video_type' => 'required|in:youtube,vimeo,native',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $data = $request->except(['thumbnail', '_token', '_method']);

            // Handle thumbnail update
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($course->thumbnail) {
                    Storage::disk('public')->delete($course->thumbnail);
                }

                // Store new thumbnail
                $data['thumbnail'] = $request->file('thumbnail')->store('course-thumbnails', 'public');
            }

            $course->update($data);

            // Handle topics update
            if ($request->has('topics')) {
                // Delete existing topics
                $course->topics()->delete();

                // Create new topics
                foreach ($request->topics as $topic) {
                    if (!empty($topic['title'])) {
                        $course->topics()->create([
                            'title' => $topic['title'],
                            'description' => $topic['description'] ?? null,
                            'order' => $topic['order'] ?? null,
                            'duration' => $topic['duration'] ?? null,
                        ]);
                    }
                }
            }

            return redirect()
                ->route('admin.courses.index')
                ->with('success', 'Course updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update course. Please try again.');
        }
    }
}
