<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TopicController extends Controller
{
    /**
     * Display a listing of topics
     */
    public function index(Request $request)
    {
        $query = Topic::with(['course']);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $topics = $query->withCount('contents')->orderBy('order')->paginate(15);
        $courses = Course::with('instructor')->get();

        return view('admin.topics-tutor', compact('topics', 'courses'));
    }

    /**
     * Show the form for creating a new topic
     */
    public function create()
    {
        $courses = Course::with('instructor')->get();
        return view('admin.topics-create-tutor', compact('courses'));
    }

    /**
     * Store a newly created topic
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        
        // Auto-set order if not provided
        if (empty($data['order'])) {
            $maxOrder = Topic::where('course_id', $data['course_id'])->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        Topic::create($data);

        return redirect()->route('admin.topics.index')
            ->with('success', 'Topic created successfully!');
    }

    /**
     * Display the specified topic
     */
    public function show(Topic $topic)
    {
        $topic->load(['course', 'contents']);
        return view('admin.topics-show-tutor', compact('topic'));
    }

    /**
     * Show the form for editing the topic
     */
    public function edit(Topic $topic)
    {
        $courses = Course::with('instructor')->get();
        return view('admin.topics-edit-tutor', compact('topic', 'courses'));
    }

    /**
     * Update the specified topic
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        
        // Auto-set order if not provided
        if (empty($data['order'])) {
            $maxOrder = Topic::where('course_id', $data['course_id'])->max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        $topic->update($data);

        return redirect()->route('admin.topics.index')
            ->with('success', 'Topic updated successfully!');
    }

    /**
     * Remove the specified topic
     */
    public function destroy(Topic $topic)
    {
        // Check if topic has contents
        if ($topic->contents()->count() > 0) {
            return redirect()->route('admin.topics.index')
                ->with('error', 'Cannot delete topic that has contents. Please move or delete the contents first.');
        }

        $topic->delete();

        return redirect()->route('admin.topics.index')
            ->with('success', 'Topic deleted successfully!');
    }

    /**
     * Get topics for a specific course (AJAX)
     */
    public function getByCourse(Course $course)
    {
        $topics = $course->topics()->orderBy('order')->get();
        return response()->json($topics);
    }
}