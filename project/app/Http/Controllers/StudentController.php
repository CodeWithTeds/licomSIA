<?php

namespace App\Http\Controllers;


use App\Http\Requests\StudentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\EnrollmentCourse;
use App\Models\Instructor;
use App\Models\Program;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;
use App\Models\Grade;
use App\Models\Admission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['program', 'enrollments.courses']);

        if ($request->filled('program')) {
            $query->where('program_id', $request->program);
        }

        if ($request->filled('course')) {
            $query->whereHas('enrollments.courses', function($q) use ($request) {
                $q->where('course_id', $request->course);
            });
        }

        if ($request->filled('year_level')) {
            $query->where('year_level', $request->year_level);
        }

        $students = $query->paginate(10)->withQueryString();
        $programs = Program::orderBy('program_name')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('admin.students.index', compact('students', 'programs', 'courses'));
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

    // Authentication Methods
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'student') {
                return redirect()->intended(route('student.dashboard'));
            }
            
            // If not a student, logout and redirect back with error
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have student access.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
        $programs = Program::all();
        return view('student.register', compact('programs'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'program_id' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|min:1|max:4',
            'birthdate' => 'required|date',
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        // Generate a unique student number
        $studentNumber = date('Y') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT);

        // Create a corresponding student record
        Student::create([
            'user_id' => $user->id,
            'student_number' => $studentNumber,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'program_id' => $request->program_id,
            'year_level' => $request->year_level,
            'birthdate' => $request->birthdate,
        ]);

        Auth::login($user);

        return redirect()->route('student.dashboard');
    }

    // Student Dashboard Methods
    public function dashboard()
    {
        $student = Auth::user()->student;
        $studentCount = Student::count();
        $instructorCount = Instructor::count();
        $courseCount = Course::count();
        $programCount = Program::count();

        return view('student.dashboard', compact(
            'student',
            'studentCount',
            'instructorCount',
            'courseCount',
            'programCount'
        ));
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
        
        // Check if student already has a pending or active enrollment
        $activeEnrollment = $student->enrollments()
                                   ->whereIn('status', ['Pending', 'Approved', 'Enrolled'])
                                   ->latest()
                                   ->first();
        
        if ($activeEnrollment) {
            // Redirect to enrollment details page with a message
            return redirect()->route('student.enrollment.show', $activeEnrollment)
                             ->with('info', 'You already have an active enrollment. You cannot enroll in multiple programs simultaneously.');
        }
        
        $program = $student->program;
        
        // Filter courses by program_id and year_level
        $courses = Course::where('program_id', $program->program_id)
                         ->where('year_level', $student->year_level)
                         ->get();
                         
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
            'year_level' => 'required|integer|min:1|max:4',
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
                'year_level' => $request->year_level,
                'date_enrolled' => Carbon::now()->toDateString(),
                'status' => 'Pending',
            ]);
            
            // Add courses to enrollment
            foreach ($request->courses as $courseId) {
                $enrollment->enrollmentCourses()->create([
                    'course_id' => $courseId,
                ]);
            }
            
            DB::commit();
            return redirect()->route('student.enrollment.show', $enrollment)->with('success', 'Enrollment submitted successfully. Please wait for approval.');
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
        
        $enrollment->load(['enrollmentCourses.course.schedules', 'enrollmentCourses.course.grades' => function ($query) use ($student) {
            $query->where('student_id', $student->student_id);
        }]);
        
        return view('student.enrollment.show', compact('enrollment'));
    }

    // Admission Methods
    public function showAdmissionForm()
    {
        $student = Auth::user()->student;
        $admission = Admission::where('user_id', $student->user_id)->latest()->first();

        if ($admission) {
            // Redirect to the appropriate view based on admission status
            switch ($admission->application_status) {
                case 'Pending':
                    return redirect()->route('student.admission.pending');
                case 'approved':
                    return redirect()->route('student.admission.approved');
                case 'rejected':
                    return redirect()->route('student.admission.rejected');
            }
        }

        return view('student.admission.index', [
            'student' => $student,
            'admission' => $admission
        ]);
    }
    
    public function showPendingAdmission()
    {
        $student = Auth::user()->student;
        $admission = Admission::where('user_id', $student->user_id)
                    ->where('application_status', 'Pending')
                    ->latest()
                    ->first();
                    
        if (!$admission) {
            return redirect()->route('student.admission.index');
        }
        
        return view('student.admission.pending', compact('admission', 'student'));
    }
    
    public function showApprovedAdmission()
    {
        $student = Auth::user()->student;
        $admission = Admission::where('user_id', $student->user_id)
                    ->where('application_status', 'approved')
                    ->latest()
                    ->first();
                    
        if (!$admission) {
            return redirect()->route('student.admission.index');
        }
        
        return view('student.admission.approved', compact('admission', 'student'));
    }
    
    public function showRejectedAdmission()
    {
        $student = Auth::user()->student;
        $admission = Admission::where('user_id', $student->user_id)
                    ->where('application_status', 'rejected')
                    ->latest()
                    ->first();
                    
        if (!$admission) {
            return redirect()->route('student.admission.index');
        }
        
        return view('student.admission.rejected', compact('admission', 'student'));
    }

    public function createAdmission()
    {
        $student = Auth::user()->student;
        $programs = Program::all();
        return view('student.admission.create', compact('student', 'programs'));
    }

    public function storeAdmission(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'email' => 'required|email|max:100',
            'mobile_number' => 'required|string|max:20',
            'gender' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'home_address' => 'required|string',
            'civil_status' => 'required|string|max:50',
            'citizenship' => 'required|string|max:255',
            'religion' => 'required|string|max:50',
            'father_first_name' => 'required|string|max:100',
            'father_last_name' => 'required|string|max:100',
            'father_middle_name' => 'nullable|string|max:100',
            'father_occupation' => 'required|string|max:100',
            'mother_first_name' => 'required|string|max:100',
            'mother_last_name' => 'required|string|max:100',
            'mother_middle_name' => 'nullable|string|max:100',
            'mother_occupation' => 'required|string|max:100',
            'program_id' => 'required|exists:programs,program_id',
            'last_school_attended' => 'required|string|max:150',
            'year_graduated' => 'nullable|string',
            'school_year_applied' => 'required|string|max:20',
            'age' => 'required|integer',
            'suffix_name' => 'nullable|string|max:10',
            'barangay' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'zipcode' => 'required|string|max:10',
            'disability' => 'nullable|string',
            'course_preferences' => 'required|string|max:100',
            'admission_type' => 'required|string|max:50',
            'scholarship' => 'nullable|string|max:20',
            'expected_date_of_grad' => 'nullable|string|max:100',
            'upload_requirements' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);

        $student = Auth::user()->student;
        
        $data = [
            'user_id' => $student->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'home_address' => $request->home_address,
            'civil_status' => $request->civil_status,
            'citizenship' => $request->citizenship,
            'religion' => $request->religion,
            'father_first_name' => $request->father_first_name,
            'father_last_name' => $request->father_last_name,
            'father_middle_name' => $request->father_middle_name,
            'father_occupation' => $request->father_occupation,
            'mother_first_name' => $request->mother_first_name,
            'mother_last_name' => $request->mother_last_name,
            'mother_middle_name' => $request->mother_middle_name,
            'mother_occupation' => $request->mother_occupation,
            'program_id' => $request->program_id,
            'last_school_attended' => $request->last_school_attended,
            'year_graduated' => $request->year_graduated,
            'school_year_applied' => $request->school_year_applied,
            'application_status' => 'Pending',
            'age' => $request->age,
            'suffix_name' => $request->suffix_name,
            'barangay' => $request->barangay,
            'city' => $request->city,
            'province' => $request->province,
            'zipcode' => $request->zipcode,
            'disability' => $request->disability,
            'course_preferences' => $request->course_preferences,
            'admission_type' => $request->admission_type,
            'scholarship' => $request->scholarship,
            'expected_date_of_grad' => $request->expected_date_of_grad,
        ];
        
        // Handle file upload if provided
        if ($request->hasFile('upload_requirements')) {
            $file = $request->file('upload_requirements');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('requirements', $filename, 'public');
            $data['upload_requirements'] = $path;
        }

        Admission::create($data);

        return redirect()->route('student.admission.index')->with('success', 'Admission application submitted successfully.');
    }

    public function myGrades(Request $request)
    {
        $student = Auth::user()->student;
        $semester = $request->input('semester');
        
        $gradesQuery = Grade::with(['course.program', 'instructor'])
            ->where('student_id', $student->student_id);
        
        if ($semester) {
            $gradesQuery->where('semester', $semester);
        }
        
        $grades = $gradesQuery->get()->groupBy('school_year');
        
        return view('student.grades.index', compact('student', 'grades'));
    }

    private function getProgramName($programId)
    {
        if (!$programId) {
            return 'Unknown Program';
        }
        
        $program = Program::find($programId);
        return $program ? $program->program_name : 'Unknown Program';
    }
}