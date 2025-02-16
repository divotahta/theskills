<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Instructor\CategoryController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\CourseController as PublicCourseController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses', [PublicCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [PublicCourseController::class, 'show'])->name('courses.show');

// Auth routes
Route::middleware(['auth'])->group(function () {
    // Dashboard routes based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        } elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
        
        return view('dashboard');
    })->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Instructor routes
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', function () {
        return view('instructor.dashboard');
    })->name('instructor.dashboard');
});

// Student routes  
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

// Rute untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])
        ->name('admin.courses.create');
    
    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])
        ->name('admin.courses.store');
    
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])
        ->name('admin.courses.index');
});

// Rute untuk instructor
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    // Course routes - hanya gunakan method yang diperlukan
    Route::resource('courses', CourseController::class)->except(['show', 'destroy']);

    // Category routes
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
});

// Rute untuk student
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/courses', function () {
        $enrolledCourses = \App\Models\Enrollment::where('user_id', Auth::id())
            ->with(['course' => function($q) {
                $q->with('instructor');
            }])
            ->latest()
            ->get();
            
        return view('student.courses.index', compact('enrolledCourses'));
    })->name('student.courses.index');
});

// Auth routes
require __DIR__.'/auth.php';