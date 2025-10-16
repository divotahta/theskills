<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController as PublicCourseController;
use App\Http\Controllers\Auth\RegisteredUserController;

// ============================================================================
// PUBLIC ROUTES
// ============================================================================

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');

// Public pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Support pages
Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/support/help-center', function () {
    return view('support.help-center');
})->name('support.help-center');

Route::get('/support/privacy-policy', function () {
    return view('support.privacy-policy');
})->name('support.privacy-policy');

Route::get('/support/terms-of-service', function () {
    return view('support.terms-of-service');
})->name('support.terms-of-service');

Route::get('/support/faq', function () {
    return view('support.faq');
})->name('support.faq');

// Payment callbacks (no auth required)
Route::post('/payment/notification', [App\Http\Controllers\Student\PaymentController::class, 'notification'])
    ->name('payment.notification');
Route::get('/student/payment/success', [App\Http\Controllers\Student\PaymentController::class, 'success'])
    ->name('student.payment.success');
Route::get('/student/payment/failure', [App\Http\Controllers\Student\PaymentController::class, 'failure'])
    ->name('student.payment.failure');

// ============================================================================
// AUTHENTICATION ROUTES
// ============================================================================

// Guest routes (login/register)
Route::middleware('guest')->group(function () {
    // Student Registration
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Instructor Registration  
    Route::get('instructor/register', [RegisteredUserController::class, 'createInstructor'])
        ->name('instructor.register');
    Route::post('instructor/register', [RegisteredUserController::class, 'storeInstructor'])
        ->name('instructor.register.store');
});

// Include auth routes (login, logout, etc.)
require __DIR__ . '/auth.php';

// ============================================================================
// AUTHENTICATED ROUTES
// ============================================================================

Route::middleware(['auth'])->group(function () {
    // Dashboard redirect based on role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'instructor' => redirect()->route('instructor.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => redirect('/')
        };
    })->name('dashboard');
});

// ============================================================================
// ADMIN ROUTES
// ============================================================================

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Admin Profile
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])
            ->name('admin.profile.edit');
        Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])
            ->name('admin.profile.update');
        Route::get('/profile/show', [App\Http\Controllers\Admin\ProfileController::class, 'show'])
            ->name('admin.profile.show');
        Route::post('/profile/cover', [App\Http\Controllers\Admin\ProfileController::class, 'updateCover'])
            ->name('admin.profile.update-cover');
        Route::delete('/profile/avatar', [App\Http\Controllers\Admin\ProfileController::class, 'deleteAvatar'])
            ->name('admin.profile.delete-avatar');
    });

    // Admin Management Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Analytics
        Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])
            ->name('analytics.index');
        Route::get('/analytics/export', [App\Http\Controllers\Admin\AnalyticsController::class, 'export'])
            ->name('analytics.export');
        
        // Course Management
        Route::resource('courses', App\Http\Controllers\Admin\CourseController::class);
    Route::patch('/courses/{course}/toggle-status', [App\Http\Controllers\Admin\CourseController::class, 'toggleStatus'])
            ->name('courses.toggle-status');
    Route::get('/courses/{course}/learn', [App\Http\Controllers\Admin\CourseController::class, 'learn'])
            ->name('courses.learn');

        // Course Topics Management
        Route::prefix('courses/{course}')->group(function () {
            Route::get('/topics', [App\Http\Controllers\Admin\CourseController::class, 'topics'])
                ->name('courses.topics');
            Route::get('/topics/create', [App\Http\Controllers\Admin\CourseController::class, 'createTopic'])
                ->name('courses.topics.create');
            Route::post('/topics', [App\Http\Controllers\Admin\CourseController::class, 'storeTopic'])
                ->name('courses.topics.store');
            Route::get('/topics/{topic}/edit', [App\Http\Controllers\Admin\CourseController::class, 'editTopic'])
                ->name('courses.topics.edit');
            Route::put('/topics/{topic}', [App\Http\Controllers\Admin\CourseController::class, 'updateTopic'])
                ->name('courses.topics.update');
            Route::delete('/topics/{topic}', [App\Http\Controllers\Admin\CourseController::class, 'destroyTopic'])
                ->name('courses.topics.destroy');
        });

        // Course Contents Management
        Route::prefix('courses/{course}')->group(function () {
            Route::get('/contents', [App\Http\Controllers\Admin\CourseContentController::class, 'index'])
                ->name('courses.contents.index');
            Route::get('/contents/create', [App\Http\Controllers\Admin\CourseContentController::class, 'create'])
                ->name('courses.contents.create');
            Route::post('/contents', [App\Http\Controllers\Admin\CourseContentController::class, 'store'])
                ->name('courses.contents.store');
            Route::get('/contents/{courseContent}', [App\Http\Controllers\Admin\CourseContentController::class, 'show'])
                ->name('courses.contents.show');
            Route::get('/contents/{courseContent}/edit', [App\Http\Controllers\Admin\CourseContentController::class, 'edit'])
                ->name('courses.contents.edit');
            Route::put('/contents/{courseContent}', [App\Http\Controllers\Admin\CourseContentController::class, 'update'])
                ->name('courses.contents.update');
            Route::patch('/contents/{courseContent}/toggle-status', [App\Http\Controllers\Admin\CourseContentController::class, 'toggleStatus'])
                ->name('courses.contents.toggle-status');
            Route::delete('/contents/{courseContent}', [App\Http\Controllers\Admin\CourseContentController::class, 'destroy'])
                ->name('courses.contents.destroy');
        });

        // Course Progress Management
    Route::post('/courses/{course}/toggle-progress', [App\Http\Controllers\Admin\CourseController::class, 'toggleContentProgress'])
            ->name('courses.toggle-progress');
    Route::post('/courses/{course}/update-time', [App\Http\Controllers\Admin\CourseController::class, 'updateContentTime'])
            ->name('courses.update-time');

        // Category Management
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::patch('/categories/{category}/toggle-status', [App\Http\Controllers\Admin\CategoryController::class, 'toggleStatus'])
            ->name('categories.toggle-status');

        // User Management
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::patch('/users/{user}/toggle-verification', [App\Http\Controllers\Admin\UserController::class, 'toggleVerification'])
            ->name('users.toggle-verification');
        Route::get('/students', [App\Http\Controllers\Admin\UserController::class, 'students'])
            ->name('students.index');
        Route::get('/instructors', [App\Http\Controllers\Admin\UserController::class, 'instructors'])
            ->name('instructors.index');

        // Course Level Management
        Route::resource('course-levels', App\Http\Controllers\Admin\CourseLevelController::class);
        Route::patch('/course-levels/{courseLevel}/toggle-status', [App\Http\Controllers\Admin\CourseLevelController::class, 'toggleStatus'])
            ->name('course-levels.toggle-status');

        // Topic Management
        Route::resource('topics', App\Http\Controllers\Admin\TopicController::class);

        // Payment Management
        Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])
            ->name('payments.index');
        Route::post('/payments/{payment}/update-status', [App\Http\Controllers\Admin\PaymentController::class, 'updateStatus'])
            ->name('payments.update-status');
    });
});

// ============================================================================
// INSTRUCTOR ROUTES
// ============================================================================

Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
        // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Instructor\DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile Management
    Route::get('/profile/edit', [App\Http\Controllers\Instructor\ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Instructor\ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/profile', [App\Http\Controllers\Instructor\ProfileController::class, 'show'])
        ->name('profile.show');
        Route::post('/profile/cover', [App\Http\Controllers\Instructor\ProfileController::class, 'updateCover'])
            ->name('profile.update-cover');
        Route::delete('/profile/avatar', [App\Http\Controllers\Instructor\ProfileController::class, 'deleteAvatar'])
            ->name('profile.delete-avatar');

    // Course Management
    Route::resource('courses', App\Http\Controllers\Instructor\CourseController::class);
        Route::patch('/courses/{course}/toggle-status', [App\Http\Controllers\Instructor\CourseController::class, 'toggleStatus'])
            ->name('courses.toggle-status');
        Route::get('/courses/{course}/learn', [App\Http\Controllers\Instructor\CourseController::class, 'learn'])
            ->name('courses.learn');

        // Course Topics Management
    Route::prefix('courses/{course}')->group(function () {
        Route::get('/topics', [App\Http\Controllers\Instructor\CourseController::class, 'topics'])
            ->name('courses.topics');
        Route::get('/topics/create', [App\Http\Controllers\Instructor\CourseController::class, 'createTopic'])
            ->name('courses.topics.create');
        Route::post('/topics', [App\Http\Controllers\Instructor\CourseController::class, 'storeTopic'])
            ->name('courses.topics.store');
        Route::get('/topics/{topic}/edit', [App\Http\Controllers\Instructor\CourseController::class, 'editTopic'])
            ->name('courses.topics.edit');
        Route::put('/topics/{topic}', [App\Http\Controllers\Instructor\CourseController::class, 'updateTopic'])
            ->name('courses.topics.update');
        Route::delete('/topics/{topic}', [App\Http\Controllers\Instructor\CourseController::class, 'destroyTopic'])
            ->name('courses.topics.destroy');
    });

        // Course Contents Management
    Route::prefix('courses/{course}')->group(function () {
        Route::get('/contents', [App\Http\Controllers\Instructor\CourseContentController::class, 'index'])
            ->name('courses.contents.index');
        Route::get('/contents/create', [App\Http\Controllers\Instructor\CourseContentController::class, 'create'])
            ->name('courses.contents.create');
        Route::post('/contents', [App\Http\Controllers\Instructor\CourseContentController::class, 'store'])
            ->name('courses.contents.store');
        Route::get('/contents/{courseContent}', [App\Http\Controllers\Instructor\CourseContentController::class, 'show'])
            ->name('courses.contents.show');
        Route::get('/contents/{courseContent}/edit', [App\Http\Controllers\Instructor\CourseContentController::class, 'edit'])
            ->name('courses.contents.edit');
        Route::put('/contents/{courseContent}', [App\Http\Controllers\Instructor\CourseContentController::class, 'update'])
            ->name('courses.contents.update');
        Route::delete('/contents/{courseContent}', [App\Http\Controllers\Instructor\CourseContentController::class, 'destroy'])
            ->name('courses.contents.destroy');
        Route::patch('/contents/{courseContent}/toggle-status', [App\Http\Controllers\Instructor\CourseContentController::class, 'toggleStatus'])
            ->name('courses.contents.toggle-status');
    });

        // Course Progress Management
        Route::post('/courses/{course}/toggle-progress', [App\Http\Controllers\Instructor\CourseController::class, 'toggleContentProgress'])
            ->name('courses.toggle-progress');

    // Student Management
    Route::get('/students', [App\Http\Controllers\Instructor\StudentController::class, 'index'])
        ->name('students.index');
    Route::get('/students/{student}', [App\Http\Controllers\Instructor\StudentController::class, 'show'])
        ->name('students.show');
    Route::get('/students/{student}/courses/{course}/progress', [App\Http\Controllers\Instructor\StudentController::class, 'progress'])
        ->name('students.progress');
    Route::get('/students/export', [App\Http\Controllers\Instructor\StudentController::class, 'export'])
        ->name('students.export');

        // Analytics
    Route::get('/analytics', [App\Http\Controllers\Instructor\AnalyticsController::class, 'index'])
        ->name('analytics.index');
    Route::get('/analytics/export', [App\Http\Controllers\Instructor\AnalyticsController::class, 'export'])
        ->name('analytics.export');

        // Categories
    Route::post('/categories', [App\Http\Controllers\Instructor\CategoryController::class, 'store'])
        ->name('categories.store');

    // AJAX routes for notifications (must be before main routes to avoid conflicts)
    Route::get('/notifications/recent', [App\Http\Controllers\Instructor\NotificationController::class, 'getRecent'])
        ->name('notifications.recent');
    Route::get('/notifications/unread-count', [App\Http\Controllers\Instructor\NotificationController::class, 'getUnreadCount'])
        ->name('notifications.unread-count');
    
    // Notifications (main routes)
    Route::get('/notifications', [App\Http\Controllers\Instructor\NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::get('/notifications/{notification}', [App\Http\Controllers\Instructor\NotificationController::class, 'show'])
        ->name('notifications.show');
    Route::post('/notifications/{notification}/mark-read', [App\Http\Controllers\Instructor\NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');
    Route::post('/notifications/{notification}/mark-unread', [App\Http\Controllers\Instructor\NotificationController::class, 'markAsUnread'])
        ->name('notifications.mark-unread');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\Instructor\NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [App\Http\Controllers\Instructor\NotificationController::class, 'destroy'])
        ->name('notifications.destroy');
});


// ============================================================================
// STUDENT ROUTES
// ============================================================================

// Notifications routes (moved outside main group to avoid conflicts)
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/notifications/recent', [App\Http\Controllers\Student\NotificationController::class, 'getRecent'])
        ->name('notifications.recent');
    Route::get('/notifications/unread-count', [App\Http\Controllers\Student\NotificationController::class, 'getUnreadCount'])
        ->name('notifications.unread-count');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\Student\ProfileController::class, 'show'])
        ->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\Student\ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Student\ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile/avatar', [App\Http\Controllers\Student\ProfileController::class, 'deleteAvatar'])
        ->name('profile.delete-avatar');
    Route::post('/profile/cover', [App\Http\Controllers\Student\ProfileController::class, 'updateCover'])
        ->name('profile.update-cover');

    // Course Management
    Route::get('/courses', [App\Http\Controllers\Student\CourseController::class, 'index'])
        ->name('courses.index');
    Route::get('/courses/browse', [App\Http\Controllers\Student\CourseController::class, 'browse'])
        ->name('courses.browse');
    Route::get('/courses/{course}', [App\Http\Controllers\Student\CourseController::class, 'show'])
        ->name('courses.show');
    Route::post('/courses/{course}/enroll', [App\Http\Controllers\Student\CourseController::class, 'enroll'])
        ->name('courses.enroll');
    Route::get('/courses/{course}/learn', [App\Http\Controllers\Student\CourseController::class, 'learn'])
        ->name('courses.learn');
    Route::post('/courses/{course}/toggle-progress', [App\Http\Controllers\Student\CourseController::class, 'toggleContentProgress'])
        ->name('courses.toggle-progress');
    Route::post('/courses/{course}/update-time', [App\Http\Controllers\Student\CourseController::class, 'updateContentTime'])
        ->name('courses.update-time');

    // Payment Management
    Route::get('/payment/{course}', [App\Http\Controllers\Student\PaymentController::class, 'show'])
        ->name('payment.show');
    Route::post('/payment/{course}/create', [App\Http\Controllers\Student\PaymentController::class, 'create'])
        ->name('payment.create');
    Route::get('/payment/{payment}/status', [App\Http\Controllers\Student\PaymentController::class, 'checkStatus'])
        ->name('payment.status');
    Route::post('/payment/{payment}/update-status', [App\Http\Controllers\Student\PaymentController::class, 'updateStatus'])
        ->name('payment.update-status');

    // Payment History
    Route::get('/payment-history', [App\Http\Controllers\Student\PaymentHistoryController::class, 'index'])
        ->name('payment.history');
    Route::get('/payment/{payment}/details', [App\Http\Controllers\Student\PaymentHistoryController::class, 'show'])
        ->name('payment.details');

    // Progress Tracking
    Route::get('/progress', [App\Http\Controllers\Student\ProgressController::class, 'index'])
        ->name('progress');

    // Certificates
    Route::get('/certificates', [App\Http\Controllers\Student\CertificateController::class, 'index'])
        ->name('certificates');
    Route::get('/certificates/{certificate}/download', [App\Http\Controllers\Student\CertificateController::class, 'download'])
        ->name('certificates.download');
    Route::post('/certificates/generate', [App\Http\Controllers\Student\CertificateController::class, 'generate'])
        ->name('certificates.generate');

    // Notifications (main routes)
    Route::get('/notifications', [App\Http\Controllers\Student\NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::get('/notifications/{notification}', [App\Http\Controllers\Student\NotificationController::class, 'show'])
        ->name('notifications.show');
    Route::post('/notifications/{notification}/mark-read', [App\Http\Controllers\Student\NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');
    Route::post('/notifications/{notification}/mark-unread', [App\Http\Controllers\Student\NotificationController::class, 'markAsUnread'])
        ->name('notifications.mark-unread');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\Student\NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [App\Http\Controllers\Student\NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    // Settings
        Route::get('/settings', function () {
            return view('student.settings-tutor');
        })->name('settings');
    });