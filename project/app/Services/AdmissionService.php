<?php

namespace App\Services;

use App\Models\Admission;
use App\Repositories\AdmissionRepository;

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
} 