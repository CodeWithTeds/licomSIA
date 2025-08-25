<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Program;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class EnrollmentController extends Controller
{
    protected $enrollmentService;
    
    public function __construct(EnrollmentService $enrollmentService)
    {
        $this->enrollmentService = $enrollmentService;
        
    }
    
    public function index(Request $request): View
    {
        $programId = $request->input('program_id');
        $yearLevel = $request->input('year_level');
        $status = $request->input('status');
        
        $enrollments = $this->enrollmentService->getAllEnrollments($programId, $yearLevel, $status);
        $programs = Program::all();
        
        return view('admin.enrollments.index', compact('enrollments', 'programs'));
    }
    
    public function pending(): View
    {
        $enrollments = $this->enrollmentService->getPendingEnrollments();
        return view('admin.enrollments.pending', compact('enrollments'));
    }
    
    public function show(Enrollment $enrollment): View
    {
        $enrollment->load(['student', 'student.program', 'enrollmentCourses.course']);
        return view('admin.enrollments.show', compact('enrollment'));
    }
    
    public function approve(Enrollment $enrollment): RedirectResponse
    {
        $this->enrollmentService->approveEnrollment($enrollment);
        return redirect()->route('admin.enrollments.index')
            ->with('success', 'Enrollment approved successfully.');
    }
}