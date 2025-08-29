<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function deansList(Request $request)
    {
        // Compute per-student average from grades.computed_grade
        $students = Student::with(['program'])
            ->get()
            ->map(function ($student) {
                $grades = Grade::where('student_id', $student->student_id)->pluck('computed_grade')->filter();
                $average = $grades->count() ? round($grades->avg(), 2) : null;
                $isDeansList = $average !== null && $average >= 92;
                $status = $average !== null && $average >= 75 ? 'Passed' : 'Failed';

                return (object) [
                    'student' => $student,
                    'average' => $average,
                    'isDeansList' => $isDeansList,
                    'status' => $status,
                ];
            });

        $passed = $students->filter(fn ($s) => $s->status === 'Passed')->values();
        $failed = $students->filter(fn ($s) => $s->status === 'Failed')->values();

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.reports.deans_list_pdf', compact('passed', 'failed'));
            return $pdf->download('deans-list-report.pdf');
        }

        return view('admin.reports.deans_list', compact('passed', 'failed'));
    }
}


