<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdmissionRequest;
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

    public function create()
    {
        if (Auth::check()) {
            $pendingAdmission = Auth::user()->admissions()->where('application_status', 'Pending')->first();
            if ($pendingAdmission) {
                return view('student.admission.pending', compact('pendingAdmission'));
            }
        }

        $programs = Program::all();
        return view('student.admission.index', compact('programs'));
    }

    public function store(AdmissionRequest $request)
    {
        $data = $request->validated();
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        $this->admissionService->createAdmission($data);

        return redirect()->route('admission.create')->with('success', 'Admission submitted successfully!');
    }
}
