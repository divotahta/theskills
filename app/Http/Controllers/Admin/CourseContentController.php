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
    public function index(Course $course)
    {
        $contents = $course->contents()->with(['topic'])->orderBy('order')->paginate(15);
        $topics = $course->topics;

        return view('admin.courses.contents-tutor', compact('course', 'contents', 'topics'));
    }

    /**
     * Show the form for creating a new course content from course
     */
    public function create(Course $course)
    {
        $topics = $course->topics;
        
        return view('admin.courses.contents-create-tutor', compact('course', 'topics'));
    }

    /**
     * Store a newly created course content
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
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
        $data['course_id'] = $course->id;
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

        return redirect()->route('admin.courses.contents.index', $course)
            ->with('success', 'Course content created successfully!');
    }

    /**
     * Display the specified course content
     */
    public function show(Course $course, CourseContent $courseContent)
    {
        // Pastikan materi milik kursus yang dimaksud
        if ($courseContent->course_id !== $course->id) {
            abort(404);
        }
        
        $courseContent->load(['course', 'topic']);
        return view('admin.courses.contents-show-tutor', compact('course', 'courseContent'));
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
        
        return view('admin.courses.contents-edit-tutor', compact('course', 'courseContent', 'topics'));
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

        return redirect()->route('admin.courses.contents.index', $course)
            ->with('success', 'Course content updated successfully!');
    }

    /**
     * Remove the specified course content
     */
    public function destroy(Course $course, CourseContent $courseContent)
    {
        // Pastikan materi milik kursus yang dimaksud
        if ($courseContent->course_id !== $course->id) {
            abort(404);
        }

        try {
            // Delete file if exists
            if ($courseContent->file_path) {
                Storage::disk('public')->delete($courseContent->file_path);
            }

            $courseContent->delete();

            return redirect()->route('admin.courses.contents.index', $course)
                ->with('success', 'Course content deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.courses.contents.index', $course)
                ->with('error', 'Failed to delete course content. Please try again.');
        }
    }

    /**
     * Toggle published status
     */
    public function toggleStatus(Course $course, CourseContent $courseContent)
    {
        // Pastikan materi milik kursus yang dimaksud
        if ($courseContent->course_id !== $course->id) {
            abort(404);
        }

        $courseContent->update(['is_published' => !$courseContent->is_published]);
        
        $status = $courseContent->is_published ? 'published' : 'unpublished';
        return redirect()->route('admin.courses.contents.index', $course)
            ->with('success', "Course content {$status} successfully!");
    }
}
