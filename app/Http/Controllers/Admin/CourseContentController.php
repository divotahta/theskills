<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    /**
     * Display a listing of course contents
     */
    public function index(Request $request)
    {
        $query = CourseContent::with(['course', 'topic']);

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by topic
        if ($request->filled('topic_id')) {
            $query->where('topic_id', $request->topic_id);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('material_content', 'like', "%{$searchTerm}%");
            });
        }

        $contents = $query->orderBy('order')->paginate(15);
        $courses = Course::all();
        $topics = Topic::all();

        return view('admin.course-contents.index', compact('contents', 'courses', 'topics'));
    }

    /**
     * Show the form for creating a new course content from course
     */
    public function createFromCourse(Course $course)
    {
        $topics = $course->topics;
        
        return view('admin.course-contents.create', compact('course', 'topics'));
    }

    /**
     * Store a newly created course content
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'nullable|exists:topics,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_content' => 'nullable|string',
            'youtube_embed_url' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar|max:10240', // 10MB max
            'announcement' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $data = $request->except(['file', '_token']);
        $data['is_published'] = $request->boolean('is_published');

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('course-contents', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
        }

        // Set order if not provided
        if (empty($data['order'])) {
            $maxOrder = CourseContent::where('course_id', $data['course_id'])->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        CourseContent::create($data);

        // Redirect berdasarkan cara akses
        if ($request->has('from_course')) {
            return redirect()->route('admin.courses.show', $data['course_id'])
                ->with('success', 'Materi kursus berhasil ditambahkan');
        }

        return redirect()->route('admin.course-contents.index')
            ->with('success', 'Materi kursus berhasil ditambahkan');
    }

    /**
     * Display the specified course content
     */
    public function show(CourseContent $courseContent)
    {
        $courseContent->load(['course', 'topic']);
        return view('admin.course-contents.show', compact('courseContent'));
    }

    /**
     * Show the form for editing the specified course content
     */
    public function edit(Course $course, CourseContent $courseContent)
    {
        // Pastikan materi milik kursus yang dimaksud
        if ($courseContent->course_id !== $course->id) {
            abort(404);
        }
        
        $topics = $course->topics;
        
        return view('admin.course-contents.edit', compact('course', 'courseContent', 'topics'));
    }

    /**
     * Update the specified course content
     */
    public function update(Request $request, Course $course, CourseContent $courseContent)
    {
        // Pastikan materi milik kursus yang dimaksud
        if ($courseContent->course_id !== $course->id) {
            abort(404);
        }

        $request->validate([
            'topic_id' => 'nullable|exists:topics,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_content' => 'nullable|string',
            'youtube_embed_url' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,zip,rar|max:10240',
            'announcement' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $data = $request->except(['file', '_token', '_method']);
        $data['is_published'] = $request->boolean('is_published');
        $data['course_id'] = $course->id; // Pastikan course_id sesuai

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($courseContent->file_path) {
                Storage::disk('public')->delete($courseContent->file_path);
            }

            $file = $request->file('file');
            $fileName = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('course-contents', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
        }

        $courseContent->update($data);

        return redirect()->route('admin.courses.show', $course)
            ->with('success', 'Materi kursus berhasil diperbarui');
    }

    /**
     * Remove the specified course content
     */
    public function destroy(CourseContent $courseContent)
    {
        try {
            // Delete file if exists
            if ($courseContent->file_path) {
                Storage::disk('public')->delete($courseContent->file_path);
            }

            $courseContent->delete();

            return back()->with('success', 'Materi kursus berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus materi kursus. Silakan coba lagi.');
        }
    }

    /**
     * Toggle published status
     */
    public function toggleStatus(CourseContent $courseContent)
    {
        $courseContent->update(['is_published' => !$courseContent->is_published]);
        
        $status = $courseContent->is_published ? 'dipublikasikan' : 'disembunyikan';
        return back()->with('success', "Materi telah {$status}");
    }
}
