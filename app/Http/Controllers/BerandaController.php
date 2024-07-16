<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StudentUpdateRequest;

use App\Models\Kelas;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Sublesson;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index():View
    {
        $student = Student::count();
        $lesson = Lesson::count();
        $sublesson = Sublesson::count();
        $kelas = Kelas::count();

        return view('beranda')->with([
            'siswa' => $student,
            'materi' => $lesson,
            'submateri' => $sublesson,
            'kelas' => $kelas,
        ]);
    }
}
