<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'course', 'instructor'])->paginate(10);
        return view('admin.grades.index', compact('grades'));
    }

    public function show(Student $student)
    {
        $grades = Grade::with(['course', 'instructor'])
            ->where('student_id', $student->student_id)
            ->get();
        return view('admin.grades.show', compact('student', 'grades'));
    }
}
