<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;

class InstructorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('instructor')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('teacher.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();

        $classCount = $instructor->courses()->count();
        $studentCount = $instructor->students()->count();
        $schedule = $instructor->today_schedules()->with('course')->get();

        // Placeholder data for assignments and messages
        $assignmentsDue = 8;
        $unreadMessages = 3;

        return view('teacher.dashboard', compact(
            'classCount',
            'studentCount',
            'assignmentsDue',
            'unreadMessages',
            'schedule'
        ));
    }

    public function myCourses()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $courses = $instructor->courses()->with('program')->paginate(10);
        return view('teacher.my_courses', compact('courses'));
    }

    public function myStudents()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $students = $instructor->students()->with('program')->paginate(10);
        return view('teacher.my_students', compact('students'));
    }

    public function mySchedule()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $schedules = $instructor->schedules()->with('course')->paginate(10);
        return view('teacher.my_schedule', compact('schedules'));
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}
