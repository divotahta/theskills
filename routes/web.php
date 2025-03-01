<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Instructor\CategoryController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;
use App\Http\Controllers\CourseController as PublicCourseController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Instructor\DashboardController as InstructorDashboardController;
use App\Http\Controllers\Instructor\ProfileController as InstructorProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
// use App\Http\Controllers\Instructor\CourseController;

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
    Route::prefix('instructor')->name('instructor.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
        
        // Profile
        Route::get('/profile/edit', [InstructorProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [InstructorProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/{instructor}', [InstructorProfileController::class, 'show'])->name('profile.show');
        
        // Courses
        Route::get('/courses', [InstructorCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [InstructorCourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [InstructorCourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [InstructorCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [InstructorCourseController::class, 'update'])->name('courses.update');
        
        // Categories
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    });
});

// Student routes  
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    });
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
