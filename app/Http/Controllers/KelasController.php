<?php

namespace App\Http\Controllers;

// use App\Http\Requests\KelasUpdateRequest;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KelasController extends Controller
{
    public function index():View
    {
        return view('kelas.data')->with([
            'kelas' => Kelas::latest()->paginate(30),
        ]);
    }

    public function create():View
    {
        return view('kelas.create');
    }

    public function store(Request $request):RedirectResponse
    {
        $imagePath = $request->file('thumbnail_location')->store('thumbnail-kelas', 'public');
        Kelas::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'thumbnail_location' => $imagePath,
        ]);

        return redirect()->route('kelas.index')->with(['success' => 'Data berhasil disimpan']);
    }
    /**
     * Display the user's Kelas form.
     */
    public function edit(String $id): View
    {
        $Kelas = Kelas::where('id', $id)->first();
        return view('kelas.edit', [
            'kelas' => $Kelas,
        ]);
    }

    /**
     * Update the user's Kelas information.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
    
        // Simpan thumbnail yang lama dalam variabel
        $oldThumbnailLocation = $kelas->thumbnail_location;
    
        if ($request->hasFile('thumbnail_location')) {
            // Hapus file lama jika ada
            if (Storage::exists($oldThumbnailLocation)) {
                Storage::delete($oldThumbnailLocation);
            }
    
            // Simpan file yang baru
            $imagePath = $request->file('thumbnail_location')->store('thumbnail-kelas', 'public');
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $imagePath = $oldThumbnailLocation;
        }
    
        $kelas->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'thumbnail_location' => $imagePath,
        ]);
    
        return redirect()->route('kelas.index')->with(['success' => 'Data berhasil diubah']);
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(String $id): RedirectResponse
    {
        $Kelas = Kelas::findOrFail($id);
        $Kelas->delete();

        return redirect()->route('kelas.index')->with(['success' => 'Data berhasil dihapus']);
    }

    public function getSiswa(Request $request)
    {
        $id = $request->id;
        $kelas = Kelas::where('id', $id)->select('name')->first();
        $siswa = Student::whereHas('kelas', function ($query) use ($id) {
            $query->where('kelas.id', $id);
        })->get();
        return view('kelas.daftar-siswa')->with([
            'students' => $siswa,
            'kelas' => $kelas,
        ]);
    }
}
