<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SublessonController;
use App\Http\Controllers\PanelSiswaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::get('/beranda', function () {
//     return view('beranda');
// })->middleware(['auth', 'verified'])->name('beranda');

Route::get('/', function () {
    // Cek apakah pengguna sudah login
    if (auth()->check()) {
        $user = auth()->user(); 
        if ($user->role == 'admin') {
            return redirect()->route('beranda'); // Jika role adalah 'admin', arahkan ke beranda
        } elseif ($user->role == 'student') {
            return redirect()->route('panel-siswa.dashboard'); // Jika role adalah 'student', arahkan ke panel siswa
        }
    } else {
        return redirect()->route('login'); // Jika belum login, arahkan ke halaman login
    }
});


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin:admin')->group(function () {
        Route::get('/beranda',  [BerandaController::class, 'index'])->name('beranda');
        Route::get('daftar-siswa', [KelasController::class, 'getSiswa'])->name('daftar-siswa');
        Route::resource('/kelas', KelasController::class)->except(['show']);
        Route::resource('/student', StudentController::class)->except(['show']);
        Route::resource('/lesson', LessonController::class)->except(['show']);
        Route::resource('/sublesson', SublessonController::class)->except(['show']);
    });

    Route::middleware('admin:student')->group(function () {
        Route::get('/dashboard', [PanelSiswaController::class, 'dashboard'])->name('panel-siswa.dashboard');
        Route::get('/kelas-math', [PanelSiswaController::class, 'daftarKelasMath'])->name('panel-siswa.daftarKelasMath');
        Route::get('/kelas-coding', [PanelSiswaController::class, 'daftarKelasCoding'])->name('panel-siswa.daftarKelasCoding');
        Route::get('/daftar-materi', [PanelSiswaController::class, 'daftarMateri'])->name('panel-siswa.daftarMateri');
        Route::get('/submateri', [PanelSiswaController::class, 'daftarSubMateri'])->name('panel-siswa.daftarSubMateri');
        Route::get('/materi', [PanelSiswaController::class, 'getSubMateri'])->name('panel-siswa.getMateri');
    });
});


require __DIR__ . '/auth.php';
