<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', 'admin'])->group(function () {
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
    });
});

// Student routes
Route::prefix('student')->name('student.')->group(function () {
    // Public student routes
    Route::get('/login', function () {
        return view('student.login');
    })->name('login');
    Route::post('/login', [StudentController::class, 'login'])->name('login.submit');
    
    // Admission routes
    Route::get('/admission', [StudentController::class, 'showAdmissionForm'])->name('admission.create');
    Route::post('/admission', [StudentController::class, 'processAdmission'])->name('admission.store');

    // Protected student routes
    Route::middleware(['auth', 'student'])->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [StudentController::class, 'logout'])->name('logout');
        
        // Profile routes
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
        
        // Enrollment routes
        Route::get('/enrollment', [StudentController::class, 'showEnrollmentForm'])->name('enrollment.create');
        Route::post('/enrollment', [StudentController::class, 'processEnrollment'])->name('enrollment.store');
        Route::get('/enrollment/{enrollment}', [StudentController::class, 'showEnrollmentDetails'])->name('enrollment.show');
    });
});
