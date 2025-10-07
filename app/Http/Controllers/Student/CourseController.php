<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enrollment;
use App\Models\ContentProgress;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display enrolled courses (My Courses)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->enrollments()->with(['course.instructor', 'course.category', 'course.courseLevel', 'course.topics', 'course.contents']);

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'in_progress') {
                $query->whereHas('course', function($q) use ($user) {
                    $q->whereHas('contents', function($contentQuery) use ($user) {
                        $contentQuery->whereHas('progress', function($progressQuery) use ($user) {
                            $progressQuery->where('user_id', $user->id)->where('is_completed', true);
                        });
                    });
                });
            } elseif ($request->status === 'completed') {
                $query->whereHas('course', function($q) use ($user) {
                    $q->whereDoesntHave('contents', function($contentQuery) use ($user) {
                        $contentQuery->whereDoesntHave('progress', function($progressQuery) use ($user) {
                            $progressQuery->where('user_id', $user->id)->where('is_completed', true);
                        });
                    });
                });
            }
        }

        $enrolledCourses = $query->latest()->paginate(12);
        $categories = Category::all();
        $courseLevels = CourseLevel::all();

        return view('student.courses.index-tutor', compact('enrolledCourses', 'categories', 'courseLevels'));
    }

    /**
     * Browse all available courses
     */
    public function browse(Request $request)
    {
        $query = Course::with(['instructor', 'category', 'courseLevel'])
            ->withCount(['enrollments', 'contents', 'topics'])
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

        // Course Level filter
        if ($request->filled('level')) {
            $query->where('course_level_id', $request->level);
        }

        // Price filter
        if ($request->filled('price')) {
            if ($request->price === 'free') {
                $query->where('price', 0);
            } elseif ($request->price === 'paid') {
                $query->where('price', '>', 0);
            }
        }

        $courses = $query->latest()->paginate(12);
        $categories = Category::all();
        $courseLevels = CourseLevel::all();

        return view('student.courses.browse-tutor', compact('courses', 'categories', 'courseLevels'));
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
            'courseLevel',
            'topics' => function($query) {
                $query->with(['contents' => function($q) {
                    $q->orderBy('order');
                }])->orderBy('order');
            },
            'contents' => function($query) {
                $query->orderBy('order');
            },
            'reviews'
        ])->loadCount(['enrollments', 'contents', 'topics']);

        // Check if user is enrolled
        $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
        $isEnrolled = $enrollment !== null;
        
        // Get user progress using ContentProgress
        $progress = $course->getUserProgress(Auth::id());

        return view('student.courses.show-tutor', compact('course', 'isEnrolled', 'progress'));
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
                ->with('error', 'You are not enrolled in this course.');
        }

        $course->load([
            'instructor', 
            'category', 
            'courseLevel',
            'topics' => function($query) {
                $query->with(['contents' => function($q) {
                    $q->orderBy('order');
                }])->orderBy('order');
            },
            'contents' => function($query) {
                $query->orderBy('order');
            }
        ]);

        // Get user progress for this course
        $progress = $course->getUserProgress(Auth::id());

        return view('student.courses.learn-tutor', compact('course', 'enrollment', 'progress'));
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