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
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string',
        ]);

        Evaluation::create([
            'student_id' => Auth::user()->student->student_id,
            'instructor_id' => $request->instructor_id,
            'semester' => $request->semester,
            'school_year' => $request->school_year,
            'rating' => $request->rating,
            'comments' => $request->comments,
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
