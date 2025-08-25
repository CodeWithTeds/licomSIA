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

    public function getAll($programId = null)
    {
        $query = Admission::with('program')->latest();
        
        if ($programId) {
            $query->where('program_id', $programId);
        }
        
        return $query->get();
    }
} 