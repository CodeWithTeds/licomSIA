<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('landing');
});

// Student Routes
Route::get('/student/register', [StudentController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentController::class, 'register'])->name('student.register.post');
Route::get('/student/login', [StudentController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentController::class, 'login'])->name('student.login.post');

// Student authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->middleware('can:student')
        ->name('student.dashboard');
    Route::post('/student/logout', [StudentController::class, 'logout'])->name('student.logout');
});

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('can:admin')->name('admin.dashboard');

    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Instructor Routes
    Route::resource('instructors', InstructorController::class)->middleware('can:admin');
        
    // Course Routes
    Route::resource('courses', CourseController::class) ->middleware('can:admin');
        
    // Program Routes
    Route::resource('programs', ProgramController::class)->middleware('can:admin');
        
    // Department Routes
    Route::resource('departments', DepartmentController::class)->middleware('can:admin');
        
    // Position Routes
    Route::resource('positions', PositionController::class)->middleware('can:admin');

    // Student profile routes
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::put('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    
    // Admin routes for student management
    Route::prefix('admin')->group(function () {
        // Student management
        Route::resource('students', StudentController::class);
    });
});
