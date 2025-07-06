<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;

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
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->middleware('can:admin')
        ->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    // Instructor Routes
    Route::resource('instructors', InstructorController::class)
        ->middleware('can:admin');
        
    // Course Routes
    Route::resource('courses', CourseController::class)
        ->middleware('can:admin');
        
    // Program Routes
    Route::resource('programs', ProgramController::class)
        ->middleware('can:admin');
        
    // Department Routes
    Route::resource('departments', DepartmentController::class)
        ->middleware('can:admin');
        
    // Position Routes
    Route::resource('positions', PositionController::class)
        ->middleware('can:admin');
});
