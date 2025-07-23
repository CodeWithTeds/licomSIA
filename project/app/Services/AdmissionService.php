<?php

namespace App\Services;

use App\Models\Admission;
use App\Models\Student;
use App\Models\User;
use App\Repositories\AdmissionRepository;
use Illuminate\Support\Facades\Hash;

class AdmissionService
{
    protected $admissionRepository;

    public function __construct(AdmissionRepository $admissionRepository)
    {
        $this->admissionRepository = $admissionRepository;
    }

    public function createAdmission(array $data): Admission
    {
        return $this->admissionRepository->create($data);
    }

    public function getAllAdmissions()
    {
        return $this->admissionRepository->getAll();
    }

    public function approveAdmission(Admission $admission)
    {
        $admission->application_status = 'approved';
        $admission->save();

        // Create a new user
        $user = User::create([
            'name' => $admission->first_name . ' ' . $admission->last_name,
            'email' => $admission->email,
            'password' => Hash::make('password'), // Or a randomly generated password
            'role' => 'student',
        ]);

        // Generate a unique student number
        $studentNumber = date('Y') . '-' . str_pad($admission->admission_id, 4, '0', STR_PAD_LEFT);

        // Create a new student record
        Student::create([
            'user_id' => $user->id,
            'student_number' => $studentNumber,
            'first_name' => $admission->first_name,
            'last_name' => $admission->last_name,
            'email' => $admission->email,
            'program_id' => $admission->program_id,
            'year_level' => 1, // Default to 1st year
        ]);

        return $admission;
    }

    public function rejectAdmission(Admission $admission)
    {
        $admission->application_status = 'rejected';
        $admission->save();

        return $admission;
    }
} 