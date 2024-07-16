<?php

namespace App\Http\Controllers;

// use App\Http\Requests\LessonUpdateRequest;

use App\Models\Kelas;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function index():View
    {
        return view('lesson.data')->with([
            'lessons' => Lesson::latest()->with('kelas')->paginate(30),
        ]);
    }

    public function create():View
    {
        $kelas = Kelas::select('id', 'name')->get();
        return view('lesson.create', compact('kelas'));
    }

    public function store(Request $request):RedirectResponse
    {
        Lesson::create([
            'name' => $request->name,
            'description' => $request->description,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('lesson.index')->with(['success' => 'Data berhasil disimpan']);
    }
    /**
     * Display the user's Lesson form.
     */
    public function edit(String $id): View
    {
        $Lesson = Lesson::where('id', $id)->first();
        $kelas = Kelas::select('id', 'name')->get();
        return view('lesson.edit', [
            'lesson' => $Lesson,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the user's Lesson information.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
            'kelas_id' => $request->kelas,
        ]);

        return redirect()->route('lesson.index')->with(['succes', 'Data berhasil diubah']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(String $id): RedirectResponse
    {
        $Lesson = Lesson::findOrFail($id);
        $Lesson->delete();

        return redirect()->route('lesson.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
