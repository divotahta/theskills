<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

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

// Rute untuk instructor
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->group(function () {
    Route::get('/dashboard', function () {
        $totalCourses = \App\Models\Course::where('instructor_id', Auth::user()->id)->count();
        $totalStudents = \App\Models\Enrollment::whereHas('course', function($q) {
            $q->where('instructor_id', Auth::user()->id);
        })->count();
        $totalRevenue = \App\Models\Payment::whereHas('course', function($q) {
            $q->where('instructor_id', Auth::user()->id);
        })->where('status', 'completed')->sum('amount');
        
        return view('instructor.dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue'));
    })->name('instructor.dashboard');
});

// Rute untuk student
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', function () {
        $enrolledCourses = \App\Models\Enrollment::where('user_id', Auth::id())
            ->with('course')
            ->get();
        $completedCourses = \App\Models\Enrollment::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
        $totalCertificates = \App\Models\Certificate::where('user_id', Auth::id())->count();
        
        return view('student.dashboard', compact('enrolledCourses', 'completedCourses', 'totalCertificates'));
    })->name('student.dashboard');
});

// Rute autentikasi (login, register, dll.)
require __DIR__.'/auth.php';