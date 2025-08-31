<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Program;

class AdminController extends Controller
{
    /**
     * Show the admin login page
     */
    public function showLoginForm(): View
    {
        return view('login');
    }
    
    /**
     * Handle admin login request
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            // If not admin, logout and redirect back with error
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ])->onlyInput('email');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    /**
     * Show the admin dashboard
     */
    public function dashboard(): View
    {
        $studentCount = Student::count();
        $instructorCount = Instructor::count();
        $courseCount = Course::count();
        $programCount = Program::count();
        $recentEnrollments = Student::whereHas('enrollments', function($query) {
            $query->where('status', 'Enrolled');
        })->with(['program', 'enrollments' => function($query) {
            $query->where('status', 'Enrolled')->latest('date_enrolled');
        }])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'studentCount',
            'instructorCount',
            'courseCount',
            'programCount',
            'recentEnrollments'
        ));
    }
    
    /**
     * Handle admin logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('login');
    }
}