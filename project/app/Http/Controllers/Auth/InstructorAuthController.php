<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;
use App\Models\Program;

class InstructorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('/login');
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

    public function myStudents(Request $request)
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $query = $instructor->students()->with('program');

        // Apply filters
        if ($request->filled('program')) {
            $query->where('program_id', $request->program);
        }

        if ($request->filled('year_level')) {
            $query->where('year_level', $request->year_level);
        }

        $students = $query->paginate(10)->withQueryString();
        $programs = \App\Models\Program::orderBy('program_name')->get();

        return view('teacher.my_students', compact('students', 'programs'));
    }

    public function mySchedule()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $schedules = $instructor->schedules()->with('course')->get();

        $daysOfWeek = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];

        $scheduleByDay = collect($daysOfWeek)->mapWithKeys(function ($day) use ($schedules) {
            return [$day => $schedules->where('day', $day)->sortBy('start_time')];
        });

        return view('teacher.my_schedule', compact('scheduleByDay'));
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
