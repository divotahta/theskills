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
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Debug route for file upload testing
Route::post('/debug-upload', function(Request $request) {
    \Log::info('Debug upload request:', [
        'has_file' => $request->hasFile('thumbnail'),
        'file_valid' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->isValid() : 'no file',
        'file_size' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->getSize() : 'no file',
        'file_error' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->getError() : 'no file',
        'file_path' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->path() : 'no file',
        'all_files' => $request->allFiles()
    ]);
    
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        try {
            $path = $file->store('test-uploads', 'public');
            return response()->json(['success' => true, 'path' => $path]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    
    return response()->json(['success' => false, 'error' => 'No file uploaded']);
});

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
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin profile routes
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/admin/profile/show', [AdminProfileController::class, 'show'])->name('admin.profile.show');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Course management routes
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])
        ->name('admin.courses.index');
    
    Route::get('/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])
        ->name('admin.courses.create');
    
    Route::post('/courses', [App\Http\Controllers\Admin\CourseController::class, 'store'])
        ->name('admin.courses.store');
    
    Route::get('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'show'])
        ->name('admin.courses.show');
    
    Route::get('/courses/{course}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])
        ->name('admin.courses.edit');
    
    Route::put('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])
        ->name('admin.courses.update');
    
    Route::patch('/courses/{course}/toggle-status', [App\Http\Controllers\Admin\CourseController::class, 'toggleStatus'])
        ->name('admin.courses.toggle-status');
    
    Route::delete('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])
        ->name('admin.courses.destroy');
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
        
        // Student course routes
        Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
        Route::post('/courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
        Route::post('/courses/{course}/unenroll', [StudentCourseController::class, 'unenroll'])->name('courses.unenroll');
        Route::get('/my-courses', [StudentCourseController::class, 'myCourses'])->name('courses.my-courses');
        Route::get('/courses/{course}/learn', [StudentCourseController::class, 'learn'])->name('courses.learn');
        Route::post('/courses/{course}/review', [StudentCourseController::class, 'review'])->name('courses.review');
        Route::get('/courses/{course}/statistics', [StudentCourseController::class, 'statistics'])->name('courses.statistics');
        Route::post('/courses/{course}/progress', [StudentCourseController::class, 'updateProgress'])->name('courses.progress');
        Route::get('/courses/category/{category}', [StudentCourseController::class, 'category'])->name('courses.category');
        Route::get('/courses/search', [StudentCourseController::class, 'search'])->name('courses.search');
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
