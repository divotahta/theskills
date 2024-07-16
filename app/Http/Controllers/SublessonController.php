<?php

namespace App\Http\Controllers;

// use App\Http\Requests\LessonUpdateRequest;

use App\Models\Kelas;
use App\Models\Lesson;
use App\Models\Sublesson;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SublessonController extends Controller
{
    public function index():View
    {
        return view('sublesson.data')->with([
            'sublessons' => Sublesson::latest()->with('lesson')->get(),
        ]);
    }

    public function create():View
    {
        $lesson = Lesson::select('id', 'name')->get();
        return view('sublesson.create', compact('lesson'));
    }

    public function store(Request $request):RedirectResponse
    {
        if ($request->hasFile('pdf_location')) {
            $pdf_location = $request->file('pdf_location')->store('pdf-lessons', 'public');
        } else {
            $pdf_location = null;
        }
        Sublesson::create([
            'name' => $request->name,
            'description' => $request->description,
            'pdf_location' => $pdf_location,
            'youtube_link' => $request->youtube_link,
            'lesson_id' => $request->lesson,
        ]);

        return redirect()->route('sublesson.index')->with(['success' => 'Data berhasil disimpan']);
    }
    /**
     * Display the user's Lesson form.
     */
    public function edit(String $id): View
    {
        $Lesson = Lesson::select('id', 'name')->get();
        $sublesson =Sublesson::where('id', $id)->first();
        return view('sublesson.edit', [
            'lesson' => $Lesson,
            'sublesson' => $sublesson,
        ]);
    }

    /**
     * Update the user's Lesson information.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $lesson = Sublesson::findOrFail($id);

        $oldPDFLocation = $lesson->pdf_location;
    
        if ($request->hasFile('pdf_location')) {
            // Hapus file lama jika ada
            if (!is_null($oldPDFLocation)){
                if (Storage::exists($oldPDFLocation)) {
                    Storage::delete($oldPDFLocation);
                }
            }
            // Simpan file yang baru
            $filePath = $request->file('pdf_location')->store('pdf-lessons', 'public');
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $filePath = $oldPDFLocation;
        }
    
        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
            'pdf_location' => $filePath,
            'youtube_link' => $request->youtube_link,
            'lesson_id' => $request->lesson,
        ]);

        return redirect()->route('sublesson.index')->with(['succes', 'Data berhasil diubah']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(String $id): RedirectResponse
    {
        $Lesson = Sublesson::findOrFail($id);
        $Lesson->delete();

        return redirect()->route('sublesson.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
