<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'course'])->where('instructor_id', Auth::guard('instructor')->id())->get();
        return view('teacher.grades.index', compact('grades'));
    }

    public function create()
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $students = $instructor->students()->get();
        $courses = $instructor->courses()->get();

        $studentCourseMap = [];
        foreach ($students as $student) {
            $enrolledCourseIds = $student->enrollments()->with('courses')->get()->pluck('courses')->flatten()->pluck('course_id');
            $studentCourseMap[$student->student_id] = $enrolledCourseIds->intersect($courses->pluck('course_id'))->values();
        }

        return view('teacher.grades.create', compact('students', 'courses', 'studentCourseMap'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'prelim_grade' => 'nullable|numeric|min:0|max:100',
            'midterm_grade' => 'nullable|numeric|min:0|max:100',
            'final_grade' => 'nullable|numeric|min:0|max:100',
        ]);

        $computed_grade = ($request->prelim_grade * 0.3) + ($request->midterm_grade * 0.3) + ($request->final_grade * 0.4);
        $remarks = $computed_grade >= 75 ? 'Passed' : 'Failed';

        Grade::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'instructor_id' => Auth::guard('instructor')->id(),
            'prelim_grade' => $request->prelim_grade,
            'midterm_grade' => $request->midterm_grade,
            'final_grade' => $request->final_grade,
            'computed_grade' => $computed_grade,
            'remarks' => $remarks,
        ]);

        return redirect()->route('teacher.grades.index')->with('success', 'Grade added successfully.');
    }

    public function edit(Grade $grade)
    {
        /** @var \App\Models\Instructor $instructor */
        $instructor = Auth::guard('instructor')->user();
        $students = $instructor->students()->get();
        $courses = $instructor->courses()->get();

        $studentCourseMap = [];
        foreach ($students as $student) {
            $enrolledCourseIds = $student->enrollments()->with('courses')->get()->pluck('courses')->flatten()->pluck('course_id');
            $studentCourseMap[$student->student_id] = $enrolledCourseIds->intersect($courses->pluck('course_id'))->values();
        }

        return view('teacher.grades.edit', compact('grade', 'students', 'courses', 'studentCourseMap'));
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,course_id',
            'prelim_grade' => 'nullable|numeric|min:0|max:100',
            'midterm_grade' => 'nullable|numeric|min:0|max:100',
            'final_grade' => 'nullable|numeric|min:0|max:100',
        ]);

        $computed_grade = ($request->prelim_grade * 0.3) + ($request->midterm_grade * 0.3) + ($request->final_grade * 0.4);
        $remarks = $computed_grade >= 75 ? 'Passed' : 'Failed';

        $grade->update([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'prelim_grade' => $request->prelim_grade,
            'midterm_grade' => $request->midterm_grade,
            'final_grade' => $request->final_grade,
            'computed_grade' => $computed_grade,
            'remarks' => $remarks,
        ]);

        return redirect()->route('teacher.grades.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('teacher.grades.index')->with('success', 'Grade deleted successfully.');
    }
}
