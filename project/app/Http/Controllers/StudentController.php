<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('program')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        return view('admin.students.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'admission_id' => 'required|integer|unique:students',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'contact' => 'required|string|max:20',
            'program_id' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|min:1|max:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
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
            
            // Create student record
            Student::create([
                'admission_id' => $request->admission_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'contact' => $request->contact,
                'program_id' => $request->program_id,
                'year_level' => $request->year_level,
                'status' => 'Pending',
                'profile_complete' => false,
                'user_id' => $user->id,
            ]);
            
            DB::commit();
            
            return redirect()->route('students.index')
                ->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $programs = Program::all();
        return view('admin.students.edit', compact('student', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'admission_id' => 'required|integer|unique:students,admission_id,' . $student->student_id . ',student_id',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'contact' => 'required|string|max:20',
            'program_id' => 'required|exists:programs,program_id',
            'year_level' => 'required|integer|min:1|max:5',
            'status' => 'required|in:Pending,Enrolled,Dropped,Graduated',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();
        
        try {
            // Delete the user account associated with this student
            if ($student->user) {
                $student->user->delete();
            }
            
            // Delete the student record
            $student->delete();
            
            DB::commit();
            
            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }

    /**
     * Student profile page
     */
    public function profile()
    {
        $student = Auth::user()->student;
        return view('student.profile', compact('student'));
    }

    /**
     * Update student profile
     */
    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student;
        
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'contact' => 'required|string|max:20',
        ]);

        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'contact' => $request->contact,
            'profile_complete' => true,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
} 