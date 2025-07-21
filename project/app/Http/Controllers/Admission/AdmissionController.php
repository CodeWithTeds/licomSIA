<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdmissionRequest;
use App\Services\AdmissionService;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    protected $admissionService;

    public function __construct(AdmissionService $admissionService)
    {
        $this->admissionService = $admissionService;
    }

    public function create()
    {
        return view('student.admission.index');
    }

    public function store(AdmissionRequest $request)
    {
        $this->admissionService->createAdmission($request->validated());

        return redirect()->route('admission.create')->with('success', 'Admission submitted successfully!');
    }
}
