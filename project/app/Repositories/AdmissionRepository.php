<?php

namespace App\Repositories;

use App\Models\Admission;
use Illuminate\Support\Facades\Hash;

class AdmissionRepository
{
    public function create(array $data): Admission
    {
        return Admission::create($data);
    }
} 