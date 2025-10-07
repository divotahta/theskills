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
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseLevelController as AdminCourseLevelController;
use App\Http\Controllers\Admin\TopicController as AdminTopicController;



// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/courses', function () {
    return view('courses');
})->name('courses.index');
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

// Student routes
Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile/edit', function () {
        return view('student.profile.edit');
    })->name('profile.edit');
    
    // Course routes
    Route::get('/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/my-courses', [App\Http\Controllers\Student\CourseController::class, 'myCourses'])->name('courses.my-courses');
    Route::get('/courses/{course}', [App\Http\Controllers\Student\CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/learn', [App\Http\Controllers\Student\CourseController::class, 'learn'])->name('courses.learn');
    Route::post('/courses/{course}/enroll', [App\Http\Controllers\Student\CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/courses/{course}/progress', [App\Http\Controllers\Student\CourseController::class, 'updateProgress'])->name('courses.progress');
    Route::post('/courses/{course}/complete', [App\Http\Controllers\Student\CourseController::class, 'markCompleted'])->name('courses.complete');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin profile routes
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/admin/profile/show', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::post('/admin/profile/cover', [AdminProfileController::class, 'updateCover'])->name('admin.profile.update-cover');
    Route::delete('/admin/profile/avatar', [AdminProfileController::class, 'deleteAvatar'])->name('admin.profile.delete-avatar');
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
    
    Route::get('/courses/{course}/learn', [App\Http\Controllers\Admin\CourseController::class, 'learn'])
        ->name('admin.courses.learn');
    
    Route::delete('/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'destroy'])
        ->name('admin.courses.destroy');
    
    // Course Topic management routes (nested under courses)
    Route::get('/courses/{course}/topics', [App\Http\Controllers\Admin\CourseController::class, 'topics'])
        ->name('admin.courses.topics');
    Route::get('/courses/{course}/topics/create', [App\Http\Controllers\Admin\CourseController::class, 'createTopic'])
        ->name('admin.courses.topics.create');
    Route::post('/courses/{course}/topics', [App\Http\Controllers\Admin\CourseController::class, 'storeTopic'])
        ->name('admin.courses.topics.store');
    Route::get('/courses/{course}/topics/{topic}/edit', [App\Http\Controllers\Admin\CourseController::class, 'editTopic'])
        ->name('admin.courses.topics.edit');
    Route::put('/courses/{course}/topics/{topic}', [App\Http\Controllers\Admin\CourseController::class, 'updateTopic'])
        ->name('admin.courses.topics.update');
    Route::delete('/courses/{course}/topics/{topic}', [App\Http\Controllers\Admin\CourseController::class, 'destroyTopic'])
        ->name('admin.courses.topics.destroy');

    // Course Content management routes (nested under courses)
    Route::get('/courses/{course}/contents', [CourseContentController::class, 'index'])
        ->name('admin.courses.contents.index');
    
    Route::get('/courses/{course}/contents/create', [CourseContentController::class, 'create'])
        ->name('admin.courses.contents.create');
    
    Route::post('/courses/{course}/contents', [CourseContentController::class, 'store'])
        ->name('admin.courses.contents.store');
    
    Route::get('/courses/{course}/contents/{courseContent}', [CourseContentController::class, 'show'])
        ->name('admin.courses.contents.show');
    
    Route::get('/courses/{course}/contents/{courseContent}/edit', [CourseContentController::class, 'edit'])
        ->name('admin.courses.contents.edit');
    
    Route::put('/courses/{course}/contents/{courseContent}', [CourseContentController::class, 'update'])
        ->name('admin.courses.contents.update');
    
    Route::patch('/courses/{course}/contents/{courseContent}/toggle-status', [CourseContentController::class, 'toggleStatus'])
        ->name('admin.courses.contents.toggle-status');
    
    Route::delete('/courses/{course}/contents/{courseContent}', [CourseContentController::class, 'destroy'])
        ->name('admin.courses.contents.destroy');
    
    // Course Progress tracking routes
    Route::post('/courses/{course}/toggle-progress', [App\Http\Controllers\Admin\CourseController::class, 'toggleContentProgress'])
        ->name('admin.courses.toggle-progress');
    Route::post('/courses/{course}/update-time', [App\Http\Controllers\Admin\CourseController::class, 'updateContentTime'])
        ->name('admin.courses.update-time');
    
    // Category management routes
    Route::get('/categories', [AdminCategoryController::class, 'index'])
        ->name('admin.categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])
        ->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])
        ->name('admin.categories.store');
    Route::get('/categories/{category}', [AdminCategoryController::class, 'show'])
        ->name('admin.categories.show');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])
        ->name('admin.categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])
        ->name('admin.categories.update');
    Route::patch('/categories/{category}/toggle-status', [AdminCategoryController::class, 'toggleStatus'])
        ->name('admin.categories.toggle-status');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])
        ->name('admin.categories.destroy');
    
    // User management routes
    Route::get('/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])
        ->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])
        ->name('admin.users.store');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])
        ->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])
        ->name('admin.users.update');
    Route::patch('/users/{user}/toggle-verification', [AdminUserController::class, 'toggleVerification'])
        ->name('admin.users.toggle-verification');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');
    
    // Specific user type routes
    Route::get('/students', [AdminUserController::class, 'students'])
        ->name('admin.students.index');
    Route::get('/instructors', [AdminUserController::class, 'instructors'])
        ->name('admin.instructors.index');
    
    // Course Level management routes
    Route::get('/course-levels', [AdminCourseLevelController::class, 'index'])
        ->name('admin.course-levels.index');
    Route::get('/course-levels/create', [AdminCourseLevelController::class, 'create'])
        ->name('admin.course-levels.create');
    Route::post('/course-levels', [AdminCourseLevelController::class, 'store'])
        ->name('admin.course-levels.store');
    Route::get('/course-levels/{courseLevel}', [AdminCourseLevelController::class, 'show'])
        ->name('admin.course-levels.show');
    Route::get('/course-levels/{courseLevel}/edit', [AdminCourseLevelController::class, 'edit'])
        ->name('admin.course-levels.edit');
    Route::put('/course-levels/{courseLevel}', [AdminCourseLevelController::class, 'update'])
        ->name('admin.course-levels.update');
    Route::patch('/course-levels/{courseLevel}/toggle-status', [AdminCourseLevelController::class, 'toggleStatus'])
        ->name('admin.course-levels.toggle-status');
    Route::delete('/course-levels/{courseLevel}', [AdminCourseLevelController::class, 'destroy'])
        ->name('admin.course-levels.destroy');

    // Topic management routes
    Route::get('/topics', [AdminTopicController::class, 'index'])
        ->name('admin.topics.index');
    Route::get('/topics/create', [AdminTopicController::class, 'create'])
        ->name('admin.topics.create');
    Route::post('/topics', [AdminTopicController::class, 'store'])
        ->name('admin.topics.store');
    Route::get('/topics/{topic}', [AdminTopicController::class, 'show'])
        ->name('admin.topics.show');
    Route::get('/topics/{topic}/edit', [AdminTopicController::class, 'edit'])
        ->name('admin.topics.edit');
    Route::put('/topics/{topic}', [AdminTopicController::class, 'update'])
        ->name('admin.topics.update');
    Route::delete('/topics/{topic}', [AdminTopicController::class, 'destroy'])
        ->name('admin.topics.destroy');
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
        Route::post('/profile/cover', [InstructorProfileController::class, 'updateCover'])->name('profile.update-cover');
        
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
        
        // Student profile routes
        Route::get('/profile', [StudentProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/avatar', [StudentProfileController::class, 'deleteAvatar'])->name('profile.delete-avatar');
        Route::post('/profile/cover', [StudentProfileController::class, 'updateCover'])->name('profile.update-cover');
        
        // Student course routes
        Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/browse', [StudentCourseController::class, 'browse'])->name('courses.browse');
        Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
        Route::post('/courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course}/learn', [StudentCourseController::class, 'learn'])->name('courses.learn');
        Route::post('/courses/{course}/toggle-progress', [StudentCourseController::class, 'toggleContentProgress'])->name('courses.toggle-progress');
        Route::post('/courses/{course}/update-time', [StudentCourseController::class, 'updateContentTime'])->name('courses.update-time');
        
        // Additional student routes
        Route::get('/progress', function() {
            return view('student.progress-tutor');
        })->name('progress');
        
        Route::get('/certificates', function() {
            return view('student.certificates-tutor');
        })->name('certificates');
        
        Route::get('/settings', function() {
            return view('student.settings-tutor');
        })->name('settings');
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
