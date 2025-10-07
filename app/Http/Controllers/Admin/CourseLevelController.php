<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of course levels
     */
    public function index(Request $request)
    {
        $query = CourseLevel::query();

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $courseLevels = $query->withCount('courses')->ordered()->paginate(15);

        return view('admin.course-levels-tutor', compact('courseLevels'));
    }

    /**
     * Show the form for creating a new course level
     */
    public function create()
    {
        return view('admin.course-levels-create-tutor');
    }

    /**
     * Store a newly created course level
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_levels,name',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        CourseLevel::create($data);

        return redirect()->route('admin.course-levels.index')
            ->with('success', 'Course level created successfully!');
    }

    /**
     * Display the specified course level
     */
    public function show(CourseLevel $courseLevel)
    {
        $courseLevel->loadCount('courses');
        return view('admin.course-levels-show-tutor', compact('courseLevel'));
    }

    /**
     * Show the form for editing the course level
     */
    public function edit(CourseLevel $courseLevel)
    {
        return view('admin.course-levels-edit-tutor', compact('courseLevel'));
    }

    /**
     * Update the specified course level
     */
    public function update(Request $request, CourseLevel $courseLevel)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('course_levels', 'name')->ignore($courseLevel->id)
            ],
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        $courseLevel->update($data);

        return redirect()->route('admin.course-levels.index')
            ->with('success', 'Course level updated successfully!');
    }

    /**
     * Remove the specified course level
     */
    public function destroy(CourseLevel $courseLevel)
    {
        // Check if course level has courses
        if ($courseLevel->courses()->count() > 0) {
            return redirect()->route('admin.course-levels.index')
                ->with('error', 'Cannot delete course level that has courses. Please move or delete the courses first.');
        }

        $courseLevel->delete();

        return redirect()->route('admin.course-levels.index')
            ->with('success', 'Course level deleted successfully!');
    }

    /**
     * Toggle course level active status
     */
    public function toggleStatus(CourseLevel $courseLevel)
    {
        $courseLevel->update(['is_active' => !$courseLevel->is_active]);

        $status = $courseLevel->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.course-levels.index')
            ->with('success', "Course level {$status} successfully!");
    }
}