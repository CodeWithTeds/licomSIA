<?php

namespace App\Http\Controllers;


use App\Http\Requests\StudentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('program')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('admin.students.create', compact('programs'));
    }

    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load('program');
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $programs = Program::all();
        return view('admin.students.edit', compact('student', 'programs'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }

    // Student Dashboard Methods
    public function dashboard()
    {
        $student = Auth::user()->student;
        $enrollments = $student->enrollments()->orderBy('created_at', 'desc')->get();
        return view('student.dashboard', compact('student', 'enrollments'));
    }

    public function profile()
    {
        $student = Auth::user()->student;
        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student;
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $student->update($validated);
        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

    // Enrollment Methods
    public function showEnrollmentForm()
    {
        $student = Auth::user()->student;
        $program = $student->program;
        $courses = Course::where('program_id', $program->program_id)->get();
        $schedules = Schedule::with('course')->get();
        
        // Get current school year and semester
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $schoolYear = $currentYear . '-' . $nextYear;
        
        // Determine semester based on current month
        $currentMonth = date('n');
        $semester = $currentMonth >= 6 && $currentMonth <= 10 ? 'First' : 'Second';
        
        return view('student.enrollment.create', compact('student', 'program', 'courses', 'schedules', 'schoolYear', 'semester'));
    }

    public function processEnrollment(Request $request)
    {
        $request->validate([
            'school_year' => 'required|string|max:10',
            'semester' => 'required|string|max:10',
            'courses' => 'required|array|min:1',
            'courses.*' => 'exists:courses,course_id',
        ]);

        DB::beginTransaction();
        try {
            $student = Auth::user()->student;
            
            // Create enrollment record
            $enrollment = Enrollment::create([
                'student_id' => $student->student_id,
                'school_year' => $request->school_year,
                'semester' => $request->semester,
                'date_enrolled' => Carbon::now(),
                'status' => 'Pending',
            ]);
            
            // Add courses to enrollment
            foreach ($request->courses as $courseId) {
                $enrollment->enrollmentCourses()->create([
                    'course_id' => $courseId,
                ]);
            }
            
            DB::commit();
            return redirect()->route('student.dashboard')->with('success', 'Enrollment submitted successfully. Please wait for approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred during enrollment: ' . $e->getMessage())->withInput();
        }
    }

    public function showEnrollmentDetails(Enrollment $enrollment)
    {
        $student = Auth::user()->student;
        
        // Make sure the enrollment belongs to the logged-in student
        if ($enrollment->student_id !== $student->student_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $enrollment->load(['enrollmentCourses.course', 'enrollmentCourses.course.schedules']);
        
        return view('student.enrollment.show', compact('enrollment'));
    }

    // Admission Methods
    public function showAdmissionForm()
    {
        $programs = Program::all();
        return view('student.admission.create', compact('programs'));
    }

    public function processAdmission(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:students,email',
            'program_id' => 'required|exists:programs,program_id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Create user account
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);
            
            // Generate student number (e.g., 2023-0001)
            $year = date('Y');
            $lastStudent = Student::where('student_number', 'like', $year . '-%')
                ->orderBy('student_number', 'desc')
                ->first();
                
            if ($lastStudent) {
                $lastNumber = intval(substr($lastStudent->student_number, 5));
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            $studentNumber = $year . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            
            // Create student record
            Student::create([
                'user_id' => $user->id,
                'student_number' => $studentNumber,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'program_id' => $request->program_id,
            ]);
            
            DB::commit();
            
            // Log the user in
            Auth::login($user);
            
            return redirect()->route('student.dashboard')->with('success', 'Your admission has been processed successfully. Welcome to our institution!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred during admission: ' . $e->getMessage())->withInput();
        }
    }
} 