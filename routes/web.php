<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Rute untuk semua pengguna
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk pengguna yang sudah login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $totalUsers = \App\Models\User::count();
        $totalCourses = \App\Models\Course::count();
        $totalEnrollments = \App\Models\Enrollment::count();
        $totalRevenue = \App\Models\Payment::where('status', 'completed')->sum('amount');
        
        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalEnrollments', 'totalRevenue'));
    })->name('admin.dashboard');
});

// Rute autentikasi (login, register, dll.)
require __DIR__.'/auth.php';