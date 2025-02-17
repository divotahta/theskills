<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Instructor\CategoryController;
use App\Http\Controllers\Instructor\CourseController;
use App\Http\Controllers\CourseController as PublicCourseController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ProfileController as InstructorProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/courses', [PublicCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [PublicCourseController::class, 'show'])->name('courses.show');

// Auth routes
Route::middleware(['auth'])->group(function () {
    // Dashboard routes based on role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        } elseif (Auth::user()->role === 'student') {
            return redirect()->route('student.dashboard');
        }
        return redirect('/');
    })->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])
        ->name('admin.courses.create');

    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])
        ->name('admin.courses.store');

    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])
        ->name('admin.courses.index');
});

// Instructor routes
Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [DashboardController::class, 'index'])->name('instructor.dashboard');
    Route::get('/instructor/profile', [InstructorProfileController::class, 'edit'])->name('instructor.profile.edit');
    Route::put('/instructor/profile', [InstructorProfileController::class, 'update'])->name('instructor.profile.update');
});
Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    // Course routes - hanya gunakan method yang diperlukan
    Route::resource('courses', CourseController::class)->except(['show', 'destroy']);

    // Category routes
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
});

// Student routes  
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');
    Route::get('/student/profile', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::put('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
});
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/courses', function () {
        $enrolledCourses = \App\Models\Enrollment::where('user_id', Auth::id())
            ->with(['course' => function ($q) {
                $q->with('instructor');
            }])
            ->latest()
            ->get();

        return view('student.courses.index', compact('enrolledCourses'));
    })->name('student.courses.index');
});

// Auth routes
Route::middleware('guest')->group(function () {
    // Student Registration
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Instructor Registration  
    Route::get('instructor/register', [RegisteredUserController::class, 'createInstructor'])
        ->name('instructor.register');
    Route::post('instructor/register', [RegisteredUserController::class, 'storeInstructor'])
        ->name('instructor.register.store');
});

// Auth routes
require __DIR__ . '/auth.php';
