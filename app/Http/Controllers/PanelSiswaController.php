<?php

namespace App\Http\Controllers;

// use App\Http\Requests\KelasUpdateRequest;

use App\Models\Kelas;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Sublesson;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PanelSiswaController extends Controller
{
    public function dashboard(): View
    {
        return view('students-panel.dashboard');
    }
    public function daftarKelasCoding(): View
    {
        $userId = auth()->id();
        
        // Menggunakan whereHas untuk mengambil kelas yang dimiliki oleh siswa dengan ID pengguna tertentu
        $kelas = Kelas::whereHas('student', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('type', 'coding')->latest()->paginate(30);

    
        return view('students-panel.daftar-kelas', [
            'kelas' => $kelas,
            'title' => 'Kelas Coding',
        ]);
    }

    public function daftarKelasMath(): View
    {
        $userId = auth()->id();
        
        // Menggunakan whereHas untuk mengambil kelas yang dimiliki oleh siswa dengan ID pengguna tertentu
        $kelas = Kelas::whereHas('student', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('type', 'math')->latest()->paginate(30);

    
        return view('students-panel.daftar-kelas', [
            'kelas' => $kelas,
            'title' => 'Kelas Math',
        ]);
    }

    public function daftarMateri(Request $request): View
    {
        $id = $request->id;
        $lessons = Lesson::where('kelas_id', $id)->select('id','name','description')->latest()->paginate(30);
        $kelas = Kelas::where('id', $id)->select('name')->first();

        return view('students-panel.daftar-lessons', [
            'lessons' => $lessons,
            'title' => $kelas->name,
        ]);
    }

    public function daftarSubMateri(Request $request): View
    {
        $id = $request->id;
        $sublessons = Sublesson::where('lesson_id', $id)->select('id','name','description')->latest()->paginate(30);
        $lesson = Lesson::where('id', $id)->select('name')->first();

        return view('students-panel.daftar-sublessons', [
            'lessons' => $sublessons,
            'title' => $lesson->name,
        ]);
    }

    public function getSubMateri(Request $request): View
    {
        $id = $request->id;
        $lesson = Sublesson::where('id', $id)->first();

        return view('students-panel.sublesson', [
            'lesson' => $lesson,
        ]);
    }

}
