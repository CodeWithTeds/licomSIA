<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with('instructor')
            ->where('student_id', Auth::user()->student->student_id)
            ->get();
        return view('student.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $instructors = Auth::user()->student->instructors();
        return view('student.evaluations.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|exists:instructors,instructor_id',
            'semester' => 'required|string|max:10',
            'school_year' => 'required|string|max:10',
            'comments' => 'nullable|string',
            'subject_mastery' => 'required|integer|min:1|max:5',
            'teaching_clarity' => 'required|integer|min:1|max:5',
            'student_engagement' => 'required|integer|min:1|max:5',
            'fairness_of_grading' => 'required|integer|min:1|max:5',
            'respect_for_students' => 'required|integer|min:1|max:5',
        ]);

        $ratings = [
            $request->subject_mastery,
            $request->teaching_clarity,
            $request->student_engagement,
            $request->fairness_of_grading,
            $request->respect_for_students,
        ];

        $average_rating = array_sum($ratings) / count($ratings);

        Evaluation::create([
            'student_id' => Auth::user()->student->student_id,
            'instructor_id' => $request->instructor_id,
            'semester' => $request->semester,
            'school_year' => $request->school_year,
            'comments' => $request->comments,
            'average_rating' => $average_rating,
            'subject_mastery' => $request->subject_mastery,
            'teaching_clarity' => $request->teaching_clarity,
            'student_engagement' => $request->student_engagement,
            'fairness_of_grading' => $request->fairness_of_grading,
            'respect_for_students' => $request->respect_for_students,
        ]);

        return redirect()->route('student.evaluations.index')->with('success', 'Evaluation submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
