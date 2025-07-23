<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admission\AdmissionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Public routes
Route::get('/login', function () {
    return view('login');
})->name('login');

// Admission routes
Route::get('/admission', [AdmissionController::class, 'create'])->name('admission.create');
Route::post('/admission', [AdmissionController::class, 'store'])->name('admission.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Department routes
        Route::resource('departments', DepartmentController::class);

        // Position routes
        Route::resource('positions', PositionController::class);

        // Instructor routes
        Route::resource('instructors', InstructorController::class);

        // Course routes
        Route::resource('courses', CourseController::class);

        // Program routes
        Route::resource('programs', ProgramController::class);

        // Student routes
        Route::resource('students', StudentController::class);

        // Admin Enrollment Routes
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/enrollments/pending', [EnrollmentController::class, 'pending'])->name('enrollments.pending');
        Route::get('/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::post('/enrollments/{enrollment}/approve', [EnrollmentController::class, 'approve'])->name('enrollments.approve');

        // Schedule routes
        Route::resource('schedules', ScheduleController::class);

        // Admission routes
        Route::resource('admissions', AdmissionController::class)->except(['create', 'store']);
        Route::post('admissions/{admission}/approve', [AdmissionController::class, 'approve'])->name('admissions.approve');
        Route::post('admissions/{admission}/reject', [AdmissionController::class, 'reject'])->name('admissions.reject');

    });
});

// Student routes
Route::prefix('student')->name('student.')->group(function () {
    // Public student routes
    Route::get('/login', function () {
        return view('student.login');
    })->name('login');
    Route::post('/login', [StudentController::class, 'login'])->name('login.submit');


    // Registration routes
    Route::get('/register', function () {
        $programs = \App\Models\Program::all();
        return view('student.register', compact('programs'));
    })->name('register');
    Route::post('/register', [StudentController::class, 'processAdmission'])->name('register.submit');

    // Protected student routes
    Route::middleware(['auth', \App\Http\Middleware\StudentMiddleware::class])->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

        // Profile routes
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');

        // Enrollment routes
        Route::get('/enroll', [StudentController::class, 'showEnrollmentForm'])->name('enroll');
        Route::post('/enroll', [StudentController::class, 'processEnrollment'])->name('enrollment.store');
        Route::get('/enrollment/{enrollment}', [StudentController::class, 'showEnrollmentDetails'])->name('enrollment.show');

        // Admission routes
        Route::get('/admission', [StudentController::class, 'showAdmissionForm'])->name('admission.index');
        Route::post('/admission', [StudentController::class, 'processAdmission'])->name('admission.store');
        Route::get('/admission/{admission}', [StudentController::class, 'showAdmissionDetails'])->name('admission.show');
    });
});
