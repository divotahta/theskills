<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\ContentProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display all students enrolled in instructor's courses
     */
    public function index(Request $request)
    {
        $instructor = Auth::user();
        
        // Get students with their enrollment details
        $students = User::whereHas('enrollments.course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->with(['enrollments' => function($query) use ($instructor) {
            $query->whereHas('course', function($q) use ($instructor) {
                $q->where('instructor_id', $instructor->id);
            })->with('course');
        }])
        ->withCount(['enrollments as total_enrollments' => function($query) use ($instructor) {
            $query->whereHas('course', function($q) use ($instructor) {
                $q->where('instructor_id', $instructor->id);
            });
        }])
        ->paginate(20);

        // Get course filter options
        $courses = Course::where('instructor_id', $instructor->id)
                        ->select('id', 'title')
                        ->get();

        // Apply course filter if provided
        if ($request->has('course_id') && $request->course_id) {
            $students = User::whereHas('enrollments', function($query) use ($request) {
                $query->where('course_id', $request->course_id);
            })
            ->with(['enrollments' => function($query) use ($request) {
                $query->where('course_id', $request->course_id)->with('course');
            }])
            ->paginate(20);
        }

        return view('instructor.students.index', compact('students', 'courses'));
    }

    /**
     * Show student details and progress
     */
    public function show(User $student)
    {
        $instructor = Auth::user();
        
        // Get student's enrollments in instructor's courses
        $enrollments = Enrollment::where('user_id', $student->id)
                                ->whereHas('course', function($query) use ($instructor) {
                                    $query->where('instructor_id', $instructor->id);
                                })
                                ->with(['course', 'course.category'])
                                ->get();

        // Get student's progress in each course
        $progressData = collect();
        foreach ($enrollments as $enrollment) {
            $totalContents = $enrollment->course->contents()->count();
            $completedContents = ContentProgress::where('user_id', $student->id)
                                               ->whereHas('courseContent', function($query) use ($enrollment) {
                                                   $query->where('course_id', $enrollment->course_id);
                                               })
                                               ->where('is_completed', true)
                                               ->count();
            
            $progressData->push([
                'enrollment' => $enrollment,
                'total_contents' => $totalContents,
                'completed_contents' => $completedContents,
                'progress_percentage' => $totalContents > 0 ? round(($completedContents / $totalContents) * 100, 2) : 0
            ]);
        }

        // Get recent activity
        $recentActivity = ContentProgress::where('user_id', $student->id)
                                        ->whereHas('courseContent.course', function($query) use ($instructor) {
                                            $query->where('instructor_id', $instructor->id);
                                        })
                                        ->with(['courseContent.course'])
                                        ->latest()
                                        ->take(10)
                                        ->get();

        return view('instructor.students.show', compact('student', 'enrollments', 'progressData', 'recentActivity'));
    }

    /**
     * Get students by course
     */
    public function byCourse(Course $course)
    {
        $instructor = Auth::user();
        
        // Check if course belongs to instructor
        if ($course->instructor_id !== $instructor->id) {
            abort(403, 'Unauthorized access to course students.');
        }

        $students = User::whereHas('enrollments', function($query) use ($course) {
            $query->where('course_id', $course->id);
        })
        ->with(['enrollments' => function($query) use ($course) {
            $query->where('course_id', $course->id);
        }])
        ->paginate(20);

        return view('instructor.students.by-course', compact('students', 'course'));
    }

    /**
     * Get student progress in specific course
     */
    public function progress(User $student, Course $course)
    {
        $instructor = Auth::user();
        
        // Check if course belongs to instructor
        if ($course->instructor_id !== $instructor->id) {
            abort(403, 'Unauthorized access to course.');
        }

        // Check if student is enrolled in course
        $enrollment = Enrollment::where('user_id', $student->id)
                               ->where('course_id', $course->id)
                               ->first();

        if (!$enrollment) {
            abort(404, 'Student not enrolled in this course.');
        }

        // Get course contents with progress
        $contents = $course->contents()->with(['progress' => function($query) use ($student) {
            $query->where('user_id', $student->id);
        }])->get();

        // Calculate overall progress
        $totalContents = $contents->count();
        $completedContents = $contents->where('progress.is_completed', true)->count();
        $progressPercentage = $totalContents > 0 ? round(($completedContents / $totalContents) * 100, 2) : 0;

        return view('instructor.students.progress', compact('student', 'course', 'enrollment', 'contents', 'progressPercentage'));
    }

    /**
     * Export students data
     */
    public function export(Request $request)
    {
        $instructor = Auth::user();
        
        $students = User::whereHas('enrollments.course', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })
        ->with(['enrollments.course'])
        ->get();

        // Create CSV data
        $csvData = [];
        $csvData[] = ['Name', 'Email', 'Phone', 'Enrolled Courses', 'Total Enrollments', 'Registration Date'];

        foreach ($students as $student) {
            $courseNames = $student->enrollments->pluck('course.title')->implode(', ');
            $csvData[] = [
                $student->name,
                $student->email,
                $student->phone ?? '-',
                $courseNames,
                $student->enrollments->count(),
                $student->created_at->format('Y-m-d')
            ];
        }

        $filename = 'students_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
