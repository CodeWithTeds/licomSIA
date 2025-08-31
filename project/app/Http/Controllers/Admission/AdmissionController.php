<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdmissionRequest;
use App\Models\Admission;
use App\Models\Program;
use App\Services\AdmissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    protected $admissionService;

    public function __construct(AdmissionService $admissionService)
    {
        $this->admissionService = $admissionService;
    }

    public function index(Request $request)
    {
        $programId = $request->input('program_id');
        $admissions = $this->admissionService->getAllAdmissions($programId);
        $programs = Program::all();
        return view('admin.admissions.index', compact('admissions', 'programs'));
    }

    public function show(Admission $admission)
    {
        return view('admin.admissions.show', compact('admission'));
    }

    public function approve(Admission $admission)
    {
        try {
            $this->admissionService->approveAdmission($admission);
            return redirect()->route('admin.admissions.index')
                ->with('success', 'Admission approved successfully. Qualification email has been sent.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Admission approval failed: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            
            $errorMessage = 'Error approving admission';
            if (app()->environment('local', 'development')) {
                $errorMessage .= ': ' . $e->getMessage();
            }
            
            return redirect()->route('admin.admissions.index')
                ->with('error', $errorMessage);
        }
    }

    public function reject(Admission $admission)
    {
        $this->admissionService->rejectAdmission($admission);
        return redirect()->route('admin.admissions.index')->with('success', 'Admission rejected successfully.');
    }

    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user has an admission record
            $admission = Admission::where('user_id', $user->id)->latest()->first();
            
            if ($admission) {
                switch ($admission->application_status) {
                    case 'Pending':
                        return view('student.admission.pending', compact('admission'));
                    case 'approved':
                        return view('student.admission.approved', compact('admission'));
                    case 'rejected':
                        return view('student.admission.rejected', compact('admission'));
                }
            }
        }

        $programs = Program::all();
        return view('admission.create', compact('programs'));
    }

    public function store(AdmissionRequest $request)
    {
        $data = $request->validated();
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $this->admissionService->createAdmission($data);

        return redirect()->route('public.admission.create')->with('success', 'Admission submitted successfully!');
    }
}
