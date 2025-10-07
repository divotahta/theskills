<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseLevel;
use App\Models\Enrollment;
use App\Models\Topic;
use App\Models\ContentProgress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();
        $courseLevels = CourseLevel::active()->ordered()->get();
        return view('admin.courses-create-tutor', compact('categories', 'instructors', 'courseLevels'));
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

        $data = $request->all();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $image = $request->file('thumbnail');

            $extension = $image->getClientOriginalExtension();
            if (empty($extension)) {
                $extension = $image->guessExtension();
            }

            $imageName = Str::slug($request->title) . '-' . time() . '.' . $extension;

            // Simpan ke: storage/app/public/course-thumbnails/
            $image->storeAs('public/course-thumbnails', $imageName);

            // ✅ SIMPAN PATH RELATIF KE DATABASE
            $data['thumbnail'] = 'course-thumbnails/' . $imageName;
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil ditambahkan');
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

        $courses = $query->withCount(['enrollments', 'contents'])->latest()->paginate(15);
        $categories = Category::all();
        $totalEnrollments = Enrollment::count();

        return view('admin.courses-tutor', compact('courses', 'categories', 'totalEnrollments'));
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
        $course->load([
            'instructor', 
            'category', 
            'courseLevel',
            'topics' => function($query) {
                $query->with(['contents' => function($q) {
                    $q->orderBy('order');
                }])->orderBy('order');
            },
            'enrollments.user', 
            'contents' => function($query) {
                $query->orderBy('order');
            }
        ]);

        return view('admin.courses.show-tutor', compact('course'));
    }

    /**
     * Show course learning interface
     */
    public function learn(Course $course)
    {
        $course->load(['instructor', 'category', 'topics', 'contents' => function($query) {
            $query->orderBy('order');
        }]);

        // Get user progress for this course
        $userId = Auth::id();
        $progress = $course->getUserProgress($userId);

        return view('admin.courses.learn', compact('course', 'progress'));
    }

    /**
     * Edit course form
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $instructors = User::where('role', 'instructor')->get();
        $courseLevels = CourseLevel::active()->ordered()->get();

        return view('admin.courses-edit-tutor', compact('course', 'categories', 'instructors', 'courseLevels'));
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->except(['thumbnail', '_token', '_method']);

            // Handle thumbnail update
            if ($request->hasFile('thumbnail')) {
                $uploadedFile = $request->file('thumbnail');

                if ($uploadedFile->isValid()) {
                    $tempPath = $uploadedFile->getPathname();
                    $realPath = $uploadedFile->getRealPath();
                    $pathToCheck = !empty($realPath) ? $realPath : $tempPath;
                    $fileSize = !empty($pathToCheck) ? @filesize($pathToCheck) : false;

                    if (!empty($pathToCheck) && $fileSize !== false && $fileSize > 0) {
                        // Delete old thumbnail
                        if ($course->thumbnail) {
                            Storage::disk('public')->delete($course->thumbnail);
                        }
                        // Store new thumbnail
                        try {
                            $data['thumbnail'] = $uploadedFile->store('course-thumbnails', 'public');
                        } catch (\Throwable $t) {
                            Log::error('Thumbnail update store failed: ' . $t->getMessage());
                        }
                    } else {
                        Log::warning('Thumbnail update skipped: empty temp/real path or zero-size file.');
                    }
                } else {
                    Log::warning('Thumbnail update failed: invalid uploaded file, error code ' . $uploadedFile->getError());
                }
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

    /**
     * Show topics for a specific course
     */
    public function topics(Course $course)
    {
        $topics = $course->topics()->withCount('contents')->orderBy('order')->paginate(15);
        return view('admin.courses.topics-tutor', compact('course', 'topics'));
    }

    /**
     * Show form to create a new topic for a course
     */
    public function createTopic(Course $course)
    {
        return view('admin.courses.topics-create-tutor', compact('course'));
    }

    /**
     * Store a new topic for a course
     */
    public function storeTopic(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['course_id'] = $course->id;
        
        // Auto-set order if not provided
        if (empty($data['order'])) {
            $maxOrder = Topic::where('course_id', $course->id)->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        Topic::create($data);

        return redirect()->route('admin.courses.topics', $course)
            ->with('success', 'Topic created successfully!');
    }

    /**
     * Show form to edit a topic
     */
    public function editTopic(Course $course, Topic $topic)
    {
        // Ensure topic belongs to course
        if ($topic->course_id !== $course->id) {
            abort(404);
        }
        
        return view('admin.courses.topics-edit-tutor', compact('course', 'topic'));
    }

    /**
     * Update a topic
     */
    public function updateTopic(Request $request, Course $course, Topic $topic)
    {
        // Ensure topic belongs to course
        if ($topic->course_id !== $course->id) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['course_id'] = $course->id;
        
        // Auto-set order if not provided
        if (empty($data['order'])) {
            $maxOrder = Topic::where('course_id', $course->id)->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        $topic->update($data);

        return redirect()->route('admin.courses.topics', $course)
            ->with('success', 'Topic updated successfully!');
    }

    /**
     * Delete a topic
     */
    public function destroyTopic(Course $course, Topic $topic)
    {
        // Ensure topic belongs to course
        if ($topic->course_id !== $course->id) {
            abort(404);
        }

        // Check if topic has contents
        if ($topic->contents()->count() > 0) {
            return redirect()->route('admin.courses.topics', $course)
                ->with('error', 'Cannot delete topic that has contents. Please move or delete the contents first.');
        }

        $topic->delete();

        return redirect()->route('admin.courses.topics', $course)
            ->with('success', 'Topic deleted successfully!');
    }

    /**
     * Toggle content completion status
     */
    public function toggleContentProgress(Request $request, Course $course)
    {
        $request->validate([
            'content_id' => 'required|exists:course_contents,id',
            'completed' => 'required|boolean',
        ]);

        $userId = Auth::id();
        $contentId = $request->content_id;
        $completed = $request->boolean('completed');

        // Ensure content belongs to this course
        $content = $course->contents()->findOrFail($contentId);

        // Get or create progress record
        $progress = ContentProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'course_content_id' => $contentId,
            ],
            [
                'is_completed' => false,
                'time_spent' => 0,
            ]
        );

        // Update completion status
        if ($completed) {
            $progress->markAsCompleted();
        } else {
            $progress->markAsIncomplete();
        }

        // Get updated progress for the course
        $courseProgress = $course->getUserProgress($userId);

        return response()->json([
            'success' => true,
            'completed' => $progress->is_completed,
            'completed_at' => $progress->completed_at?->format('M j, Y g:i A'),
            'course_progress' => $courseProgress,
        ]);
    }

    /**
     * Update content time spent
     */
    public function updateContentTime(Request $request, Course $course)
    {
        $request->validate([
            'content_id' => 'required|exists:course_contents,id',
            'time_spent' => 'required|integer|min:0',
        ]);

        $userId = Auth::id();
        $contentId = $request->content_id;
        $timeSpent = $request->time_spent;

        // Ensure content belongs to this course
        $course->contents()->findOrFail($contentId);

        // Get or create progress record
        $progress = ContentProgress::firstOrCreate(
            [
                'user_id' => $userId,
                'course_content_id' => $contentId,
            ],
            [
                'is_completed' => false,
                'time_spent' => 0,
            ]
        );

        // Update time spent
        $progress->updateTimeSpent($timeSpent);

        return response()->json([
            'success' => true,
            'time_spent' => $progress->time_spent,
            'formatted_time' => $progress->formatted_time_spent,
        ]);
    }
}
