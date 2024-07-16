<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StudentUpdateRequest;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index():View
    {
        return view('student.data')->with([
            'students' => Student::latest()
            ->with(['kelas' => function ($query) {
                $query->select('name'); // Pilih kolom 'name' dari tabel 'kelas'
            }])
            ->get(),
        ]);
    }

    public function create():View
    {
        $kelas = Kelas::select('id', 'name')->get();
        return view('student.create',  compact('kelas'));
    }

    public function store(Request $request):RedirectResponse
    {


        $password = bcrypt($request->name);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role' => 'student',
        ]);
        $userId = User::where('name', $request->name)->value('id');
        $request->merge(['user_id' => $userId]);
        $student = Student::create($request->except('kelas_id'));

        $kelas_id = $request->input('kelas_id', []);
        $student->kelas()->sync($kelas_id);


        return redirect()->route('student.index')->with(['success' => 'Data berhasil disimpan']);
    }
    /**
     * Display the user's Student form.
     */
    public function edit(String $id): View
    {
        $student = Student::where('id', $id)->first();
        $kelas = Kelas::select('id', 'name')->get();
        $kelasTerpilih = $student->kelas->pluck('id');
        $kelasTerpilih = $kelasTerpilih->toArray();
        return view('student.edit', [
            'student' => $student,
            'kelas' => $kelas,
            'kelasTerpilih' => $kelasTerpilih,
        ]);
    }

    /**
     * Update the user's Student information.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        $kelas_id = $request->input('kelas_id', []);
        $student->kelas()->sync($kelas_id);


        return redirect()->route('student.index')->with(['succes', 'Data berhasil diubah']);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(String $id): RedirectResponse
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
