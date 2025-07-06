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

Route::get('/login', function () {
    return view('login');
});

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Instructor Routes
    Route::resource('instructors', InstructorController::class);
        
    // Course Routes
    Route::resource('courses', CourseController::class);
        
    // Program Routes
    Route::resource('programs', ProgramController::class);
        
    // Department Routes
    Route::resource('departments', DepartmentController::class);
        
    // Position Routes
    Route::resource('positions', PositionController::class);

    // Student profile routes
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::put('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    
    // Admin routes for student management
    Route::prefix('admin')->group(function () {
        // Student management
        Route::resource('students', StudentController::class);
    });
});
